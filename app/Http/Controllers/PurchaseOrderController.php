<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $purchaseOrders = PurchaseOrder::with(['vendor', 'signatoryEmployee'])
            ->when($search, function($query) use ($search) {
                $query->search($search);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.purchase-orders.index', compact('purchaseOrders', 'search'));
    }

    public function create()
    {
        $clients = Client::where('status', 'active')->get();
        $employees = Employee::where('status', 'active')->get();
        $poNumber = PurchaseOrder::generatePoNumber();
        $signatoryNaniHadijah = Employee::where('name', 'like', '%Nani Hadijah%')->first();
        
        return view('dashboard.purchase-orders.create', compact('clients', 'employees', 'poNumber', 'signatoryNaniHadijah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'po_number' => 'required|unique:purchase_orders,po_number',
            'po_date' => 'required|date',
            'ref_number' => 'nullable|string',
            'vendor_id' => 'required|exists:clients,id',
            'ship_to_company' => 'required|string',
            'ship_to_address' => 'required|string',
            'attention_to' => 'nullable|string',
            'attention_name' => 'nullable|string',
            'signatory_employee_id' => 'nullable|exists:employees,id',
            'notes' => 'nullable|string',
            'terms' => 'nullable|array',
            'terms.*' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.part_number' => 'nullable|string',
            'items.*.item_type' => 'nullable|string|in:hardware,service',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.uom' => 'required|string',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Get vendor data
            $vendor = Client::findOrFail($request->vendor_id);

            // Penandatangan tetap Nani Hadijah
            $signatoryId = $request->signatory_employee_id
                ?: Employee::where('name', 'like', '%Nani Hadijah%')->first()?->id;

            // Create PO
            $purchaseOrder = PurchaseOrder::create([
                'po_number' => $request->po_number,
                'po_date' => $request->po_date,
                'ref_number' => $request->ref_number,
                'vendor_id' => $request->vendor_id,
                'vendor_name' => $vendor->name,
                'vendor_address' => $vendor->address,
                'vendor_email' => $vendor->email,
                'vendor_contact_person' => $vendor->contact_person ?? $vendor->phone,
                'ship_to_company' => $request->ship_to_company,
                'ship_to_address' => $request->ship_to_address,
                'attention_to' => $request->attention_to,
                'attention_name' => $request->attention_name,
                'signatory_employee_id' => $signatoryId,
                'notes' => $request->notes,
                'terms' => array_values(array_filter($request->terms ?? [])),
                'subtotal' => 0,
                'vat_amount' => 0,
                'total_amount' => 0,
                'status' => 'draft',
                'created_by' => auth()->id(),
            ]);

            // Create PO items
            foreach ($request->items as $item) {
                // Ensure quantity and unit_price are numeric
                $quantity = (float) $item['quantity'];
                $unitPrice = (float) $item['unit_price'];
                
                // Calculate total price: Total = Quantity × Unit Price
                $totalPrice = round($quantity * $unitPrice, 2);
                
                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'item_type' => $item['item_type'] ?? 'hardware',
                    'description' => $item['description'],
                    'part_number' => $item['part_number'] ?? null,
                    'quantity' => $quantity,
                    'uom' => $item['uom'],
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                ]);
            }

            // Reload items relationship and calculate totals
            $purchaseOrder->load('items');
            $purchaseOrder->calculateTotals();

            DB::commit();

            return redirect()->route('purchase-orders.index')
                ->with('success', 'Purchase Order berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load(['vendor', 'items', 'signatoryEmployee', 'createdBy']);
        
        return view('dashboard.purchase-orders.show', compact('purchaseOrder'));
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        $clients = Client::where('status', 'active')->get();
        $employees = Employee::where('status', 'active')->get();
        $purchaseOrder->load('items');
        $signatoryNaniHadijah = Employee::where('name', 'like', '%Nani Hadijah%')->first();
        
        return view('dashboard.purchase-orders.edit', compact('purchaseOrder', 'clients', 'employees', 'signatoryNaniHadijah'));
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $request->validate([
            'po_number' => 'required|unique:purchase_orders,po_number,' . $purchaseOrder->id,
            'po_date' => 'required|date',
            'ref_number' => 'nullable|string',
            'vendor_id' => 'required|exists:clients,id',
            'ship_to_company' => 'required|string',
            'ship_to_address' => 'required|string',
            'attention_to' => 'nullable|string',
            'attention_name' => 'nullable|string',
            'signatory_employee_id' => 'nullable|exists:employees,id',
            'notes' => 'nullable|string',
            'terms' => 'nullable|array',
            'terms.*' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.part_number' => 'nullable|string',
            'items.*.item_type' => 'nullable|string|in:hardware,service',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.uom' => 'required|string',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Get vendor data
            $vendor = Client::findOrFail($request->vendor_id);

            // Penandatangan tetap Nani Hadijah
            $signatoryId = $request->signatory_employee_id
                ?: Employee::where('name', 'like', '%Nani Hadijah%')->first()?->id;

            // Update PO
            $purchaseOrder->update([
                'po_number' => $request->po_number,
                'po_date' => $request->po_date,
                'ref_number' => $request->ref_number,
                'vendor_id' => $request->vendor_id,
                'vendor_name' => $vendor->name,
                'vendor_address' => $vendor->address,
                'vendor_email' => $vendor->email,
                'vendor_contact_person' => $vendor->contact_person ?? $vendor->phone,
                'ship_to_company' => $request->ship_to_company,
                'ship_to_address' => $request->ship_to_address,
                'attention_to' => $request->attention_to,
                'attention_name' => $request->attention_name,
                'signatory_employee_id' => $signatoryId,
                'notes' => $request->notes,
                'terms' => array_values(array_filter($request->terms ?? [])),
            ]);

            // Delete existing items
            $purchaseOrder->items()->delete();

            // Create new PO items
            foreach ($request->items as $item) {
                // Ensure quantity and unit_price are numeric
                $quantity = (float) $item['quantity'];
                $unitPrice = (float) $item['unit_price'];
                
                // Calculate total price: Total = Quantity × Unit Price
                $totalPrice = round($quantity * $unitPrice, 2);
                
                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'item_type' => $item['item_type'] ?? 'hardware',
                    'description' => $item['description'],
                    'part_number' => $item['part_number'] ?? null,
                    'quantity' => $quantity,
                    'uom' => $item['uom'],
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                ]);
            }

            // Reload items relationship and calculate totals
            $purchaseOrder->load('items');
            $purchaseOrder->calculateTotals();

            DB::commit();

            return redirect()->route('purchase-orders.index')
                ->with('success', 'Purchase Order berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        try {
            $purchaseOrder->delete();
            return redirect()->route('purchase-orders.index')
                ->with('success', 'Purchase Order berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pdf(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load(['vendor', 'items', 'signatoryEmployee', 'createdBy']);
        
        $pdf = Pdf::loadView('dashboard.purchase-orders.pdf', compact('purchaseOrder'));
        
        $san = function ($s) { return preg_replace('/[\/\\\\:*?"<>|]/', '-', (string) $s); };
        $filename = $san($purchaseOrder->po_number ?? 'PO') . ' - ' . $san($purchaseOrder->vendor_name ?? '') . ' - POS Galia.pdf';
        return $pdf->download($filename);
    }

    public function getVendorData(Request $request)
    {
        $vendor = Client::find($request->vendor_id);
        
        if (!$vendor) {
            return response()->json(['error' => 'Vendor tidak ditemukan'], 404);
        }

        return response()->json([
            'name' => $vendor->name,
            'address' => $vendor->address,
            'email' => $vendor->email,
            'contact_person' => $vendor->contact_person ?? $vendor->phone,
        ]);
    }
} 