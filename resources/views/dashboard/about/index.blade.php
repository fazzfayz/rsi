@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Tentang Kami</h2>
                    @if($about)
                        <a href="{{ route('dashboard.about.edit', $about) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit mr-2"></i>Edit Tentang Kami
                        </a>
                    @else
                        <a href="{{ route('dashboard.about.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-plus mr-2"></i>Tambah Tentang Kami
                        </a>
                    @endif
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($about)
                    <div class="space-y-6">
                        @if($about->image)
                            <div class="flex justify-center">
                                <img src="{{ asset('storage/'.$about->image) }}" alt="Tentang Kami"
                                     class="max-w-sm h-auto rounded-lg shadow-md border">
                            </div>
                        @endif

                        <div class="prose max-w-none">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $about->title }}</h3>
                            <p class="text-gray-700 leading-relaxed mb-4">{{ $about->description }}</p>

                            @if($about->list_items)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-800 mb-2">Fitur/Kelebihan:</h4>
                                    <ul class="list-disc list-inside space-y-1 text-gray-700">
                                        @foreach(explode("\n", $about->list_items) as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-info-circle text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada konten Tentang Kami</h3>
                        <p class="text-gray-500 mb-6">Buat konten tentang perusahaan atau organisasi Anda.</p>
                        <a href="{{ route('dashboard.about.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Buat Tentang Kami Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 