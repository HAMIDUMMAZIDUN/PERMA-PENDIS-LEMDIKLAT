@extends('layouts.dashboard')
@section('title', 'Pengaturan Tampilan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between border-b border-gray-100 pb-4 dark:border-gray-800">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-900 dark:text-white">Pengaturan Tampilan</h1>
            <p class="text-gray-500 text-sm mt-1 dark:text-gray-400">Atur konten teks sambutan dan foto grid di halaman depan Beranda.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Welcome Content Card --}}
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-4 dark:text-white">Konten Sambutan (Hero Section)</h2>
            <div class="space-y-4">
                <div>
                    <label for="home_welcome_title" class="form-label">Judul Sambutan</label>
                    <input id="home_welcome_title" name="home_welcome_title" type="text" 
                           value="{{ old('home_welcome_title', $settings['home_welcome_title']) }}" required
                           class="form-input @error('home_welcome_title') border-red-400 @enderror">
                    @error('home_welcome_title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="home_welcome_desc" class="form-label">Deskripsi Sambutan</label>
                    <textarea id="home_welcome_desc" name="home_welcome_desc" rows="4" required
                              class="form-input @error('home_welcome_desc') border-red-400 @enderror">{{ old('home_welcome_desc', $settings['home_welcome_desc']) }}</textarea>
                    @error('home_welcome_desc')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Photos Grid Management Card --}}
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-2 dark:text-white">Kelola Foto Grid Hero (5 Foto)</h2>
            <p class="text-gray-500 text-xs mb-6 dark:text-gray-400">Anda dapat mengunggah file foto baru dari perangkat Anda ATAU menempelkan URL gambar langsung (misalnya dari Unsplash).</p>
            
            <div class="space-y-6">
                @for($i = 1; $i <= 5; $i++)
                <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 dark:border-gray-800 dark:bg-gray-900/30 flex flex-col md:flex-row gap-6 items-center">
                    {{-- Image Preview --}}
                    <div class="w-32 h-20 rounded-xl overflow-hidden shrink-0 border border-gray-200 shadow-sm dark:border-gray-800">
                        <img src="{{ $settings["home_img_{$i}"] }}" alt="Preview {{ $i }}" class="w-full h-full object-cover">
                    </div>
                    
                    {{-- Form Controls --}}
                    <div class="flex-1 w-full space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-primary-900 dark:text-white">Foto Grid #{{ $i }}</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Upload File Option --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-gray-400">Unggah Foto Baru</label>
                                <input type="file" name="home_img_file_{{ $i }}" accept="image/*"
                                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-gray-800 dark:file:text-gray-300 dark:hover:file:bg-gray-700/50 transition">
                                @error("home_img_file_{$i}")
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Image URL Option --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-gray-400">Atau Gunakan URL Gambar</label>
                                <input type="url" name="home_img_url_{{ $i }}" placeholder="https://example.com/image.jpg"
                                       class="form-input py-1 text-xs">
                                @error("home_img_url_{$i}")
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        {{-- Program Images Management Card --}}
        <div class="card">
            <h2 class="text-xl font-bold text-gray-900 mb-2 dark:text-white">Kelola Foto Skema Pelatihan (3 Foto)</h2>
            <p class="text-gray-500 text-xs mb-6 dark:text-gray-400">Atur gambar skema untuk jenjang SD/MI, SMP/MTS, dan SMA/SMK di halaman Beranda.</p>
            
            <div class="space-y-6">
                @php
                    $badges = [1 => 'SD/MI', 2 => 'SMP/MTS', 3 => 'SMA/SMK'];
                @endphp
                @for($i = 1; $i <= 3; $i++)
                <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 dark:border-gray-800 dark:bg-gray-900/30 flex flex-col md:flex-row gap-6 items-center">
                    {{-- Image Preview --}}
                    <div class="w-32 h-20 rounded-xl overflow-hidden shrink-0 border border-gray-200 shadow-sm dark:border-gray-800">
                        <img src="{{ $settings["home_program_img_{$i}"] }}" alt="Preview {{ $i }}" class="w-full h-full object-cover">
                    </div>
                    
                    {{-- Form Controls --}}
                    <div class="flex-1 w-full space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-primary-900 dark:text-white">Skema Jenjang {{ $badges[$i] }}</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Upload File Option --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-gray-400">Unggah Foto Baru</label>
                                <input type="file" name="home_program_img_file_{{ $i }}" accept="image/*"
                                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-gray-800 dark:file:text-gray-300 dark:hover:file:bg-gray-700/50 transition">
                                @error("home_program_img_file_{$i}")
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Image URL Option --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-gray-400">Atau Gunakan URL Gambar</label>
                                <input type="url" name="home_program_img_url_{{ $i }}" placeholder="https://example.com/image.jpg"
                                       class="form-input py-1 text-xs">
                                @error("home_program_img_url_{$i}")
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        {{-- Save Button --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('dashboard') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 transition">Batal</a>
            <button type="submit" class="btn-primary px-8">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
