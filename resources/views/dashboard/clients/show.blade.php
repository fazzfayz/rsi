@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Detail Client</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('clients.edit', $client) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nama Client</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $client->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Status</label>
                        <div class="mt-1">{!! $client->status_badge !!}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tahun Bergabung</label>
                        <p class="text-lg text-gray-900">{{ $client->join_year }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Alamat</label>
                        <p class="text-gray-900">{{ $client->address }}</p>
                    </div>
                    @if($client->phone)
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nomor Telepon</label>
                        <p class="text-gray-900">{{ $client->phone }}</p>
                    </div>
                    @endif
                    @if($client->email)
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Email</label>
                        <p class="text-gray-900">
                            <a href="mailto:{{ $client->email }}" class="text-blue-600 hover:text-blue-800">{{ $client->email }}</a>
                        </p>
                    </div>
                    @endif
                    @if($client->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Deskripsi</label>
                        <p class="text-gray-900">{{ $client->description }}</p>
                    </div>
                    @endif
                    <div class="flex justify-between items-center pt-4">
                        <div class="text-sm text-gray-500">Dibuat: {{ $client->created_at->format('d F Y H:i') }}</div>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus client ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus Client</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 