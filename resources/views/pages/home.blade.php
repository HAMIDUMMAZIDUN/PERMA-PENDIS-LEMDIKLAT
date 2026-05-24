@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-primary-900 via-primary-800 to-secondary-700 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        
        
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            {{-- Left Content --}}
            <div class="animate-slide-in">
                <span class="inline-block px-4 py-1.5 rounded-full bg-white/20 text-white text-sm font-medium mb-4 backdrop-blur">
                    Pusat Pelatihan Terpercaya
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                    {!! nl2br(e(\App\Models\Setting::get('home_welcome_title', "Selamat Datang di\nLemdiklat\nPermapendis"))) !!}
                </h1>
                <p class="text-lg text-emerald-100 mb-8 leading-relaxed max-w-lg">
                    {!! nl2br(e(\App\Models\Setting::get('home_welcome_desc', 'Lembaga Pendidikan dan Pelatihan Permapendis adalah pusat pelatihan yang berdedikasi untuk meningkatkan kompetensi tenaga pendidik dan kependidikan di Indonesia.'))) !!}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-primary-900 font-bold rounded-xl hover:bg-emerald-50 transition shadow-lg dark:bg-gray-900">
                        
                        Tentang Kami
                    </a>
                    <a href="{{ route('articles') }}" class="inline-flex items-center gap-2 px-6 py-3 border-2 border-white text-white font-bold rounded-xl hover:bg-white/10 transition">
                        
                        Lihat Artikel
                    </a>
                </div>
            </div>
            {{-- Right Image Grid --}}
            <div class="animate-fade-in hidden md:grid grid-cols-3 grid-rows-2 gap-3 h-72">
                <img src="{{ \App\Models\Setting::get('home_img_1', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=300&h=200&fit=crop') }}" alt="Pelatihan" class="object-cover rounded-2xl w-full h-full shadow-lg row-span-2 hover:scale-105 transition-transform">
                <img src="{{ \App\Models\Setting::get('home_img_2', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=200&h=130&fit=crop') }}" alt="Kelas" class="object-cover rounded-2xl w-full h-full shadow-lg hover:scale-105 transition-transform">
                <img src="{{ \App\Models\Setting::get('home_img_3', 'https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=200&h=130&fit=crop') }}" alt="Sertifikasi" class="object-cover rounded-2xl w-full h-full shadow-lg hover:scale-105 transition-transform">
                <img src="{{ \App\Models\Setting::get('home_img_4', 'https://images.unsplash.com/photo-1588702547923-7408e47e5d6e?w=200&h=130&fit=crop') }}" alt="Workshop" class="object-cover rounded-2xl w-full h-full shadow-lg hover:scale-105 transition-transform">
                <img src="{{ \App\Models\Setting::get('home_img_5', 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=200&h=130&fit=crop') }}" alt="Presentasi" class="object-cover rounded-2xl w-full h-full shadow-lg hover:scale-105 transition-transform">
            </div>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="bg-white py-10 border-b border-gray-100 dark:bg-gray-900 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            @foreach([
                ['number' => '500+', 'label' => 'Alumni', 'icon' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'],
                ['number' => '20+', 'label' => 'Instruktur', 'icon' => 'M20 6h-2.18c.07-.44.18-.87.18-1.3C18 2.57 15.86.5 13.5.5c-1.55 0-2.93.78-3.77 2l-.73 1-.73-1C7.43 1.28 6.05.5 4.5.5 2.14.5 0 2.57 0 4.7c0 .43.11.86.18 1.3H0v2h20V6z'],
                ['number' => '3', 'label' => 'Program Unggulan', 'icon' => 'M12 3L1 9l11 6 9-4.91V17h2V9L12 3zm-5.5 5.5L12 5.56 17.5 8.5 12 11.44 6.5 8.5z'],
                ['number' => '10+', 'label' => 'Tahun Berpengalaman', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z'],
            ] as $stat)
            <div class="flex flex-col items-center gap-2">
                
                <p class="text-3xl font-extrabold text-primary-900">{{ $stat['number'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14 animate-slide-up">
        <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900 mb-4">Mengapa Memilih Kami?</h2>
        <p class="text-gray-500 max-w-2xl mx-auto text-lg dark:text-gray-400">Karena komitmen kami untuk meningkatkan Lembaga Pendidikan dan Kompetensi di tingkat nasional maupun internasional.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([
            ['icon' => '🏆', 'title' => 'Pengalaman & Kompeten', 'desc' => 'Instruktur berpengalaman dan profesional di bidang pendidikan dan pelatihan.', 'color' => 'from-emerald-500 to-emerald-700'],
            ['icon' => '📚', 'title' => 'Materi Berkualitas', 'desc' => 'Kurikulum dan materi pelatihan selalu diperbarui mengikuti kebutuhan terkini.', 'color' => 'from-teal-500 to-teal-700'],
            ['icon' => '💡', 'title' => 'Pendekatan Inovatif', 'desc' => 'Metode belajar aktif dan interaktif yang mendorong partisipasi peserta.', 'color' => 'from-indigo-500 to-purple-700'],
            ['icon' => '🤝', 'title' => 'Relasi & Jejaring Luas', 'desc' => 'Akses komunitas dan jejaring alumni untuk pengembangan karir lebih lanjut.', 'color' => 'from-orange-500 to-red-600'],
        ] as $feature)
        <div class="card-hover group animate-slide-up text-center">
            
            <h3 class="font-bold text-gray-900 text-lg mb-2 dark:text-white">{{ $feature['title'] }}</h3>
            <p class="text-gray-500 text-sm leading-relaxed dark:text-gray-400">{{ $feature['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Training Programs --}}
<section class="bg-gradient-to-br from-gray-50 to-emerald-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900 mb-4">Skema Pendidikan Dan Pelatihan</h2>
            <p class="text-gray-500 max-w-2xl mx-auto dark:text-gray-400">Berikut adalah beberapa skema Pelatihan yang tersedia, dirancang untuk memenuhi kebutuhan industri dan meningkatkan daya saing peserta.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['title' => 'Pelatihan Kepala Sekolah Dasar (SD) / Madrasah Ibtidaiyah (MI)', 'desc' => 'Program pelatihan komprehensif untuk kepala sekolah SD/MI dalam kepemimpinan pendidikan, manajemen sekolah, dan pengembangan kurikulum tingkat dasar.', 'img' => \App\Models\Setting::get('home_program_img_1', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=250&fit=crop'), 'badge' => 'SD/MI'],
                ['title' => 'Pelatihan Kepala Sekolah SMP/MTS', 'desc' => 'Pelatihan khusus kepala sekolah SMP/MTS meliputi manajemen remaja, pengembangan karakter siswa, dan strategi pembelajaran efektif tingkat menengah pertama.', 'img' => \App\Models\Setting::get('home_program_img_2', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=400&h=250&fit=crop'), 'badge' => 'SMP/MTS'],
                ['title' => 'Pelatihan Kepala Sekolah SMA/SMK/MA/MAK', 'desc' => 'Program pelatihan untuk kepala sekolah SMA/SMK/MA/MAK fokus pada persiapan siswa ke perguruan tinggi, link and match industri, dan pengembangan soft skills.', 'img' => \App\Models\Setting::get('home_program_img_3', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400&h=250&fit=crop'), 'badge' => 'SMA/SMK'],
            ] as $program)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group dark:bg-gray-900">
                <div class="relative overflow-hidden h-52">
                    <img src="{{ $program['img'] }}" alt="{{ $program['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    
                    <span class="absolute top-3 right-3 badge-primary text-xs font-bold">{{ $program['badge'] }}</span>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 text-base mb-3 leading-snug dark:text-white">{{ $program['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed dark:text-gray-400">{{ $program['desc'] }}</p>
                    <a href="{{ route('register') }}" class="mt-4 inline-flex items-center gap-1 text-primary-700 font-semibold text-sm hover:text-primary-900 transition">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Latest News --}}
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
        <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900 mb-4">Berita Terbaru</h2>
        <p class="text-gray-500 dark:text-gray-400">Update terbaru seputar kegiatan, informasi, dan pengumuman dari Lemdiklat Permapendis.</p>
    </div>

    @if($articles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($articles as $article)
        <a href="{{ route('articles.show', $article->slug) }}" class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col dark:bg-gray-900">
            <div class="relative overflow-hidden h-48">
                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                
                @if($article->category)
                    <span class="absolute top-3 left-3 badge-primary text-xs">{{ $article->category->name }}</span>
                @endif
            </div>
            <div class="p-5 flex flex-col flex-1">
                <h3 class="font-bold text-gray-900 text-base mb-2 group-hover:text-primary-700 transition leading-snug line-clamp-2 dark:text-white">{{ $article->title }}</h3>
                <p class="text-gray-500 text-sm flex-1 line-clamp-3 dark:text-gray-400">{{ $article->excerpt }}</p>
                <div class="mt-3 flex items-center justify-between text-xs text-gray-400">
                    <span>{{ $article->author }}</span>
                    <span>{{ $article->updated_at->locale('id')->diffForHumans() }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 text-gray-400">
        
        <p>Belum ada berita terbaru.</p>
    </div>
    @endif

    <div class="text-center mt-10">
        <a href="{{ route('articles') }}" class="btn-primary">Lihat Semua Artikel</a>
    </div>
</section>

{{-- CTA Section --}}
<section class="bg-gradient-to-r from-primary-900 to-secondary-700 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Siap Bergabung?</h2>
        <p class="text-emerald-100 text-lg mb-8">Daftarkan diri Anda sekarang dan mulai perjalanan peningkatan kompetensi bersama kami.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-primary-900 font-bold rounded-xl hover:bg-emerald-50 transition shadow-lg dark:bg-gray-900">Daftar Sekarang</a>
            <a href="{{ route('contact') }}" class="px-8 py-3 border-2 border-white text-white font-bold rounded-xl hover:bg-white/10 transition">Hubungi Kami</a>
        </div>
    </div>
</section>

@endsection
