@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Detail Surat Jalan</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('delivery-orders.edit', $deliveryOrder->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        @if($deliveryOrder->pdf_path)
                            <a href="{{ route('delivery-orders.download-pdf', $deliveryOrder->id) }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-download mr-2"></i>Download PDF
                            </a>
                        @endif
                        <a href="{{ route('delivery-orders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <hr class="mb-6 border-gray-200">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>Informasi Pengiriman
                        </h3>
                        <div class="bg-gray-50 p-4 rounded-lg space-y-3 border border-gray-100">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Kirim:</span>
                                <span class="font-semibold text-gray-900">{{ $deliveryOrder->delivery_date->format('d F Y') }}</span>
                            </div>
                            @if($deliveryOrder->attention_to)
                            <div class="flex justify-between border-t pt-2 mt-2">
                                <span class="text-gray-600">Ditujukan ke:</span>
                                <span class="font-semibold text-gray-900">{{ $deliveryOrder->attention_to }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Alamat Tujuan
                        </h3>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 h-full">
                            <p class="text-gray-900 leading-relaxed">
                                <strong>{{ $deliveryOrder->client->name }}</strong><br>
                                {{ $deliveryOrder->shipping_address ?? $deliveryOrder->client->address }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-box-open mr-2 text-orange-500"></i>Daftar Barang Dikirim
                    </h3>
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nama Barang / Deskripsi</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Satuan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($deliveryOrder->items as $index => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->name }}</td>
                                        <td class="px-6 py-4 text-sm text-center font-bold text-gray-900">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->unit ?? 'Pcs' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($deliveryOrder->notes)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Catatan Tambahan</h3>
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 italic text-gray-700">
                            "{{ $deliveryOrder->notes }}"
                        </div>
                    </div>
                @endif

                <div class="flex flex-wrap justify-between items-center border-t pt-6 gap-4">
                    <div class="flex space-x-3">
                        <a href="{{ route('delivery-orders.edit', $deliveryOrder->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 shadow-sm transition">
                            <i class="fas fa-edit mr-2"></i>Edit Data
                        </a>
                        
                        @if($deliveryOrder->pdf_path)
                            <a href="{{ route('delivery-orders.download-pdf', $deliveryOrder->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 shadow-sm transition">
                                <i class="fas fa-download mr-2"></i>Download PDF
                            </a>
                        @else
                            <a href="{{ route('delivery-orders.generate-pdf', $deliveryOrder->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 shadow-sm transition">
                                <i class="fas fa-file-pdf mr-2"></i>Generate PDF
                            </a>
                        @endif
                        
                        <a href="{{ route('delivery-orders.generate-pdf', $deliveryOrder->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-sm transition">
                            <i class="fas fa-sync mr-2"></i>Update PDF
                        </a>
                    </div>

                    <div class="flex space-x-3">
                        <form action="{{ route('delivery-orders.destroy', $deliveryOrder->id) }}" 
                              method="POST" class="inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat jalan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 shadow-sm transition">
                                <i class="fas fa-trash mr-2"></i>Hapus
                            </button>
                        </form>
                        
                        <a href="{{ route('delivery-orders.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 bg-white shadow-sm transition">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection