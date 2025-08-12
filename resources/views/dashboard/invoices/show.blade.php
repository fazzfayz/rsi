@extends('layouts.admin')

@section('header')
    <h1 class="m-0">Detail Invoice</h1>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Invoice Header -->
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $invoice->invoice_number }}</h2>
                        <p class="text-gray-600">{{ $invoice->client->name }}</p>
                    </div>
                    <div class="text-right">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $invoice->status_badge }}">
                            {{ $invoice->status_text }}
                        </span>
                    </div>
                </div>

                <!-- Invoice Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Invoice</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Invoice:</span>
                                <span class="font-medium">{{ $invoice->formatted_invoice_date }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Jatuh Tempo:</span>
                                <span class="font-medium">{{ $invoice->formatted_due_date }}</span>
                            </div>
                            @if($invoice->vendor_code)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Kode Vendor:</span>
                                    <span class="font-medium">{{ $invoice->vendor_code }}</span>
                                </div>
                            @endif
                            @if($invoice->attention_to)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Attention To:</span>
                                    <span class="font-medium">{{ $invoice->attention_to }}</span>
                                </div>
                            @endif
                            @if($invoice->attention_name)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Jabatan:</span>
                                    <span class="font-medium">{{ $invoice->attention_name }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Client</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama:</span>
                                <span class="font-medium">{{ $invoice->client->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium">{{ $invoice->client->email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Telepon:</span>
                                <span class="font-medium">{{ $invoice->client->phone }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Alamat:</span>
                                <span class="font-medium">{{ $invoice->client->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Items -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Item Invoice</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deskripsi
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga Satuan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($invoice->items as $index => $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $item->description }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Totals -->
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subtotal</label>
                            <div class="text-lg font-bold text-gray-900">
                                Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">PPN 12%</label>
                            <div class="text-lg font-bold text-gray-900">
                                Rp {{ number_format($invoice->ppn_amount, 0, ',', '.') }}
                                @if($invoice->include_ppn)
                                    <span class="text-sm text-gray-500">(DPP: 11/12 x Total)</span>
                                @else
                                    <span class="text-sm text-gray-500">(Tidak termasuk)</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Total</label>
                            <div class="text-lg font-bold text-blue-600">
                                Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                @if($invoice->notes)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Catatan</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $invoice->notes }}</p>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex justify-between items-center">
                    <div class="flex space-x-4">
                        <a href="{{ route('invoices.edit', $invoice->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            <i class="fas fa-edit mr-2"></i>Edit Invoice
                        </a>
                        
                        @if($invoice->pdf_path && file_exists(public_path($invoice->pdf_path)))
                            <a href="{{ route('invoices.download-pdf', $invoice->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                <i class="fas fa-download mr-2"></i>Download PDF
                            </a>
                        @else
                            <a href="{{ route('invoices.generate-pdf', $invoice->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                                <i class="fas fa-file-pdf mr-2"></i>Generate PDF
                            </a>
                        @endif
                        
                        <a href="{{ route('invoices.generate-pdf', $invoice->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-sync mr-2"></i>Regenerate PDF
                        </a>
                    </div>

                    <div class="flex space-x-4">
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" 
                              method="POST" class="inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus invoice ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                <i class="fas fa-trash mr-2"></i>Hapus Invoice
                            </button>
                        </form>
                        
                        <a href="{{ route('invoices.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 bg-white shadow-sm">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 