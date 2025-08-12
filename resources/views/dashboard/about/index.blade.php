@extends('layouts.admin')

@section('header')
    <h1 class="m-0">Tentang Kami</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($about)
        <div class="card mb-4">
            <div class="card-body">
                @if($about->image)
                    <img src="{{ asset('storage/'.$about->image) }}" alt="Tentang Kami" class="img-thumbnail mb-3" style="max-width: 300px;">
                @endif
                <h3>{{ $about->title }}</h3>
                <p>{{ $about->description }}</p>
                @if($about->list_items)
                    <ul>
                        @foreach(explode("\n", $about->list_items) as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
                <a href="{{ route('dashboard.about.edit', $about) }}" class="btn btn-warning mt-3">Edit</a>
            </div>
        </div>
    @else
        <a href="{{ route('dashboard.about.create') }}" class="btn btn-success">Tambah Tentang Kami</a>
    @endif
@endsection 