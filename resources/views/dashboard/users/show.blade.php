@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Detail User</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Dasar -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-user mr-2 text-blue-600"></i>Informasi Dasar
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                                <p class="text-sm text-gray-900">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Email</label>
                                <p class="text-sm text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Status Email</label>
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Terverifikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>Belum Terverifikasi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Sistem -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-cog mr-2 text-green-600"></i>Informasi Sistem
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">ID User</label>
                                <p class="text-sm text-gray-900">{{ $user->id }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Dibuat Pada</label>
                                <p class="text-sm text-gray-900">{{ $user->created_at->format('d F Y H:i:s') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Terakhir Diupdate</label>
                                <p class="text-sm text-gray-900">{{ $user->updated_at->format('d F Y H:i:s') }}</p>
                            </div>
                            @if($user->email_verified_at)
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Email Diverifikasi Pada</label>
                                    <p class="text-sm text-gray-900">{{ $user->email_verified_at->format('d F Y H:i:s') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Status Akun -->
                <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2 text-purple-600"></i>Status Akun
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $user->id === auth()->id() ? 'Ya' : 'Tidak' }}</div>
                            <div class="text-sm text-gray-600">User Saat Ini</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">
                                @if($user->email_verified_at) Ya @else Tidak @endif
                            </div>
                            <div class="text-sm text-gray-600">Email Terverifikasi</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">
                                {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                            </div>
                            <div class="text-sm text-gray-600">Bergabung</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection