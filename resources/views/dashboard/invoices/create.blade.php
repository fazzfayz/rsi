@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Buat Invoice Baru</h2>
                    <a href="{{ route('invoices.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm">
                    @csrf
                    
                    <!-- Invoice Header -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">Client *</label>
                            <select name="client_id" id="client_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Client</option>
                                @foreach($clients as $client)
                                    @php
                                        $latestPo = $client->purchaseOrders->first();
                                    @endphp
                                    <option value="{{ $client->id }}"
                                            data-contact-person="{{ e($client->contact_person ?? '') }}"
                                            data-jabatan="{{ e($client->jabatan ?? '') }}"
                                            data-po-ref="{{ e(optional($latestPo)->ref_number ?? '') }}"
                                            {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="signer_id" class="block text-sm font-medium text-gray-700 mb-2">Penandatangan *</label>
                            <select name="signer_id" id="signer_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Penandatangan</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('signer_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }} - {{ $employee->position }}
                                    </option>
                                @endforeach
                            </select>
                            @error('signer_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Invoice Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="invoice_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Invoice *</label>
                            <input type="date" name="invoice_date" id="invoice_date" value="{{ old('invoice_date', date('Y-m-d')) }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('invoice_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Jatuh Tempo *</label>
                            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+30 days'))) }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('due_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="vendor_code" class="block text-sm font-medium text-gray-700 mb-2">Kode Vendor</label>
                            <input type="text" name="vendor_code" id="vendor_code" value="{{ old('vendor_code') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Contoh: DTSIR">
                            @error('vendor_code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="po_ref_number" class="block text-sm font-medium text-gray-700 mb-2">PO Ref Number</label>
                            <input type="text" name="po_ref_number" id="po_ref_number" value="{{ old('po_ref_number') }}"
                                   readonly
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700 cursor-not-allowed"
                                   placeholder="Pilih client untuk mengisi otomatis">
                            @error('po_ref_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Attention To -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="attention_to" class="block text-sm font-medium text-gray-700 mb-2">Attention To</label>
                            <input type="text" name="attention_to" id="attention_to" value="{{ old('attention_to') }}" placeholder="Contoh: Devi Santosa"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('attention_to')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="attention_name" class="block text-sm font-medium text-gray-700 mb-2">Jabatan Attention</label>
                            <input type="text" name="attention_name" id="attention_name" value="{{ old('attention_name') }}" placeholder="Contoh: Manager Operasional"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('attention_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- PPN and Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">PPN</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="include_ppn" id="include_ppn" value="1" {{ old('include_ppn') ? 'checked' : '' }} 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="include_ppn" class="ml-2 text-sm text-gray-700">Include PPN 12%</label>
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select name="status" id="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="sent" {{ old('status') == 'sent' ? 'selected' : '' }}>Terkirim</option>
                                <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Dibayar</option>
                                <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>Terlambat</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Invoice Items -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Item Invoice</h3>
                            <button type="button" id="addItem" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 shadow-sm font-medium border border-green-700" style="background-color: #22c55e;">
                                <i class="fas fa-plus mr-2"></i>Tambah Item
                            </button>
                        </div>

                        <div id="itemsContainer">
                            <div class="item-row bg-gray-50 p-4 rounded-lg mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi *</label>
                                        <input type="text" name="items[0][description]" required 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               placeholder="Contoh: HDD CCTV 2TB + Kamera">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                                        <input type="number" name="items[0][quantity]" min="1" value="1" required 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                                                            <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Satuan *</label>
                                            <input type="number" name="items[0][unit_price]" min="0" step="1" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                   placeholder="0">
                                        </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Total</label>
                                        <input type="text" readonly class="item-total w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                                    </div>
                                </div>
                                <button type="button" class="remove-item mt-2 px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700 shadow-sm font-medium border border-red-700">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Totals -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subtotal</label>
                                <input type="text" id="subtotal" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">PPN 12%</label>
                                <input type="text" id="ppn" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Total</label>
                                <input type="text" id="total" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 font-bold">
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <textarea name="notes" id="notes" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('invoices.index') }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 bg-white shadow-sm font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 shadow-sm font-medium border border-blue-600">
                            <i class="fas fa-save mr-2"></i>Buat Invoice
                        </button>
                    </div>
                    
                    <!-- Info Message -->
                    <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    <strong>Catatan:</strong> Setelah invoice dibuat, PDF akan otomatis dibuat dengan data yang telah diisi.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let itemIndex = 1;

document.getElementById('addItem').addEventListener('click', function() {
    const container = document.getElementById('itemsContainer');
    const newItem = document.createElement('div');
    newItem.className = 'item-row bg-gray-50 p-4 rounded-lg mb-4';
    newItem.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi *</label>
                <input type="text" name="items[${itemIndex}][description]" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Contoh: HDD CCTV 2TB + Kamera">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Quantity *</label>
                <input type="number" name="items[${itemIndex}][quantity]" min="1" value="1" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga Satuan *</label>
                <input type="number" name="items[${itemIndex}][unit_price]" min="0" step="1" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="0">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Total</label>
                <input type="text" readonly class="item-total w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
            </div>
        </div>
        <button type="button" class="remove-item mt-2 px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700 shadow-sm font-medium border border-red-700">
            <i class="fas fa-trash mr-1"></i>Hapus
        </button>
    `;
    container.appendChild(newItem);
    itemIndex++;
    
    // Add event listeners to new item
    addItemEventListeners(newItem);
});

// Add event listeners to item inputs
function addItemEventListeners(itemRow) {
    const quantityInput = itemRow.querySelector('input[name*="[quantity]"]');
    const unitPriceInput = itemRow.querySelector('input[name*="[unit_price]"]');
    const totalInput = itemRow.querySelector('.item-total');
    const removeButton = itemRow.querySelector('.remove-item');
    
    function calculateItemTotal() {
        const quantity = parseInt(quantityInput.value) || 0;
        const unitPrice = parseInt(unitPriceInput.value) || 0;
        const total = quantity * unitPrice;
        totalInput.value = formatNumber(total);
        calculateTotals();
    }
    
    quantityInput.addEventListener('input', calculateItemTotal);
    unitPriceInput.addEventListener('input', calculateItemTotal);
    
    removeButton.addEventListener('click', function() {
        itemRow.remove();
        calculateTotals();
    });
}

// Calculate totals
function calculateTotals() {
    let subtotal = 0;
    document.querySelectorAll('.item-total').forEach(input => {
        subtotal += parseInt(input.value.replace(/[^\d]/g, '')) || 0;
    });
    
    const includePPN = document.getElementById('include_ppn').checked;
    const ppn = includePPN ? subtotal * (11/12) * 0.12 : 0;
    const total = subtotal + ppn;
    
    document.getElementById('subtotal').value = formatNumber(subtotal);
    document.getElementById('ppn').value = formatNumber(ppn);
    document.getElementById('total').value = formatNumber(total);
}

// Format number to Indonesian currency
function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

// Isi Attention To, Jabatan Attention, dan PO Ref Number dari data client yang dipilih (PO Ref otomatis, tidak bisa diedit)
function fillFromClient() {
    const clientSelect = document.getElementById('client_id');
    const opt = clientSelect.options[clientSelect.selectedIndex];
    const poRefInput = document.getElementById('po_ref_number');
    if (!opt || !opt.value) {
        document.getElementById('attention_to').value = '';
        document.getElementById('attention_name').value = '';
        poRefInput.value = '';
        return;
    }
    document.getElementById('attention_to').value = opt.dataset.contactPerson || '';
    document.getElementById('attention_name').value = opt.dataset.jabatan || '';
    poRefInput.value = opt.dataset.poRef || '';
}
document.getElementById('client_id').addEventListener('change', fillFromClient);

// Add event listeners to first item
document.addEventListener('DOMContentLoaded', function() {
    const firstItem = document.querySelector('.item-row');
    addItemEventListeners(firstItem);
    
    // Add event listener to PPN checkbox
    document.getElementById('include_ppn').addEventListener('change', calculateTotals);
    
    // Isi dari client jika sudah ada (misal old input)
    fillFromClient();
    
    // Initial calculation
    calculateTotals();
});
</script>
@endsection 