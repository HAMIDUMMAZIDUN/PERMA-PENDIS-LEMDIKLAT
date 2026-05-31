@extends('layouts.dashboard')
@section('title', 'Pengaturan Tampilan')
@section('page-title', 'Pengaturan Tampilan')
@section('page-subtitle', 'Atur konten teks sambutan dan multimedia di halaman utama Beranda')

@section('content')
<div class="max-w-4xl space-y-8 animate-fade-in">

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Welcome Content Card --}}
        <div class="card p-8">
            <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Konten Sambutan (Hero Section)</h2>
            <div class="space-y-5">
                <div>
                    <label for="home_welcome_title" class="form-label font-bold text-sm">Judul Utama Sambutan <span class="text-red-500">*</span></label>
                    <input id="home_welcome_title" name="home_welcome_title" type="text" 
                           value="{{ old('home_welcome_title', $settings['home_welcome_title']) }}" required
                           class="form-input @error('home_welcome_title') border-red-400 @enderror"
                           placeholder="Contoh: Selamat Datang di Lemdiklat Permapendis">
                    @error('home_welcome_title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="home_welcome_desc" class="form-label font-bold text-sm">Deskripsi / Teks Pembuka <span class="text-red-500">*</span></label>
                    <textarea id="home_welcome_desc" name="home_welcome_desc" rows="4" required
                              class="form-input @error('home_welcome_desc') border-red-400 @enderror"
                              placeholder="Masukkan paragraf penjelasan singkat mengenai Lembaga Anda...">{{ old('home_welcome_desc', $settings['home_welcome_desc']) }}</textarea>
                    @error('home_welcome_desc')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Background Configuration Card --}}
        <div class="card p-8">
            <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Pengaturan Latar Belakang Beranda</h2>
            
            <div class="space-y-6">
                {{-- Type Selection --}}
                <div>
                    <span class="block text-sm font-semibold text-gray-700 mb-3 dark:text-gray-300">Tipe Latar Belakang</span>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 cursor-pointer font-semibold text-sm">
                            <input type="radio" name="home_bg_type" value="color" 
                                   {{ old('home_bg_type', $settings['home_bg_type'] ?? 'color') === 'color' ? 'checked' : '' }}
                                   class="text-primary-650 focus:ring-primary-500">
                            Warna Solid (Solid Color)
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer font-semibold text-sm">
                            <input type="radio" name="home_bg_type" value="image" 
                                   {{ old('home_bg_type', $settings['home_bg_type'] ?? 'color') === 'image' ? 'checked' : '' }}
                                   class="text-primary-650 focus:ring-primary-500">
                            Gambar Latar (Background Image)
                        </label>
                    </div>
                </div>

                {{-- Color Options (Hex Pickers) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-50 pt-6 dark:border-emerald-950/20">
                    <div>
                        <label for="home_bg_color" class="form-label font-bold text-sm">Warna Latar (Light Mode)</label>
                        <div class="flex gap-3 items-center">
                            <input id="home_bg_color" name="home_bg_color" type="color" 
                                   value="{{ old('home_bg_color', $settings['home_bg_color'] ?? '#e8f4fd') }}"
                                   class="w-12 h-12 rounded-xl cursor-pointer border border-gray-200 bg-transparent p-0">
                            <input type="text" id="home_bg_color_hex" value="{{ old('home_bg_color', $settings['home_bg_color'] ?? '#e8f4fd') }}"
                                   oninput="document.getElementById('home_bg_color').value = this.value"
                                   class="form-input py-2 flex-1 text-sm font-semibold uppercase" placeholder="#ffffff">
                        </div>
                    </div>

                    <div>
                        <label for="home_bg_color_dark" class="form-label font-bold text-sm">Warna Latar (Dark Mode)</label>
                        <div class="flex gap-3 items-center">
                            <input id="home_bg_color_dark" name="home_bg_color_dark" type="color" 
                                   value="{{ old('home_bg_color_dark', $settings['home_bg_color_dark'] ?? '#070e17') }}"
                                   class="w-12 h-12 rounded-xl cursor-pointer border border-gray-200 bg-transparent p-0">
                            <input type="text" id="home_bg_color_dark_hex" value="{{ old('home_bg_color_dark', $settings['home_bg_color_dark'] ?? '#070e17') }}"
                                   oninput="document.getElementById('home_bg_color_dark').value = this.value"
                                   class="form-input py-2 flex-1 text-sm font-semibold uppercase" placeholder="#000000">
                        </div>
                    </div>
                </div>

                {{-- Image Options (File / URL) --}}
                <div class="border-t border-gray-50 pt-6 dark:border-emerald-950/20 space-y-4">
                    <span class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Konfigurasi Gambar Latar</span>
                    
                    @if(!empty($settings['home_bg_image']))
                    <div class="w-full h-40 rounded-2xl overflow-hidden border border-gray-200 relative mb-4 dark:border-emerald-950/20 shadow-sm">
                        <img src="{{ $settings['home_bg_image'] }}" alt="Current BG" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 px-3 py-1 bg-black/60 backdrop-blur text-white text-[10px] font-bold rounded-full">Background Aktif Saat Ini</span>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-450 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Unggah Gambar Latar Baru</label>
                            <input type="file" name="home_bg_image_file" accept="image/*"
                                   class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                            @error("home_bg_image_file")
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Atau Gunakan URL Gambar</label>
                            <input type="url" name="home_bg_image_url" placeholder="https://example.com/background.jpg"
                                   class="form-input py-2 text-xs">
                            @error("home_bg_image_url")
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Photos Grid Management Card --}}
        <div class="card p-8">
            <h2 class="text-xl font-extrabold text-gray-900 mb-2 dark:text-white">Kelola Foto Grid Hero (5 Foto)</h2>
            <p class="text-gray-400 text-xs mb-6 font-semibold">Anda dapat mengunggah file foto baru dari perangkat Anda (Maksimal 500MB per foto) ATAU menempelkan URL gambar langsung dari internet.</p>
            
            <div class="space-y-6">
                @for($i = 1; $i <= 5; $i++)
                <div class="p-5 rounded-2xl border border-gray-100 bg-gray-50/50 dark:border-emerald-950/20 dark:bg-[#080d0b]/40 flex flex-col md:flex-row gap-6 items-center">
                    {{-- Image Preview with Outer border --}}
                    <div class="w-32 h-20 rounded-xl overflow-hidden shrink-0 border border-gray-200 shadow-sm dark:border-emerald-950/40 relative">
                        <img src="{{ $settings["home_img_{$i}"] }}" alt="Preview {{ $i }}" class="w-full h-full object-cover">
                    </div>
                    
                    {{-- Form Controls --}}
                    <div class="flex-1 w-full space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-extrabold text-primary-900 dark:text-white">Foto Grid #{{ $i }}</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Upload File Option --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-450 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Unggah Foto Baru</label>
                                <input type="file" name="home_img_file_{{ $i }}" accept="image/*"
                                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                                @error("home_img_file_{$i}")
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Image URL Option --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-450 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Atau Gunakan URL Gambar</label>
                                <input type="url" name="home_img_url_{{ $i }}" placeholder="https://example.com/image.jpg"
                                       class="form-input py-2 text-xs">
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
        <div class="card p-8">
            <h2 class="text-xl font-extrabold text-gray-900 mb-2 dark:text-white">Kelola Foto Skema Pelatihan (3 Foto)</h2>
            <p class="text-gray-400 text-xs mb-6 font-semibold">Atur gambar skema untuk jenjang SD/MI, SMP/MTS, dan SMA/SMK di halaman Beranda (Maksimal 500MB per foto).</p>
            
            <div class="space-y-6">
                @php
                    $badges = [1 => 'SD/MI', 2 => 'SMP/MTS', 3 => 'SMA/SMK'];
                @endphp
                @for($i = 1; $i <= 3; $i++)
                <div class="p-5 rounded-2xl border border-gray-100 bg-gray-50/50 dark:border-emerald-950/20 dark:bg-[#080d0b]/40 flex flex-col md:flex-row gap-6 items-center">
                    {{-- Image Preview --}}
                    <div class="w-32 h-20 rounded-xl overflow-hidden shrink-0 border border-gray-200 shadow-sm dark:border-emerald-950/40 relative">
                        <img src="{{ $settings["home_program_img_{$i}"] }}" alt="Preview {{ $i }}" class="w-full h-full object-cover">
                    </div>
                    
                    {{-- Form Controls --}}
                    <div class="flex-1 w-full space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-extrabold text-primary-900 dark:text-white">Skema Jenjang {{ $badges[$i] }}</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Upload File Option --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Unggah Foto Baru</label>
                                <input type="file" name="home_program_img_file_{{ $i }}" accept="image/*"
                                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                                @error("home_program_img_file_{$i}")
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Image URL Option --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Atau Gunakan URL Gambar</label>
                                <input type="url" name="home_program_img_url_{{ $i }}" placeholder="https://example.com/image.jpg"
                                       class="form-input py-2 text-xs">
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
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('dashboard') }}" class="btn-secondary py-3 px-8 text-sm">Batal</a>
            <button type="submit" class="btn-primary py-3 px-8 text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
