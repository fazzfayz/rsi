@extends('layouts.admin')

@section('header')
    <h1 class="m-0"></h1>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Surat Jalan</h2>
                    <a href="{{ route('delivery-orders.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-plus mr-2"></i>Buat Surat Jalan
                    </a>
                </div>
                <form method="GET" action="{{ route('delivery-orders.index') }}" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-0">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari nomor surat jalan, customer, atau sopir..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex-shrink-0">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @if($deliveryOrders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No. Surat Jalan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Kirim
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Item
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($deliveryOrders as $do)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-blue-600">
                                                {{ $do->do_number }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $do->client->name }}
                                            </div>
                                            <div class="text-xs text-gray-500 truncate max-w-xs">
                                                {{ Str::limit($do->shipping_address, 40) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $do->driver_name ?? '-' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $do->vehicle_no ?? 'Tanpa Kendaraan' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $do->delivery_date->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 border">
                                                {{ $do->items->count() }} Jenis Barang
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('delivery-orders.show', $do->id) }}" 
                                                   class="text-blue-600 hover:text-blue-900" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('delivery-orders.edit', $do->id) }}" 
                                                   class="text-green-600 hover:text-green-900" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                @if($do->pdf_path)
                                                    <a href="{{ route('delivery-orders.download-pdf', $do->id) }}" 
                                                       class="text-purple-600 hover:text-purple-900" title="Download PDF">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif

                                                <form action="{{ route('delivery-orders.destroy', $do->id) }}" 
                                                      method="POST" class="inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat jalan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                        <div class="text-sm text-gray-500 mb-3 mb-md-0">
                            Menampilkan <strong>{{ $deliveryOrders->firstItem() ?? 0 }}</strong>
                            -
                            <strong>{{ $deliveryOrders->lastItem() ?? 0 }}</strong>
                            dari
                            <strong>{{ $deliveryOrders->total() }}</strong>
                            data
                        </div>
                        <div>
                            {{ $deliveryOrders->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-truck-loading text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Belum ada data surat jalan</p>
                        <a href="{{ route('delivery-orders.create') }}" 
                           class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Buat Surat Jalan Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection