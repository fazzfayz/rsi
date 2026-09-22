@extends('layouts.admin')

@section('title', 'Pesan Masuk / Inquiry Website')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">Inquiry Masuk Website</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Inquiry Masuk</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-outline card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-inbox mr-1"></i> Daftar Permintaan Konsultasi & Pesan
                </h3>
                <div class="card-tools">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('inquiries.index') }}" class="btn {{ !$status ? 'btn-primary' : 'btn-default' }}">Semua ({{ $inquiries->total() }})</a>
                        <a href="{{ route('inquiries.index', ['status' => 'unread']) }}" class="btn {{ $status === 'unread' ? 'btn-warning' : 'btn-default' }}">Belum Dibaca ({{ $unreadCount }})</a>
                        <a href="{{ route('inquiries.index', ['status' => 'read']) }}" class="btn {{ $status === 'read' ? 'btn-success' : 'btn-default' }}">Sudah Dibaca</a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Nama / PIC</th>
                            <th>Perusahaan</th>
                            <th>Email / Telepon</th>
                            <th>Kebutuhan Layanan</th>
                            <th class="text-center" style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr class="{{ !$inquiry->is_read ? 'font-weight-bold bg-light' : '' }}">
                                <td>{{ $loop->iteration + ($inquiries->currentPage() - 1) * $inquiries->perPage() }}</td>
                                <td>
                                    @if(!$inquiry->is_read)
                                        <span class="badge badge-warning"><i class="fas fa-envelope mr-1"></i> Baru</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-check mr-1"></i> Dibaca</span>
                                    @endif
                                </td>
                                <td>{{ $inquiry->created_at->format('d M Y, H:i') }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->company ?: '-' }}</td>
                                <td>
                                    <div><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></div>
                                    @if($inquiry->phone)
                                        <small class="text-muted"><i class="fas fa-phone-alt"></i> {{ $inquiry->phone }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $inquiry->service_needed ?: 'Konsultasi Umum' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('inquiries.show', $inquiry) }}" class="btn btn-info" title="Lihat Detail Pesan">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('inquiries.toggle-read', $inquiry) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-default" title="{{ $inquiry->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                                <i class="fas {{ $inquiry->is_read ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('inquiries.destroy', $inquiry) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 text-secondary d-block"></i>
                                    Belum ada inquiry atau pesan masuk dari website.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($inquiries->hasPages())
                <div class="card-footer clearfix">
                    {{ $inquiries->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
