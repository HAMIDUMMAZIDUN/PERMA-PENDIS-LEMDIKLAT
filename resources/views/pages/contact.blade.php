@extends('layouts.app')
@section('title', 'Kontak Kami')
@section('description', 'Hubungi Lemdiklat Permapendis - Silakan kirimkan pesan, pertanyaan, atau konsultasi program kemitraan bersama kami.')

@section('content')

{{-- Elegant Page Header --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-emerald-950 text-white py-24 text-center overflow-hidden">
    {{-- High-end background decorations --}}
    <div class="absolute inset-0 opacity-15 pointer-events-none">
        <svg class="absolute top-0 right-0 w-[600px] h-[600px] text-primary-500/20 transform translate-x-1/4 -translate-y-1/4" fill="none" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="0.3" stroke-dasharray="2 2" />
        </svg>
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 space-y-6 animate-slide-up">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-semibold tracking-wide backdrop-blur-md">
            Hubungi Tim Lemdiklat
        </span>
        <h1 class="text-4xl md:text-6xl font-black tracking-tight">Hubungi Kami</h1>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-lg md:text-xl text-emerald-100/80 max-w-2xl mx-auto leading-relaxed font-medium">
            Kami siap melayani kebutuhan informasi program pelatihan, sertifikasi pengajar, kerja sama kelembagaan, serta saran terbaik untuk Anda.
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="grid lg:grid-cols-12 gap-12 items-start">

        {{-- Contact Form --}}
        <div class="card lg:col-span-7 p-8 md:p-10 space-y-6">
            <div class="space-y-2">
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Kirim Pesan Langsung</h2>
                <p class="text-gray-400 text-sm font-medium">Lengkapi formulir di bawah ini dan perwakilan kami akan membalas pesan Anda dalam 24 jam.</p>
            </div>

            @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required
                               class="form-input @error('name') border-red-400 @enderror"
                               placeholder="Masukkan nama lengkap Anda">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="form-label">Alamat Email <span class="text-red-500">*</span></label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                               class="form-input @error('email') border-red-400 @enderror"
                               placeholder="nama@email.com">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                
                <div>
                    <label for="message" class="form-label">Pesan / Detail Konsultasi <span class="text-red-500">*</span></label>
                    <textarea id="message" name="message" rows="6" required
                              class="form-input @error('message') border-red-400 @enderror"
                              placeholder="Tuliskan detail pertanyaan atau usulan kerja sama Anda di sini..."></textarea>
                    @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <button type="submit" class="btn-primary w-full py-4 text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Pesan Sekarang
                </button>
            </form>
        </div>

        {{-- Contact Info + Map --}}
        <div class="lg:col-span-5 space-y-8">
            <div class="card p-8 space-y-6">
                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Informasi Kontak Resmi</h2>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-primary-500/10 flex items-center justify-center text-primary-700 shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm dark:text-white">Alamat Kampus Utama</p>
                            <p class="text-gray-500 text-sm leading-relaxed dark:text-gray-400 mt-1 font-medium">Jl. Gedebage Selatan No.137 Kel. Cisaranteun Kidul, Kec. Gedebage, Kota Bandung, Jawa Barat 40295</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-secondary-500/10 flex items-center justify-center text-secondary-700 shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm dark:text-white">Surel Layanan Pelanggan</p>
                            <a href="mailto:info@lemdiklat-permapendis.com" class="text-primary-700 hover:text-primary-900 text-sm font-semibold dark:text-primary-400 dark:hover:text-primary-300 mt-1 block">info@lemdiklat-permapendis.com</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Google Map with premium container --}}
            <div class="rounded-3xl overflow-hidden shadow-md border border-gray-100 dark:border-emerald-950/20">
                <iframe width="100%" height="320" frameborder="0" scrolling="no"
                    src="https://maps.google.com/maps?width=100%25&height=320&hl=id&q=Jl.+Gedebage+Selatan+No.137,+Bandung&t=&z=14&ie=UTF8&iwloc=B&output=embed"
                    class="block filter grayscale dark:invert-[0.9] dark:hue-rotate-[180deg]">
                </iframe>
            </div>
        </div>
    </div>
</section>
@endsection
