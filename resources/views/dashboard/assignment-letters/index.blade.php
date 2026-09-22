@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Surat Tugas</h2>
                    <a href="{{ route('assignment-letters.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-plus mr-2"></i>Buat Surat Tugas
                    </a>
                </div>

                <!-- Search and Filter -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    <form method="GET" action="{{ route('assignment-letters.index') }}" class="flex flex-wrap gap-4">
                        <div class="flex-1 min-w-64">
                            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nomor surat, nama penandatangan, atau penerima tugas..." 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="min-w-48">
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                                <option value="draft" {{ $status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-search mr-2"></i>Cari
                            </button>
                            <a href="{{ route('assignment-letters.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-refresh mr-2"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Letters Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">No. Surat</th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Penandatangan</th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Penerima Tugas</th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($letters as $letter)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900 font-medium">{{ $letter->letter_number }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $letter->signer->name }}</div>
                                        <div class="text-sm leading-5 text-gray-500">{{ $letter->signer->position }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $letter->assignedTo->name }}</div>
                                        <div class="text-sm leading-5 text-gray-500">{{ $letter->assignedTo->position }}</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ Str::limit($letter->assignment_description, 50) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $letter->formatted_assignment_date }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $letter->status_badge }}">
                                            {{ $letter->status_text }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('assignment-letters.show', $letter->id) }}" 
                                               class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('assignment-letters.edit', $letter->id) }}" 
                                               class="text-green-600 hover:text-green-900" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($letter->pdf_path)
                                                <a href="{{ route('assignment-letters.download-pdf', $letter->id) }}" 
                                                   class="text-purple-600 hover:text-purple-900" title="Download PDF">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('assignment-letters.generate-pdf', $letter->id) }}" 
                                                   class="text-orange-600 hover:text-orange-900" title="Generate PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('assignment-letters.destroy', $letter->id) }}" 
                                                  method="POST" class="inline" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat tugas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center text-gray-500">
                                        Tidak ada surat tugas ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="text-sm text-gray-500 mb-3 md:mb-0">
                        Menampilkan <strong>{{ $letters->firstItem() ?? 0 }}</strong>
                        -
                        <strong>{{ $letters->lastItem() ?? 0 }}</strong>
                        dari
                        <strong>{{ $letters->total() }}</strong>
                        data
                    </div>
                    <div>
                        {{ $letters->onEachSide(1)->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 