@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

<div class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">

{{-- Hero Section --}}
@php
    $isImageBg = \App\Models\Setting::get('home_bg_type', 'color') === 'image' && \App\Models\Setting::get('home_bg_image');
    
    $badgeClass = $isImageBg 
        ? 'bg-white/10 border border-white/20 text-white backdrop-blur-md' 
        : 'bg-primary-500/10 border border-primary-500/20 text-primary-700 dark:bg-primary-950/20 dark:border-primary-900/30 dark:text-primary-300';
        
    $titleClass = $isImageBg 
        ? 'text-white' 
        : 'text-primary-950 dark:text-white';
        
    $descClass = $isImageBg 
        ? 'text-white/90' 
        : 'text-gray-650 dark:text-gray-300';
        
    $statNumberClass = $isImageBg 
        ? 'text-white' 
        : 'text-primary-900 dark:text-primary-400';
        
    $statLabelClass = $isImageBg 
        ? 'text-white/80' 
        : 'text-gray-500 dark:text-gray-400';
        
    $borderClass = $isImageBg 
        ? 'border-white/25' 
        : 'border-gray-200/60 dark:border-emerald-950/30';
@endphp

<section id="hero" class="relative overflow-hidden min-h-[600px] md:min-h-[750px] lg:min-h-[850px] flex flex-col justify-between pt-20 md:pt-24 pb-16 transition-all duration-300"
         style="
         --hero-bg-light: {{ \App\Models\Setting::get('home_bg_color', '#e8f4fd') }};
         --hero-bg-dark: {{ \App\Models\Setting::get('home_bg_color_dark', '#070e17') }};
         @if($isImageBg)
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

    @if($isImageBg)
        {{-- High-end vignette shadows (Darkens TOP and BOTTOM edges for supreme text legibility and image depth) --}}
        {{-- 1. Top Shadow (Darkens navigation bar area) --}}
        <div class="absolute inset-x-0 top-0 h-1/3 bg-gradient-to-b from-black/80 via-black/20 to-transparent pointer-events-none"></div>
        
        {{-- 2. Bottom Shadow (Darkens lower section) --}}
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/85 via-black/30 to-transparent pointer-events-none"></div>
    @else
        {{-- High-end background decorations for solid color mode --}}
        <div class="absolute inset-0 opacity-15 pointer-events-none">
            <svg class="absolute top-0 right-0 w-[600px] h-[600px] text-blue-500/10 transform translate-x-1/4 -translate-y-1/4" fill="none" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 2" />
                <circle cx="50" cy="50" r="30" stroke="currentColor" stroke-width="0.2" />
            </svg>
            <div class="absolute -bottom-10 left-10 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl"></div>
            <div class="absolute top-20 right-20 w-70 h-70 bg-indigo-500/5 rounded-full blur-3xl"></div>
        </div>
    @endif

    {{-- 1. TOP CONTAINER (Sticking to the top area of the image background) --}}
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-left z-10 w-full pt-2 animate-fade-in">
        <h1 class="text-xl md:text-2xl lg:text-3xl font-extrabold tracking-tight text-left leading-tight {{ $titleClass }}">
           
        </h1>
    </div>

    {{-- 2. BOTTOM CONTAINER (Description at the top, and Buttons + Stats aligned horizontally on 1 line below it) --}}
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-left z-10 w-full mt-auto pt-16 pb-6 animate-fade-in">
        <div class="border-t {{ $borderClass }} pt-8 w-full space-y-6">
            {{-- Description (Stored above the buttons and stats) --}}
            <div class="max-w-5xl">
                <p class="text-xl md:text-2xl lg:text-3xl font-bold tracking-tight text-left leading-snug {{ $descClass }}">
                   
                </p>    
            </div>
            
            {{-- Buttons and Stats (aligned horizontally on a single line on desktop) --}}
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 w-full">
                {{-- Left Side: Buttons --}}
                <div class="flex flex-row flex-wrap sm:flex-nowrap gap-3 shrink-0">
                    <a href="{{ route('about') }}" class="btn-primary py-2.5 px-6 text-sm whitespace-nowrap">
                        Tentang Kami
                    </a>
                    <a href="{{ route('articles') }}" class="btn-secondary py-2.5 px-6 text-sm whitespace-nowrap">
                        Berita & Kegiatan
                    </a>
                </div>

                {{-- Right Side: Stats --}}
                <div class="grid grid-cols-2 sm:flex sm:flex-row gap-y-4 gap-x-6 sm:gap-8 sm:divide-x {{ $borderClass }} shrink-0">
                    @foreach([
                        ['number' => \App\Models\Setting::get('stat_alumni', '500+'), 'label' => 'Alumni Tersertifikasi'],
                        ['number' => \App\Models\Setting::get('stat_instruktur', '20+'), 'label' => 'Instruktur BNSP'],
                        ['number' => \App\Models\Setting::get('stat_program', '3'), 'label' => 'Program Unggulan'],
                        ['number' => \App\Models\Setting::get('stat_tahun', '10+'), 'label' => 'Tahun Pelayanan'],
                    ] as $index => $stat)
                    <div class="{{ $index > 0 ? 'sm:pl-8' : '' }} shrink-0">
                        <p class="text-xl md:text-2xl font-extrabold {{ $statNumberClass }} tracking-tight leading-none">{{ $stat['number'] }}</p>
                        <p class="text-[9px] font-bold {{ $statLabelClass }} uppercase tracking-wider mt-1.5 leading-none">{{ $stat['label'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Tentang Section --}}
<section id="about" class="py-24 border-t border-gray-150 dark:border-emerald-950/20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">
    <div class="text-center space-y-4">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-primary-950 dark:text-white">{{ \App\Models\Setting::get('about_title', 'Tentang PERMA PENDIS') }}</h2>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-lg md:text-xl text-gray-500 leading-relaxed font-medium dark:text-gray-400 text-justify">
            {{ \App\Models\Setting::get('about_desc', 'Lembaga Pendidikan dan Pelatihan berkomitmen tinggi meningkatkan kompetensi melalui program pelatihan terstruktur, kurikulum mutakhir, instruktur berpengalaman, serta pendekatan modern yang berorientasi hasil nyata.') }}
        </p>
    </div>

    {{-- Visi & Misi --}}
    <div class="grid md:grid-cols-2 gap-8">
        <div class="card border-l-4 border-primary-600 space-y-4 bg-white dark:bg-[#0b120f] p-8 rounded-3xl border border-gray-100 dark:border-emerald-950/30">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Visi Kami</h2>
            <p class="text-gray-500 leading-relaxed dark:text-gray-400 font-medium text-base">{{ \App\Models\Setting::get('about_visi', 'Menjadi pusat keunggulan (center of excellence) pengembangan kompetensi pendidik dan kependidikan yang berdaya saing tinggi, relevan dengan kemajuan digital, serta mendorong terciptanya budaya belajar sepanjang hayat di Indonesia.') }}</p>
        </div>
        
        <div class="card border-l-4 border-secondary-600 space-y-4 bg-white dark:bg-[#0b120f] p-8 rounded-3xl border border-gray-100 dark:border-emerald-950/30">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Misi Kami</h2>
            <ul class="space-y-3 font-medium text-gray-500 dark:text-gray-400">
                @php
                    $misiText = \App\Models\Setting::get('about_misi', "- Menyelenggarakan program pelatihan berbasis kompetensi riil dan praktik manajemen terbaik.\n- Memfasilitasi ujian sertifikasi profesi untuk memvalidasi kualifikasi keahlian pendidik.\n- Membangun kolaborasi strategis dengan kementerian, dinas pendidikan, serta lembaga internasional.");
                    $misiItems = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $misiText))));
                @endphp
                @foreach($misiItems as $item)
                @if(!empty($item))
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 bg-emerald-500 shrink-0 mt-2"></span> 
                    <span>{{ ltrim(trim($item), '-*• ') }}</span>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>



    {{-- Banner Susunan Pengurus --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-emerald-950 via-primary-950 to-teal-950 text-white px-8 py-14 text-center shadow-lg">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(252,211,77,0.06),transparent_40%)]"></div>
        <div class="relative max-w-xl mx-auto space-y-6">
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight">{{ \App\Models\Setting::get('org_title', 'Susunan Organisasi') }}</h2>
            <div class="w-16 h-1 bg-gradient-to-r from-emerald-500 to-teal-400 mx-auto rounded-full"></div>
            <p class="text-emerald-100/80 text-sm font-medium leading-relaxed">
                {{ \App\Models\Setting::get('org_desc', 'Struktur kepengurusan profesional yang mendampingi dan mengarahkan kemajuan PERMA PENDIS.') }}
            </p>
            <div class="pt-4">
                <a href="{{ route('about') }}#susunan-organisasi" target="_blank" rel="noopener noreferrer" class="btn-primary inline-flex items-center gap-1.5 px-5 py-2.5 text-sm">
                    <span>Lihat Susunan Kepengurusan Lengkap</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Agenda/Events Section --}}
<section id="events" class="py-24 border-t border-gray-150 dark:border-emerald-950/20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-4">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-primary-950 dark:text-white">Agenda & Event Mendatang</h2>
            <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full"></div>
            <p class="text-gray-500 dark:text-gray-400 font-medium max-w-xl">Ikuti berbagai kegiatan pelatihan, seminar, rapat kerja, dan diskusi panel yang diselenggarakan oleh PERMA PENDIS.</p>
        </div>
        <a href="{{ route('events') }}" class="btn-secondary py-3 px-6 shrink-0 self-start md:self-auto">
            Lihat Kalender Agenda
        </a>
    </div>

    @if($events->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($events as $event)
        <div class="relative group bg-white rounded-3xl border border-gray-100 hover:border-primary-100 hover:shadow-[0_20px_50px_rgba(0,0,0,0.03)] transition-all duration-300 overflow-hidden flex flex-col dark:bg-[#0b120f] dark:border-emerald-950/20 dark:hover:border-primary-900/40">
            <a href="{{ route('events.show', $event->slug) }}" class="flex flex-col flex-1">
                <div class="relative overflow-hidden h-48">
                    @if($event->cover_image)
                        <img src="{{ asset($event->cover_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950/20 dark:to-teal-950/10 flex items-center justify-center text-emerald-600/30 text-5xl">
                            📅
                        </div>
                    @endif
                    <span class="absolute top-4 left-4 inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $event->type_color }} bg-white/95 shadow-sm dark:bg-[#0c1410]/95">
                        {{ ucfirst($event->type) }}
                    </span>
                </div>
                <div class="p-6 flex flex-col flex-1 space-y-4">
                    <div class="flex items-center gap-2 text-xs text-emerald-600 dark:text-emerald-450 font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $event->start_date->translatedFormat('d M Y • H:i') }} WIB
                    </div>
                    <h3 class="font-bold text-gray-900 text-base leading-snug group-hover:text-primary-700 transition line-clamp-2 dark:text-white">{{ $event->title }}</h3>
                    <div class="text-xs text-gray-400 dark:text-gray-500 font-medium space-y-1">
                        @if($event->location)
                        <p class="flex items-center gap-1.5 truncate">
                            📍 {{ $event->location }}
                        </p>
                        @endif
                        @if($event->contact_person)
                        <p class="flex items-center gap-1.5 truncate">
                            📞 {{ $event->contact_person }}
                        </p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 border border-dashed border-gray-200 dark:border-emerald-950/30 rounded-3xl text-gray-400">
        <p class="font-medium text-lg">Belum ada agenda terdekat.</p>
    </div>
    @endif
</section>

{{-- Latest News --}}
<section id="articles" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
        <div class="space-y-4">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-primary-950 dark:text-white">Kabar & Artikel Terbaru</h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full"></div>
            <p class="text-gray-500 dark:text-gray-400 font-medium">Ikuti berita terhangat, wawasan digitalisasi sekolah, serta panduan kurikulum dari ahli PERMA PENDIS.</p>
        </div>
        <div class="flex items-center gap-3 shrink-0 self-start md:self-auto">
            <a href="{{ route('articles') }}" class="btn-secondary py-3 px-6">Lihat Semua Artikel</a>
        </div>
    </div>

    @if($articles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($articles as $article)
        <div class="relative group bg-white rounded-3xl border border-gray-100 hover:border-primary-100 hover:shadow-[0_20px_50px_rgba(0,0,0,0.03)] transition-all duration-300 overflow-hidden flex flex-col dark:bg-[#0b120f] dark:border-emerald-950/20 dark:hover:border-primary-900/40">
            <a href="{{ route('articles.show', $article->slug) }}" class="flex flex-col flex-1">
                <div class="relative overflow-hidden h-52">
                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @if($article->category)
                        <span class="absolute top-4 left-4 badge-primary text-xs font-medium px-3 py-1 bg-white/95 border-0 shadow-sm dark:bg-[#0c1410]/95">{{ $article->category->name }}</span>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-1 space-y-3">
                    <h3 class="font-bold text-gray-900 text-base leading-snug group-hover:text-primary-700 transition line-clamp-2 dark:text-white">{{ $article->title }}</h3>
                    <p class="text-gray-500 text-sm flex-1 line-clamp-3 dark:text-gray-400 font-medium">{{ $article->excerpt }}</p>
                    <div class="pt-4 border-t border-gray-50 dark:border-emerald-950/20 flex items-center justify-between text-xs text-gray-400 font-medium dark:text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $article->author }}
                        </span>
                        <span>{{ $article->updated_at->locale('id')->diffForHumans() }}</span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 border border-dashed border-gray-200 dark:border-emerald-950/30 rounded-3xl text-gray-400">
        <p class="font-medium text-lg">Belum ada berita terbaru.</p>
    </div>
    @endif
</section>

{{-- Arsip Dokumentasi Section --}}
<section id="gallery" class="py-24 border-t border-gray-150 dark:border-emerald-950/20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-primary-950 dark:text-white">{{ \App\Models\Setting::get('gallery_title', 'Arsip Dokumentasi') }}</h2>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed font-medium dark:text-gray-400">
            {{ \App\Models\Setting::get('gallery_desc', 'Galeri momentum kegiatan pelatihan, sertifikasi, dan kemitraan strategis PERMA PENDIS.') }}
        </p>
    </div>

    @if($galleries->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($galleries as $gallery)
            @php
                $coverUrl = $gallery->cover_image ? asset($gallery->cover_image) : ($gallery->items->first() ? asset($gallery->items->first()->file_path) : '');
                $allImages = [];
                if ($gallery->cover_image) {
                    $allImages[] = asset($gallery->cover_image);
                }
                foreach ($gallery->items as $item) {
                    $allImages[] = asset($item->file_path);
                }
                $allImages = array_values(array_unique($allImages));
                if (empty($allImages) && $coverUrl) {
                    $allImages[] = $coverUrl;
                }
                $allImagesJson = json_encode($allImages);
            @endphp
            @if($coverUrl)
            <div onclick="openGalleryLightbox({{ $allImagesJson }}, '{{ addslashes($gallery->title) }}')" class="group cursor-pointer relative rounded-3xl overflow-hidden shadow-md border border-gray-100 dark:border-emerald-950/20 aspect-[4/3] bg-gray-100 dark:bg-[#0b120f] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                {{-- Image --}}
                <img src="{{ $coverUrl }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                
                {{-- Dark Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <p class="text-white font-bold text-base leading-snug transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        {{ $gallery->title }}
                    </p>
                    @if($gallery->category)
                        <span class="text-emerald-400 text-xs font-semibold mt-1.5 flex items-center gap-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">
                            📂 {{ $gallery->category->name }}
                        </span>
                    @endif
                    @if(count($allImages) > 1)
                        <span class="text-emerald-400 text-xs font-semibold mt-1 flex items-center gap-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-100">
                            📸 {{ count($allImages) }} Foto
                        </span>
                    @endif
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @else
    <div class="text-center py-16 border border-dashed border-gray-200 dark:border-emerald-950/30 rounded-3xl text-gray-400">
        <p class="font-medium text-lg">Belum ada galeri kegiatan terbit.</p>
    </div>
    @endif

    {{-- YouTube Video Gallery Section --}}
    @php
        $ytItemsJson = \App\Models\Setting::get('youtube_gallery_items');
        $ytItems = $ytItemsJson ? json_decode($ytItemsJson, true) : [
            [
                'link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'title' => 'Dokumentasi Video Kegiatan',
                'desc' => 'Tonton rangkuman video momentum kegiatan, pelatihan, dan kebersamaan di PERMA PENDIS secara langsung.',
            ]
        ];
    @endphp
    @if(count($ytItems) > 0)
    <div class="mt-20 border-t border-gray-150 dark:border-emerald-950/20 pt-20 space-y-12">
        <div class="text-center space-y-4">
            <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-primary-950 dark:text-white">Galeri Video Dokumentasi</h3>
            <div class="w-12 h-1 bg-gradient-to-r from-red-655 to-red-450 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            @foreach($ytItems as $index => $item)
                @php
                    $ytId = \App\Models\Setting::getYoutubeId($item['link']);
                @endphp
                @if($ytId)
                <div class="bg-white dark:bg-[#0b120f]/50 border border-gray-100 dark:border-emerald-950/20 rounded-3xl overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Custom Playable Video Card -->
                        <div id="yt-player-container-{{ $index }}" class="relative overflow-hidden aspect-[16/9] bg-black group cursor-pointer w-full border-b border-gray-100 dark:border-emerald-950/20">
                            <!-- Video Thumbnail -->
                            <img id="yt-thumbnail-{{ $index }}" src="https://img.youtube.com/vi/{{ $ytId }}/maxresdefault.jpg" onerror="this.src='https://img.youtube.com/vi/{{ $ytId }}/hqdefault.jpg'" alt="Video Thumbnail" class="w-full h-full object-cover group-hover:scale-102 transition duration-500">
                            
                            <!-- Overlay with Play Button -->
                            <div id="yt-play-overlay-{{ $index }}" onclick="playYoutubeOnSite('{{ $ytId }}', 'yt-player-container-{{ $index }}')" class="absolute inset-0 bg-black/35 group-hover:bg-black/45 transition flex items-center justify-center">
                                <div class="w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center shadow-xl group-hover:scale-110 transition duration-300 transform">
                                    <svg class="w-6 h-6 fill-current ml-1" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content details -->
                        <div class="p-6 space-y-2 text-left">
                            <h4 class="font-bold text-gray-900 text-base leading-snug dark:text-white line-clamp-1">
                                {{ $item['title'] ?: 'Video Dokumentasi' }}
                            </h4>
                            @if(!empty($item['desc']))
                            <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 leading-relaxed">
                                {{ $item['desc'] }}
                            </p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action buttons -->
                    <div class="p-6 pt-0 flex gap-2">
                        <button onclick="playYoutubeOnSite('{{ $ytId }}', 'yt-player-container-{{ $index }}')" class="btn-primary py-2 px-4 text-xs flex items-center gap-1.5 justify-center flex-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                            </svg>
                            <span>Putar</span>
                        </button>
                        
                        <a href="{{ $item['link'] }}" target="_blank" rel="noopener noreferrer" class="btn-secondary py-2 px-4 text-xs flex items-center gap-1.5 justify-center border border-gray-205 dark:border-emerald-950/40 flex-1">
                            <svg class="w-3.5 h-3.5 text-red-600 fill-current" viewBox="0 0 24 24">
                                <path d="M23.498 6.163c-.272-1.002-1.064-1.794-2.066-2.066C19.605 3.5 12 3.5 12 3.5s-7.605 0-9.432.597c-1.002.272-1.794 1.064-2.066 2.066C0 7.995 0 12 0 12s0 4.005.597 5.837c.272 1.002 1.064 1.794 2.066 2.066C4.395 20.5 12 20.5 12 20.5s7.605 0 9.432-.597c1.002-.272 1.794-1.064 2.066-2.066C24 16.005 24 12 24 12s0-4.005-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <span>YouTube</span>
                        </a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif
</section>

{{-- Downloads Section --}}
<section id="downloads" class="py-24 border-t border-gray-150 dark:border-emerald-950/20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-4">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-primary-950 dark:text-white">Dokumen & Formulir Resmi</h2>
            <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-full"></div>
            <p class="text-gray-500 dark:text-gray-400 font-medium max-w-xl">Unduh berbagai formulir pendaftaran, brosur program, surat keputusan, dan file administrasi resmi lainnya secara langsung.</p>
        </div>
        <a href="{{ route('downloads') }}" class="btn-secondary py-3 px-6 shrink-0 self-start md:self-auto">
            Kunjungi Download Center
        </a>
    </div>

    @if($downloads->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($downloads as $download)
        <div class="bg-white dark:bg-[#0b120f] border border-gray-100 dark:border-emerald-950/20 rounded-3xl p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-6">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded dark:bg-emerald-950/30 dark:text-emerald-400">
                        {{ strtoupper($download->file_type) }}
                    </span>
                    <span class="text-[10px] text-gray-400 dark:text-gray-500 font-semibold">
                        {{ $download->file_size }}
                    </span>
                </div>
                <h3 class="font-bold text-gray-900 text-sm leading-snug line-clamp-2 dark:text-white" title="{{ $download->title }}">
                    {{ $download->title }}
                </h3>
                @if($download->category)
                    <p class="text-[11px] font-semibold text-gray-450 dark:text-gray-500">
                        📂 {{ $download->category->name }}
                    </p>
                @endif
                @if($download->description)
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 leading-relaxed">
                        {{ $download->description }}
                    </p>
                @endif
            </div>
            
            <a href="{{ route('downloads.file', $download) }}" class="btn-primary w-full py-2 text-xs flex items-center justify-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Unduh Berkas
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 border border-dashed border-gray-200 dark:border-emerald-950/30 rounded-3xl text-gray-400">
        <p class="font-medium text-lg">Belum ada dokumen publik yang diunggah.</p>
    </div>
    @endif
</section>

{{-- Kontak Section --}}
<section id="contact" class="py-24 border-t border-gray-150 dark:border-emerald-950/20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-primary-950 dark:text-white">{{ \App\Models\Setting::get('contact_page_title', 'Hubungi Kami') }}</h2>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed font-medium dark:text-gray-400">
            {{ \App\Models\Setting::get('contact_page_desc', 'Kami siap melayani kebutuhan informasi program pelatihan, sertifikasi pengajar, serta kerja sama kelembagaan.') }}
        </p>
    </div>

    <div class="grid lg:grid-cols-12 gap-12 items-start">
        {{-- Contact Form --}}
        <div class="card lg:col-span-7 p-8 md:p-10 space-y-6 bg-white dark:bg-[#0b120f] rounded-3xl border border-gray-100 dark:border-emerald-950/30">
            <div class="space-y-2">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Kirim Pesan Langsung</h2>
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
                <h2 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-emerald-950/20 pb-4">Informasi Kontak Resmi</h2>
                <div class="space-y-6">
                    @if(\App\Models\Setting::get('contact_address'))
                    <div class="flex items-start gap-4">
                        <div>
                            <p class="font-medium text-gray-900 text-sm dark:text-white">Alamat Kampus Utama</p>
                            <p class="text-gray-500 text-sm leading-relaxed dark:text-gray-400 mt-1 font-medium">{{ \App\Models\Setting::get('contact_address') }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if(\App\Models\Setting::get('contact_email'))
                    <div class="flex items-start gap-4">
                        <div>
                            <p class="font-medium text-gray-900 text-sm dark:text-white">Surel Layanan Pelanggan</p>
                            <a href="mailto:{{ \App\Models\Setting::get('contact_email') }}" class="text-primary-700 hover:text-primary-900 text-sm font-medium dark:text-primary-400 dark:hover:text-primary-300 mt-1 block">{{ \App\Models\Setting::get('contact_email') }}</a>
                        </div>
                    </div>
                    @endif

                    @if(\App\Models\Setting::get('contact_phone'))
                    <div class="flex items-start gap-4">
                        <div>
                            <p class="font-medium text-gray-900 text-sm dark:text-white">Telepon / WhatsApp</p>
                            <a href="tel:{{ \App\Models\Setting::get('contact_phone') }}" class="text-primary-700 hover:text-primary-900 text-sm font-medium dark:text-primary-400 dark:hover:text-primary-300 mt-1 block">{{ \App\Models\Setting::get('contact_phone') }}</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Google Map with premium container --}}
            @if(\App\Models\Setting::getMapEmbedUrl())
            <div class="rounded-3xl overflow-hidden shadow-md border border-gray-100 dark:border-emerald-950/20">
                <iframe width="100%" height="320" frameborder="0" scrolling="no"
                    src="{{ \App\Models\Setting::getMapEmbedUrl() }}"
                    class="block filter grayscale dark:invert-[0.9] dark:hue-rotate-[180deg]">
                </iframe>
            </div>
            @endif
        </div>
    </div>
</section>



{{-- Gallery Lightbox Modal --}}
<div id="gallery-lightbox-modal" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-md flex items-center justify-center p-4 transition-all duration-300 opacity-0">
    {{-- Close Button --}}
    <button onclick="closeGalleryLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-white hover:scale-110 transition p-2 bg-white/10 hover:bg-white/20 rounded-full z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    {{-- Navigation: Prev Arrow --}}
    <button id="lightbox-prev-btn" onclick="prevLightboxImage()" class="absolute left-6 text-white/80 hover:text-white hover:scale-110 transition p-3 bg-white/10 hover:bg-white/20 rounded-full z-50 hidden select-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    {{-- Navigation: Next Arrow --}}
    <button id="lightbox-next-btn" onclick="nextLightboxImage()" class="absolute right-6 text-white/80 hover:text-white hover:scale-110 transition p-3 bg-white/10 hover:bg-white/20 rounded-full z-50 hidden select-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Content Container --}}
    <div class="max-w-5xl w-full flex flex-col items-center gap-4 relative">
        <div class="w-full relative overflow-hidden rounded-2xl border border-white/10 bg-black/40 flex items-center justify-center aspect-[16/10] md:aspect-[16/9]">
            <img id="lightbox-image" src="" alt="Lightbox View" class="max-w-full max-h-[80vh] object-contain transition-all duration-300">
        </div>
        
        {{-- Caption and Info --}}
        <div class="text-center w-full px-6 py-2">
            <p id="lightbox-caption" class="text-white text-lg font-bold tracking-wide"></p>
            <p id="lightbox-counter" class="text-gray-400 text-xs font-semibold mt-1"></p>
        </div>
    </div>
</div>

<script>
    function playYoutubeOnSite(videoId, containerId) {
        const container = document.getElementById(containerId);
        if (container) {
            container.innerHTML = `
                <iframe class="w-full h-full" 
                        src="https://www.youtube.com/embed/${videoId}?autoplay=1" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
            `;
        }
    }

    let lightboxImages = [];
    let currentLightboxIndex = 0;

    function openGalleryLightbox(images, caption) {
        if (!images || images.length === 0) return;
        lightboxImages = images;
        currentLightboxIndex = 0;
        
        document.getElementById('lightbox-caption').textContent = caption;
        updateLightboxView();
        
        const modal = document.getElementById('gallery-lightbox-modal');
        modal.classList.remove('hidden');
        modal.offsetHeight; // force reflow
        modal.classList.remove('opacity-0');
        modal.classList.add('opacity-100');
        
        document.body.style.overflow = 'hidden';
    }

    function closeGalleryLightbox() {
        const modal = document.getElementById('gallery-lightbox-modal');
        modal.classList.add('opacity-0');
        modal.classList.remove('opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    function updateLightboxView() {
        const imgEl = document.getElementById('lightbox-image');
        if (imgEl) {
            imgEl.style.opacity = '0.3';
            imgEl.style.transform = 'scale(0.98)';
            setTimeout(() => {
                imgEl.src = lightboxImages[currentLightboxIndex];
                imgEl.onload = () => {
                    imgEl.style.opacity = '1';
                    imgEl.style.transform = 'scale(1)';
                };
            }, 100);
        }
        
        const counterEl = document.getElementById('lightbox-counter');
        if (counterEl) {
            counterEl.textContent = `Foto ${currentLightboxIndex + 1} dari ${lightboxImages.length}`;
        }
        
        const prevBtn = document.getElementById('lightbox-prev-btn');
        const nextBtn = document.getElementById('lightbox-next-btn');
        if (lightboxImages.length > 1) {
            if (prevBtn) prevBtn.classList.remove('hidden');
            if (nextBtn) nextBtn.classList.remove('hidden');
        } else {
            if (prevBtn) prevBtn.classList.add('hidden');
            if (nextBtn) nextBtn.classList.add('hidden');
        }
    }

    function prevLightboxImage() {
        if (lightboxImages.length <= 1) return;
        currentLightboxIndex = (currentLightboxIndex - 1 + lightboxImages.length) % lightboxImages.length;
        updateLightboxView();
    }

    function nextLightboxImage() {
        if (lightboxImages.length <= 1) return;
        currentLightboxIndex = (currentLightboxIndex + 1) % lightboxImages.length;
        updateLightboxView();
    }

    // Close on background click
    document.getElementById('gallery-lightbox-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeGalleryLightbox();
        }
    });

    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('gallery-lightbox-modal');
        if (modal && !modal.classList.contains('hidden')) {
            if (e.key === 'Escape') {
                closeGalleryLightbox();
            } else if (e.key === 'ArrowLeft') {
                prevLightboxImage();
            } else if (e.key === 'ArrowRight') {
                nextLightboxImage();
            }
        }
    });
</script>

</div>
@endsection
