@extends('layouts.admin')

@section('title', 'Pengaturan Website & WMS')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">Pengaturan Website & WMS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pengaturan Website</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('dashboard.settings.update') }}" method="POST">
            @csrf

            <!-- 1. Konfigurasi WMS Featured Product -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-boxes mr-1"></i> Pengaturan WMS (Warehouse Management System)
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="wms_demo_url" class="font-weight-bold">
                            URL Live Demo WMS (WMS_DEMO_URL) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                            </div>
                            <input type="url" class="form-control" id="wms_demo_url" name="wms_demo_url"
                                   value="{{ old('wms_demo_url', $settings['wms_demo_url'] ?? config('rsi.wms_demo_url')) }}"
                                   placeholder="https://demo-wms.ruang-solusi.com" required>
                        </div>
                        <small class="form-text text-muted">
                            URL ini adalah tujuan yang akan dibuka ketika pengunjung mengklik tombol <strong>"Try WMS Live"</strong> di homepage. Anda dapat mengubahnya kapan saja tanpa perlu menyentuh source code.
                        </small>
                    </div>
                </div>
            </div>

            <!-- 2. Hero Section Content -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-desktop mr-1"></i> Konten Hero Section Homepage
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="hero_badge" class="font-weight-bold">Badge Kredibilitas Atas</label>
                        <input type="text" class="form-control" id="hero_badge" name="hero_badge"
                               value="{{ old('hero_badge', $settings['hero_badge'] ?? 'Integrated IT Infrastructure & Managed Service Provider') }}"
                               placeholder="Integrated IT Infrastructure & Managed Service Provider">
                    </div>

                    <div class="form-group">
                        <label for="hero_title" class="font-weight-bold">Headline Utama Hero</label>
                        <textarea class="form-control" id="hero_title" name="hero_title" rows="2"
                                  placeholder="Mitra Teknologi Terpercaya untuk Infrastruktur IT, Managed Service 24/7, dan Aplikasi Tailor-Made">{{ old('hero_title', $settings['hero_title'] ?? 'Mitra Teknologi Terpercaya untuk Infrastruktur IT, Managed Service 24/7, dan Aplikasi Tailor-Made') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="hero_subtitle" class="font-weight-bold">Deskripsi Ringkas Hero</label>
                        <textarea class="form-control" id="hero_subtitle" name="hero_subtitle" rows="3"
                                  placeholder="Ruang Solusi Internusa (RSI) menghadirkan solusi pengadaan dan sewa hardware berstandar enterprise...">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 3. Informasi Kontak & Operasional -->
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-address-book mr-1"></i> Kontak Resmi & Operasional Perusahaan
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_email" class="font-weight-bold">Email Bisnis</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email"
                                       value="{{ old('contact_email', $settings['contact_email'] ?? 'info@ruang-solusi.com') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_phone" class="font-weight-bold">Nomor Telepon Kantor</label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone"
                                       value="{{ old('contact_phone', $settings['contact_phone'] ?? '+62 815-1940-7954') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_whatsapp" class="font-weight-bold">WhatsApp Hotline</label>
                                <input type="text" class="form-control" id="contact_whatsapp" name="contact_whatsapp"
                                       value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '6281519407954') }}" required>
                                <small class="text-muted">Gunakan format angka tanpa tanda + (contoh: 6281519407954)</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact_address" class="font-weight-bold">Alamat Kantor Operasional</label>
                        <textarea class="form-control" id="contact_address" name="contact_address" rows="2">{{ old('contact_address', $settings['contact_address'] ?? 'Jl. Alam Utama XI, RT.13/RW.3, Bintara Jaya, Kec. Bekasi Barat, Kota Bekasi, Jawa Barat 17136') }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Simpan Semua Pengaturan
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
