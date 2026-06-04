@php
    $tabNames = [
        'hero' => 'Hero & Statistik',
        'background' => 'Latar & Logo',
        'about' => 'Tentang Lembaga',
        'gallery' => 'Arsip Dokumentasi',
        'contact' => 'Hubungi Kami'
    ];
    $currentTabName = $tabNames[$activeTab] ?? 'Pengaturan Tampilan';
@endphp

@extends('layouts.dashboard')
@section('title', 'Kelola ' . $currentTabName)
@section('page-title', 'Kelola ' . $currentTabName)
@section('page-subtitle', 'Perbarui detail konten ' . strtolower($currentTabName) . ' secara dinamis dan real-time')

@section('content')
<div class="max-w-4xl space-y-8 animate-fade-in">

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        <input type="hidden" name="tab" value="{{ $activeTab }}">

        @if($activeTab === 'hero')
            {{-- Welcome Content Card --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Konten Sambutan (Hero Section)</h2>
                <div class="space-y-5">
                    <div>
                        <label for="home_welcome_title" class="form-label font-bold text-sm">Judul Utama Sambutan <span class="text-red-500">*</span></label>
                        <input id="home_welcome_title" name="home_welcome_title" type="text" 
                               value="{{ old('home_welcome_title', $settings['home_welcome_title']) }}" required
                               class="form-input @error('home_welcome_title') border-red-400 @enderror"
                               placeholder="Contoh: Selamat Datang di PERMA PENDIS">
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

            {{-- Statistik Halaman Utama Card --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Statistik Halaman Utama</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label for="stat_alumni" class="form-label font-bold text-sm">Alumni Tersertifikasi <span class="text-red-500">*</span></label>
                        <input id="stat_alumni" name="stat_alumni" type="text" 
                               value="{{ old('stat_alumni', $settings['stat_alumni'] ?? '') }}" required
                               class="form-input @error('stat_alumni') border-red-400 @enderror"
                               placeholder="Contoh: 500+">
                        @error('stat_alumni')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stat_instruktur" class="form-label font-bold text-sm">Instruktur BNSP <span class="text-red-500">*</span></label>
                        <input id="stat_instruktur" name="stat_instruktur" type="text" 
                               value="{{ old('stat_instruktur', $settings['stat_instruktur'] ?? '') }}" required
                               class="form-input @error('stat_instruktur') border-red-400 @enderror"
                               placeholder="Contoh: 20+">
                        @error('stat_instruktur')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stat_program" class="form-label font-bold text-sm">Program Unggulan <span class="text-red-500">*</span></label>
                        <input id="stat_program" name="stat_program" type="text" 
                               value="{{ old('stat_program', $settings['stat_program'] ?? '') }}" required
                               class="form-input @error('stat_program') border-red-400 @enderror"
                               placeholder="Contoh: 3">
                        @error('stat_program')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stat_tahun" class="form-label font-bold text-sm">Tahun Pelayanan <span class="text-red-500">*</span></label>
                        <input id="stat_tahun" name="stat_tahun" type="text" 
                               value="{{ old('stat_tahun', $settings['stat_tahun'] ?? '') }}" required
                               class="form-input @error('stat_tahun') border-red-400 @enderror"
                               placeholder="Contoh: 10+">
                        @error('stat_tahun')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        @if($activeTab === 'background')
            {{-- Background Configuration Card --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Pengaturan Latar Belakang & Logo</h2>
                
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

                    {{-- App Logo Options (File / URL) --}}
                    <div class="border-t border-gray-50 pt-6 dark:border-emerald-950/20 space-y-4">
                        <span class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Konfigurasi Logo Aplikasi</span>
                        
                        <div id="preview-logo-container" class="w-24 h-24 rounded-xl overflow-hidden border border-gray-200 relative mb-4 dark:border-emerald-950/20 shadow-sm bg-white {{ empty($settings['app_logo']) ? 'hidden' : '' }}">
                            <img id="preview-logo" src="{{ $settings['app_logo'] ?? '' }}" alt="Current Logo" class="w-full h-full object-contain p-2">
                        </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-450 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Unggah Logo Aplikasi Baru</label>
                            <input type="file" name="app_logo_file" accept="image/*" onchange="previewSettingsImage(this, 'preview-logo')"
                                   class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                            @error("app_logo_file")
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Atau Gunakan URL Logo</label>
                            <input type="url" name="app_logo_url" placeholder="https://example.com/logo.png"
                                   class="form-input py-2 text-xs">
                            @error("app_logo_url")
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Image Options (File / URL) --}}
                <div class="border-t border-gray-50 pt-6 dark:border-emerald-950/20 space-y-4">
                    <span class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Konfigurasi Gambar Latar</span>
                    
                    <div id="preview-bg-container" class="w-full h-40 rounded-2xl overflow-hidden border border-gray-200 relative mb-4 dark:border-emerald-950/20 shadow-sm {{ empty($settings['home_bg_image']) ? 'hidden' : '' }}">
                        <img id="preview-bg" src="{{ $settings['home_bg_image'] }}" alt="Current BG" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 px-3 py-1 bg-black/60 backdrop-blur text-white text-[10px] font-bold rounded-full">Background Aktif Saat Ini</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-450 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Unggah Gambar Latar Baru</label>
                            <input type="file" name="home_bg_image_file" accept="image/*" onchange="previewSettingsImage(this, 'preview-bg')"
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
        @endif



        @if($activeTab === 'about')
            {{-- Card 3: Tentang Kami & Visi Misi --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Bagian: Tentang Kami (Visi, Misi, Values)</h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="about_badge" class="form-label font-bold text-sm">Badge Seksi <span class="text-red-500">*</span></label>
                            <input id="about_badge" name="about_badge" type="text" value="{{ old('about_badge', $settings['about_badge']) }}" required class="form-input">
                        </div>
                        <div class="md:col-span-2">
                            <label for="about_title" class="form-label font-bold text-sm">Judul Seksi <span class="text-red-500">*</span></label>
                            <input id="about_title" name="about_title" type="text" value="{{ old('about_title', $settings['about_title']) }}" required class="form-input">
                        </div>
                    </div>

                    <div>
                        <label for="about_desc" class="form-label font-bold text-sm">Deskripsi Utama <span class="text-red-500">*</span></label>
                        <textarea id="about_desc" name="about_desc" rows="3" required class="form-input">{{ old('about_desc', $settings['about_desc']) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-50 pt-6 dark:border-emerald-950/20">
                        <div>
                            <label for="about_visi" class="form-label font-bold text-sm">Visi Lembaga <span class="text-red-500">*</span></label>
                            <textarea id="about_visi" name="about_visi" rows="4" required class="form-input text-sm">{{ old('about_visi', $settings['about_visi']) }}</textarea>
                        </div>
                        <div>
                            <label for="about_misi" class="form-label font-bold text-sm">Misi Lembaga (Satu baris per poin) <span class="text-red-500">*</span></label>
                            <textarea id="about_misi" name="about_misi" rows="4" required class="form-input text-sm" placeholder="Contoh:&#10;- Misi pertama&#10;- Misi kedua">{{ old('about_misi', $settings['about_misi']) }}</textarea>
                        </div>
                    </div>



                    <div class="border-t border-gray-50 pt-6 dark:border-emerald-950/20 space-y-4">
                        <span class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Bagian: Susunan Organisasi (Tampilan Publik)</span>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <label for="org_title" class="form-label font-bold text-sm">Judul Seksi <span class="text-red-500">*</span></label>
                                <input id="org_title" name="org_title" type="text" value="{{ old('org_title', $settings['org_title']) }}" required class="form-input">
                            </div>
                            <div class="md:col-span-2">
                                <label for="org_desc" class="form-label font-bold text-sm">Deskripsi Seksi <span class="text-red-500">*</span></label>
                                <input id="org_desc" name="org_desc" type="text" value="{{ old('org_desc', $settings['org_desc']) }}" required class="form-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($activeTab === 'gallery')
            {{-- YouTube Video Gallery Card --}}
            <div class="card p-8 mb-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-2 dark:text-white">Galeri Video YouTube</h2>
                <p class="text-gray-400 text-xs mb-6 font-semibold">Kelola galeri video kegiatan dari YouTube yang ingin ditampilkan di halaman depan. Anda bisa mengatur berapa banyak yang ingin dimasukkan.</p>
                
                <div id="youtube-gallery-items-container" class="space-y-6">
                    @foreach($settings['youtube_gallery_items'] ?? [] as $index => $item)
                    <div class="p-5 rounded-2xl border border-gray-150 bg-gray-50/50 dark:border-emerald-950/20 dark:bg-[#080d0b]/40 flex flex-col gap-4 youtube-gallery-row animate-slide-up" id="youtube-gallery-item-{{ $index }}">
                        <div class="flex items-center justify-between border-b border-gray-100 dark:border-emerald-950/10 pb-2">
                            <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Video #{{ $index + 1 }}</span>
                            <button type="button" onclick="removeYoutubeRow({{ $index }})" class="text-red-500 hover:text-red-750 text-[10px] font-bold flex items-center gap-1">
                                🗑️ Hapus Video
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-550 uppercase tracking-wide">Link Video YouTube <span class="text-red-500">*</span></label>
                                <input type="url" name="youtube_gallery_items[{{ $index }}][link]" value="{{ old('youtube_gallery_items.'.$index.'.link', $item['link'] ?? '') }}" placeholder="Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="form-input py-2 text-xs" required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-550 uppercase tracking-wide">Judul Video</label>
                                    <input type="text" name="youtube_gallery_items[{{ $index }}][title]" value="{{ old('youtube_gallery_items.'.$index.'.title', $item['title'] ?? '') }}" placeholder="Masukkan judul video..." class="form-input py-2 text-xs">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-550 uppercase tracking-wide">Deskripsi Singkat</label>
                                    <input type="text" name="youtube_gallery_items[{{ $index }}][desc]" value="{{ old('youtube_gallery_items.'.$index.'.desc', $item['desc'] ?? '') }}" placeholder="Masukkan deskripsi video..." class="form-input py-2 text-xs">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Add Video Button --}}
                <div class="mt-6">
                    <button type="button" onclick="addYoutubeItem()" class="w-full py-4 rounded-2xl border-2 border-dashed border-gray-200 dark:border-emerald-950/40 hover:border-primary-500 dark:hover:border-emerald-600 transition flex items-center justify-center gap-2 text-sm font-bold text-gray-500 hover:text-primary-650 dark:text-gray-400 dark:hover:text-emerald-455">
                        <span>➕ Tambah Video YouTube Baru</span>
                    </button>
                </div>
            </div>

            {{-- Template block for dynamic youtube rows --}}
            <template id="youtube-item-template">
                <div class="p-5 rounded-2xl border border-gray-150 bg-gray-50/50 dark:border-emerald-950/20 dark:bg-[#080d0b]/40 flex flex-col gap-4 youtube-gallery-row animate-slide-up" id="youtube-gallery-item-ROW_ID">
                    <div class="flex items-center justify-between border-b border-gray-100 dark:border-emerald-950/10 pb-2">
                        <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Video Baru</span>
                        <button type="button" onclick="removeYoutubeRow('ROW_ID')" class="text-red-500 hover:text-red-750 text-[10px] font-bold flex items-center gap-1">
                            🗑️ Hapus Video
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-550 uppercase tracking-wide">Link Video YouTube <span class="text-red-500">*</span></label>
                            <input type="url" name="youtube_gallery_items[ROW_ID][link]" placeholder="Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="form-input py-2 text-xs" required>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-550 uppercase tracking-wide">Judul Video</label>
                                <input type="text" name="youtube_gallery_items[ROW_ID][title]" placeholder="Masukkan judul video..." class="form-input py-2 text-xs">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-550 uppercase tracking-wide">Deskripsi Singkat</label>
                                <input type="text" name="youtube_gallery_items[ROW_ID][desc]" placeholder="Masukkan deskripsi video..." class="form-input py-2 text-xs">
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Gallery / Documentation Card --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-2 dark:text-white">Arsip Dokumentasi Kegiatan</h2>
                <p class="text-gray-400 text-xs mb-6 font-semibold">Unggah atau masukkan URL foto dokumentasi kegiatan pelatihan, lokakarya, dan momentum berharga Lembaga.</p>
                
                <div class="space-y-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="gallery_title" class="form-label font-bold text-sm">Judul Seksi <span class="text-red-500">*</span></label>
                            <input id="gallery_title" name="gallery_title" type="text" value="{{ old('gallery_title', $settings['gallery_title']) }}" required class="form-input">
                        </div>
                        <div>
                            <label for="gallery_desc" class="form-label font-bold text-sm">Deskripsi Seksi <span class="text-red-500">*</span></label>
                            <input id="gallery_desc" name="gallery_desc" type="text" value="{{ old('gallery_desc', $settings['gallery_desc']) }}" required class="form-input">
                        </div>
                    </div>
                </div>

                <div id="gallery-items-container" class="space-y-6">
                    @foreach($settings['gallery_items'] ?? [] as $index => $item)
                    <div class="p-5 rounded-2xl border border-gray-100 bg-gray-50/50 dark:border-emerald-950/20 dark:bg-[#080d0b]/40 flex flex-col gap-6 animate-slide-up gallery-item-row" id="gallery-item-{{ $index }}">
                        <div class="flex flex-col md:flex-row gap-6 items-center w-full">
                            {{-- Hidden input for existing image path --}}
                            <input type="hidden" name="gallery_items[{{ $index }}][image]" value="{{ $item['image'] ?? '' }}">

                            {{-- Image Preview --}}
                            <div class="w-32 h-20 rounded-xl overflow-hidden shrink-0 border border-gray-200 shadow-sm dark:border-emerald-950/40 relative bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                @if(!empty($item['image']))
                                    <img id="preview-gallery-{{ $index }}" src="{{ $item['image'] }}" alt="Preview {{ $index }}" class="w-full h-full object-cover">
                                    <div id="placeholder-gallery-{{ $index }}" class="text-gray-400 text-xs font-semibold hidden">Belum Ada Foto</div>
                                @else
                                    <div id="placeholder-gallery-{{ $index }}" class="text-gray-400 text-xs font-semibold">Belum Ada Foto</div>
                                    <img id="preview-gallery-{{ $index }}" src="" alt="Preview {{ $index }}" class="w-full h-full object-cover hidden">
                                @endif
                            </div>
                            
                            {{-- Form Controls --}}
                            <div class="flex-1 w-full space-y-3">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label class="block text-[11px] font-bold text-gray-455 dark:text-gray-500 uppercase tracking-wide">Keterangan / Caption Foto Utama <span class="text-red-500">*</span></label>
                                            <button type="button" onclick="removeGalleryRow({{ $index }})" class="text-red-500 hover:text-red-750 text-[10px] font-bold flex items-center gap-1">
                                                🗑️ Hapus Dokumentasi
                                            </button>
                                        </div>
                                        <input type="text" name="gallery_items[{{ $index }}][caption]" value="{{ old('gallery_items.'.$index.'.caption', $item['caption'] ?? '') }}" placeholder="Masukkan keterangan foto dokumentasi..." class="form-input py-2 text-xs">
                                    </div>
                                    
                                    {{-- Upload File Option --}}
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Unggah Foto Utama Baru</label>
                                        <input type="file" name="gallery_items[{{ $index }}][file]" accept="image/*" onchange="previewDynamicImage(this, {{ $index }})"
                                               class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                                        @error("gallery_items.{$index}.file")
                                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Image URL Option --}}
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Atau URL Gambar Utama</label>
                                        <input type="url" name="gallery_items[{{ $index }}][url]" value="{{ old('gallery_items.'.$index.'.url', $item['image'] ?? '') }}" placeholder="https://example.com/image.jpg"
                                               class="form-input py-2 text-xs" oninput="previewDynamicUrl(this, {{ $index }})">
                                        @error("gallery_items.{$index}.url")
                                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Sub Gallery Section --}}
                        <div class="border-t border-gray-150/40 dark:border-emerald-950/20 pt-4 w-full">
                            <div class="flex justify-between items-center mb-3">
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide font-bold">Foto Tambahan (Untuk Slider / Lightbox)</label>
                                <button type="button" onclick="addSubItem({{ $index }})" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 flex items-center gap-1">
                                    ➕ Tambah Foto Tambahan
                                </button>
                            </div>
                            
                            <div id="sub-gallery-container-{{ $index }}" class="space-y-3 pl-4 border-l-2 border-emerald-500/20">
                                @foreach($item['images'] ?? [] as $subIndex => $subImage)
                                    <div class="flex items-center gap-4 bg-white dark:bg-emerald-950/10 p-3 rounded-xl border border-gray-100 dark:border-emerald-950/20" id="sub-item-row-{{ $index }}-{{ $subIndex }}">
                                        <input type="hidden" name="gallery_items[{{ $index }}][sub_items][{{ $subIndex }}][image]" value="{{ $subImage }}">
                                        
                                        <div class="w-16 h-12 rounded-lg overflow-hidden shrink-0 border border-gray-200 bg-gray-100 flex items-center justify-center">
                                            <img id="preview-sub-{{ $index }}-{{ $subIndex }}" src="{{ $subImage }}" class="w-full h-full object-cover">
                                        </div>
                                        
                                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <input type="file" name="gallery_items[{{ $index }}][sub_items][{{ $subIndex }}][file]" accept="image/*" onchange="previewSubImage(this, {{ $index }}, {{ $subIndex }})" class="block w-full text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[10px] file:bg-primary-50 file:text-primary-750">
                                            <input type="url" name="gallery_items[{{ $index }}][sub_items][{{ $subIndex }}][url]" value="{{ $subImage }}" oninput="previewSubUrl(this, {{ $index }}, {{ $subIndex }})" class="form-input py-1 text-xs" placeholder="Atau URL gambar...">
                                        </div>
                                        
                                        <button type="button" onclick="removeSubRow({{ $index }}, {{ $subIndex }})" class="text-red-500 hover:text-red-750 text-xs font-bold p-1">
                                            🗑️
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Add Button --}}
                <div class="mt-6">
                    <button type="button" onclick="addGalleryItem()" class="w-full py-4 rounded-2xl border-2 border-dashed border-gray-200 dark:border-emerald-950/40 hover:border-primary-500 dark:hover:border-emerald-600 transition flex items-center justify-center gap-2 text-sm font-bold text-gray-500 hover:text-primary-650 dark:text-gray-400 dark:hover:text-emerald-450">
                        <span>➕ Tambah Foto Dokumentasi Baru</span>
                    </button>
                </div>
            </div>
            
            {{-- Template block for dynamic gallery rows --}}
            <template id="gallery-item-template">
                <div class="p-5 rounded-2xl border border-gray-100 bg-gray-50/50 dark:border-emerald-950/20 dark:bg-[#080d0b]/40 flex flex-col gap-6 animate-slide-up gallery-item-row" id="gallery-item-ROW_ID">
                    <div class="flex flex-col md:flex-row gap-6 items-center w-full">
                        <input type="hidden" name="gallery_items[ROW_ID][image]" value="">
                        
                        <div class="w-32 h-20 rounded-xl overflow-hidden shrink-0 border border-gray-200 shadow-sm dark:border-emerald-950/40 relative bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                            <img id="preview-gallery-ROW_ID" src="" alt="Preview" class="w-full h-full object-cover hidden">
                            <div id="placeholder-gallery-ROW_ID" class="text-gray-400 text-xs font-semibold">Belum Ada Foto</div>
                        </div>
                        
                        <div class="flex-1 w-full space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <label class="block text-[11px] font-bold text-gray-455 dark:text-gray-500 uppercase tracking-wide">Keterangan / Caption Foto Utama <span class="text-red-500">*</span></label>
                                        <button type="button" onclick="removeGalleryRow('ROW_ID')" class="text-red-500 hover:text-red-750 text-[10px] font-bold flex items-center gap-1">
                                            🗑️ Hapus Dokumentasi
                                        </button>
                                    </div>
                                    <input type="text" name="gallery_items[ROW_ID][caption]" value="" placeholder="Masukkan keterangan foto dokumentasi..." class="form-input py-2 text-xs">
                                </div>
                                
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Unggah Foto Utama Baru</label>
                                    <input type="file" name="gallery_items[ROW_ID][file]" accept="image/*" onchange="previewDynamicImage(this, 'ROW_ID')"
                                           class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                                </div>
                                
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Atau URL Gambar Utama</label>
                                    <input type="url" name="gallery_items[ROW_ID][url]" placeholder="https://example.com/image.jpg"
                                           class="form-input py-2 text-xs" oninput="previewDynamicUrl(this, 'ROW_ID')">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sub Gallery Section --}}
                    <div class="border-t border-gray-150/40 dark:border-emerald-950/20 pt-4 w-full">
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide font-bold">Foto Tambahan (Untuk Slider / Lightbox)</label>
                            <button type="button" onclick="addSubItem('ROW_ID')" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 flex items-center gap-1">
                                ➕ Tambah Foto Tambahan
                            </button>
                        </div>
                        
                        <div id="sub-gallery-container-ROW_ID" class="space-y-3 pl-4 border-l-2 border-emerald-500/20">
                            <!-- Dynamically added sub-gallery items go here -->
                        </div>
                    </div>
                </div>
            </template>
        @endif

        @if($activeTab === 'contact')
            {{-- Card 4: Hubungi Kami --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Bagian: Hubungi Kami (Kontak & Peta)</h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="contact_page_title" class="form-label font-bold text-sm">Judul Halaman / Seksi <span class="text-red-500">*</span></label>
                            <input id="contact_page_title" name="contact_page_title" type="text" value="{{ old('contact_page_title', $settings['contact_page_title']) }}" required class="form-input">
                        </div>
                        <div>
                            <label for="contact_page_desc" class="form-label font-bold text-sm">Deskripsi Singkat <span class="text-red-500">*</span></label>
                            <input id="contact_page_desc" name="contact_page_desc" type="text" value="{{ old('contact_page_desc', $settings['contact_page_desc']) }}" required class="form-input">
                        </div>
                    </div>

                    <div>
                        <label for="contact_address" class="form-label font-bold text-sm">Alamat Fisik Resmi <span class="text-red-500">*</span></label>
                        <textarea id="contact_address" name="contact_address" rows="2" required class="form-input">{{ old('contact_address', $settings['contact_address']) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="contact_email" class="form-label font-bold text-sm">Email Layanan Pelanggan <span class="text-red-500">*</span></label>
                            <input id="contact_email" name="contact_email" type="email" value="{{ old('contact_email', $settings['contact_email']) }}" required class="form-input">
                        </div>
                        <div>
                            <label for="contact_phone" class="form-label font-bold text-sm">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                            <input id="contact_phone" name="contact_phone" type="text" value="{{ old('contact_phone', $settings['contact_phone']) }}" required class="form-input">
                        </div>
                    </div>

                    <div>
                        <label for="contact_map_embed" class="form-label font-bold text-sm">URL Embed Google Map <span class="text-red-500">*</span></label>
                        <input id="contact_map_embed" name="contact_map_embed" type="text" value="{{ old('contact_map_embed', $settings['contact_map_embed']) }}" required class="form-input" placeholder="Masukkan URL src iframe peta saja">
                        <p class="text-gray-400 text-[10px] mt-1 font-semibold">Salin hanya bagian link "src" dari kode embed Iframe Google Maps.</p>
                    </div>
                </div>
            </div>
        @endif



        {{-- Save Button --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('dashboard') }}" class="btn-secondary py-3 px-8 text-sm">Batal</a>
            <button type="submit" class="btn-primary py-3 px-8 text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
    function previewSettingsImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById(previewId).src = e.target.result;
                if (previewId === 'preview-bg') {
                    document.getElementById('preview-bg-container').classList.remove('hidden');
                }
                if (previewId === 'preview-logo') {
                    document.getElementById('preview-logo-container').classList.remove('hidden');
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    let rowCounter = {{ count($settings['gallery_items'] ?? []) }};
    function addGalleryItem() {
        const container = document.getElementById('gallery-items-container');
        const template = document.getElementById('gallery-item-template').innerHTML;
        const newRowHtml = template.replace(/ROW_ID/g, rowCounter);
        
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = newRowHtml.trim();
        container.appendChild(tempDiv.firstChild);
        rowCounter++;
    }

    function removeGalleryRow(rowId) {
        const row = document.getElementById('gallery-item-' + rowId);
        if (row) {
            if (confirm('Apakah Anda yakin ingin menghapus foto ini dari galeri?')) {
                row.remove();
            }
        }
    }

    function previewDynamicImage(input, rowId) {
        const previewEl = document.getElementById('preview-gallery-' + rowId);
        const placeholderEl = document.getElementById('placeholder-gallery-' + rowId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (previewEl) {
                    previewEl.src = e.target.result;
                    previewEl.classList.remove('hidden');
                }
                if (placeholderEl) {
                    placeholderEl.classList.add('hidden');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewDynamicUrl(input, rowId) {
        const previewEl = document.getElementById('preview-gallery-' + rowId);
        const placeholderEl = document.getElementById('placeholder-gallery-' + rowId);
        if (input.value) {
            if (previewEl) {
                previewEl.src = input.value;
                previewEl.classList.remove('hidden');
            }
            if (placeholderEl) {
                placeholderEl.classList.add('hidden');
            }
        } else {
            const fileInput = document.querySelector(`input[name="gallery_items[${rowId}][file]"]`);
            if (!fileInput || !fileInput.files.length) {
                if (previewEl) previewEl.classList.add('hidden');
                if (placeholderEl) placeholderEl.classList.remove('hidden');
            }
        }
    }

    // Sub-gallery management
    let subCounters = {};
    function addSubItem(rowId) {
        if (subCounters[rowId] === undefined) {
            const container = document.getElementById('sub-gallery-container-' + rowId);
            subCounters[rowId] = container ? container.children.length : 0;
        }
        const subIndex = subCounters[rowId]++;
        const container = document.getElementById('sub-gallery-container-' + rowId);
        if (!container) return;

        const subHtml = `
            <div class="flex items-center gap-4 bg-white dark:bg-emerald-950/10 p-3 rounded-xl border border-gray-100 dark:border-emerald-950/20" id="sub-item-row-${rowId}-${subIndex}">
                <input type="hidden" name="gallery_items[${rowId}][sub_items][${subIndex}][image]" value="">
                
                <div class="w-16 h-12 rounded-lg overflow-hidden shrink-0 border border-gray-200 bg-gray-100 flex items-center justify-center">
                    <img id="preview-sub-${rowId}-${subIndex}" src="" class="w-full h-full object-cover hidden">
                    <div id="placeholder-sub-${rowId}-${subIndex}" class="text-[10px] text-gray-400 font-semibold">No Image</div>
                </div>
                
                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <input type="file" name="gallery_items[${rowId}][sub_items][${subIndex}][file]" accept="image/*" onchange="previewSubImage(this, ${rowId}, ${subIndex})" class="block w-full text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[10px] file:bg-primary-50 file:text-primary-750">
                    <input type="url" name="gallery_items[${rowId}][sub_items][${subIndex}][url]" oninput="previewSubUrl(this, ${rowId}, ${subIndex})" class="form-input py-1 text-xs" placeholder="Atau URL gambar...">
                </div>
                
                <button type="button" onclick="removeSubRow(${rowId}, ${subIndex})" class="text-red-500 hover:text-red-750 text-xs font-bold p-1">
                    🗑️
                </button>
            </div>
        `;
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = subHtml.trim();
        container.appendChild(tempDiv.firstChild);
    }

    function removeSubRow(rowId, subIndex) {
        const row = document.getElementById('sub-item-row-' + rowId + '-' + subIndex);
        if (row) {
            row.remove();
        }
    }

    function previewSubImage(input, rowId, subIndex) {
        const previewEl = document.getElementById('preview-sub-' + rowId + '-' + subIndex);
        const placeholderEl = document.getElementById('placeholder-sub-' + rowId + '-' + subIndex);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (previewEl) {
                    previewEl.src = e.target.result;
                    previewEl.classList.remove('hidden');
                }
                if (placeholderEl) {
                    placeholderEl.classList.add('hidden');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewSubUrl(input, rowId, subIndex) {
        const previewEl = document.getElementById('preview-sub-' + rowId + '-' + subIndex);
        const placeholderEl = document.getElementById('placeholder-sub-' + rowId + '-' + subIndex);
        if (input.value) {
            if (previewEl) {
                previewEl.src = input.value;
                previewEl.classList.remove('hidden');
            }
            if (placeholderEl) {
                placeholderEl.classList.add('hidden');
            }
        } else {
            const fileInput = document.querySelector(`input[name="gallery_items[${rowId}][sub_items][${subIndex}][file]"]`);
            if (!fileInput || !fileInput.files.length) {
                if (previewEl) previewEl.classList.add('hidden');
                if (placeholderEl) placeholderEl.classList.remove('hidden');
            }
        }
    }

    let ytRowCounter = {{ count($settings['youtube_gallery_items'] ?? []) }};
    function addYoutubeItem() {
        const container = document.getElementById('youtube-gallery-items-container');
        const template = document.getElementById('youtube-item-template').innerHTML;
        const newRowHtml = template.replace(/ROW_ID/g, ytRowCounter);
        
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = newRowHtml.trim();
        container.appendChild(tempDiv.firstChild);
        ytRowCounter++;
        updateYoutubeIndices();
    }

    function removeYoutubeRow(rowId) {
        const row = document.getElementById('youtube-gallery-item-' + rowId);
        if (row) {
            if (confirm('Apakah Anda yakin ingin menghapus video ini dari galeri?')) {
                row.remove();
                updateYoutubeIndices();
            }
        }
    }

    function updateYoutubeIndices() {
        const rows = document.querySelectorAll('.youtube-gallery-row');
        rows.forEach((row, index) => {
            const span = row.querySelector('.text-primary-900');
            if (span && !span.textContent.includes('Baru')) {
                span.textContent = 'Video #' + (index + 1);
            }
        });
    }
</script>
@endsection
