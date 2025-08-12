@extends('layouts.admin')

@section('header')
    <h1 class="m-0">Edit Tentang Kami</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $about->title ?? '') }}" required>
                    @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" required>{{ old('description', $about->description ?? '') }}</textarea>
                    @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>List Keunggulan (1 baris 1 poin)</label>
                    <textarea name="list_items" class="form-control" rows="4">{{ old('list_items', $about->list_items ?? '') }}</textarea>
                    @error('list_items')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Gambar (opsional)</label>
                    @if(isset($about) && $about->image)
                        <img src="{{ asset('storage/'.$about->image) }}" alt="Tentang Kami" class="img-thumbnail mb-2" style="max-width: 200px;">
                    @endif
                    <input type="file" name="image" class="form-control-file">
                    @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection 