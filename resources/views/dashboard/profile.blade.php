@extends('layouts.dashboard')
@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')
@section('page-subtitle', 'Kelola informasi profil Anda')

@section('content')
<div class="max-w-3xl space-y-8 animate-fade-in">

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
    @endif

    {{-- Profile Exquisite Card --}}
    <div class="card p-0 overflow-hidden">
        {{-- High-end Banner Header --}}
        <div class="bg-gradient-to-r from-primary-950 via-primary-900 to-emerald-950 px-8 py-10 flex flex-col items-center text-white relative">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(252,211,77,0.04),transparent_40%)]"></div>
            
            {{-- Avatar Wrapper with Gradient Halo --}}
            <div class="relative mb-4 group z-10">
                <div class="absolute -inset-1.5 bg-gradient-to-tr from-primary-500 to-secondary-400 rounded-full opacity-60 blur-sm group-hover:opacity-100 transition duration-500"></div>
                
                @if($user->profile?->profile_picture)
                    <img src="{{ asset('uploads/profile-photos/' . $user->profile->profile_picture) }}"
                         alt="Foto Profil" id="preview-img"
                         class="relative w-28 h-28 rounded-full object-cover border-4 border-white dark:border-[#0c1410] shadow-xl group-hover:scale-102 transition duration-500">
                @else
                    <div id="avatar-fallback" class="relative w-28 h-28 rounded-full bg-white/10 border-4 border-white dark:border-[#0c1410] flex items-center justify-center text-4xl font-black shadow-xl">
                        {{ $user->initials }}
                    </div>
                @endif
                
                {{-- Upload Trigger Button --}}
                <button onclick="document.getElementById('photo-input').click()"
                        class="absolute -bottom-1.5 -right-1.5 w-10 h-10 bg-white dark:bg-[#0c1410] rounded-full flex items-center justify-center text-primary-900 dark:text-primary-350 shadow-lg hover:scale-105 active:scale-95 transition"
                        title="Unggah Foto Profil Baru (Maksimal 500MB)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </button>
            </div>
            
            <h2 class="text-2xl font-black tracking-tight z-10">{{ $user->display_name }}</h2>
            <div class="flex items-center gap-2 mt-2 z-10">
                <span class="badge-primary px-3 py-0.5 bg-white/15 border-0 text-white font-bold text-xs">{{ $user->role?->name ?? 'User' }}</span>
                <span class="text-xs font-bold font-mono text-emerald-250 opacity-80">{{ $user->username }}</span>
            </div>
        </div>

        {{-- Hidden Form for Image Upload --}}
        <form action="{{ route('dashboard.profile.photo') }}" method="POST" enctype="multipart/form-data" id="photo-form">
            @csrf
            <input type="file" id="photo-input" name="photo" accept="image/*" class="hidden"
                   onchange="document.getElementById('photo-form').submit()">
        </form>

        {{-- Profile Form --}}
        <div class="p-8">
            <form action="{{ route('dashboard.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="form-label">Username</label>
                        <input type="text" value="{{ $user->username }}" disabled
                               class="form-input bg-gray-100 text-gray-500 cursor-not-allowed dark:bg-[#070c0a] dark:border-emerald-950/20 dark:text-gray-500">
                        <p class="text-xs text-gray-400 mt-1.5 font-medium">Username unik ini permanen & tidak dapat diubah</p>
                    </div>
                    <div>
                        <label for="name" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->profile?->name) }}" required
                               class="form-input @error('name') border-red-400 @enderror">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="form-label">Alamat Email <span class="text-red-500">*</span></label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->profile?->email) }}" required
                               class="form-input @error('email') border-red-400 @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="form-label">Nomor Telepon / WhatsApp</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone', $user->profile?->phone) }}"
                               class="form-input" placeholder="Contoh: 0812-3456-7890">
                    </div>
                    <div>
                        <label for="city" class="form-label">Kota Tinggal</label>
                        <input id="city" name="city" type="text" value="{{ old('city', $user->profile?->city) }}"
                               class="form-input" placeholder="Bandung">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address" class="form-label">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="3"
                                  class="form-input"
                                  placeholder="Masukkan alamat domisili lengkap Anda">{{ old('address', $user->profile?->address) }}</textarea>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 dark:border-emerald-950/20">
                    <button type="submit" class="btn-primary py-3.5 px-8">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Account Info Summary --}}
    <div class="card p-8">
        <h3 class="font-extrabold text-gray-900 text-lg mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Status & Informasi Akun</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm font-semibold">
            <div class="flex justify-between py-3 border-b border-gray-150/40 dark:border-emerald-950/20">
                <span class="text-gray-400 font-bold uppercase tracking-wider text-[11px] mt-0.5">Status Akun</span>
                <span class="{{ $user->is_activated ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500' }}">
                    {{ $user->is_activated ? '✓ Aktif / Terverifikasi' : '✗ Tertunda' }}
                </span>
            </div>
            <div class="flex justify-between py-3 border-b border-gray-150/40 dark:border-emerald-950/20">
                <span class="text-gray-400 font-bold uppercase tracking-wider text-[11px] mt-0.5">Peran Sistem</span>
                <span class="text-gray-900 dark:text-white">{{ $user->role?->name ?? '-' }}</span>
            </div>
            <div class="flex justify-between py-3 border-b border-gray-150/40 dark:border-emerald-950/20">
                <span class="text-gray-400 font-bold uppercase tracking-wider text-[11px] mt-0.5">Tanggal Registrasi</span>
                <span class="text-gray-900 dark:text-white">{{ $user->created_at->locale('id')->isoFormat('D MMMM YYYY') }}</span>
            </div>
            <div class="flex justify-between py-3 border-b border-gray-150/40 dark:border-emerald-950/20">
                <span class="text-gray-400 font-bold uppercase tracking-wider text-[11px] mt-0.5">Pembaruan Terakhir</span>
                <span class="text-gray-900 dark:text-white">{{ $user->updated_at->locale('id')->isoFormat('D MMMM YYYY') }}</span>
            </div>
            <div class="sm:col-span-2 py-3">
                <span class="text-gray-400 font-bold uppercase tracking-wider text-[11px]">ID Enkripsi Pengguna</span>
                <p class="font-mono text-xs text-gray-500 mt-2 break-all p-3.5 bg-gray-50 dark:bg-[#070c0a] dark:border dark:border-emerald-950/20 rounded-2xl">{{ $user->id }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
