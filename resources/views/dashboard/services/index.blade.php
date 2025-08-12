@extends('layouts.admin')

@section('header')
    <h1 class="m-0">Layanan</h1>
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('services.create') }}" class="btn btn-success">Tambah Layanan</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Label</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td class="text-center">
                        @if($service->image)
                            <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $service->title }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->label }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus layanan?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada layanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection 