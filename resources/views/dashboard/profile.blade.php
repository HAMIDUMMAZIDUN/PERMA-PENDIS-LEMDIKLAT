@extends('layouts.dashboard')
@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')
@section('page-subtitle', 'Kelola informasi profil Anda')

@section('content')
<div class="max-w-2xl">

    @if(session('success'))
    <div class="alert-success mb-6">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-error mb-6">{{ session('error') }}</div>
    @endif

    {{-- Profile Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6 dark:bg-gray-900 dark:border-gray-800">
        <div class="bg-gradient-to-r from-primary-900 to-primary-700 px-6 py-8 flex flex-col items-center text-white relative">
            {{-- Avatar --}}
            <div class="relative mb-4">
                @if($user->profile?->profile_picture)
                    <img src="{{ asset('uploads/profile-photos/' . $user->profile->profile_picture) }}"
                         alt="Foto Profil" id="preview-img"
                         class="w-28 h-28 rounded-full object-cover border-4 border-white shadow-lg">
                @else
                    <div id="avatar-fallback" class="w-28 h-28 rounded-full bg-white/20 border-4 border-white flex items-center justify-center text-3xl font-bold shadow-lg">
                        {{ $user->initials }}
                    </div>
                @endif
                {{-- Upload trigger --}}
                <button onclick="document.getElementById('photo-input').click()"
                        class="absolute -bottom-1 -right-1 w-9 h-9 bg-white rounded-full flex items-center justify-center text-primary-700 shadow-md hover:bg-emerald-50 transition dark:bg-gray-900">
                    
                </button>
            </div>
            <h2 class="text-xl font-bold">{{ $user->display_name }}</h2>
            <p class="text-emerald-200 text-sm">{{ $user->role?->name ?? 'User' }}</p>
            <p class="text-emerald-200 text-xs mt-1 font-mono">{{ $user->username }}</p>
        </div>

        {{-- Photo Upload (hidden form) --}}
        <form action="{{ route('dashboard.profile.photo') }}" method="POST" enctype="multipart/form-data" id="photo-form">
            @csrf
            <input type="file" id="photo-input" name="photo" accept="image/*" class="hidden"
                   onchange="document.getElementById('photo-form').submit()">
        </form>

        {{-- Profile Form --}}
        <div class="p-6">
            <form action="{{ route('dashboard.profile.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Username</label>
                        <input type="text" value="{{ $user->username }}" disabled
                               class="form-input bg-gray-50 text-gray-500 cursor-not-allowed dark:bg-gray-800 dark:text-gray-400">
                        <p class="text-xs text-gray-400 mt-1">Username tidak dapat diubah</p>
                    </div>
                    <div>
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->profile?->name) }}" required
                               class="form-input @error('name') border-red-400 @enderror">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->profile?->email) }}" required
                               class="form-input @error('email') border-red-400 @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone', $user->profile?->phone) }}"
                               class="form-input" placeholder="08xx-xxxx-xxxx">
                    </div>
                    <div>
                        <label for="city" class="form-label">Kota</label>
                        <input id="city" name="city" type="text" value="{{ old('city', $user->profile?->city) }}"
                               class="form-input" placeholder="Bandung">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address" class="form-label">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="3"
                                  class="form-input"
                                  placeholder="Masukkan alamat lengkap">{{ old('address', $user->profile?->address) }}</textarea>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2 border-t border-gray-100 dark:border-gray-800">
                    <button type="submit" class="btn-primary">
                        
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Account Info --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 dark:bg-gray-900 dark:border-gray-800">
        <h3 class="font-bold text-gray-900 text-lg mb-4 dark:text-white">Informasi Akun</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                <span class="text-gray-500 dark:text-gray-400">Status</span>
                <span class="font-medium {{ $user->is_activated ? 'text-teal-600' : 'text-red-500' }}">
                    {{ $user->is_activated ? '✓ Aktif' : '✗ Tidak Aktif' }}
                </span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                <span class="text-gray-500 dark:text-gray-400">Role</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $user->role?->name ?? '-' }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                <span class="text-gray-500 dark:text-gray-400">Bergabung</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $user->created_at->locale('id')->isoFormat('D MMM YYYY') }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                <span class="text-gray-500 dark:text-gray-400">Terakhir Update</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $user->updated_at->locale('id')->isoFormat('D MMM YYYY') }}</span>
            </div>
            <div class="sm:col-span-2 py-2">
                <span class="text-gray-500 text-xs dark:text-gray-400">ID Pengguna</span>
                <p class="font-mono text-xs text-gray-700 mt-1 break-all dark:text-gray-300">{{ $user->id }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
