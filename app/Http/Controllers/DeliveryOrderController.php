<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderItem;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DeliveryOrderController extends Controller
{
    /**
     * Menampilkan daftar surat jalan
     */
    public function index(Request $request)
    {
        $query = DeliveryOrder::with(['client', 'items']);

        // Filter Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('do_number', 'like', "%{$search}%")
                    ->orWhere('driver_name', 'like', "%{$search}%")
                    ->orWhere('vehicle_no', 'like', "%{$search}%")
                    ->orWhere('shipping_address', 'like', "%{$search}%")
                    ->orWhereHas('client', function ($qc) use ($search) {
                        $qc->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Fixed: 10 surat jalan per halaman
        //
        // Kebutuhan:
        // - Setiap halaman selalu "terkunci" isinya 10 data (data baru tidak menggeser halaman 1, dst).
        // - Di dalam halaman, urutan tampil tetap terbaru (berdasarkan tanggal kirim).
        //
        // Cara:
        // - Pembagian halaman: berdasarkan urutan input (id ASC) => stabil, data baru selalu masuk halaman terakhir/berikutnya.
        // - Urutan tampil: sort koleksi di halaman saat ini berdasarkan delivery_date DESC.
        $deliveryOrders = $query->orderBy('id', 'asc')->paginate(10)->withQueryString();
        $deliveryOrders->setCollection(
            $deliveryOrders->getCollection()
                ->sortByDesc(fn ($do) => $do->delivery_date)
                ->values()
        );

        return view('dashboard.suratjalan.index', compact('deliveryOrders'));
    }

    /**
     * Preview nomor DO untuk tanggal tertentu (AJAX).
     */
    public function previewDoNumber(Request $request)
    {
        $date = $request->query('date', date('Y-m-d'));
        $doNumber = DeliveryOrder::generateDoNumber($date);
        return response()->json(['do_number' => $doNumber]);
    }

    /**
     * Form buat surat jalan baru
     */
    public function create()
    {
        $clients = Client::where('status', 'active')->get();
        $employees = Employee::where('status', 'active')->get();
        $deliveryDate = old('delivery_date', date('Y-m-d'));
        $doNumber = DeliveryOrder::generateDoNumber($deliveryDate);
        return view('dashboard.suratjalan.create', compact('clients', 'employees', 'doNumber'));
    }

    /**
     * Simpan data ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'do_number' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'delivery_date' => 'required|date',
            'carrier_employee_id' => 'required|exists:employees,id',
            'signer_employee_id' => 'required|exists:employees,id',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.po_number' => 'nullable|string',
            'items.*.unit' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Get client data
            $client = Client::findOrFail($request->client_id);

            // 1. Generate Nomor Surat Jalan Otomatis berdasarkan tanggal pengiriman (format: {no}/DO-RSI/{bulan_romawi}/{tahun})
            $doNumber = DeliveryOrder::generateDoNumber($request->delivery_date);

            // 2. Simpan Header
            $do = DeliveryOrder::create([
                'do_number' => $doNumber,
                'client_id' => $request->client_id,
                'delivery_date' => $request->delivery_date,
                'carrier_employee_id' => $request->carrier_employee_id,
                'signer_employee_id' => $request->signer_employee_id,
                'receiver_name' => null, // Kosongkan, akan diisi di PDF
                'shipping_address' => $request->shipping_address ?: $client->address,
                'attention_to' => $client->contact_person ?? $client->name,
                'notes' => $request->notes,
            ]);

            // 3. Simpan Item-itemnya
            foreach ($request->items as $item) {
                DeliveryOrderItem::create([
                    'delivery_order_id' => $do->id,
                    'name' => $item['name'],
                    'po_number' => $item['po_number'] ?? null,
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'] ?? 'Pcs',
                ]);
            }

            DB::commit();
            return redirect()->route('delivery-orders.show', $do->id)
                             ->with('success', 'Surat Jalan berhasil dibuat dengan nomor ' . $doNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Detail surat jalan
     */
    public function show($id)
    {
        $deliveryOrder = DeliveryOrder::with(['client', 'items', 'carrierEmployee', 'signerEmployee'])->findOrFail($id);
        return view('dashboard.suratjalan.show', compact('deliveryOrder'));
    }

    /**
     * Form edit data
     */
    public function edit($id)
    {
        $deliveryOrder = DeliveryOrder::with('items')->findOrFail($id);
        $clients = Client::where('status', 'active')->get();
        $employees = Employee::where('status', 'active')->get();
        return view('dashboard.suratjalan.edit', compact('deliveryOrder', 'clients', 'employees'));
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $do = DeliveryOrder::findOrFail($id);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'delivery_date' => 'required|date',
            'carrier_employee_id' => 'required|exists:employees,id',
            'signer_employee_id' => 'required|exists:employees,id',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.po_number' => 'nullable|string',
            'items.*.unit' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Get client data
            $client = Client::findOrFail($request->client_id);

            // Update Header
            $do->update([
                'client_id' => $request->client_id,
                'delivery_date' => $request->delivery_date,
                'carrier_employee_id' => $request->carrier_employee_id,
                'signer_employee_id' => $request->signer_employee_id,
                'shipping_address' => $request->shipping_address ?: $client->address,
                'attention_to' => $client->contact_person ?? $client->name,
                'notes' => $request->notes,
            ]);

            // Hapus item lama dan simpan yang baru (Sync)
            $do->items()->delete();
            foreach ($request->items as $item) {
                DeliveryOrderItem::create([
                    'delivery_order_id' => $do->id,
                    'name' => $item['name'],
                    'po_number' => $item['po_number'] ?? null,
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'] ?? 'Pcs',
                ]);
            }

            DB::commit();
            return redirect()->route('delivery-orders.show', $do->id)
                             ->with('success', 'Surat Jalan berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data.');
        }
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $do = DeliveryOrder::findOrFail($id);
        
        // Hapus file PDF jika ada
        if ($do->pdf_path) {
            Storage::disk('public')->delete($do->pdf_path);
        }

        $do->delete(); // Ini otomatis menghapus items jika menggunakan cascade di DB
        return redirect()->route('delivery-orders.index')->with('success', 'Surat Jalan dihapus.');
    }

    /**
     * Generate & Simpan PDF
     */
    public function generatePdf($id)
    {
        $deliveryOrder = DeliveryOrder::with(['client', 'items', 'carrierEmployee', 'signerEmployee'])->findOrFail($id);
        
        $pdf = Pdf::loadView('dashboard.suratjalan.pdf', compact('deliveryOrder'));
        
        $fileName = 'SJ-' . str_replace('/', '-', $deliveryOrder->do_number) . '.pdf';
        $filePath = 'pdfs/delivery-orders/' . $fileName;
        
        // Simpan ke storage
        Storage::disk('public')->put($filePath, $pdf->output());
        
        // Update path di database
        $deliveryOrder->update(['pdf_path' => $filePath]);

        return back()->with('success', 'PDF berhasil dibuat.');
    }

    /**
     * Download PDF
     */
    public function downloadPdf($id)
    {
        $do = DeliveryOrder::findOrFail($id);
        if (!$do->pdf_path || !Storage::disk('public')->exists($do->pdf_path)) {
            return back()->with('error', 'File PDF tidak ditemukan.');
        }

        return Storage::disk('public')->download($do->pdf_path);
    }
}
