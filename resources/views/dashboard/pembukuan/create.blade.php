@extends('layouts.admin')

@section('title', 'Buat Pembukuan')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Buat Pembukuan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pembukuan.index') }}">Pembukuan</a></li>
            <li class="breadcrumb-item active">Buat Baru</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header"><h3 class="card-title mb-0">Form Pembukuan</h3></div>
            <form action="{{ route('pembukuan.store') }}" method="POST" id="pembukuanForm">
                @csrf
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_project">Nama Project <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_project') is-invalid @enderror" id="nama_project" name="nama_project" value="{{ old('nama_project') }}" required>
                                @error('nama_project')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required>
                                @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_berakhir">Tanggal Berakhir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_berakhir') is-invalid @enderror" id="tanggal_berakhir" name="tanggal_berakhir" value="{{ old('tanggal_berakhir', date('Y-m-d')) }}" required>
                                @error('tanggal_berakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tabel Barang <span class="text-danger">*</span></label>
                        <div class="table-responsive border">
                            <table class="table table-bordered mb-0 bg-white" id="itemsTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 40px;">No</th>
                                        <th>Nama Barang</th>
                                        <th class="text-center" style="width: 100px;">Quantity</th>
                                        <th class="text-right" style="width: 130px;">Harga Barang</th>
                                        <th class="text-right" style="width: 130px;">Total</th>
                                        <th class="text-center" style="width: 50px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsBody">
                                    <tr class="item-row">
                                        <td class="text-center item-no align-middle">1</td>
                                        <td class="align-middle">
                                            <input type="text" name="items[0][nama_barang]" class="form-control form-control-sm" placeholder="Nama barang" required>
                                        </td>
                                        <td class="align-middle">
                                            <input type="number" name="items[0][quantity]" class="form-control form-control-sm quantity text-center" min="0.01" step="0.01" value="1" required>
                                        </td>
                                        <td class="align-middle">
                                            <input type="number" name="items[0][harga_barang]" class="form-control form-control-sm harga text-right" min="0" step="1" value="0" required>
                                        </td>
                                        <td class="text-right total-display align-middle">0</td>
                                        <td class="text-center align-middle">
                                            <input type="hidden" class="total-val" value="0">
                                            <button type="button" class="btn btn-danger btn-sm remove-item py-0 px-1" title="Hapus" disabled><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-success btn-sm mt-2" id="addItem"><i class="fas fa-plus mr-1"></i> Tambah Barang</button>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah Total (semua barang)</label>
                                <div class="form-control bg-light font-weight-bold" id="jumlahDisplay">Rp 0</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="income">Income</label>
                                <input type="number" class="form-control @error('income') is-invalid @enderror" id="income" name="income" min="0" step="1" value="{{ old('income', 0) }}" placeholder="Opsional">
                                @error('income')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text text-muted">Jika income &lt; jumlah → Profit. Jika income &gt; jumlah → Loss. Tampil di kolom Selisih.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Selisih (preview)</label>
                                <div class="form-control bg-light" id="selisihPreview">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('pembukuan.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    var itemIndex = 1;

    function byId(id) { return document.getElementById(id); }

    function formatNum(n) {
        var x = Math.round(Number(n) || 0);
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function calcRow(row) {
        var q = parseFloat(row.querySelector('.quantity') && row.querySelector('.quantity').value) || 0;
        var h = parseFloat(row.querySelector('.harga') && row.querySelector('.harga').value) || 0;
        var t = q * h;
        var tv = row.querySelector('.total-val');
        var td = row.querySelector('.total-display');
        if (tv) tv.value = t.toFixed(2);
        if (td) td.textContent = formatNum(t);
        renumber();
        updateSum();
    }

    function renumber() {
        var rows = document.querySelectorAll('#itemsBody .item-row');
        rows.forEach(function (r, i) {
            var no = r.querySelector('.item-no');
            if (no) no.textContent = String(i + 1);
        });
    }

    function getSum() {
        var rows = document.querySelectorAll('#itemsBody .item-row');
        var s = 0;
        rows.forEach(function (r) {
            var v = r.querySelector('.total-val');
            s += parseFloat(v && v.value) || 0;
        });
        return s;
    }

    function updateSum() {
        var sum = getSum();
        var j = byId('jumlahDisplay');
        if (j) j.textContent = 'Rp ' + formatNum(sum);
        updateSelisihPreview();
    }

    function updateSelisihPreview() {
        var sum = getSum();
        var inc = parseFloat(byId('income') && byId('income').value) || 0;
        var diff = Math.abs(inc - sum);
        var prev = byId('selisihPreview');
        if (!prev) return;
        if (inc > sum) prev.textContent = 'Profit Rp ' + formatNum(diff);
        else if (inc < sum) prev.textContent = 'Loss Rp ' + formatNum(diff);
        else prev.textContent = 'Nihil Rp ' + formatNum(diff); 
    }

    function buildRow(idx) {
        return '<td class="text-center item-no align-middle"></td>' +
            '<td class="align-middle"><input type="text" name="items[' + idx + '][nama_barang]" class="form-control form-control-sm" placeholder="Nama barang" required></td>' +
            '<td class="align-middle"><input type="number" name="items[' + idx + '][quantity]" class="form-control form-control-sm quantity text-center" min="0.01" step="0.01" value="1" required></td>' +
            '<td class="align-middle"><input type="number" name="items[' + idx + '][harga_barang]" class="form-control form-control-sm harga text-right" min="0" step="1" value="0" required></td>' +
            '<td class="text-right total-display align-middle">0</td>' +
            '<td class="text-center align-middle">' +
                '<input type="hidden" class="total-val" value="0">' +
                '<button type="button" class="btn btn-danger btn-sm remove-item py-0 px-1" title="Hapus"><i class="fas fa-trash"></i></button>' +
            '</td>';
    }

    function updateRemove() {
        var rows = document.querySelectorAll('#itemsBody .item-row');
        var disable = rows.length <= 1;
        rows.forEach(function (r) {
            var b = r.querySelector('.remove-item');
            if (b) b.disabled = disable;
        });
    }

    function onDocClick(e) {
        var t = e && e.target;
        if (!t || !t.closest) return;
        var rb = t.closest('.remove-item');
        if (rb) {
            var row = rb.closest('tr');
            if (!row || !row.classList.contains('item-row')) return;
            if (document.querySelectorAll('#itemsBody .item-row').length <= 1) return;
            e.preventDefault();
            row.remove();
            renumber();
            updateSum();
            updateRemove();
        }
    }

    function onInput(e) {
        var el = e.target;
        if (!el) return;
        if (el.classList.contains('quantity') || el.classList.contains('harga')) {
            var row = el.closest ? el.closest('tr') : null;
            if (row && row.classList.contains('item-row')) calcRow(row);
        }
        if (el.id === 'income') updateSelisihPreview();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var addBtn = byId('addItem');
        if (addBtn) addBtn.addEventListener('click', function () {
            var tbody = byId('itemsBody');
            if (!tbody) return;
            var tr = document.createElement('tr');
            tr.className = 'item-row';
            tr.innerHTML = buildRow(itemIndex);
            tbody.appendChild(tr);
            itemIndex++;
            renumber();
            updateRemove();
        });

        document.addEventListener('click', onDocClick);
        document.addEventListener('input', onInput);

        renumber();
        updateSum();
        updateRemove();
    });
})();
</script>
@endpush
