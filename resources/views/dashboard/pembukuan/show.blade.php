@extends('layouts.admin')

@section('title', 'Detail Pembukuan')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Detail Pembukuan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pembukuan.index') }}">Pembukuan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">{{ $pembukuan->nama_project }}</h3>
                <div>
                    <a href="{{ route('pembukuan.pdf', $pembukuan) }}" class="btn btn-secondary btn-sm"><i class="fas fa-file-pdf mr-1"></i> Unduh PDF</a>
                    <a href="{{ route('pembukuan.edit', $pembukuan) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit mr-1"></i> Edit</a>
                    <a href="{{ route('pembukuan.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <strong>Tanggal Mulai</strong><br>
                        {{ $pembukuan->formatted_tanggal_mulai }}
                    </div>
                    <div class="col-md-4">
                        <strong>Tanggal Berakhir</strong><br>
                        {{ $pembukuan->formatted_tanggal_berakhir }}
                    </div>
                    <div class="col-md-4">
                        <strong>Selisih</strong><br>
                        @if($pembukuan->selisih_status === 'profit')
                            <span class="badge badge-success">{{ $pembukuan->selisih_label }}</span>
                        @elseif($pembukuan->selisih_status === 'loss')
                            <span class="badge badge-danger">{{ $pembukuan->selisih_label }}</span>
                        @else
                            <span class="text-muted">Rp 0</span>
                        @endif
                    </div>
                </div>

                <h5 class="mb-2">Tabel Barang</h5>
                <div class="table-responsive border">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width: 40px;">No</th>
                                <th>Nama Barang</th>
                                <th class="text-center" style="width: 100px;">Quantity</th>
                                <th class="text-right" style="width: 130px;">Harga Barang</th>
                                <th class="text-right" style="width: 130px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembukuan->items as $i => $item)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right">Rp {{ $item->formatted_harga_barang }}</td>
                                    <td class="text-right">Rp {{ $item->formatted_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 offset-md-6">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td><strong>Jumlah Total</strong></td>
                                <td class="text-right">Rp {{ $pembukuan->formatted_total_jumlah }}</td>
                            </tr>
                            <tr>
                                <td><strong>Income</strong></td>
                                <td class="text-right">Rp {{ $pembukuan->formatted_income }}</td>
                            </tr>
                            <tr>
                                <td><strong>Selisih</strong></td>
                                <td class="text-right">
                                    @if($pembukuan->selisih_status === 'profit')
                                        <span class="badge badge-success">{{ $pembukuan->selisih_label }}</span>
                                    @elseif($pembukuan->selisih_status === 'loss')
                                        <span class="badge badge-danger">{{ $pembukuan->selisih_label }}</span>
                                    @else
                                        Rp 0
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
