@extends('layouts.admin')

@section('title', 'Purchase Order')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Purchase Order</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Purchase Order</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">Daftar Purchase Order</h3>
                <a href="{{ route('purchase-orders.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Buat PO Baru
                </a>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('purchase-orders.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="Cari nomor PO, vendor, atau ref number..." value="{{ $search }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered text-nowrap" id="poTable">
                        <thead class="thead-light">
                            <tr>
                                <th>No. PO</th>
                                <th>Tanggal</th>
                                <th>Vendor</th>
                                <th>Ref. No</th>
                                <th class="text-right">Total</th>
                                <th>Status</th>
                                <th>Penandatangan</th>
                                <th class="text-center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchaseOrders as $po)
                                <tr>
                                    <td class="font-weight-bold">{{ $po->po_number }}</td>
                                    <td>{{ $po->formatted_po_date }}</td>
                                    <td>{{ $po->vendor_name }}</td>
                                    <td>{{ $po->ref_number ?? '-' }}</td>
                                    <td class="text-right">Rp {{ $po->formatted_total_amount }}</td>
                                    <td>
                                        <span class="badge {{ $po->status_badge }}">{{ $po->status_text }}</span>
                                    </td>
                                    <td>{{ $po->signatoryEmployee->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('purchase-orders.show', $po) }}" class="btn btn-info" title="Lihat"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('purchase-orders.edit', $po) }}" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('purchase-orders.pdf', $po) }}" class="btn btn-secondary" title="PDF"><i class="fas fa-file-pdf"></i></a>
                                            <form action="{{ route('purchase-orders.destroy', $po) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus PO ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Tidak ada data Purchase Order</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $purchaseOrders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    #poTable th, #poTable td { vertical-align: middle; }
</style>
@endpush 