@extends('layouts.admin')

@section('header')
    <h1 class="m-0">Dashboard</h1>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(isset($stats))
            @include('components.dashboard-stats', ['stats' => $stats])
        @endif
        
        <!-- Employee Overview Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Recent Employees -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-user-tie mr-2 text-orange-600"></i>Karyawan Terbaru
                        </h3>
                        <a href="{{ route('employees.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    @if($recentEmployees->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentEmployees as $employee)
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        @if($employee->photo)
                                            <img src="{{ asset('storage/employees/' . $employee->photo) }}" 
                                                 alt="{{ $employee->name }}" 
                                                 class="h-10 w-10 rounded-full object-cover">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $employee->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            {{ $employee->position }} • {{ $employee->department }}
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $employee->status_badge }}">
                                            @if($employee->status == 'active')
                                                Aktif
                                            @elseif($employee->status == 'inactive')
                                                Tidak Aktif
                                            @else
                                                Diberhentikan
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada data karyawan</p>
                    @endif
                </div>
            </div>

            <!-- Employee Statistics -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-chart-pie mr-2 text-blue-600"></i>Statistik Karyawan
                    </h3>
                    
                    <!-- By Department -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Berdasarkan Departemen</h4>
                        <div class="space-y-2">
                            @foreach($employeesByDepartment as $dept)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">{{ $dept->department }}</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $dept->total }} karyawan</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- By Status -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Berdasarkan Status</h4>
                        <div class="space-y-2">
                            @foreach($employeesByStatus as $status)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">
                                        @if($status->status == 'active')
                                            <i class="fas fa-user-check text-green-600 mr-1"></i>Aktif
                                        @elseif($status->status == 'inactive')
                                            <i class="fas fa-user-clock text-yellow-600 mr-1"></i>Tidak Aktif
                                        @else
                                            <i class="fas fa-user-times text-red-600 mr-1"></i>Diberhentikan
                                        @endif
                                    </span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $status->total }} karyawan</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assignment Letters Overview Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Recent Assignment Letters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-file-alt mr-2 text-indigo-600"></i>Surat Tugas Terbaru
                        </h3>
                        <a href="{{ route('assignment-letters.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    @if($recentAssignmentLetters->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentAssignmentLetters as $letter)
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-file-alt text-indigo-600"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $letter->letter_number }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            {{ $letter->signer->name }} → {{ $letter->assignedTo->name }}
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $letter->status_badge }}">
                                            {{ $letter->status_text }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada surat tugas</p>
                    @endif
                </div>
            </div>

            <!-- Assignment Letters Statistics -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-chart-pie mr-2 text-indigo-600"></i>Statistik Surat Tugas
                    </h3>
                    
                    <!-- By Status -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Berdasarkan Status</h4>
                        <div class="space-y-2">
                            @foreach($assignmentLettersByStatus as $status)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">
                                        @if($status->status == 'draft')
                                            <i class="fas fa-file text-gray-600 mr-1"></i>Draft
                                        @elseif($status->status == 'active')
                                            <i class="fas fa-file-check text-green-600 mr-1"></i>Aktif
                                        @elseif($status->status == 'completed')
                                            <i class="fas fa-file-check-double text-blue-600 mr-1"></i>Selesai
                                        @else
                                            <i class="fas fa-file-times text-red-600 mr-1"></i>Dibatalkan
                                        @endif
                                    </span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $status->total }} surat</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Overview Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Recent Invoices -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-file-invoice mr-2 text-purple-600"></i>Invoice Terbaru
                        </h3>
                        <a href="{{ route('invoices.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    @if($recentInvoices->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentInvoices as $invoice)
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                            <i class="fas fa-file-invoice text-purple-600"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $invoice->invoice_number }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            {{ $invoice->client->name }} • Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $invoice->status_badge }}">
                                            {{ $invoice->status_text }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada invoice</p>
                    @endif
                </div>
            </div>

            <!-- Invoice Statistics -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-chart-pie mr-2 text-purple-600"></i>Statistik Invoice
                    </h3>
                    
                    <!-- By Status -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Berdasarkan Status</h4>
                        <div class="space-y-2">
                            @foreach($invoicesByStatus as $status)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">
                                        @if($status->status == 'draft')
                                            <i class="fas fa-file text-gray-600 mr-1"></i>Draft
                                        @elseif($status->status == 'sent')
                                            <i class="fas fa-paper-plane text-blue-600 mr-1"></i>Terkirim
                                        @elseif($status->status == 'paid')
                                            <i class="fas fa-check-circle text-green-600 mr-1"></i>Dibayar
                                        @elseif($status->status == 'overdue')
                                            <i class="fas fa-exclamation-triangle text-red-600 mr-1"></i>Terlambat
                                        @else
                                            <i class="fas fa-times-circle text-red-600 mr-1"></i>Dibatalkan
                                        @endif
                                    </span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $status->total }} invoice</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-bolt mr-2 text-yellow-600"></i>Aksi Cepat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <a href="{{ route('employees.create') }}" 
                       class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                        <i class="fas fa-user-plus text-blue-600 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium text-blue-900">Tambah Karyawan</p>
                            <p class="text-sm text-blue-700">Tambah karyawan baru</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('employees.index') }}" 
                       class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                        <i class="fas fa-list text-green-600 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium text-green-900">Lihat Semua Karyawan</p>
                            <p class="text-sm text-green-700">Kelola data karyawan</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('assignment-letters.create') }}" 
                       class="flex items-center p-4 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                        <i class="fas fa-file-plus text-indigo-600 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium text-indigo-900">Buat Surat Tugas</p>
                            <p class="text-sm text-indigo-700">Buat surat tugas baru</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('invoices.create') }}" 
                       class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                        <i class="fas fa-file-invoice text-purple-600 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium text-purple-900">Buat Invoice</p>
                            <p class="text-sm text-purple-700">Buat invoice baru</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('clients.index') }}"
                       class="flex items-center p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors">
                        <i class="fas fa-user-tie text-orange-600 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium text-orange-900">Data Client</p>
                            <p class="text-sm text-orange-700">Kelola data client</p>
                        </div>
                    </a>

                    <a href="{{ route('users.index') }}"
                       class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                        <i class="fas fa-user-shield text-purple-600 text-xl mr-3"></i>
                        <div>
                            <p class="font-medium text-purple-900">Manajemen User</p>
                            <p class="text-sm text-purple-700">Kelola user sistem</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
