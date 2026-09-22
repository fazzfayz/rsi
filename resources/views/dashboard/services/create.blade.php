@extends('layouts.admin')

@section('header')
    <h1 class="m-0">Tambah Layanan</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Tipe Layanan</label>
                    <select name="service_type" class="form-control" required>
                        <option value="managed_service" {{ old('service_type') === 'managed_service' ? 'selected' : '' }}>Managed Service</option>
                        <option value="infrastruktur_teknologi" {{ old('service_type') === 'infrastruktur_teknologi' ? 'selected' : '' }}>Infrastruktur Teknologi</option>
                        <option value="web_software_development" {{ old('service_type') === 'web_software_development' ? 'selected' : '' }}>Web & Software Development</option>
                        <option value="cloud_hosting" {{ old('service_type') === 'cloud_hosting' ? 'selected' : '' }}>Cloud Hosting</option>
                    </select>
                    @error('service_type')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi (Full)</label>
                    <textarea name="description" class="form-control" rows="8" required>{{ old('description') }}</textarea>
                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Ringkasan (Landing Page)</label>
                    <textarea name="excerpt" class="form-control" rows="3" placeholder="Opsional. Jika kosong, akan dibuat otomatis dari deskripsi.">{{ old('excerpt') }}</textarea>
                    @error('excerpt')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Label</label>
                    <input type="text" name="label" class="form-control" value="{{ old('label') }}">
                    @error('label')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Gambar Cover (opsional)</label>
                    <input type="file" name="image" class="form-control-file" accept="image/*">
                    @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Katalog PDF (opsional, khusus Managed Service)</label>
                    <input type="file" name="catalog_file" id="catalog_file" class="form-control-file" accept=".pdf,application/pdf">
                    @error('catalog_file')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label id="links_label">Link Tambahan (opsional)</label>
                    <textarea name="links_text" id="links_text" class="form-control" rows="5" placeholder="Format per baris bisa:&#10;1) Label|https://contoh.com&#10;2) mugglecloud.com">{{ old('links_text') }}</textarea>
                    <small id="links_help" class="text-muted">Bisa isi URL saja (contoh: mugglecloud.com) atau pakai format Label|URL.</small>
                    @error('links_text')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Galeri Foto (bisa banyak, opsional)</label>
                    <input type="file" name="gallery[]" class="form-control-file" accept="image/*" multiple>
                    @error('gallery')<div class="text-danger small">{{ $message }}</div>@enderror
                    @error('gallery.*')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Logo Partner (bisa banyak, opsional)</label>
                    <input type="file" name="logos[]" class="form-control-file" accept="image/*" multiple>
                    @error('logos')<div class="text-danger small">{{ $message }}</div>@enderror
                    @error('logos.*')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection 

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.querySelector('select[name="service_type"]');
    const catalogInput = document.getElementById('catalog_file');
    const linksLabel = document.getElementById('links_label');
    const linksHelp = document.getElementById('links_help');

    function updateTypeUi() {
        const t = typeSelect ? typeSelect.value : 'managed_service';
        const isManaged = t === 'managed_service';

        if (catalogInput) {
            catalogInput.required = isManaged;
        }

        if (!linksLabel || !linksHelp) return;

        if (t === 'infrastruktur_teknologi') {
            linksLabel.textContent = 'Link Marketplace (Tokopedia/Shopee)';
            linksHelp.textContent = 'Isi per baris: Nama Toko|URL Marketplace';
        } else if (t === 'web_software_development') {
            linksLabel.textContent = 'Link Portfolio Project';
            linksHelp.textContent = 'Isi per baris: Nama Project|URL Web/App';
        } else if (t === 'cloud_hosting') {
            linksLabel.textContent = 'Link Cloud Hosting';
            linksHelp.textContent = 'Isi per baris: Nama Paket|URL Hosting';
        } else {
            linksLabel.textContent = 'Link Tambahan (opsional)';
            linksHelp.textContent = 'Untuk Managed Service, link bisa dipakai untuk materi tambahan.';
        }
    }

    if (typeSelect) {
        typeSelect.addEventListener('change', updateTypeUi);
    }
    updateTypeUi();
});
</script>
@endpush