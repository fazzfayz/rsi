@extends('layouts.admin')

@section('title', 'Buat Purchase Order')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Buat Purchase Order</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('purchase-orders.index') }}">Purchase Order</a></li>
            <li class="breadcrumb-item active">Buat PO</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header"><h3 class="card-title mb-0">Form Purchase Order</h3></div>
            <form action="{{ route('purchase-orders.store') }}" method="POST" id="poForm" novalidate>
                @csrf
                <div class="card-body">
                    <!-- Header Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="po_number">Nomor PO <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('po_number') is-invalid @enderror" id="po_number" name="po_number" value="{{ $poNumber }}" required>
                                @error('po_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="po_date">Tanggal PO <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('po_date') is-invalid @enderror" id="po_date" name="po_date" value="{{ old('po_date', date('Y-m-d')) }}" required>
                                @error('po_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ref_number">Ref. No</label>
                                <input type="text" class="form-control @error('ref_number') is-invalid @enderror" id="ref_number" name="ref_number" value="{{ old('ref_number', $poNumber) }}" readonly>
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
                                                data-address="{{ $client->address ?? '' }}"
                                                {{ old('vendor_id') == $client->id ? 'selected' : '' }}>
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
                                <input type="text" class="form-control" id="vendor_name" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_email">Email Vendor</label>
                                <input type="email" class="form-control" id="vendor_email" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_contact_person">Contact Person</label>
                                <input type="text" class="form-control" id="vendor_contact_person" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendor_address">Alamat Vendor</label>
                                <textarea class="form-control" id="vendor_address" rows="2" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Ship To Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ship_to_company">Ship To Company <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('ship_to_company') is-invalid @enderror" id="ship_to_company" name="ship_to_company" value="{{ old('ship_to_company', 'PT. RSI') }}" required>
                                @error('ship_to_company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ship_to_address">Ship To Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('ship_to_address') is-invalid @enderror" id="ship_to_address" name="ship_to_address" rows="2" required>{{ old('ship_to_address', 'Jl. Contoh No. 123, Jakarta') }}</textarea>
                                @error('ship_to_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="attention_to">Attention To</label>
                                <input type="text" class="form-control @error('attention_to') is-invalid @enderror" id="attention_to" name="attention_to" value="{{ old('attention_to') }}">
                                @error('attention_to')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="attention_name">Attention Name</label>
                                <input type="text" class="form-control @error('attention_name') is-invalid @enderror" id="attention_name" name="attention_name" value="{{ old('attention_name') }}">
                                @error('attention_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Items Table: No, Description, Part Number, QTY, UOM, Unit Price, Total IDR -->
                    <div class="form-group">
                        <label>Items <span class="text-danger">*</span></label>
                        <div class="table-responsive border border-dark">
                            <table class="table table-bordered mb-0 bg-white" id="itemsTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 36px;">No</th>
                                        <th class="text-left" style="width: 22%;">Description</th>
                                        <th class="text-center" style="width: 85px;">Part Number</th>
                                        <th class="text-center" style="width: 50px;">QTY</th>
                                        <th class="text-center" style="width: 62px;">UOM</th>
                                        <th class="text-right" style="width: 85px;">Unit Price</th>
                                        <th class="text-right" style="width: 85px;">Total IDR</th>
                                        <th class="text-center" style="width: 42px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsBody">
                                    <tr class="item-row">
                                        <td class="text-center item-no align-middle">1</td>
                                        <td class="align-middle py-1 px-1">
                                            <textarea name="items[0][description]" class="form-control form-control-sm border-0 rounded-0" rows="2" placeholder="Deskripsi" required></textarea>
                                        </td>
                                        <td class="align-middle py-1 px-1">
                                            <input type="text" name="items[0][part_number]" class="form-control form-control-sm border-0" placeholder="-">
                                        </td>
                                        <td class="align-middle py-1 px-1">
                                            <input type="number" name="items[0][quantity]" class="form-control form-control-sm quantity text-center border-0" min="0.01" step="0.01" value="1" required>
                                        </td>
                                        <td class="align-middle py-1 px-1">
                                            <select name="items[0][uom]" class="form-control form-control-sm border-0">
                                                <option value="Unit">Unit</option>
                                                <option value="PCS">PCS</option>
                                                <option value="Set">Set</option>
                                                <option value="Box">Box</option>
                                                <option value="Meter">Meter</option>
                                                <option value="Lot">Lot</option>
                                                <option value="Roll">Roll</option>
                                            </select>
                                        </td>
                                        <td class="align-middle py-1 px-1">
                                            <input type="number" name="items[0][unit_price]" class="form-control form-control-sm unit-price text-right border-0" min="0" step="1" value="0" required>
                                        </td>
                                        <td class="text-right total-idr-display align-middle py-1 px-1">0</td>
                                        <td class="text-center align-middle py-1 px-1">
                                            <input type="hidden" name="items[0][item_type]" value="hardware">
                                            <input type="hidden" class="total-price" value="0">
                                            <button type="button" class="btn btn-danger btn-sm remove-item py-0 px-1" title="Hapus" disabled><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-success btn-sm mt-2" id="addItem"><i class="fas fa-plus mr-1"></i> Tambah Item</button>
                    </div>

                    <!-- Note (tetap / tidak bisa diubah) -->
                    @php
                        $fixedNotes = "- All shipments must include notes, invoices and receipts\n- We will return the goods if not in accordance with the order\n- Purchase order (PO) number must be listed on the note / invoice / receipt\n- If delivery of goods by partial, please include a copy of the PO";
                    @endphp
                    <input type="hidden" name="notes" value="{{ $fixedNotes }}">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Note :</label>
                                <div class="bg-light border rounded p-3 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">
                                    - All shipments must include notes, invoices and receipts<br>
                                    - We will return the goods if not in accordance with the order<br>
                                    - Purchase order (PO) number must be listed on the note / invoice / receipt<br>
                                    - If delivery of goods by partial, please include a copy of the PO
                                </div>
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
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan PO</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
#itemsTable { table-layout: fixed; border: 2px solid #000 !important; font-size: 0.9rem; }
#itemsTable thead th {
    background-color: #e9ecef;
    font-weight: 600;
    border: 1px solid #000 !important;
    padding: 5px 4px;
    vertical-align: middle;
    font-size: 0.85rem;
}
#itemsTable tbody td {
    border: 1px solid #000 !important;
    vertical-align: middle;
}
#itemsTable .form-control-sm { font-size: 0.8rem; min-height: 28px; }
#itemsTable .form-control-sm.border-0 { background: transparent; box-shadow: none; }
#itemsTable textarea.form-control-sm { min-height: 38px; resize: vertical; }
#itemsTable .total-idr-display { font-weight: 500; font-size: 0.85rem; }
</style>
@endpush

@push('scripts')
<script>
(function () {
    'use strict';

    let itemIndex = 1;
    var UOM_OPTS = '<option value="Unit">Unit</option><option value="PCS">PCS</option><option value="Set">Set</option><option value="Box">Box</option><option value="Meter">Meter</option><option value="Lot">Lot</option><option value="Roll">Roll</option>';

    function byId(id) { return document.getElementById(id); }

    function formatNumber(num) {
        var n = Math.round(Number(num) || 0);
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function buildItemRow(idx) {
        return '<td class="text-center item-no align-middle"></td>' +
            '<td class="align-middle py-1 px-1"><textarea name="items[' + idx + '][description]" class="form-control form-control-sm border-0 rounded-0" rows="2" placeholder="Deskripsi" required></textarea></td>' +
            '<td class="align-middle py-1 px-1"><input type="text" name="items[' + idx + '][part_number]" class="form-control form-control-sm border-0" placeholder="-"></td>' +
            '<td class="align-middle py-1 px-1"><input type="number" name="items[' + idx + '][quantity]" class="form-control form-control-sm quantity text-center border-0" min="0.01" step="0.01" value="1" required></td>' +
            '<td class="align-middle py-1 px-1"><select name="items[' + idx + '][uom]" class="form-control form-control-sm border-0">' + UOM_OPTS + '</select></td>' +
            '<td class="align-middle py-1 px-1"><input type="number" name="items[' + idx + '][unit_price]" class="form-control form-control-sm unit-price text-right border-0" min="0" step="1" value="0" required></td>' +
            '<td class="text-right total-idr-display align-middle py-1 px-1">0</td>' +
            '<td class="text-center align-middle py-1 px-1">' +
                '<input type="hidden" name="items[' + idx + '][item_type]" value="hardware">' +
                '<input type="hidden" class="total-price" value="0">' +
                '<button type="button" class="btn btn-danger btn-sm remove-item py-0 px-1" title="Hapus"><i class="fas fa-trash"></i></button>' +
            '</td>';
    }

    function calculateRow(row) {
        var q = parseFloat(row.querySelector('.quantity') && row.querySelector('.quantity').value) || 0;
        var p = parseFloat(row.querySelector('.unit-price') && row.querySelector('.unit-price').value) || 0;
        var t = q * p;
        var totalEl = row.querySelector('.total-price');
        var displayEl = row.querySelector('.total-idr-display');
        if (totalEl) totalEl.value = t.toFixed(2);
        if (displayEl) displayEl.textContent = formatNumber(t);
        renumberRows();
    }

    function renumberRows() {
        var rows = document.querySelectorAll('#itemsBody .item-row');
        rows.forEach(function (r, i) {
            var no = r.querySelector('.item-no');
            if (no) no.textContent = String(i + 1);
        });
    }

    function updateRemoveButtons() {
        var rows = document.querySelectorAll('#itemsBody .item-row');
        var disable = rows.length <= 1;
        rows.forEach(function (r) {
            var btn = r.querySelector('.remove-item');
            if (btn) btn.disabled = disable;
        });
    }

    function onDocClick(e) {
        var t = e && e.target;
        if (!t || !t.closest) return;
        var rb = t.closest('.remove-item');
        if (rb) {
            var row = rb.closest('tr');
            if (!row || !row.classList.contains('item-row')) return;
            if (byId('itemsBody') && !byId('itemsBody').contains(row)) return;
            if (document.querySelectorAll('#itemsBody .item-row').length <= 1) return;
            e.preventDefault();
            row.remove();
            renumberRows();
            updateRemoveButtons();
            return;
        }
    }

    function onInput(e) {
        var el = e.target;
        if (!el || (!el.classList.contains('quantity') && !el.classList.contains('unit-price'))) return;
        var row = el.closest ? el.closest('tr') : null;
        if (row && row.classList.contains('item-row')) calculateRow(row);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var vs = byId('vendor_id');
        if (vs) {
            vs.addEventListener('change', function () {
                var opt = this.options[this.selectedIndex];
                var g = function (k) { return opt ? (opt.getAttribute('data-' + k) || '') : ''; };
                var f = byId('vendor_name');   if (f) f.value = g('name');
                var e = byId('vendor_email'); if (e) e.value = g('email');
                var c = byId('vendor_contact_person'); if (c) c.value = g('contact');
                var a = byId('vendor_address');        if (a) a.value = g('address');
            });
            if (vs.value) vs.dispatchEvent(new Event('change'));
        }

        var addBtn = byId('addItem');
        if (addBtn) addBtn.addEventListener('click', function () {
            var tbody = byId('itemsBody');
            if (!tbody) return;
            var tr = document.createElement('tr');
            tr.className = 'item-row';
            tr.innerHTML = buildItemRow(itemIndex);
            tbody.appendChild(tr);
            itemIndex++;
            renumberRows();
            updateRemoveButtons();
        });

        document.addEventListener('click', onDocClick);
        document.addEventListener('input', onInput);

        renumberRows();
        updateRemoveButtons();
    });
})();
</script>
@endpush
