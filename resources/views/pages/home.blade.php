@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-emerald-950 text-white overflow-hidden py-24 md:py-32">
    {{-- High-end background decorations --}}
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <svg class="absolute top-0 right-0 w-[800px] h-[800px] text-primary-500/20 transform translate-x-1/3 -translate-y-1/3" fill="none" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 2" />
            <circle cx="50" cy="50" r="30" stroke="currentColor" stroke-width="0.2" />
        </svg>
        <div class="absolute -bottom-10 left-10 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-20 w-80 h-80 bg-secondary-500/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            {{-- Left Content --}}
            <div class="animate-slide-in lg:col-span-7 space-y-8">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm font-semibold tracking-wide backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Pusat Pelatihan & Sertifikasi Profesional
                </span>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                    {!! nl2br(e(\App\Models\Setting::get('home_welcome_title', "Selamat Datang di\nLemdiklat\nPermapendis"))) !!}
                </h1>
                
                <p class="text-lg text-emerald-100/80 leading-relaxed max-w-xl font-medium">
                    {!! nl2br(e(\App\Models\Setting::get('home_welcome_desc', 'Lembaga Pendidikan dan Pelatihan Permapendis adalah pusat pelatihan yang berdedikasi untuk meningkatkan kompetensi tenaga pendidik dan kependidikan di Indonesia.'))) !!}
                </p>
                
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('about') }}" class="btn-primary py-3 px-8 shadow-emerald-950/50">
                        Tentang Kami
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('articles') }}" class="btn-secondary py-3 px-8">
                        Lihat Artikel
                    </a>
                </div>
            </div>
            
            {{-- Right Image Grid (Artistic and Premium Layout) --}}
            <div class="animate-fade-in lg:col-span-5 hidden lg:block relative">
                <div class="absolute -inset-4 bg-gradient-to-tr from-primary-500/10 to-secondary-500/10 rounded-3xl blur-2xl"></div>
                <div class="relative grid grid-cols-12 gap-4 h-[420px]">
                    <div class="col-span-6 space-y-4">
                        <div class="h-64 overflow-hidden rounded-3xl border border-white/10 group">
                            <img src="{{ \App\Models\Setting::get('home_img_1', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=300&h=200&fit=crop') }}" 
                                 alt="Pelatihan" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="h-36 overflow-hidden rounded-3xl border border-white/10 group">
                            <img src="{{ \App\Models\Setting::get('home_img_2', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=200&h=130&fit=crop') }}" 
                                 alt="Kelas" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                        </div>
                    </div>
                    <div class="col-span-6 space-y-4 pt-10">
                        <div class="h-36 overflow-hidden rounded-3xl border border-white/10 group">
                            <img src="{{ \App\Models\Setting::get('home_img_3', 'https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=200&h=130&fit=crop') }}" 
                                 alt="Sertifikasi" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="h-64 overflow-hidden rounded-3xl border border-white/10 group">
                            <img src="{{ \App\Models\Setting::get('home_img_4', 'https://images.unsplash.com/photo-1588702547923-7408e47e5d6e?w=200&h=130&fit=crop') }}" 
                                 alt="Presentasi" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Stats section with modern cards --}}
<section class="relative -mt-10 z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-[#0b120f] rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-gray-100 dark:border-emerald-950/30 p-8 md:p-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 divide-y-2 md:divide-y-0 lg:divide-x divide-gray-100 dark:divide-emerald-950/20">
            @foreach([
                ['number' => '500+', 'label' => 'Alumni Tersertifikasi', 'color' => 'text-primary-600 dark:text-primary-400'],
                ['number' => '20+', 'label' => 'Instruktur Berpengalaman', 'color' => 'text-secondary-500'],
                ['number' => '3', 'label' => 'Program Unggulan', 'color' => 'text-indigo-600 dark:text-indigo-400'],
                ['number' => '10+', 'label' => 'Tahun Pelayanan', 'color' => 'text-emerald-600 dark:text-emerald-400'],
            ] as $index => $stat)
            <div class="flex flex-col items-center justify-center text-center {{ $index > 1 ? 'pt-6 md:pt-0' : '' }} lg:pt-0 lg:px-4">
                <p class="text-4xl lg:text-5xl font-black {{ $stat['color'] }} tracking-tight mb-2">{{ $stat['number'] }}</p>
                <p class="text-xs lg:text-sm font-bold text-gray-400 uppercase tracking-widest dark:text-gray-500">{{ $stat['label'] }}</p>
            </div>
            @endforeach
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
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center {{ $feature['bg'] }} transition-transform duration-500 group-hover:rotate-6">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $feature['icon'] !!}
                </svg>
            </div>
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

@endsection
