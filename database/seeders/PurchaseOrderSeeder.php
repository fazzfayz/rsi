<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Client;
use App\Models\Employee;
use App\Models\User;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get sample data
        $client = Client::first();
        $employee = Employee::first();
        $user = User::first();

        if (!$client || !$employee || !$user) {
            $this->command->error('Sample data tidak ditemukan. Pastikan Client, Employee, dan User sudah ada.');
            return;
        }

        // Create sample PO
        $po = PurchaseOrder::create([
            'po_number' => '001/RSI.PO/01/2025',
            'po_date' => now(),
            'ref_number' => 'REF-001',
            'vendor_id' => $client->id,
            'vendor_name' => $client->name,
            'vendor_address' => $client->address,
            'vendor_email' => $client->email,
            'vendor_contact_person' => $client->phone,
            'ship_to_company' => 'PT. RSI',
            'ship_to_address' => 'Jl. Contoh No. 123, Jakarta',
            'attention_to' => 'Purchasing Department',
            'attention_name' => 'John Doe',
            'signatory_employee_id' => $employee->id,
            'notes' => 'Sample Purchase Order untuk testing',
            'subtotal' => 0,
            'vat_amount' => 0,
            'total_amount' => 0,
            'status' => 'draft',
            'created_by' => $user->id,
        ]);

        // Create sample items
        $items = [
            [
                'description' => 'Laptop Dell Inspiron 15',
                'part_number' => 'DELL-INS15-001',
                'quantity' => 2,
                'uom' => 'UNIT',
                'unit_price' => 15000000,
            ],
            [
                'description' => 'Mouse Wireless Logitech',
                'part_number' => 'LOG-MOU-001',
                'quantity' => 5,
                'uom' => 'PCS',
                'unit_price' => 250000,
            ],
            [
                'description' => 'Keyboard Mechanical',
                'part_number' => 'KB-MECH-001',
                'quantity' => 3,
                'uom' => 'PCS',
                'unit_price' => 800000,
            ],
        ];

        foreach ($items as $itemData) {
            $totalPrice = $itemData['quantity'] * $itemData['unit_price'];
            
            PurchaseOrderItem::create([
                'purchase_order_id' => $po->id,
                'description' => $itemData['description'],
                'part_number' => $itemData['part_number'],
                'quantity' => $itemData['quantity'],
                'uom' => $itemData['uom'],
                'unit_price' => $itemData['unit_price'],
                'total_price' => $totalPrice,
            ]);
        }

        // Calculate totals
        $po->calculateTotals();

        $this->command->info('Sample Purchase Order berhasil dibuat dengan ID: ' . $po->id);
    }
} 