@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Detail Surat Tugas</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('assignment-letters.edit', $letter->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        @if($letter->pdf_path)
                            <a href="{{ route('assignment-letters.download-pdf', $letter->id) }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-download mr-2"></i>Download PDF
                            </a>
                        @else
                            <a href="{{ route('assignment-letters.generate-pdf', $letter->id) }}" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-file-pdf mr-2"></i>Generate PDF
                            </a>
                        @endif
                        <a href="{{ route('assignment-letters.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <!-- Letter Header -->
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Surat</h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Nomor Surat</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $letter->letter_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Tanggal Surat</p>
                                    <p class="text-gray-900">{{ $letter->formatted_assignment_date }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $letter->status_badge }}">
                                        {{ $letter->status_text }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Periode Tugas</h3>
                            <div class="space-y-3">
                                @if($letter->start_date)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Tanggal Mulai</p>
                                        <p class="text-gray-900">{{ $letter->formatted_start_date }}</p>
                                    </div>
                                @endif
                                @if($letter->end_date)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Tanggal Selesai</p>
                                        <p class="text-gray-900">{{ $letter->formatted_end_date }}</p>
                                    </div>
                                @endif
                                @if($letter->location)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Lokasi</p>
                                        <p class="text-gray-900">{{ $letter->location }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Signer Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-user-tie mr-2 text-blue-600"></i>Penandatangan
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama</p>
                                <p class="text-gray-900 font-semibold">{{ $letter->signer->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jabatan</p>
                                <p class="text-gray-900">{{ $letter->signer->position }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Departemen</p>
                                <p class="text-gray-900">{{ $letter->signer->department }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-gray-900">{{ $letter->signer->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-user-check mr-2 text-green-600"></i>Penerima Tugas
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama</p>
                                <p class="text-gray-900 font-semibold">{{ $letter->assignedTo->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jabatan</p>
                                <p class="text-gray-900">{{ $letter->assignedTo->position }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Departemen</p>
                                <p class="text-gray-900">{{ $letter->assignedTo->department }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-gray-900">{{ $letter->assignedTo->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assignment Details -->
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-tasks mr-2 text-orange-600"></i>Detail Tugas
                    </h4>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Deskripsi Tugas</p>
                            <p class="text-gray-900">{{ $letter->assignment_description }}</p>
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2 text-gray-600"></i>Informasi Sistem
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Dibuat Pada</p>
                            <p class="text-gray-900">{{ $letter->created_at->format('d F Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Terakhir Diupdate</p>
                            <p class="text-gray-900">{{ $letter->updated_at->format('d F Y H:i') }}</p>
                        </div>
                        @if($letter->pdf_path)
                            <div>
                                <p class="text-sm font-medium text-gray-500">File PDF</p>
                                <p class="text-gray-900">{{ basename($letter->pdf_path) }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <a href="{{ route('assignment-letters.edit', $letter->id) }}" 
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit mr-2"></i>Edit Surat Tugas
                        </a>
                        @if($letter->pdf_path)
                            <a href="{{ route('assignment-letters.download-pdf', $letter->id) }}" 
                               class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-download mr-2"></i>Download PDF
                            </a>
                        @else
                            <a href="{{ route('assignment-letters.generate-pdf', $letter->id) }}" 
                               class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-file-pdf mr-2"></i>Generate PDF
                            </a>
                        @endif
                        <form action="{{ route('assignment-letters.destroy', $letter->id) }}" 
                              method="POST" class="inline" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat tugas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-trash mr-2"></i>Hapus Surat Tugas
                            </button>
                        </form>
                    </div>
                    
                    <a href="{{ route('assignment-letters.index') }}" 
                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 