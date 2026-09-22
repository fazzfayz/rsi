@extends('layouts.admin')

@section('title', 'Edit Purchase Order')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Edit Purchase Order</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('purchase-orders.index') }}">Purchase Order</a></li>
            <li class="breadcrumb-item active">Edit PO</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header"><h3 class="card-title mb-0">Edit Purchase Order: {{ $purchaseOrder->po_number }}</h3></div>
            <form action="{{ route('purchase-orders.update', $purchaseOrder) }}" method="POST" id="poForm" novalidate>
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- Header Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="po_number">Nomor PO <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" name="po_number" value="{{ old('po_number', $purchaseOrder->po_number) }}" required>
                                @error('po_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="po_date">Tanggal PO <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('po_date') is-invalid @enderror" id="po_date" name="po_date" value="{{ old('po_date', $purchaseOrder->po_date->format('Y-m-d')) }}" required>
                                @error('po_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ref_number">Ref. No</label>
                                <input type="text" class="form-control @error('ref_number') is-invalid @enderror" id="ref_number" name="ref_number" value="{{ old('ref_number', $purchaseOrder->ref_number ?: $purchaseOrder->po_number) }}" readonly>
                                @error('ref_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text text-muted">Otomatis mengikuti Nomor PO</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_id">Vendor <span class="text-danger">*</span></label>
                                <select class="form-control @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id" required>
                                    <option value="">Pilih Vendor</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" 
                                                data-name="{{ $client->name }}"
                                                data-email="{{ $client->email ?? '' }}"
                                                data-contact="{{ $client->contact_person ?? $client->phone ?? '' }}"
                                                data-address="{{ $client->address }}"
                                                {{ old('vendor_id', $purchaseOrder->vendor_id) == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vendor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Vendor Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_name">Nama Vendor</label>
                                <input type="text" class="form-control" id="vendor_name" value="{{ $purchaseOrder->vendor_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_email">Email Vendor</label>
                                <input type="email" class="form-control" id="vendor_email" value="{{ $purchaseOrder->vendor_email }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_contact_person">Contact Person</label>
                                <input type="text" class="form-control" id="vendor_contact_person" value="{{ $purchaseOrder->vendor_contact_person }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_address">Alamat Vendor</label>
                                <textarea class="form-control" id="vendor_address" rows="2" readonly>{{ $purchaseOrder->vendor_address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Ship To Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ship_to_company">Ship To Company <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('ship_to_company') is-invalid @enderror" id="ship_to_company" name="ship_to_company" value="{{ old('ship_to_company', $purchaseOrder->ship_to_company) }}" required>
                                @error('ship_to_company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ship_to_address">Ship To Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('ship_to_address') is-invalid @enderror" id="ship_to_address" name="ship_to_address" rows="2" required>{{ old('ship_to_address', $purchaseOrder->ship_to_address) }}</textarea>
                                @error('ship_to_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="attention_to">Attention To</label>
                                <input type="text" class="form-control @error('attention_to') is-invalid @enderror" id="attention_to" name="attention_to" value="{{ old('attention_to', $purchaseOrder->attention_to) }}">
                                @error('attention_to')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="attention_name">Attention Name</label>
                                <input type="text" class="form-control @error('attention_name') is-invalid @enderror" id="attention_name" name="attention_name" value="{{ old('attention_name', $purchaseOrder->attention_name) }}">
                                @error('attention_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="form-group">
                        <label>Items <span class="text-danger">*</span></label>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="itemsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Description</th>
                                        <th>Part Number</th>
                                        <th class="text-center" style="width:120px">Qty</th>
                                        <th class="text-center" style="width:140px">UOM</th>
                                        <th class="text-right" style="width:160px">Unit Price</th>
                                        <th class="text-right" style="width:180px">Total</th>
                                        <th style="width:60px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchaseOrder->items as $index => $item)
                                    <tr class="item-row">
                                        <td><input type="text" name="items[{{ $index }}][description]" class="form-control" value="{{ $item->description }}" required></td>
                                        <td><input type="text" name="items[{{ $index }}][part_number]" class="form-control" value="{{ $item->part_number }}"></td>
                                        <td><input type="number" name="items[{{ $index }}][quantity]" class="form-control quantity text-center" min="1" value="{{ $item->quantity }}" required></td>
                                        <td>
                                            <select name="items[{{ $index }}][uom]" class="form-control">
                                                <option value="PCS" {{ $item->uom == 'PCS' ? 'selected' : '' }}>PCS</option>
                                                <option value="UNIT" {{ $item->uom == 'UNIT' ? 'selected' : '' }}>UNIT</option>
                                                <option value="SET" {{ $item->uom == 'SET' ? 'selected' : '' }}>SET</option>
                                                <option value="BOX" {{ $item->uom == 'BOX' ? 'selected' : '' }}>BOX</option>
                                                <option value="KG" {{ $item->uom == 'KG' ? 'selected' : '' }}>KG</option>
                                                <option value="METER" {{ $item->uom == 'METER' ? 'selected' : '' }}>METER</option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="items[{{ $index }}][unit_price]" class="form-control unit-price text-right" min="0" step="0.01" value="{{ $item->unit_price }}" required></td>
                                        <td><input type="text" class="form-control total-price text-right" readonly value="{{ number_format($item->total_price, 2, '.', '') }}"></td>
                                        <td class="text-center"><button type="button" class="btn btn-danger btn-sm remove-item"><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-success btn-sm" id="addItem"><i class="fas fa-plus mr-1"></i> Tambah Item</button>
                    </div>

                    <!-- Totals -->
                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <table class="table table-sm mb-0">
                                <tr>
                                    <td class="text-muted"><strong>Subtotal:</strong></td>
                                    <td class="text-right"><span id="subtotal">Rp {{ number_format($purchaseOrder->subtotal, 0, ',', '.') }}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>VAT (12%):</strong></td>
                                    <td class="text-right"><span id="vat">Rp {{ number_format($purchaseOrder->vat_amount, 0, ',', '.') }}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Total:</strong></td>
                                    <td class="text-right"><span id="total">Rp {{ number_format($purchaseOrder->total_amount, 0, ',', '.') }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Term and Conditions (bisa tambah/hapus sendiri) -->
                    <div class="form-group mt-3">
                        <label>Term and Conditions</label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="termsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;">No.</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 60px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="termsBody">
                                    @php $editTerms = old('terms', $purchaseOrder->terms ?? []); if (empty($editTerms)) { $editTerms = ['Quotation validity : 7 days', 'All price and availability can change anytime without prior notice.', 'Delivery time : 5 working day', 'Device Warranty : 1 year', 'Term Of Payment : Payment 100% after delivery', 'Customer must provide Purchase Order (PO)', 'Configuration warranty : 30 days']; } @endphp
                                    @foreach($editTerms as $idx => $text)
                                    <tr class="term-row">
                                        <td class="text-center term-no">{{ $idx + 1 }}</td>
                                        <td><input type="text" name="terms[{{ $idx }}]" class="form-control form-control-sm" value="{{ is_string($text) ? $text : ($text ?? '') }}" placeholder="Isi syarat & ketentuan"></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-term" {{ count($editTerms) <= 1 ? 'disabled' : '' }}><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-success btn-sm mt-1" id="addTerm"><i class="fas fa-plus mr-1"></i> Tambah Term</button>
                    </div>

                    <!-- Notes and Signatory -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="4">{{ old('notes', $purchaseOrder->notes) }}</textarea>
                                @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Penandatangan</label>
                                <div class="form-control bg-light" style="cursor: default;">Nani Hadijah</div>
                                <input type="hidden" name="signatory_employee_id" value="{{ optional($signatoryNaniHadijah)->id ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('purchase-orders.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update PO</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Auto fill vendor data when vendor is selected (seperti surat jalan)
document.getElementById('vendor_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const vendorName = selectedOption.getAttribute('data-name') || '';
    const vendorEmail = selectedOption.getAttribute('data-email') || '';
    const vendorContact = selectedOption.getAttribute('data-contact') || '';
    const vendorAddress = selectedOption.getAttribute('data-address') || '';
    
    document.getElementById('vendor_name').value = vendorName;
    document.getElementById('vendor_email').value = vendorEmail;
    document.getElementById('vendor_contact_person').value = vendorContact;
    document.getElementById('vendor_address').value = vendorAddress;
});

// Trigger on page load if vendor is already selected
if (document.getElementById('vendor_id').value) {
    document.getElementById('vendor_id').dispatchEvent(new Event('change'));
}
</script>

@endsection

@push('styles')
<style>
    #itemsTable th, #itemsTable td { vertical-align: middle; }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    let itemIndex = {{ count($purchaseOrder->items) }};

    // Auto-fill REF No from PO Number
    $('#po_number').on('input', function() {
        $('#ref_number').val($(this).val());
    });

    // Add new item row
    $('#addItem').click(function() {
        const newRow = `
            <tr class="item-row">
                <td>
                    <input type="text" name="items[${itemIndex}][description]" class="form-control" required>
                </td>
                <td>
                    <input type="text" name="items[${itemIndex}][part_number]" class="form-control">
                </td>
                <td>
                    <input type="number" name="items[${itemIndex}][quantity]" class="form-control quantity text-center" min="1" value="1" required>
                </td>
                <td>
                    <select name="items[${itemIndex}][uom]" class="form-control">
                        <option value="PCS">PCS</option>
                        <option value="UNIT">UNIT</option>
                        <option value="SET">SET</option>
                        <option value="BOX">BOX</option>
                        <option value="KG">KG</option>
                        <option value="METER">METER</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="items[${itemIndex}][unit_price]" class="form-control unit-price text-right" min="0" step="0.01" value="0" required>
                </td>
                <td>
                    <input type="text" class="form-control total-price text-right" readonly value="0.00">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#itemsTable tbody').append(newRow);
        
        // Calculate total for new row if values are set
        const newRowEl = $('#itemsTable tbody tr').last();
        calculateItemTotal(newRowEl);
        
        itemIndex++;
    });

    // Remove item row
    $(document).on('click', '.remove-item', function() {
        if ($('#itemsTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            updateRemoveButtons();
            calculateTotals();
        }
    });

    // Term and Conditions: tambah / hapus / reindex
    function reindexTerms() {
        $('#termsBody .term-row').each(function(i) {
            $(this).find('.term-no').text(i + 1);
            $(this).find('input[name^="terms"]').attr('name', 'terms[' + i + ']');
            $(this).find('.remove-term').prop('disabled', $('#termsBody .term-row').length <= 1);
        });
    }
    $('#addTerm').on('click', function() {
        const idx = $('#termsBody .term-row').length;
        const row = '<tr class="term-row"><td class="text-center term-no">' + (idx + 1) + '</td>' +
            '<td><input type="text" name="terms[' + idx + ']" class="form-control form-control-sm" value="" placeholder="Isi syarat & ketentuan"></td>' +
            '<td class="text-center"><button type="button" class="btn btn-danger btn-sm remove-term"><i class="fas fa-trash"></i></button></td></tr>';
        $('#termsBody').append(row);
        reindexTerms();
    });
    $(document).on('click', '.remove-term', function() {
        if ($('#termsBody .term-row').length <= 1) return;
        $(this).closest('.term-row').remove();
        reindexTerms();
    });
    reindexTerms();

    // Update remove button states
    function updateRemoveButtons() {
        const rowCount = $('#itemsTable tbody tr').length;
        $('.remove-item').prop('disabled', rowCount <= 1);
    }

    // Calculate item total - Perbaikan rumus: Total = Quantity × Unit Price (Real-time)
    function calculateItemTotal(row) {
        const quantity = parseFloat(row.find('.quantity').val()) || 0;
        const unitPrice = parseFloat(row.find('.unit-price').val()) || 0;
        
        // Total = Quantity × Unit Price
        const total = quantity * unitPrice;
        
        // Format dengan 2 desimal
        row.find('.total-price').val(total.toFixed(2));
        
        // Recalculate totals
        calculateTotals();
    }

    // Event listener untuk quantity dan unit price - Real-time calculation
    // Menggunakan multiple events untuk memastikan perhitungan real-time
    $(document).on('input keyup paste change', '.quantity, .unit-price', function() {
        const row = $(this).closest('tr');
        calculateItemTotal(row);
    });
    
    // Tambahan event listener khusus untuk input number (beberapa browser memerlukan ini)
    $(document).on('keydown', '.quantity, .unit-price', function(e) {
        // Trigger calculation saat tombol angka ditekan
        if ((e.key >= '0' && e.key <= '9') || e.key === '.' || e.key === 'Backspace' || e.key === 'Delete') {
            setTimeout(() => {
                const row = $(this).closest('tr');
                calculateItemTotal(row);
            }, 10);
        }
    });

    // Format currency on blur
    $(document).on('blur', '.unit-price', function() {
        const value = parseFloat($(this).val()) || 0;
        $(this).val(value.toFixed(2));
        // Recalculate after formatting
        calculateItemTotal($(this).closest('tr'));
    });

    // Calculate totals
    function calculateTotals() {
        let subtotal = 0;
        $('.total-price').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
        });
        
        const vat = subtotal * 0.12;
        const total = subtotal + vat;
        
        $('#subtotal').text('Rp ' + subtotal.toLocaleString('id-ID', {minimumFractionDigits: 0, maximumFractionDigits: 0}));
        $('#vat').text('Rp ' + vat.toLocaleString('id-ID', {minimumFractionDigits: 0, maximumFractionDigits: 0}));
        $('#total').text('Rp ' + total.toLocaleString('id-ID', {minimumFractionDigits: 0, maximumFractionDigits: 0}));
    }

    // Form validation
    $('#poForm').on('submit', function(e) {
        let isValid = true;
        let errorMessage = '';

        // Check if at least one item has description
        let hasValidItem = false;
        $('#itemsTable tbody tr').each(function() {
            const description = $(this).find('input[name*="[description]"]').val();
            if (description && description.trim() !== '') {
                hasValidItem = true;
            }
        });

        if (!hasValidItem) {
            isValid = false;
            errorMessage = 'Minimal harus ada satu item dengan description.';
        }

        // Check if vendor is selected
        if (!$('#vendor_id').val()) {
            isValid = false;
            errorMessage = 'Vendor harus dipilih.';
        }

        if (!isValid) {
            e.preventDefault();
            alert(errorMessage);
            return false;
        }
    });

    // Recalculate all item totals on page load
    function recalculateAllItems() {
        $('#itemsTable tbody tr').each(function() {
            calculateItemTotal($(this));
        });
    }

    // Set initial REF No from PO Number if empty
    if (!$('#ref_number').val() && $('#po_number').val()) {
        $('#ref_number').val($('#po_number').val());
    }

    // Initial calculation and setup
    recalculateAllItems();
    updateRemoveButtons();
});
</script>
@endpush 