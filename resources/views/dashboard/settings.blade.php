@php
    $tabNames = [
        'hero' => 'Hero & Statistik',
        'background' => 'Latar & Logo',
        'why' => 'Mengapa Memilih Kami',
        'scheme' => 'Skema Pendidikan',
        'about' => 'Tentang Lembaga',
        'gallery' => 'Arsip Dokumentasi',
        'contact' => 'Hubungi Kami',
        'cta' => 'Panggilan Aksi (CTA)'
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

        @if($activeTab === 'why')
            {{-- Card 1: Mengapa Memilih Kami --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Bagian: Mengapa Memilih Kami?</h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="why_title" class="form-label font-bold text-sm">Judul Seksi <span class="text-red-500">*</span></label>
                            <input id="why_title" name="why_title" type="text" value="{{ old('why_title', $settings['why_title']) }}" required class="form-input">
                        </div>
                        <div>
                            <label for="why_desc" class="form-label font-bold text-sm">Deskripsi Singkat Seksi <span class="text-red-500">*</span></label>
                            <input id="why_desc" name="why_desc" type="text" value="{{ old('why_desc', $settings['why_desc']) }}" required class="form-input">
                        </div>
                    </div>

                    <div class="border-t border-gray-50 pt-6 dark:border-emerald-950/20 space-y-4">
                        <span class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Detail Kartu Manfaat</span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Kartu 1</span>
                                <input name="why_card_title_1" type="text" value="{{ old('why_card_title_1', $settings['why_card_title_1']) }}" required class="form-input text-sm" placeholder="Judul Kartu 1">
                                <textarea name="why_card_desc_1" rows="2" required class="form-input text-xs" placeholder="Deskripsi Kartu 1">{{ old('why_card_desc_1', $settings['why_card_desc_1']) }}</textarea>
                            </div>
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Kartu 2</span>
                                <input name="why_card_title_2" type="text" value="{{ old('why_card_title_2', $settings['why_card_title_2']) }}" required class="form-input text-sm" placeholder="Judul Kartu 2">
                                <textarea name="why_card_desc_2" rows="2" required class="form-input text-xs" placeholder="Deskripsi Kartu 2">{{ old('why_card_desc_2', $settings['why_card_desc_2']) }}</textarea>
                            </div>
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Kartu 3</span>
                                <input name="why_card_title_3" type="text" value="{{ old('why_card_title_3', $settings['why_card_title_3']) }}" required class="form-input text-sm" placeholder="Judul Kartu 3">
                                <textarea name="why_card_desc_3" rows="2" required class="form-input text-xs" placeholder="Deskripsi Kartu 3">{{ old('why_card_desc_3', $settings['why_card_desc_3']) }}</textarea>
                            </div>
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Kartu 4</span>
                                <input name="why_card_title_4" type="text" value="{{ old('why_card_title_4', $settings['why_card_title_4']) }}" required class="form-input text-sm" placeholder="Judul Kartu 4">
                                <textarea name="why_card_desc_4" rows="2" required class="form-input text-xs" placeholder="Deskripsi Kartu 4">{{ old('why_card_desc_4', $settings['why_card_desc_4']) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($activeTab === 'scheme')
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
                            <img id="preview-program-{{ $i }}" src="{{ $settings["home_program_img_{$i}"] }}" alt="Preview {{ $i }}" class="w-full h-full object-cover">
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
                                    <input type="file" name="home_program_img_file_{{ $i }}" accept="image/*" onchange="previewSettingsImage(this, 'preview-program-{{ $i }}')"
                                           class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                                    @error("home_program_img_file_{{ $i }}")
                                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Image URL Option --}}
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Atau Gunakan URL Gambar</label>
                                    <input type="url" name="home_program_img_url_{{ $i }}" placeholder="https://example.com/image.jpg"
                                           class="form-input py-2 text-xs">
                                    @error("home_program_img_url_{{ $i }}")
                                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            {{-- Card 2: Skema Pendidikan & Pelatihan --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Bagian: Skema Pendidikan & Pelatihan</h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="scheme_title" class="form-label font-bold text-sm">Judul Seksi <span class="text-red-500">*</span></label>
                            <input id="scheme_title" name="scheme_title" type="text" value="{{ old('scheme_title', $settings['scheme_title']) }}" required class="form-input">
                        </div>
                        <div>
                            <label for="scheme_desc" class="form-label font-bold text-sm">Deskripsi Seksi <span class="text-red-500">*</span></label>
                            <input id="scheme_desc" name="scheme_desc" type="text" value="{{ old('scheme_desc', $settings['scheme_desc']) }}" required class="form-input">
                        </div>
                    </div>

                    <div class="border-t border-gray-50 pt-6 dark:border-emerald-950/20 space-y-4">
                        <span class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Detail Kartu Jenjang</span>
                        <div class="space-y-4">
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Jenjang SD / MI</span>
                                <input name="scheme_title_1" type="text" value="{{ old('scheme_title_1', $settings['scheme_title_1']) }}" required class="form-input text-sm">
                                <textarea name="scheme_desc_1" rows="2" required class="form-input text-xs">{{ old('scheme_desc_1', $settings['scheme_desc_1']) }}</textarea>
                            </div>
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Jenjang SMP / MTs</span>
                                <input name="scheme_title_2" type="text" value="{{ old('scheme_title_2', $settings['scheme_title_2']) }}" required class="form-input text-sm">
                                <textarea name="scheme_desc_2" rows="2" required class="form-input text-xs">{{ old('scheme_desc_2', $settings['scheme_desc_2']) }}</textarea>
                            </div>
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Jenjang SMA / SMK / MA</span>
                                <input name="scheme_title_3" type="text" value="{{ old('scheme_title_3', $settings['scheme_title_3']) }}" required class="form-input text-sm">
                                <textarea name="scheme_desc_3" rows="2" required class="form-input text-xs">{{ old('scheme_desc_3', $settings['scheme_desc_3']) }}</textarea>
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
                        <span class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nilai-Nilai Utama (Values)</span>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Nilai 1</span>
                                <input name="about_value_title_1" type="text" value="{{ old('about_value_title_1', $settings['about_value_title_1']) }}" required class="form-input text-sm">
                                <textarea name="about_value_desc_1" rows="2" required class="form-input text-xs">{{ old('about_value_desc_1', $settings['about_value_desc_1']) }}</textarea>
                            </div>
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Nilai 2</span>
                                <input name="about_value_title_2" type="text" value="{{ old('about_value_title_2', $settings['about_value_title_2']) }}" required class="form-input text-sm">
                                <textarea name="about_value_desc_2" rows="2" required class="form-input text-xs">{{ old('about_value_desc_2', $settings['about_value_desc_2']) }}</textarea>
                            </div>
                            <div class="p-4 rounded-2xl bg-gray-50/50 dark:bg-[#080d0b]/40 border border-gray-100 dark:border-emerald-950/20 space-y-3">
                                <span class="text-xs font-bold text-primary-900 dark:text-emerald-300">Nilai 3</span>
                                <input name="about_value_title_3" type="text" value="{{ old('about_value_title_3', $settings['about_value_title_3']) }}" required class="form-input text-sm">
                                <textarea name="about_value_desc_3" rows="2" required class="form-input text-xs">{{ old('about_value_desc_3', $settings['about_value_desc_3']) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($activeTab === 'gallery')
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

                <div class="space-y-6">
                    @for($i = 1; $i <= 6; $i++)
                    <div class="p-5 rounded-2xl border border-gray-100 bg-gray-50/50 dark:border-emerald-950/20 dark:bg-[#080d0b]/40 flex flex-col md:flex-row gap-6 items-center animate-slide-up" id="gallery-slot-{{ $i }}">
                        {{-- Hidden input for deletion --}}
                        <input type="hidden" name="delete_gallery_img_{{ $i }}" id="delete_gallery_img_{{ $i }}" value="0">

                        {{-- Image Preview --}}
                        <div class="w-32 h-20 rounded-xl overflow-hidden shrink-0 border border-gray-200 shadow-sm dark:border-emerald-950/40 relative bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                            @if(isset($settings["gallery_img_{$i}"]) && $settings["gallery_img_{$i}"])
                                <img id="preview-gallery-{{ $i }}" src="{{ $settings["gallery_img_{$i}"] }}" alt="Preview {{ $i }}" class="w-full h-full object-cover">
                                <div id="placeholder-gallery-{{ $i }}" class="text-gray-400 text-xs font-semibold hidden">Belum Ada Foto</div>
                            @else
                                <div id="placeholder-gallery-{{ $i }}" class="text-gray-400 text-xs font-semibold">Belum Ada Foto</div>
                                <img id="preview-gallery-{{ $i }}" src="" alt="Preview {{ $i }}" class="w-full h-full object-cover hidden">
                            @endif
                        </div>
                        
                        {{-- Form Controls --}}
                        <div class="flex-1 w-full space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <label class="block text-[11px] font-bold text-gray-455 dark:text-gray-500 uppercase tracking-wide">Keterangan / Caption Foto {{ $i }}</label>
                                        @if(isset($settings["gallery_img_{$i}"]) && $settings["gallery_img_{$i}"])
                                        <button type="button" onclick="deleteGallerySlot({{ $i }})" class="text-red-500 hover:text-red-750 text-[10px] font-bold flex items-center gap-1">
                                            🗑️ Hapus Dokumentasi {{ $i }}
                                        </button>
                                        @endif
                                    </div>
                                    <input type="text" id="gallery_caption_{{ $i }}" name="gallery_caption_{{ $i }}" value="{{ old('gallery_caption_' . $i, $settings['gallery_caption_' . $i] ?? '') }}" placeholder="Masukkan keterangan foto dokumentasi..." class="form-input py-2 text-xs">
                                </div>
                                
                                {{-- Upload File Option --}}
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Unggah Foto Baru</label>
                                    <input type="file" id="gallery_img_file_{{ $i }}" name="gallery_img_file_{{ $i }}" accept="image/*" onchange="previewGalleryImage(this, {{ $i }})"
                                           class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                                    @error("gallery_img_file_{$i}")
                                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Image URL Option --}}
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-455 mb-1.5 dark:text-gray-500 uppercase tracking-wide">Atau Gunakan URL Gambar</label>
                                    <input type="url" id="gallery_img_url_{{ $i }}" name="gallery_img_url_{{ $i }}" value="{{ old('gallery_img_url_' . $i) }}" placeholder="https://example.com/image.jpg"
                                           class="form-input py-2 text-xs" oninput="previewGalleryUrl(this, {{ $i }})">
                                    @error("gallery_img_url_{$i}")
                                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
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

        @if($activeTab === 'cta')
            {{-- Card 5: Panggilan Aksi (CTA Section) --}}
            <div class="card p-8">
                <h2 class="text-xl font-extrabold text-gray-900 mb-6 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Bagian: Panggilan Aksi (CTA Section)</h2>
                <div class="space-y-6">
                    <div>
                        <label for="cta_title" class="form-label font-bold text-sm">Judul Panggilan Aksi <span class="text-red-500">*</span></label>
                        <input id="cta_title" name="cta_title" type="text" value="{{ old('cta_title', $settings['cta_title']) }}" required class="form-input">
                    </div>
                    <div>
                        <label for="cta_desc" class="form-label font-bold text-sm">Deskripsi / Paragraf Panggilan Aksi <span class="text-red-500">*</span></label>
                        <textarea id="cta_desc" name="cta_desc" rows="3" required class="form-input">{{ old('cta_desc', $settings['cta_desc']) }}</textarea>
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

    function deleteGallerySlot(index) {
        if (confirm('Apakah Anda yakin ingin menghapus dokumentasi slot ' + index + '?')) {
            // Set hidden delete indicator
            document.getElementById('delete_gallery_img_' + index).value = '1';
            
            // Clear inputs
            document.getElementById('gallery_caption_' + index).value = '';
            document.getElementById('gallery_img_file_' + index).value = '';
            document.getElementById('gallery_img_url_' + index).value = '';
            
            // Hide preview, show placeholder
            const previewEl = document.getElementById('preview-gallery-' + index);
            const placeholderEl = document.getElementById('placeholder-gallery-' + index);
            
            if (previewEl) {
                previewEl.src = '';
                previewEl.classList.add('hidden');
            }
            if (placeholderEl) {
                placeholderEl.classList.remove('hidden');
            }
        }
    }

    function previewGalleryImage(input, index) {
        document.getElementById('delete_gallery_img_' + index).value = '0';
        const previewEl = document.getElementById('preview-gallery-' + index);
        const placeholderEl = document.getElementById('placeholder-gallery-' + index);
        
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

    function previewGalleryUrl(input, index) {
        document.getElementById('delete_gallery_img_' + index).value = '0';
        const previewEl = document.getElementById('preview-gallery-' + index);
        const placeholderEl = document.getElementById('placeholder-gallery-' + index);
        
        if (input.value) {
            if (previewEl) {
                previewEl.src = input.value;
                previewEl.classList.remove('hidden');
            }
            if (placeholderEl) {
                placeholderEl.classList.add('hidden');
            }
        }
    }
</script>
@endsection
