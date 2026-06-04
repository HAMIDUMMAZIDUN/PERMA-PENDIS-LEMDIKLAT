@extends('layouts.app')
@section('title', 'Tentang Kami')
@section('description', 'Tentang PERMA PENDIS - Perkumpulan Manajer Pendidikan Islam Indonesia yang berdedikasi meningkatkan kompetensi manajer dan tenaga pendidik Islam')

@section('content')

{{-- Elegant Page Header --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-emerald-950 text-white py-24 text-center overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 animate-slide-up">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight">{{ \App\Models\Setting::get('about_title', 'Tentang PERMA PENDIS') }}</h1>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-lg md:text-xl text-emerald-100/80 leading-relaxed font-medium text-justify">
            {{ \App\Models\Setting::get('about_desc', 'Lembaga Pendidikan dan Pelatihan berkomitmen tinggi meningkatkan kompetensi melalui program pelatihan terstruktur, kurikulum mutakhir, instruktur berpengalaman, serta pendekatan modern yang berorientasi hasil nyata.') }}
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-24">

    {{-- Visi & Misi (High-End Presentation) --}}
    <div class="grid md:grid-cols-2 gap-8">
        <div class="card border-l-4 border-primary-600 space-y-4">
            <div class="flex items-center gap-3">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Visi Kami</h2>
            </div>
            <p class="text-gray-500 leading-relaxed dark:text-gray-400 font-medium text-base">{{ \App\Models\Setting::get('about_visi', 'Menjadi pusat keunggulan (center of excellence) pengembangan kompetensi pendidik dan kependidikan yang berdaya saing tinggi, relevan dengan kemajuan digital, serta mendorong terciptanya budaya belajar sepanjang hayat di Indonesia.') }}</p>
        </div>
        
        <div class="card border-l-4 border-secondary-600 space-y-4">
            <div class="flex items-center gap-3">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Misi Kami</h2>
            </div>
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

    {{-- AD/ART Section --}}
    <div class="card border border-gray-150 p-8 dark:bg-[#0b120f] dark:border-emerald-950/20 rounded-3xl shadow-sm space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3 max-w-3xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400">
                    Dokumen Hukum Resmi
                </span>
                <h2 class="text-2xl font-extrabold text-primary-950 dark:text-white">Anggaran Dasar & Anggaran Rumah Tangga (AD/ART)</h2>
                <p class="text-gray-500 dark:text-gray-400 font-medium text-sm leading-relaxed text-justify animate-text-clip">
                    Anggaran Dasar (AD) dan Anggaran Rumah Tangga (ART) merupakan landasan operasional konstitusional Perkumpulan Manajer Pendidikan Islam (Perma Pendis) Indonesia. Dokumen resmi ini disahkan pada Kongres ke-I Tanggal 9 Februari 2019 di Pondok Pesantren Tebuireng Jombang Jawa Timur, yang mengatur asas, landasan hukum, kode etik profesi, hak dan kewajiban anggota, serta tata kelola organisasi di tingkat nasional dan wilayah.
                </p>
            </div>
            <div class="shrink-0 self-start md:self-center">
                <a href="{{ route('ad-art') }}" target="_blank" class="btn-primary py-3.5 px-6 text-sm rounded-2xl flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition">
                    <span>Lihat Selengkapnya</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>



    {{-- Susunan Pengurus (Institutional Board Layout) --}}
    <div id="susunan-organisasi" class="space-y-12">
        <div class="text-center space-y-4">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight text-primary-950 dark:text-white">{{ \App\Models\Setting::get('org_title', 'Susunan Organisasi') }}</h2>
            <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
            <p class="text-gray-500 dark:text-gray-400 font-medium max-w-xl mx-auto">{{ \App\Models\Setting::get('org_desc', 'Struktur kepengurusan profesional yang mendampingi dan mengarahkan kemajuan PERMA PENDIS.') }}</p>
        </div>        @if($boardMembers->count() > 0)
        <div class="card p-0 overflow-hidden border border-gray-100 dark:bg-[#0b120f] dark:border-emerald-950/20 rounded-3xl shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/50 dark:bg-emerald-950/5 border-b border-gray-100 dark:border-emerald-950/20">
                            <th class="py-4 px-6 font-semibold text-center w-16">No</th>
                            <th class="py-4 px-6 font-semibold w-1/4">Struktur / Bagian</th>
                            <th class="py-4 px-6 font-semibold w-2/5">Nama Pengurus</th>
                            <th class="py-4 px-6 font-semibold">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-emerald-950/10 font-medium">
                        @foreach($boardMembers as $member)
                        <tr class="hover:bg-gray-50/30 dark:hover:bg-[#101b15]/10 transition-colors">
                            <td class="py-4 px-6 text-center text-gray-450 dark:text-gray-650 font-mono text-xs">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-4 px-6 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                                <span class="px-2.5 py-1 rounded-md bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-500/10">
                                    {{ $member->category }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-gray-900 dark:text-white font-semibold text-sm">
                                {{ $member->name }}
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 dark:text-gray-300">
                                {{ $member->role }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    {{-- Informasi Kontak --}}
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-primary-950 to-primary-900 text-white px-8 py-14 text-center shadow-lg">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(252,211,77,0.06),transparent_40%)]"></div>
        <div class="relative max-w-xl mx-auto space-y-6">
            <h3 class="text-xl md:text-2xl font-bold leading-tight">Ada Pertanyaan Mengenai Program Kami?</h3>
            <p class="text-emerald-100/80 text-sm font-medium leading-relaxed">Hubungi pusat informasi kami untuk mendapatkan detail kurikulum pelatihan atau konsultasi korporasi sekolah.</p>
            <div class="pt-4">
                <a href="{{ route('contact') }}" class="btn-primary px-8 py-3.5">Hubungi Kami Sekarang</a>
            </div>
        </div>
    </div>

</section>
@endsection
