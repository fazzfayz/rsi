@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Edit Surat Jalan</h2>
                    <a href="{{ route('delivery-orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('delivery-orders.update', $deliveryOrder->id) }}" method="POST" id="deliveryForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nomor Surat Jalan -->
                    <div class="mb-6">
                        <label for="do_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Surat Jalan *</label>
                        <input type="text" name="do_number" id="do_number" value="{{ old('do_number', $deliveryOrder->do_number) }}" required readonly
                               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">Customer / Penerima *</label>
                            <select name="client_id" id="client_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Customer</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" 
                                            data-name="{{ $client->name }}"
                                            data-contact="{{ $client->contact_person ?? $client->name }}"
                                            data-address="{{ $client->address }}"
                                            {{ old('client_id', $deliveryOrder->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="delivery_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengiriman *</label>
                            <input type="date" name="delivery_date" id="delivery_date" 
                                   value="{{ old('delivery_date', $deliveryOrder->delivery_date->format('Y-m-d')) }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('delivery_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- TO dan ATTN (Auto fill dari customer) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="to_company" class="block text-sm font-medium text-gray-700 mb-2">TO (Nama PT)</label>
                            <input type="text" id="to_company" readonly
                                   value="{{ $deliveryOrder->client->name ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none">
                            <p class="text-xs text-gray-500 mt-1">Otomatis terisi dari nama customer</p>
                        </div>

                        <div>
                            <label for="attn_person" class="block text-sm font-medium text-gray-700 mb-2">ATTN (Nama Penanggung Jawab)</label>
                            <input type="text" id="attn_person" readonly
                                   value="{{ $deliveryOrder->client->contact_person ?? $deliveryOrder->client->name ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none">
                            <p class="text-xs text-gray-500 mt-1">Otomatis terisi dari contact person customer</p>
                        </div>
                    </div>

                    <!-- Karyawan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="carrier_employee_id" class="block text-sm font-medium text-gray-700 mb-2">Pembawa *</label>
                            <select name="carrier_employee_id" id="carrier_employee_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Karyawan</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('carrier_employee_id', $deliveryOrder->carrier_employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrier_employee_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="signer_employee_id" class="block text-sm font-medium text-gray-700 mb-2">Hormat Kami *</label>
                            <select name="signer_employee_id" id="signer_employee_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Karyawan</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('signer_employee_id', $deliveryOrder->signer_employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('signer_employee_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                        <textarea name="shipping_address" id="shipping_address" rows="2" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Alamat lengkap tujuan...">{{ old('shipping_address', $deliveryOrder->shipping_address) }}</textarea>
                    </div>

                    <!-- Table Items -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Daftar Barang</h3>
                            <button type="button" id="addItem" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 shadow-sm font-medium">
                                <i class="fas fa-plus mr-2"></i>Tambah Baris
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Nama Barang</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">QTY</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">PO Number</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">UOM</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsContainer" class="bg-white divide-y divide-gray-200">
                                    @foreach($deliveryOrder->items as $index => $item)
                                    <tr class="item-row">
                                        <td class="px-4 py-3 whitespace-nowrap border border-gray-300">
                                            <span class="item-number">{{ $index + 1 }}</span>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-300">
                                            <input type="text" name="items[{{ $index }}][name]" value="{{ $item->name }}" required 
                                                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                   placeholder="Nama barang">
                                        </td>
                                        <td class="px-4 py-3 border border-gray-300">
                                            <input type="number" name="items[{{ $index }}][quantity]" min="1" value="{{ $item->quantity }}" required 
                                                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </td>
                                        <td class="px-4 py-3 border border-gray-300">
                                            <input type="text" name="items[{{ $index }}][po_number]" value="{{ $item->po_number ?? '' }}" 
                                                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                   placeholder="PO Number">
                                        </td>
                                        <td class="px-4 py-3 border border-gray-300">
                                            <input type="text" name="items[{{ $index }}][unit]" value="{{ $item->unit ?? 'Pcs' }}"
                                                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                   placeholder="UOM">
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap border border-gray-300">
                                            <button type="button" class="remove-item px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Keterangan Tambahan</label>
                        <textarea name="notes" id="notes" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Contoh: Barang sudah dicek dalam kondisi baik">{{ old('notes', $deliveryOrder->notes) }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-4 border-t pt-6">
                        <a href="{{ route('delivery-orders.show', $deliveryOrder->id) }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 bg-white shadow-sm font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 shadow-sm font-medium border border-blue-600">
                            <i class="fas fa-save mr-2"></i>Update Surat Jalan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let itemIndex = {{ count($deliveryOrder->items) }};
const shippingEl = document.getElementById('shipping_address');
let shippingAddressTouched = false;
let lastAutoAddress = '';

if (shippingEl) {
    shippingEl.addEventListener('input', function() {
        shippingAddressTouched = true;
    });
}

// Auto fill TO dan ATTN dari customer
document.getElementById('client_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const clientName = selectedOption.getAttribute('data-name') || '';
    const contactPerson = selectedOption.getAttribute('data-contact') || '';
    const clientAddress = selectedOption.getAttribute('data-address') || '';
    
    document.getElementById('to_company').value = clientName;
    document.getElementById('attn_person').value = contactPerson;

    // Auto update alamat pengiriman mengikuti customer (selama belum diedit manual)
    if (shippingEl) {
        const current = shippingEl.value.trim();
        const shouldOverwrite = !shippingAddressTouched || current === lastAutoAddress;
        if (shouldOverwrite) {
            shippingEl.value = clientAddress;
            lastAutoAddress = (clientAddress || '').trim();
            shippingAddressTouched = false;
        }
    }
});

// Trigger on page load if client is already selected
if (document.getElementById('client_id').value) {
    document.getElementById('client_id').dispatchEvent(new Event('change'));
}

// Add new row
document.getElementById('addItem').addEventListener('click', function() {
    const container = document.getElementById('itemsContainer');
    const newRow = document.createElement('tr');
    newRow.className = 'item-row';
    newRow.innerHTML = `
        <td class="px-4 py-3 whitespace-nowrap border border-gray-300">
            <span class="item-number">${itemIndex + 1}</span>
        </td>
        <td class="px-4 py-3 border border-gray-300">
            <input type="text" name="items[${itemIndex}][name]" required 
                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Nama barang">
        </td>
        <td class="px-4 py-3 border border-gray-300">
            <input type="number" name="items[${itemIndex}][quantity]" min="1" value="1" required 
                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </td>
        <td class="px-4 py-3 border border-gray-300">
            <input type="text" name="items[${itemIndex}][po_number]" 
                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="PO Number">
        </td>
        <td class="px-4 py-3 border border-gray-300">
            <input type="text" name="items[${itemIndex}][unit]" value="Pcs"
                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="UOM">
        </td>
        <td class="px-4 py-3 whitespace-nowrap border border-gray-300">
            <button type="button" class="remove-item px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </td>
    `;
    container.appendChild(newRow);
    
    // Add remove event
    newRow.querySelector('.remove-item').addEventListener('click', function() {
        if(document.querySelectorAll('.item-row').length > 1) {
            newRow.remove();
            updateRowNumbers();
        } else {
            alert('Minimal harus ada satu item barang.');
        }
    });
    
    itemIndex++;
    updateRowNumbers();
});

// Update row numbers
function updateRowNumbers() {
    document.querySelectorAll('.item-row').forEach((row, index) => {
        row.querySelector('.item-number').textContent = index + 1;
    });
}

// Remove item event listeners
document.querySelectorAll('.remove-item').forEach(button => {
    button.addEventListener('click', function() {
        if(document.querySelectorAll('.item-row').length > 1) {
            this.closest('.item-row').remove();
            updateRowNumbers();
        } else {
            alert('Minimal harus ada satu item barang.');
        }
    });
});
</script>
@endsection
