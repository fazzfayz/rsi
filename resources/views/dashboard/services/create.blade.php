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
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Label</label>
                    <input type="text" name="label" class="form-control" value="{{ old('label') }}">
                    @error('label')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Gambar (opsional)</label>
                    <input type="file" name="image" class="form-control-file">
                    @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection 