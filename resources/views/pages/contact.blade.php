@extends('layouts.app')
@section('title', 'Kontak Kami')

@section('content')

<section class="bg-gradient-to-br from-primary-900 to-primary-700 text-white py-20 text-center">
    <div class="max-w-3xl mx-auto px-4 animate-slide-up">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Kontak Kami</h1>
        <p class="text-xl text-emerald-100">Hubungi kami untuk informasi program, kerja sama, atau pertanyaan lainnya.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-2 gap-10">

        {{-- Contact Form --}}
        <div class="card">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 dark:text-white">Kirim Pesan</h2>

            @if(session('success'))
            <div class="alert-success mb-6">{{ session('success') }}</div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                           class="form-input @error('name') border-red-400 @enderror"
                           placeholder="Masukkan nama Anda">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="form-label">Alamat Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                           class="form-input @error('email') border-red-400 @enderror"
                           placeholder="nama@example.com">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="message" class="form-label">Pesan</label>
                    <textarea id="message" name="message" rows="5" required
                              class="form-input @error('message') border-red-400 @enderror"
                              placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                    @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-primary w-full justify-center">
                    
                    Kirim Pesan
                </button>
            </form>
        </div>

        {{-- Contact Info + Map --}}
        <div class="space-y-6">
            <div class="card">
                <h2 class="text-xl font-bold text-gray-900 mb-5 dark:text-white">Informasi Kontak</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        
                        <div>
                            <p class="font-semibold text-gray-900 text-sm dark:text-white">Alamat</p>
                            <p class="text-gray-500 text-sm dark:text-gray-400">Jl. Gedebage Selatan No.137 Kel. Cisaranteun Kidul, Kec. Gedebage, Kota Bandung 40295</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        
                        <div>
                            <p class="font-semibold text-gray-900 text-sm dark:text-white">Email</p>
                            <a href="mailto:info@lemdiklat-permapendis.com" class="text-primary-700 hover:underline text-sm">info@lemdiklat-permapendis.com</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Google Map --}}
            <div class="rounded-2xl overflow-hidden shadow-md border border-gray-200 dark:border-gray-800">
                <iframe width="100%" height="300" frameborder="0" scrolling="no"
                    src="https://maps.google.com/maps?width=100%25&height=300&hl=id&q=Jl.+Gedebage+Selatan+No.137,+Bandung&t=&z=14&ie=UTF8&iwloc=B&output=embed"
                    class="block">
                </iframe>
            </div>
        </div>
    </div>
</section>
@endsection
