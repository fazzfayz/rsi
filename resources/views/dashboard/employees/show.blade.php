@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Detail Karyawan</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <!-- Employee Photo and Basic Info -->
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    <div class="md:w-1/3">
                        @if($employee->photo)
                            <img src="{{ asset('storage/employees/' . $employee->photo) }}" 
                                 alt="{{ $employee->name }}" 
                                 class="w-full h-64 object-cover rounded-lg shadow-md">
                        @else
                            <div class="w-full h-64 bg-gray-300 rounded-lg shadow-md flex items-center justify-center">
                                <i class="fas fa-user text-gray-600 text-6xl"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="md:w-2/3">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $employee->name }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">ID Karyawan</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $employee->employee_id }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $employee->status_badge }}">
                                        @if($employee->status == 'active')
                                            Aktif
                                        @elseif($employee->status == 'inactive')
                                            Tidak Aktif
                                        @else
                                            Diberhentikan
                                        @endif
                                    </span>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Jabatan</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $employee->position }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Departemen</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $employee->department }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $employee->email }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Telepon</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $employee->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-user mr-2"></i>Informasi Pribadi
                        </h4>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                                <p class="text-gray-900">{{ $employee->name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-gray-900">{{ $employee->email }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Telepon</p>
                                <p class="text-gray-900">{{ $employee->phone }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Alamat</p>
                                <p class="text-gray-900">{{ $employee->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-briefcase mr-2"></i>Informasi Kepegawaian
                        </h4>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">ID Karyawan</p>
                                <p class="text-gray-900 font-mono">{{ $employee->employee_id }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jabatan</p>
                                <p class="text-gray-900">{{ $employee->position }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Departemen</p>
                                <p class="text-gray-900">{{ $employee->department }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Bergabung</p>
                                <p class="text-gray-900">{{ $employee->hire_date->format('d F Y') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
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
                    </div>

                    <!-- Financial Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-money-bill-wave mr-2"></i>Informasi Keuangan
                        </h4>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Gaji</p>
                                <p class="text-gray-900 text-lg font-semibold">{{ $employee->formatted_salary }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Lama Bekerja</p>
                                <p class="text-gray-900">
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $hireDate = $employee->hire_date;
                                        $diff = $now->diff($hireDate);
                                        $years = $diff->y;
                                        $months = $diff->m;
                                        $days = $diff->d;
                                        
                                        $duration = '';
                                        if ($years > 0) {
                                            $duration .= $years . ' tahun ';
                                        }
                                        if ($months > 0) {
                                            $duration .= $months . ' bulan ';
                                        }
                                        if ($days > 0 && $years == 0) {
                                            $duration .= $days . ' hari';
                                        }
                                        echo trim($duration);
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- System Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-info-circle mr-2"></i>Informasi Sistem
                        </h4>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Dibuat Pada</p>
                                <p class="text-gray-900">{{ $employee->created_at->format('d F Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500">Terakhir Diupdate</p>
                                <p class="text-gray-900">{{ $employee->updated_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                @if($employee->notes)
                    <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-sticky-note mr-2"></i>Catatan
                        </h4>
                        <p class="text-gray-900">{{ $employee->notes }}</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="mt-8 flex justify-between items-center">
                    <div class="flex space-x-2">
                        <a href="{{ route('employees.edit', $employee->id) }}" 
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit mr-2"></i>Edit Karyawan
                        </a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" 
                              method="POST" class="inline" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data karyawan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-trash mr-2"></i>Hapus Karyawan
                            </button>
                        </form>
                    </div>
                    
                    <a href="{{ route('employees.index') }}" 
                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 