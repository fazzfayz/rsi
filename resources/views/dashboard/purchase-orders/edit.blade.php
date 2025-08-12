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
            <form action="{{ route('purchase-orders.update', $purchaseOrder) }}" method="POST" id="poForm">
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
                                <input type="text" class="form-control @error('ref_number') is-invalid @enderror" id="ref_number" name="ref_number" value="{{ old('ref_number', $purchaseOrder->ref_number) }}">
                                @error('ref_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_id">Vendor <span class="text-danger">*</span></label>
                                <select class="form-control @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id" required>
                                    <option value="">Pilih Vendor</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('vendor_id', $purchaseOrder->vendor_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
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
                                        <td><input type="text" class="form-control total-price text-right" readonly value="{{ number_format($item->total_price, 2) }}"></td>
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
                                <label for="signatory_employee_id">Penandatangan <span class="text-danger">*</span></label>
                                <select class="form-control @error('signatory_employee_id') is-invalid @enderror" id="signatory_employee_id" name="signatory_employee_id" required>
                                    <option value="">Pilih Karyawan</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('signatory_employee_id', $purchaseOrder->signatory_employee_id) == $employee->id ? 'selected' : '' }}>{{ $employee->name }} - {{ $employee->position }}</option>
                                    @endforeach
                                </select>
                                @error('signatory_employee_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
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

    // Load vendor data when vendor is selected
    $('#vendor_id').change(function() {
        const vendorId = $(this).val();
        if (vendorId) {
            $.get(`/purchase-orders/vendor-data?vendor_id=${vendorId}`, function(data) {
                $('#vendor_name').val(data.name);
                $('#vendor_email').val(data.email);
                $('#vendor_contact_person').val(data.contact_person);
                $('#vendor_address').val(data.address);
            });
        } else {
            $('#vendor_name, #vendor_email, #vendor_contact_person, #vendor_address').val('');
        }
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
                    <input type="text" class="form-control total-price text-right" readonly value="0">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#itemsTable tbody').append(newRow);
        itemIndex++;
    });

    // Remove item row
    $(document).on('click', '.remove-item', function() {
        if ($('#itemsTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            calculateTotals();
        }
    });

    // Calculate item total
    $(document).on('input', '.quantity, .unit-price', function() {
        const row = $(this).closest('tr');
        const quantity = parseFloat(row.find('.quantity').val()) || 0;
        const unitPrice = parseFloat(row.find('.unit-price').val()) || 0;
        const total = quantity * unitPrice;
        row.find('.total-price').val(total.toFixed(2));
        calculateTotals();
    });

    // Calculate totals
    function calculateTotals() {
        let subtotal = 0;
        $('.total-price').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
        });
        
        const vat = subtotal * 0.12;
        const total = subtotal + vat;
        
        $('#subtotal').text('Rp ' + subtotal.toLocaleString('id-ID'));
        $('#vat').text('Rp ' + vat.toLocaleString('id-ID'));
        $('#total').text('Rp ' + total.toLocaleString('id-ID'));
    }

    // Initial calculation
    calculateTotals();
});
</script>
@endpush 