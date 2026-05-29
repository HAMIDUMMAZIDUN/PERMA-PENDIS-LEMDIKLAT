@extends('layouts.app')
@section('title', 'Tentang Kami')
@section('description', 'Tentang Lemdiklat Permapendis - Lembaga Pendidikan dan Pelatihan yang berdedikasi meningkatkan kompetensi tenaga pendidik Indonesia')

@section('content')

{{-- Elegant Page Header --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-emerald-950 text-white py-24 text-center overflow-hidden">
    {{-- High-end background decorations --}}
    <div class="absolute inset-0 opacity-15 pointer-events-none">
        <svg class="absolute top-0 left-0 w-[600px] h-[600px] text-primary-500/20 transform -translate-x-1/4 -translate-y-1/4" fill="none" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="0.3" stroke-dasharray="2 2" />
        </svg>
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 space-y-6 animate-slide-up">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-semibold tracking-wide backdrop-blur-md">
            Mengenal Lembaga Kami
        </span>
        <h1 class="text-4xl md:text-6xl font-black tracking-tight">Tentang Lemdiklat Permapendis</h1>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-lg md:text-xl text-emerald-100/80 max-w-3xl mx-auto leading-relaxed font-medium">
            Lembaga Pendidikan dan Pelatihan berkomitmen tinggi meningkatkan kompetensi melalui program pelatihan terstruktur, kurikulum mutakhir, instruktur berpengalaman, serta pendekatan modern yang berorientasi hasil nyata.
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-24">

    {{-- Visi & Misi (High-End Presentation) --}}
    <div class="grid md:grid-cols-2 gap-8">
        <div class="card border-l-4 border-primary-600 space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary-500/10 flex items-center justify-center text-primary-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Visi Kami</h2>
            </div>
            <p class="text-gray-500 leading-relaxed dark:text-gray-400 font-medium text-base">Menjadi pusat keunggulan (center of excellence) pengembangan kompetensi pendidik dan kependidikan yang berdaya saing tinggi, relevan dengan kemajuan digital, serta mendorong terciptanya budaya belajar sepanjang hayat di Indonesia.</p>
        </div>
        
        <div class="card border-l-4 border-secondary-600 space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-secondary-500/10 flex items-center justify-center text-secondary-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Misi Kami</h2>
            </div>
            <ul class="space-y-3 font-medium text-gray-500 dark:text-gray-400">
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0 text-xs mt-0.5">✓</span> 
                    <span>Menyelenggarakan program pelatihan berbasis kompetensi riil dan praktik manajemen terbaik.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0 text-xs mt-0.5">✓</span> 
                    <span>Memfasilitasi ujian sertifikasi profesi untuk memvalidasi kualifikasi keahlian pendidik.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0 text-xs mt-0.5">✓</span> 
                    <span>Membangun kolaborasi strategis dengan kementerian, dinas pendidikan, serta lembaga internasional.</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Value Grid --}}
    <div class="grid md:grid-cols-3 gap-8">
        @foreach([
            [
                'icon' => '🏆', 
                'title' => 'Profesional & Teruji', 
                'desc' => 'Instruktur bersertifikat BNSP, kurikulum adaptif standar industri, dan fasilitas memadai.', 
                'color' => 'bg-emerald-500/5 text-emerald-900 dark:text-emerald-300 border border-emerald-500/10'
            ],
            [
                'icon' => '🤝', 
                'title' => 'Kolaborasi Luas', 
                'desc' => 'Kemitraan global & dinas pendidikan daerah untuk perluasan kesempatan karir alumni.', 
                'color' => 'bg-amber-500/5 text-amber-900 dark:text-amber-300 border border-amber-500/10'
            ],
            [
                'icon' => '🎯', 
                'title' => 'Berorientasi Output', 
                'desc' => 'Fokus utama kami adalah keberhasilan lulusan dalam menerapkan program belajar inovatif di sekolah.', 
                'color' => 'bg-indigo-500/5 text-indigo-900 dark:text-indigo-300 border border-indigo-500/10'
            ],
        ] as $val)
        <div class="rounded-3xl p-8 space-y-4 {{ $val['color'] }}">
            <div class="text-3xl">{{ $val['icon'] }}</div>
            <h3 class="font-extrabold text-xl dark:text-white">{{ $val['title'] }}</h3>
            <p class="text-sm leading-relaxed opacity-85 font-medium">{{ $val['desc'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Susunan Pengurus (Institutional Board Layout) --}}
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
                    <h4 class="text-xs font-bold text-gray-450 uppercase tracking-widest mb-4 dark:text-gray-500">Direktur Utama</h4>
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
    </div>

    {{-- Contact CTA --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-primary-950 to-primary-900 text-white px-8 py-14 text-center shadow-lg">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(252,211,77,0.06),transparent_40%)]"></div>
        <div class="relative max-w-xl mx-auto space-y-6">
            <h3 class="text-3xl font-extrabold leading-tight">Ada Pertanyaan Mengenai Program Kami?</h3>
            <p class="text-emerald-100/80 text-sm font-medium leading-relaxed">Hubungi pusat informasi kami untuk mendapatkan detail kurikulum pelatihan atau konsultasi korporasi sekolah.</p>
            <div class="pt-4">
                <a href="{{ route('contact') }}" class="btn-primary bg-white text-primary-950 hover:bg-emerald-50 px-8 py-3.5 border-0 shadow-lg dark:bg-white dark:text-primary-950 dark:hover:bg-emerald-50">Hubungi Kami Sekarang</a>
            </div>
        </div>
    </div>

</section>
@endsection
