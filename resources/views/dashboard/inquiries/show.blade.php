@extends('layouts.admin')

@section('title', 'Detail Inquiry - ' . $inquiry->name)

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">Detail Inquiry Masuk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inquiries.index') }}">Inquiry Masuk</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Info Pengirim -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3">
                            <div class="avatar-placeholder rounded-circle bg-primary d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 28px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        </div>

                        <h3 class="profile-username text-center font-weight-bold">{{ $inquiry->name }}</h3>
                        <p class="text-muted text-center">{{ $inquiry->company ?: 'Individu / Belum ada info PT' }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email:</b> <a href="mailto:{{ $inquiry->email }}" class="float-right">{{ $inquiry->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Telepon / WA:</b> 
                                <span class="float-right">
                                    @if($inquiry->phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank">
                                            {{ $inquiry->phone }} <i class="fab fa-whatsapp text-success"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Layanan Dicari:</b> 
                                <span class="badge badge-info float-right">{{ $inquiry->service_needed ?: 'Konsultasi Umum' }}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Waktu Masuk:</b> <span class="float-right text-muted">{{ $inquiry->created_at->format('d M Y, H:i') }}</span>
                            </li>
                        </ul>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('inquiries.index') }}" class="btn btn-default">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                            @if($inquiry->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}?text=Halo%20{{ urlencode($inquiry->name) }},%20kami%20dari%20PT%20Ruang%20Solusi%20Internusa%20(RSI)%20menanggapi%20inquiry%20Anda." target="_blank" class="btn btn-success">
                                    <i class="fab fa-whatsapp mr-1"></i> Hubungi WA
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Pesan Kebutuhan -->
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-comment-alt mr-1"></i> Pesan & Kebutuhan Klien
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="p-4 bg-light rounded" style="font-size: 15px; line-height: 1.8; white-space: pre-line;">
                            {{ $inquiry->message }}
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                            <form action="{{ route('inquiries.toggle-read', $inquiry) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $inquiry->is_read ? 'btn-secondary' : 'btn-success' }}">
                                    <i class="fas {{ $inquiry->is_read ? 'fa-envelope' : 'fa-check' }} mr-1"></i>
                                    {{ $inquiry->is_read ? 'Tandai Belum Dibaca' : 'Tandai Selesai / Dibaca' }}
                                </button>
                            </form>

                            <form action="{{ route('inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Hapus data inquiry ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash mr-1"></i> Hapus Inquiry
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
