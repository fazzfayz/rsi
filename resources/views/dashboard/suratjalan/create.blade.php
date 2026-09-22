@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Buat Surat Jalan Baru</h2>
                    <a href="{{ route('delivery-orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('delivery-orders.store') }}" method="POST" id="deliveryForm">
                    @csrf
                    
                    <!-- Nomor Surat Jalan -->
                    <div class="mb-6">
                        <label for="do_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Surat Jalan *</label>
                        <input type="text" name="do_number" id="do_number" value="{{ old('do_number', $doNumber) }}" required readonly
                               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Format: No.{nomor}/DO-RSI/{bulan romawi}/{tahun}. Nomor mengikuti surat jalan yang ada berdasarkan Tanggal Pengiriman.</p>
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
                            <label for="delivery_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengiriman *</label>
                            <input type="date" name="delivery_date" id="delivery_date" value="{{ old('delivery_date', date('Y-m-d')) }}" required 
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
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none">
                            <p class="text-xs text-gray-500 mt-1">Otomatis terisi dari nama customer</p>
                        </div>

                        <div>
                            <label for="attn_person" class="block text-sm font-medium text-gray-700 mb-2">ATTN (Nama Penanggung Jawab)</label>
                            <input type="text" id="attn_person" readonly
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none">
                            <p class="text-xs text-gray-500 mt-1">Otomatis terisi dari contact person customer</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_transit" {{ old('status') == 'in_transit' ? 'selected' : '' }}>Dalam Perjalanan</option>
                            <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Terkirim</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Karyawan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="carrier_employee_id" class="block text-sm font-medium text-gray-700 mb-2">Pembawa *</label>
                            <select name="carrier_employee_id" id="carrier_employee_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Karyawan</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('carrier_employee_id') == $employee->id ? 'selected' : '' }}>
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
                                    <option value="{{ $employee->id }}" {{ old('signer_employee_id') == $employee->id ? 'selected' : '' }}>
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
                                  placeholder="Alamat lengkap tujuan...">{{ old('shipping_address') }}</textarea>
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
                                    <tr class="item-row">
                                        <td class="px-4 py-3 whitespace-nowrap border border-gray-300">
                                            <span class="item-number">1</span>
                                        </td>
                                        <td class="px-4 py-3 border border-gray-300">
                                            <input type="text" name="items[0][name]" required 
                                                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                   placeholder="Nama barang">
                                        </td>
                                        <td class="px-4 py-3 border border-gray-300">
                                            <input type="number" name="items[0][quantity]" min="1" value="1" required 
                                                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </td>
                                        <td class="px-4 py-3 border border-gray-300">
                                            <input type="text" name="items[0][po_number]" 
                                                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                   placeholder="PO Number">
                                        </td>
                                        <td class="px-4 py-3 border border-gray-300">
                                            <input type="text" name="items[0][unit]" value="Pcs"
                                                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                   placeholder="UOM">
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap border border-gray-300">
                                            <button type="button" class="remove-item px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Keterangan Tambahan</label>
                        <textarea name="notes" id="notes" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Contoh: Barang sudah dicek dalam kondisi baik">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-4 border-t pt-6">
                        <a href="{{ route('delivery-orders.index') }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 bg-white shadow-sm font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 shadow-sm font-medium border border-blue-600">
                            <i class="fas fa-truck mr-2"></i>Simpan Surat Jalan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var itemIndex = 1;
    var shippingEl = document.getElementById('shipping_address');
    var shippingAddressTouched = false;
    var lastAutoAddress = '';

    if (shippingEl) {
        shippingEl.addEventListener('input', function() {
            shippingAddressTouched = true;
        });
    }

    // Auto fill TO dan ATTN dari customer
    var clientSelect = document.getElementById('client_id');
    if (clientSelect) {
        clientSelect.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var clientName = selectedOption.getAttribute('data-name') || '';
            var contactPerson = selectedOption.getAttribute('data-contact') || '';
            var clientAddress = selectedOption.getAttribute('data-address') || '';
            
            var toCompanyEl = document.getElementById('to_company');
            var attnPersonEl = document.getElementById('attn_person');
            
            if (toCompanyEl) {
                toCompanyEl.value = clientName;
            }
            if (attnPersonEl) {
                attnPersonEl.value = contactPerson;
            }

            // Auto update alamat pengiriman mengikuti customer (selama belum diedit manual)
            if (shippingEl) {
                var current = shippingEl.value.trim();
                var shouldOverwrite = !shippingAddressTouched || current === lastAutoAddress;
                if (shouldOverwrite) {
                    shippingEl.value = clientAddress;
                    lastAutoAddress = (clientAddress || '').trim();
                    shippingAddressTouched = false;
                }
            }
        });

        // Trigger on page load if client is already selected
        if (clientSelect.value) {
            clientSelect.dispatchEvent(new Event('change'));
        }
    }

    // Update preview nomor DO saat Tanggal Pengiriman berubah
    var deliveryDateEl = document.getElementById('delivery_date');
    if (deliveryDateEl) {
        deliveryDateEl.addEventListener('change', function() {
            var date = this.value;
            if (!date) {
                return;
            }
            fetch('{{ route("delivery-orders.preview-do-number") }}?date=' + encodeURIComponent(date))
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    var doNumberEl = document.getElementById('do_number');
                    if (doNumberEl) {
                        doNumberEl.value = data.do_number;
                    }
                })
                .catch(function(error) {
                    console.error('Error fetching DO number:', error);
                });
        });
    }

    // Update row numbers
    function updateRowNumbers() {
        var rows = document.querySelectorAll('.item-row');
        for (var i = 0; i < rows.length; i++) {
            var numberEl = rows[i].querySelector('.item-number');
            if (numberEl) {
                numberEl.textContent = i + 1;
            }
        }
    }

    // Remove item handler
    function handleRemoveItem(button) {
        var rows = document.querySelectorAll('.item-row');
        if (rows.length > 1) {
            var row = button.closest('.item-row');
            if (row) {
                row.remove();
                updateRowNumbers();
            }
        } else {
            alert('Minimal harus ada satu item barang.');
        }
    }

    // Add new row
    var addItemBtn = document.getElementById('addItem');
    if (addItemBtn) {
        addItemBtn.addEventListener('click', function() {
            var container = document.getElementById('itemsContainer');
            if (!container) {
                return;
            }
            
            var newRow = document.createElement('tr');
            newRow.className = 'item-row';
            newRow.innerHTML = 
                '<td class="px-4 py-3 whitespace-nowrap border border-gray-300">' +
                    '<span class="item-number">' + (itemIndex + 1) + '</span>' +
                '</td>' +
                '<td class="px-4 py-3 border border-gray-300">' +
                    '<input type="text" name="items[' + itemIndex + '][name]" required ' +
                    'class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" ' +
                    'placeholder="Nama barang">' +
                '</td>' +
                '<td class="px-4 py-3 border border-gray-300">' +
                    '<input type="number" name="items[' + itemIndex + '][quantity]" min="1" value="1" required ' +
                    'class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">' +
                '</td>' +
                '<td class="px-4 py-3 border border-gray-300">' +
                    '<input type="text" name="items[' + itemIndex + '][po_number]" ' +
                    'class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" ' +
                    'placeholder="PO Number">' +
                '</td>' +
                '<td class="px-4 py-3 border border-gray-300">' +
                    '<input type="text" name="items[' + itemIndex + '][unit]" value="Pcs" ' +
                    'class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" ' +
                    'placeholder="UOM">' +
                '</td>' +
                '<td class="px-4 py-3 whitespace-nowrap border border-gray-300">' +
                    '<button type="button" class="remove-item px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">' +
                        '<i class="fas fa-trash"></i> Hapus' +
                    '</button>' +
                '</td>';
            
            container.appendChild(newRow);
            
            // Add remove event to new row
            var removeBtn = newRow.querySelector('.remove-item');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    handleRemoveItem(this);
                });
            }
            
            itemIndex++;
            updateRowNumbers();
        });
    }

    // Remove item event listeners for existing rows
    var removeButtons = document.querySelectorAll('.remove-item');
    for (var i = 0; i < removeButtons.length; i++) {
        removeButtons[i].addEventListener('click', function() {
            handleRemoveItem(this);
        });
    }
});
</script>
@endpush
