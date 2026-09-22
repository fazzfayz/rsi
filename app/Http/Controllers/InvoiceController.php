<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Client;
use App\Models\PurchaseOrder;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Invoice::with(['client', 'signer']);

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $invoices = $query->latest()->paginate(10);

        return view('dashboard.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::where('status', 'active')
            ->with(['purchaseOrders' => function ($q) {
                $q->orderByDesc('po_date')->orderByDesc('id');
            }])
            ->get();
        $employees = Employee::where('status', 'active')->get();
        
        return view('dashboard.invoices.create', compact('clients', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'signer_id' => 'required|exists:employees,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'vendor_code' => 'nullable|string|max:255',
            'po_ref_number' => 'nullable|string|max:255',
            'attention_to' => 'nullable|string|max:255',
            'attention_name' => 'nullable|string',
            'include_ppn' => 'boolean',
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            $data['invoice_number'] = Invoice::generateInvoiceNumber();

            $invoice = Invoice::create($data);

            // Create invoice items
            foreach ($request->items as $itemData) {
                $item = new InvoiceItem($itemData);
                $item->calculateTotal();
                $invoice->items()->save($item);
            }

            // Calculate totals
            $invoice->calculateTotals();

            // Generate PDF automatically
            $this->generatePdfForInvoice($invoice);

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dibuat dan PDF telah dibuat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::with(['client', 'signer', 'items'])->findOrFail($id);
        return view('dashboard.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::with(['items'])->findOrFail($id);
        $clients = Client::where('status', 'active')
            ->with(['purchaseOrders' => function ($q) {
                $q->orderByDesc('po_date')->orderByDesc('id');
            }])
            ->get();
        $employees = Employee::where('status', 'active')->get();
        
        return view('dashboard.invoices.edit', compact('invoice', 'clients', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'signer_id' => 'required|exists:employees,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'vendor_code' => 'nullable|string|max:255',
            'po_ref_number' => 'nullable|string|max:255',
            'attention_to' => 'nullable|string|max:255',
            'attention_name' => 'nullable|string',
            'include_ppn' => 'boolean',
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            $invoice = Invoice::findOrFail($id);
            $invoice->update($request->except('items'));

            // Delete existing items
            $invoice->items()->delete();

            // Create new invoice items
            foreach ($request->items as $itemData) {
                $item = new InvoiceItem($itemData);
                $item->calculateTotal();
                $invoice->items()->save($item);
            }

            // Calculate totals
            $invoice->calculateTotals();

            // Delete old PDF if exists
            if ($invoice->pdf_path && file_exists(public_path($invoice->pdf_path))) {
                unlink(public_path($invoice->pdf_path));
            }

            // Generate new PDF
            $this->generatePdfForInvoice($invoice);

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice berhasil diperbarui dan PDF baru telah dibuat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            
            // Delete PDF file if exists
            if ($invoice->pdf_path && file_exists(public_path($invoice->pdf_path))) {
                unlink(public_path($invoice->pdf_path));
            }
            
            $invoice->delete();
            
            return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Generate PDF for invoice
     */
    public function generatePdf(string $id)
    {
        $invoice = Invoice::with(['client', 'signer', 'items'])->findOrFail($id);
        
        // Ensure storage directory exists
        $this->ensureStorageDirectoryExists();
        
        // Load the PDF view
        $pdf = Pdf::loadView('dashboard.invoices.pdf', compact('invoice'));
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Generate filename
        $filename = 'invoice_' . str_replace('/', '_', $invoice->invoice_number) . '.pdf';
        
        // Save PDF to storage
        $pdfPath = 'storage/invoices/' . $filename;
        $pdf->save(public_path($pdfPath));
        
        // Update invoice with PDF path
        $invoice->update(['pdf_path' => $pdfPath]);
        
        // Download the PDF
        return $pdf->download($filename);
    }

    /**
     * Generate PDF for invoice (internal method)
     */
    private function generatePdfForInvoice(Invoice $invoice)
    {
        // Load the invoice with relationships
        $invoice->load(['client', 'signer', 'items']);
        
        // Ensure storage directory exists
        $this->ensureStorageDirectoryExists();
        
        // Load the PDF view
        $pdf = Pdf::loadView('dashboard.invoices.pdf', compact('invoice'));
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Generate filename
        $filename = 'invoice_' . str_replace('/', '_', $invoice->invoice_number) . '.pdf';
        
        // Save PDF to storage
        $pdfPath = 'storage/invoices/' . $filename;
        $pdf->save(public_path($pdfPath));
        
        // Update invoice with PDF path
        $invoice->update(['pdf_path' => $pdfPath]);
    }

    /**
     * Ensure storage directory exists
     */
    private function ensureStorageDirectoryExists()
    {
        $storagePath = public_path('storage/invoices');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }
    }

    /**
     * Download existing PDF
     */
    public function downloadPdf(string $id)
    {
        $invoice = Invoice::with(['client', 'signer', 'items'])->findOrFail($id);
        
        if (!$invoice->pdf_path || !file_exists(public_path($invoice->pdf_path))) {
            return back()->with('error', 'File PDF tidak ditemukan!');
        }
        
        return response()->download(public_path($invoice->pdf_path));
    }
}
