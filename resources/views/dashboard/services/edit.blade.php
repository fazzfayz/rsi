@extends('layouts.admin')

@section('header')
    <h1 class="m-0">Edit Layanan</h1>
@endsection

@section('content')
    @php
        $defaultLinksText = collect($service->extra_links ?? [])
            ->map(fn ($item) => ($item['label'] ?? '') . '|' . ($item['url'] ?? ''))
            ->filter()
            ->implode("\n");
    @endphp
    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required>
                    @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Tipe Layanan</label>
                    <select name="service_type" class="form-control" required>
                        <option value="managed_service" {{ old('service_type', $service->service_type) === 'managed_service' ? 'selected' : '' }}>Managed Service</option>
                        <option value="infrastruktur_teknologi" {{ old('service_type', $service->service_type) === 'infrastruktur_teknologi' ? 'selected' : '' }}>Infrastruktur Teknologi</option>
                        <option value="web_software_development" {{ old('service_type', $service->service_type) === 'web_software_development' ? 'selected' : '' }}>Web & Software Development</option>
                        <option value="cloud_hosting" {{ old('service_type', $service->service_type) === 'cloud_hosting' ? 'selected' : '' }}>Cloud Hosting</option>
                    </select>
                    @error('service_type')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi (Full)</label>
                    <textarea name="description" class="form-control" rows="8" required>{{ old('description', $service->description) }}</textarea>
                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Ringkasan (Landing Page)</label>
                    <textarea name="excerpt" class="form-control" rows="3" placeholder="Opsional. Jika kosong, akan dibuat otomatis dari deskripsi.">{{ old('excerpt', $service->excerpt) }}</textarea>
                    @error('excerpt')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Label</label>
                    <input type="text" name="label" class="form-control" value="{{ old('label', $service->label) }}">
                    @error('label')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Gambar Cover (opsional)</label>
                    @if($service->image)
                        <img src="{{ url('/storage/' . ltrim($service->image, '/')) }}" alt="{{ $service->title }}" class="img-thumbnail mb-2" style="width: 120px; height: 80px; object-fit: cover;">
                    @endif
                    <input type="file" name="image" class="form-control-file" accept="image/*">
                    @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Katalog PDF (opsional, khusus Managed Service)</label>
                    @if($service->catalog_file)
                        <div class="mb-2">
                            <a href="{{ url('/storage/' . ltrim($service->catalog_file, '/')) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">
                                Lihat katalog saat ini
                            </a>
                        </div>
                    @endif
                    <input type="file" name="catalog_file" id="catalog_file" class="form-control-file" accept=".pdf,application/pdf">
                    @error('catalog_file')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label id="links_label">Link Tambahan (opsional)</label>
                    <textarea name="links_text" id="links_text" class="form-control" rows="5" placeholder="Format per baris bisa: 1) Label|https://contoh.com  2) mugglecloud.com">{{ old('links_text', $defaultLinksText) }}</textarea>
                    <small id="links_help" class="text-muted">Bisa isi URL saja (contoh: mugglecloud.com) atau pakai format Label|URL.</small>
                    @error('links_text')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Tambah Galeri Foto (bisa banyak, opsional)</label>
                    <input type="file" name="gallery[]" class="form-control-file" accept="image/*" multiple>
                    @error('gallery')<div class="text-danger small">{{ $message }}</div>@enderror
                    @error('gallery.*')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Tambah Logo Partner (bisa banyak, opsional)</label>
                    <input type="file" name="logos[]" class="form-control-file" accept="image/*" multiple>
                    @error('logos')<div class="text-danger small">{{ $message }}</div>@enderror
                    @error('logos.*')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                @if(($service->images ?? collect())->count())
                    <div class="form-group">
                        <label>Galeri Saat Ini (centang untuk hapus)</label>
                        <div class="d-flex flex-wrap" style="gap: 10px;">
                            @foreach($service->images as $img)
                                <label class="position-relative border rounded p-1" style="width: 140px;">
                                    <input type="checkbox" name="delete_gallery_ids[]" value="{{ $img->id }}" style="position:absolute; top:6px; left:6px;">
                                    <img src="{{ url('/storage/' . ltrim($img->path, '/')) }}"
                                         alt="{{ $img->alt ?: $service->title }}"
                                         style="width: 100%; height: 90px; object-fit: cover; display:block; border-radius: 4px;">
                                    <div class="small text-muted mt-1" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                        Hapus foto
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(($service->logos ?? collect())->count())
                    <div class="form-group">
                        <label>Logo Saat Ini (centang untuk hapus)</label>
                        <div class="d-flex flex-wrap" style="gap: 10px;">
                            @foreach($service->logos as $logo)
                                <label class="position-relative border rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 88px; height: 88px;">
                                    <input type="checkbox" name="delete_logo_ids[]" value="{{ $logo->id }}" style="position:absolute; top:4px; left:4px;">
                                    <img src="{{ url('/storage/' . ltrim($logo->path, '/')) }}"
                                         alt="{{ $logo->alt ?: $service->title }}"
                                         style="max-width: 60px; max-height: 60px; object-fit: contain; display:block;">
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
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
        // Hapus line yang mengatur required untuk catalogInput:
        // const isManaged = t === 'managed_service';

        // if (catalogInput) {
        //     catalogInput.required = isManaged;
        // }

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