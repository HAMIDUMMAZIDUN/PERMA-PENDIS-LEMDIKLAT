@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

<div class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">

{{-- Hero Section --}}
<section id="hero" class="relative overflow-hidden py-24 md:py-32 transition-all duration-300"
         style="
         --hero-bg-light: {{ \App\Models\Setting::get('home_bg_color', '#e8f4fd') }};
         --hero-bg-dark: {{ \App\Models\Setting::get('home_bg_color_dark', '#070e17') }};
         @if(\App\Models\Setting::get('home_bg_type', 'color') === 'image' && \App\Models\Setting::get('home_bg_image'))
             background-image: url('{{ \App\Models\Setting::get('home_bg_image') }}'); background-size: cover; background-position: center;
         @endif
         ">

<style>
    #hero {
        background-color: var(--hero-bg-light);
    }
    .dark #hero {
        background-color: var(--hero-bg-dark);
    }
</style>
    {{-- High-end background decorations --}}
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <svg class="absolute top-0 right-0 w-[800px] h-[800px] text-blue-500/20 transform translate-x-1/3 -translate-y-1/3" fill="none" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 2" />
            <circle cx="50" cy="50" r="30" stroke="currentColor" stroke-width="0.2" />
        </svg>
        <div class="absolute -bottom-10 left-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-20 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl"></div>
    </div>
    {{-- Subtle dark overlay gradient for high readability over images/colors --}}
    <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/25 to-transparent pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-left z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            {{-- Left Column (Hero Content) --}}
            <div class="animate-slide-in lg:col-span-7 space-y-8">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/25 text-white text-sm font-semibold tracking-wide backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                    Pusat Pelatihan & Sertifikasi Profesional
                </span>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-tight tracking-tight text-white">
                    {!! nl2br(e(\App\Models\Setting::get('home_welcome_title', "Selamat Datang di\nLemdiklat\nPermapendis"))) !!}
                </h1>
                
                <p class="text-lg text-white/90 leading-relaxed max-w-xl font-medium">
                    {!! nl2br(e(\App\Models\Setting::get('home_welcome_desc', 'Lembaga Pendidikan dan Pelatihan Permapendis adalah pusat pelatihan yang berdedikasi untuk meningkatkan kompetensi tenaga pendidik dan kependidikan di Indonesia.'))) !!}
                </p>
                
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('about') }}" class="btn-primary py-3.5 px-8 shadow-blue-900/10 bg-white text-gray-950 hover:bg-neutral-100">
                        Tentang Kami
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('articles') }}" class="btn-secondary py-3.5 px-8 bg-white/15 border-white/20 text-white hover:bg-white/25 backdrop-blur-sm">
                        Lihat Artikel
                    </a>
                </div>

                {{-- Integrated Stats (La Maison Style, Left-Aligned White) --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-10 border-t border-white/20">
                    @foreach([
                        ['number' => '500+', 'label' => 'Alumni Tersertifikasi'],
                        ['number' => '20+', 'label' => 'Instruktur BNSP'],
                        ['number' => '3', 'label' => 'Program Unggulan'],
                        ['number' => '10+', 'label' => 'Tahun Pelayanan'],
                    ] as $stat)
                    <div>
                        <p class="text-3xl font-black text-white tracking-tight">{{ $stat['number'] }}</p>
                        <p class="text-[11px] font-bold text-white/80 uppercase tracking-wider mt-1">{{ $stat['label'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column (Empty to let background shine) --}}
            <div class="lg:col-span-5 hidden lg:block"></div>
        </div>
    </div>
</section>

{{-- Mengapa Memilih Kami? (High-end Feature Grid) --}}
<section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16 space-y-4 animate-slide-up">
        <h2 class="text-3xl md:text-5xl font-black tracking-tight text-primary-950 dark:text-white">Mengapa Memilih Kami?</h2>
        <div class="w-20 h-1.5 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-gray-500 max-w-2xl mx-auto text-lg dark:text-gray-400 font-medium">Komitmen kami adalah meningkatkan kualitas SDM pendidikan nasional melalui program terakreditasi dan profesional.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach([
            [
                'title' => 'Pengalaman & Kompeten', 
                'desc' => 'Didukung oleh instruktur profesional bersertifikasi nasional dengan pengalaman puluhan tahun.', 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />',
                'bg' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400'
            ],
            [
                'title' => 'Kurikulum Relevan', 
                'desc' => 'Materi pelatihan disesuaikan dengan kurikulum nasional terbaru serta kebutuhan digitalisasi sekolah.', 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
                'bg' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400'
            ],
            [
                'title' => 'Inovasi Digital', 
                'desc' => 'Metode pembelajaran berbasis teknologi tinggi yang praktis, fleksibel, dan mudah diimplementasikan.', 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />',
                'bg' => 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400'
            ],
            [
                'title' => 'Jejaring Nasional', 
                'desc' => 'Hubungan erat dengan ribuan pengurus dan kepala sekolah se-Indonesia untuk berbagi ide.', 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                'bg' => 'bg-teal-500/10 text-teal-600 dark:text-teal-400'
            ]
        ] as $feature)
        <div class="card-hover group flex flex-col items-center text-center p-8 space-y-5">
            <h3 class="font-extrabold text-gray-900 text-xl dark:text-white">{{ $feature['title'] }}</h3>
            <p class="text-gray-500 text-sm leading-relaxed dark:text-gray-400 font-medium">{{ $feature['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Training Programs with interactive showcase --}}
<section class="bg-gradient-to-b from-[#f2f7f4] to-[#f8faf9] py-24 dark:from-[#09110d] dark:to-[#070c0a] border-y border-emerald-950/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 space-y-4">
            <h2 class="text-3xl md:text-5xl font-black tracking-tight text-primary-950 dark:text-white">Skema Pendidikan & Pelatihan</h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg dark:text-gray-400 font-medium">Beberapa program pelatihan berjenjang yang kami tawarkan untuk kepala sekolah di seluruh tingkat satuan pendidikan.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach([
                [
                    'title' => 'Pelatihan Kepala Sekolah SD / MI', 
                    'desc' => 'Membekali kepala sekolah dasar dalam merancang strategi pembelajaran inovatif, pengelolaan tim pendidik dasar, serta komunikasi kemitraan dengan wali murid.', 
                    'img' => \App\Models\Setting::get('home_program_img_1', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=250&fit=crop'), 
                    'badge' => 'Jenjang SD/MI',
                    'tag_color' => 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 dark:bg-emerald-950/30 border-emerald-500/20'
                ],
                [
                    'title' => 'Pelatihan Kepala Sekolah SMP / MTs', 
                    'desc' => 'Program penguatan manajemen kesiswaan remaja, tata laksana manajemen sekolah menengah pertama, serta kepemimpinan transformatif era global.', 
                    'img' => \App\Models\Setting::get('home_program_img_2', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=400&h=250&fit=crop'), 
                    'badge' => 'Jenjang SMP/MTs',
                    'tag_color' => 'bg-secondary-500/10 text-secondary-700 dark:text-secondary-400 dark:bg-secondary-950/30 border-secondary-500/20'
                ],
                [
                    'title' => 'Pelatihan Kepala Sekolah SMA / SMK / MA', 
                    'desc' => 'Fokus pada kurikulum kesiapan karir, kerja sama industri modern (link and match), tata kelola sekolah tingkat menengah atas, dan kepemimpinan visioner digital.', 
                    'img' => \App\Models\Setting::get('home_program_img_3', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400&h=250&fit=crop'), 
                    'badge' => 'Jenjang SMA/SMK',
                    'tag_color' => 'bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 dark:bg-indigo-950/30 border-indigo-500/20'
                ],
            ] as $program)
            <div class="bg-white rounded-3xl shadow-[0_10px_35px_rgba(0,0,0,0.01)] hover:shadow-[0_25px_50px_rgba(0,0,0,0.04)] border border-gray-100 dark:border-emerald-950/30 overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 dark:bg-[#0b120f]">
                <div class="relative overflow-hidden h-60">
                    <img src="{{ $program['img'] }}" alt="{{ $program['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <span class="absolute top-4 right-4 px-3 py-1.5 rounded-xl text-xs font-bold border {{ $program['tag_color'] }} backdrop-blur-md">
                        {{ $program['badge'] }}
                    </span>
                </div>
                <div class="p-8 space-y-4">
                    <h3 class="font-extrabold text-gray-900 text-xl leading-snug dark:text-white group-hover:text-primary-600 transition-colors duration-200">{{ $program['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed dark:text-gray-400 font-medium">{{ $program['desc'] }}</p>
                    <div class="pt-4 border-t border-gray-50 dark:border-emerald-950/20 flex items-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-primary-700 font-bold text-sm hover:text-primary-900 transition-all group-hover:gap-3">
                            Daftar Pelatihan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Tentang Section --}}
<section id="about" class="py-24 border-t border-gray-150 dark:border-emerald-950/20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">
    <div class="text-center space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-semibold tracking-wide backdrop-blur-md">
            Mengenal Lembaga Kami
        </span>
        <h2 class="text-3xl md:text-5xl font-black tracking-tight text-primary-950 dark:text-white">Tentang Lemdiklat Permapendis</h2>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-medium dark:text-gray-400">
            Lembaga Pendidikan dan Pelatihan berkomitmen tinggi meningkatkan kompetensi melalui program pelatihan terstruktur, kurikulum mutakhir, instruktur berpengalaman, serta pendekatan modern yang berorientasi hasil nyata.
        </p>
    </div>

    {{-- Visi & Misi --}}
    <div class="grid md:grid-cols-2 gap-8">
        <div class="card border-l-4 border-primary-600 space-y-4 bg-white dark:bg-[#0b120f] p-8 rounded-3xl border border-gray-100 dark:border-emerald-950/30">
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Visi Kami</h2>
            <p class="text-gray-500 leading-relaxed dark:text-gray-400 font-medium text-base">Menjadi pusat keunggulan (center of excellence) pengembangan kompetensi pendidik dan kependidikan yang berdaya saing tinggi, relevan dengan kemajuan digital, serta mendorong terciptanya budaya belajar sepanjang hayat di Indonesia.</p>
        </div>
        
        <div class="card border-l-4 border-secondary-600 space-y-4 bg-white dark:bg-[#0b120f] p-8 rounded-3xl border border-gray-100 dark:border-emerald-950/30">
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Misi Kami</h2>
            <ul class="space-y-3 font-medium text-gray-500 dark:text-gray-400">
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 bg-emerald-500 shrink-0 mt-2"></span> 
                    <span>Menyelenggarakan program pelatihan berbasis kompetensi riil dan praktik manajemen terbaik.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 bg-emerald-500 shrink-0 mt-2"></span> 
                    <span>Memfasilitasi ujian sertifikasi profesi untuk memvalidasi kualifikasi keahlian pendidik.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 bg-emerald-500 shrink-0 mt-2"></span> 
                    <span>Membangun kolaborasi strategis dengan kementerian, dinas pendidikan, serta lembaga internasional.</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Value Grid --}}
    <div class="grid md:grid-cols-3 gap-8">
        @foreach([
            [
                'title' => 'Profesional & Teruji', 
                'desc' => 'Instruktur bersertifikat BNSP, kurikulum adaptif standar industri, and fasilitas memadai.', 
                'color' => 'bg-emerald-500/5 text-emerald-900 dark:text-emerald-300 border border-emerald-500/10'
            ],
            [
                'title' => 'Kolaborasi Luas', 
                'desc' => 'Kemitraan global & dinas pendidikan daerah untuk perluasan kesempatan karir alumni.', 
                'color' => 'bg-amber-500/5 text-amber-900 dark:text-amber-300 border border-amber-500/10'
            ],
            [
                'title' => 'Berorientasi Output', 
                'desc' => 'Fokus utama kami adalah keberhasilan lulusan dalam menerapkan program belajar inovatif di sekolah.', 
                'color' => 'bg-indigo-500/5 text-indigo-900 dark:text-indigo-300 border border-indigo-500/10'
            ],
        ] as $val)
        <div class="rounded-3xl p-8 space-y-4 {{ $val['color'] }}">
            <h3 class="font-extrabold text-xl dark:text-white">{{ $val['title'] }}</h3>
            <p class="text-sm leading-relaxed opacity-85 font-medium">{{ $val['desc'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Susunan Pengurus --}}
    <div class="space-y-12">
        <div class="text-center space-y-4">
            <h2 class="text-3xl md:text-5xl font-black tracking-tight text-primary-950 dark:text-white">Susunan Organisasi</h2>
            <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
            <p class="text-gray-500 dark:text-gray-400 font-medium max-w-xl mx-auto">Struktur kepengurusan profesional yang mendampingi dan mengarahkan kemajuan Lemdiklat Permapendis.</p>
        </div>

        {{-- Dewan Pembina --}}
        @if($pembinaLeader || $pembinaMembers->count() > 0)
        <div class="space-y-8 p-8 bg-gray-50/50 dark:bg-[#09100d]/50 rounded-3xl border border-gray-100/50 dark:border-emerald-950/20">
            <h3 class="text-2xl font-extrabold text-primary-950 dark:text-white border-b border-gray-200/50 dark:border-emerald-950/30 pb-4 flex items-center gap-3">
                <span class="w-2.5 h-6 bg-gradient-to-b from-primary-600 to-primary-800 rounded-full"></span>
                Dewan Pembina
            </h3>
            
            @if($pembinaLeader)
            <div class="flex justify-center">
                <div class="max-w-xs w-full">
                    @include('pages.partials.org-card', ['name' => $pembinaLeader->name, 'role' => $pembinaLeader->role, 'color' => $pembinaLeader->color, 'photo' => $pembinaLeader->photo])
                </div>
            </div>
            @endif
            
            @if($pembinaMembers->count() > 0)
            <div class="space-y-4">
                <h4 class="text-xs font-bold text-gray-450 uppercase tracking-widest dark:text-gray-500">Anggota Dewan Pembina</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($pembinaMembers as $member)
                    @include('pages.partials.org-card', ['name' => $member->name, 'role' => $member->role, 'color' => $member->color, 'photo' => $member->photo])
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Dewan Pengarah --}}
        @if($pengarahLeader || $pengarahMembers->count() > 0)
        <div class="space-y-8 p-8 bg-gray-50/50 dark:bg-[#09100d]/50 rounded-3xl border border-gray-100/50 dark:border-emerald-950/20">
            <h3 class="text-2xl font-extrabold text-primary-950 dark:text-white border-b border-gray-200/50 dark:border-emerald-950/30 pb-4 flex items-center gap-3">
                <span class="w-2.5 h-6 bg-gradient-to-b from-secondary-500 to-secondary-600 rounded-full"></span>
                Dewan Pengarah
            </h3>
            
            @if($pengarahLeader)
            <div class="flex justify-center">
                <div class="max-w-xs w-full">
                    @include('pages.partials.org-card', ['name' => $pengarahLeader->name, 'role' => $pengarahLeader->role, 'color' => $pengarahLeader->color, 'photo' => $pengarahLeader->photo])
                </div>
            </div>
            @endif
            
            @if($pengarahMembers->count() > 0)
            <div class="space-y-4">
                <h4 class="text-xs font-bold text-gray-450 uppercase tracking-widest dark:text-gray-500">Anggota Dewan Pengarah</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($pengarahMembers as $member)
                    @include('pages.partials.org-card', ['name' => $member->name, 'role' => $member->role, 'color' => $member->color, 'photo' => $member->photo])
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Jajaran Direksi / Pelaksana Harian --}}
        @if($direktur || $wakilDirekturs->count() > 0)
        <div class="space-y-8 p-8 bg-gray-50/50 dark:bg-[#09100d]/50 rounded-3xl border border-gray-100/50 dark:border-emerald-950/20">
            <h3 class="text-2xl font-extrabold text-primary-950 dark:text-white border-b border-gray-200/50 dark:border-emerald-950/30 pb-4 flex items-center gap-3">
                <span class="w-2.5 h-6 bg-gradient-to-b from-emerald-500 to-emerald-700 rounded-full"></span>
                Badan Pelaksana Pelatihan
            </h3>
            
            <div class="flex flex-col gap-8">
                @if($direktur)
                <div class="flex flex-col items-center">
                    <h4 class="text-xs font-bold text-gray-455 uppercase tracking-widest mb-4 dark:text-gray-500">Direktur Utama</h4>
                    <div class="max-w-xs w-full">
                        @include('pages.partials.org-card', ['name' => $direktur->name, 'role' => $direktur->role, 'color' => $direktur->color, 'photo' => $direktur->photo])
                    </div>
                </div>
                @endif
                
                @if($wakilDirekturs->count() > 0)
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-gray-455 uppercase tracking-widest dark:text-gray-500 text-center md:text-left">Wakil Direktur</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($wakilDirekturs as $member)
                        @include('pages.partials.org-card', ['name' => $member->name, 'role' => $member->role, 'color' => $member->color, 'photo' => $member->photo])
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- Sekretaris & Bendahara --}}
        @if($sekretarisBendaharas->count() > 0)
        <div class="space-y-8 p-8 bg-gray-50/50 dark:bg-[#09100d]/50 rounded-3xl border border-gray-100/50 dark:border-emerald-950/20 animate-slide-up">
            <h3 class="text-2xl font-extrabold text-primary-950 dark:text-white border-b border-gray-200/50 dark:border-emerald-950/30 pb-4 flex items-center gap-3">
                <span class="w-2.5 h-6 bg-gradient-to-b from-amber-500 to-amber-700 rounded-full"></span>
                Sekretaris & Bendahara
            </h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($sekretarisBendaharas as $member)
                @include('pages.partials.org-card', ['name' => $member->name, 'role' => $member->role, 'color' => $member->color, 'photo' => $member->photo])
                @endforeach
            </div>
        </div>
        @endif

        {{-- Kepala Bagian dan Unit --}}
        @if($kabags->count() > 0)
        <div class="space-y-8 p-8 bg-gray-50/50 dark:bg-[#09100d]/50 rounded-3xl border border-gray-100/50 dark:border-emerald-950/20 animate-slide-up">
            <h3 class="text-2xl font-extrabold text-primary-950 dark:text-white border-b border-gray-200/50 dark:border-emerald-950/30 pb-4 flex items-center gap-3">
                <span class="w-2.5 h-6 bg-gradient-to-b from-indigo-500 to-indigo-700 rounded-full"></span>
                Kepala Bagian dan Unit
            </h3>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($kabags as $member)
                @include('pages.partials.org-card', ['name' => $member->name, 'role' => $member->role, 'color' => $member->color, 'photo' => $member->photo])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

{{-- Latest News --}}
<section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
        <div class="space-y-4">
            <h2 class="text-3xl md:text-5xl font-black tracking-tight text-primary-950 dark:text-white">Kabar & Artikel Terbaru</h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full"></div>
            <p class="text-gray-500 dark:text-gray-400 font-medium">Ikuti berita terhangat, wawasan digitalisasi sekolah, serta panduan kurikulum dari ahli Lemdiklat.</p>
        </div>
        <a href="{{ route('articles') }}" class="btn-secondary py-3 px-6 shrink-0 self-start md:self-auto">Lihat Semua Artikel</a>
    </div>

    @if($articles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($articles as $article)
        <a href="{{ route('articles.show', $article->slug) }}" class="group bg-white rounded-3xl border border-gray-100 hover:border-primary-100 hover:shadow-[0_20px_50px_rgba(0,0,0,0.03)] transition-all duration-300 overflow-hidden flex flex-col dark:bg-[#0b120f] dark:border-emerald-950/20 dark:hover:border-primary-900/40">
            <div class="relative overflow-hidden h-52">
                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                @if($article->category)
                    <span class="absolute top-4 left-4 badge-primary text-xs font-semibold px-3 py-1 bg-white/95 border-0 shadow-sm dark:bg-[#0c1410]/95">{{ $article->category->name }}</span>
                @endif
            </div>
            <div class="p-6 flex flex-col flex-1 space-y-3">
                <h3 class="font-extrabold text-gray-900 text-lg leading-snug group-hover:text-primary-700 transition leading-snug line-clamp-2 dark:text-white">{{ $article->title }}</h3>
                <p class="text-gray-500 text-sm flex-1 line-clamp-3 dark:text-gray-400 font-medium">{{ $article->excerpt }}</p>
                <div class="pt-4 border-t border-gray-50 dark:border-emerald-950/20 flex items-center justify-between text-xs text-gray-400 font-semibold dark:text-gray-500">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ $article->author }}
                    </span>
                    <span>{{ $article->updated_at->locale('id')->diffForHumans() }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 border border-dashed border-gray-200 dark:border-emerald-950/30 rounded-3xl text-gray-400">
        <p class="font-medium text-lg">Belum ada berita terbaru.</p>
    </div>
    @endif
</section>

{{-- Kontak Section --}}
<section id="contact" class="py-24 border-t border-gray-150 dark:border-emerald-950/20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-semibold tracking-wide backdrop-blur-md">
            Hubungi Tim Lemdiklat
        </span>
        <h2 class="text-3xl md:text-5xl font-black tracking-tight text-primary-950 dark:text-white">Hubungi Kami</h2>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed font-medium dark:text-gray-400">
            Kami siap melayani kebutuhan informasi program pelatihan, sertifikasi pengajar, serta kerja sama kelembagaan.
        </p>
    </div>

    <div class="grid lg:grid-cols-12 gap-12 items-start">
        {{-- Contact Form --}}
        <div class="card lg:col-span-7 p-8 md:p-10 space-y-6 bg-white dark:bg-[#0b120f] rounded-3xl border border-gray-100 dark:border-emerald-950/30">
            <div class="space-y-2">
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Kirim Pesan Langsung</h2>
                <p class="text-gray-400 text-sm font-medium">Lengkapi formulir di bawah ini dan perwakilan kami akan membalas pesan Anda dalam 24 jam.</p>
            </div>

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
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Pesan Sekarang
                </button>
            </form>
        </div>

        {{-- Contact Info + Map --}}
        <div class="lg:col-span-5 space-y-8">
            <div class="card p-8 space-y-6 bg-white dark:bg-[#0b120f] rounded-3xl border border-gray-100 dark:border-emerald-950/30">
                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Informasi Kontak Resmi</h2>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div>
                            <p class="font-bold text-gray-900 text-sm dark:text-white">Alamat Kampus Utama</p>
                            <p class="text-gray-500 text-sm leading-relaxed dark:text-gray-400 mt-1 font-medium">Jl. Gedebage Selatan No.137 Kel. Cisaranteun Kidul, Kec. Gedebage, Kota Bandung, Jawa Barat 40295</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
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

{{-- CTA Section --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-primary-950 to-primary-900 text-white px-8 py-16 md:py-20 md:px-16 text-center shadow-[0_20px_50px_rgba(0,0,0,0.1)]">
        {{-- Artistic glow overlays --}}
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(252,211,77,0.1),transparent_50%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(5,150,105,0.2),transparent_40%)]"></div>
        
        <div class="relative max-w-2xl mx-auto space-y-6">
            <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-tight">Siap Untuk Meningkatkan Kualitas Sekolah Anda?</h2>
            <p class="text-emerald-100/80 text-base md:text-lg font-medium leading-relaxed">Daftarkan diri Anda sekarang sebagai peserta pelatihan profesional dan kembangkan kompetensi kepemimpinan institusi pendidikan.</p>
            <div class="flex flex-wrap justify-center gap-4 pt-4">
                <a href="{{ route('register') }}" class="btn-primary bg-white text-primary-950 hover:bg-emerald-50 px-8 py-3.5 shadow-xl shadow-black/20 dark:bg-white dark:text-primary-950 dark:hover:bg-emerald-50 border-0">
                    Daftar Sekarang
                </a>
                <a href="{{ route('contact') }}" class="btn-secondary bg-transparent border-white text-white hover:bg-white/10 px-8 py-3.5 dark:bg-transparent dark:border-white dark:text-white dark:hover:bg-white/10">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

</div>
@endsection
