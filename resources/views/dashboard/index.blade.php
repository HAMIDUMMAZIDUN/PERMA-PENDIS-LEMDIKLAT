@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali, ' . auth()->user()->display_name . '!')

@section('content')
<div class="space-y-8 animate-fade-in">

    {{-- Exquisite Welcome Hero --}}
    <div class="relative bg-gradient-to-r from-primary-950 via-primary-900 to-emerald-950 rounded-3xl p-8 text-white overflow-hidden shadow-lg shadow-primary-900/5">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(252,211,77,0.06),transparent_40%)]"></div>
        <div class="relative flex flex-col md:flex-row items-center gap-6 z-10">
            @if(auth()->user()->profile?->profile_picture)
                <img src="{{ asset('uploads/profile-photos/' . auth()->user()->profile->profile_picture) }}"
                     class="w-20 h-20 rounded-full object-cover border-4 border-white/20 shadow-md" alt="Foto Profil">
            @else
                <div class="w-20 h-20 rounded-full bg-white/10 flex items-center justify-center text-3xl font-black border-2 border-white/15">
                    {{ auth()->user()->initials }}
                </div>
            @endif
            <div class="text-center md:text-left space-y-1.5">
                <h2 class="text-2xl md:text-3xl font-black tracking-tight">Selamat Datang, {{ auth()->user()->display_name }}!</h2>
                <p class="text-emerald-200/90 text-sm font-semibold tracking-wide">Pusat tata kelola pembelajaran dan penguatan kompetensi digital Anda.</p>
            </div>
        </div>
    </div>

    {{-- High-End Stat Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([
            [
                'label' => 'Total Sertifikat', 
                'value' => '3', 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                'color' => 'text-primary-700 bg-primary-50 dark:bg-primary-950/20 dark:text-primary-400'
            ],
            [
                'label' => 'Kursus Aktif', 
                'value' => '2', 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
                'color' => 'text-teal-700 bg-teal-50 dark:bg-teal-950/20 dark:text-teal-400'
            ],
            [
                'label' => 'Ujian Mendatang', 
                'value' => '1', 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />',
                'color' => 'text-indigo-700 bg-indigo-50 dark:bg-indigo-950/20 dark:text-indigo-400'
            ],
            [
                'label' => 'Kursus Selesai', 
                'value' => '5', 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
                'color' => 'text-amber-700 bg-amber-50 dark:bg-amber-950/20 dark:text-amber-400'
            ],
        ] as $stat)
        <div class="dashboard-stat-card group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $stat['label'] }}</p>
            </div>
            <p class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">{{ $stat['value'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Main Sections Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Recent Certifications --}}
        <div class="card p-0 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
                <h3 class="font-extrabold text-gray-900 text-lg dark:text-white">Sertifikat Terbaru</h3>
                <a href="#" class="text-primary-750 text-sm font-bold hover:text-primary-900 transition-colors">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100/70 dark:divide-emerald-950/10">
                @foreach([
                    ['name' => 'Teknisi Jaringan Komputer', 'no' => 'LSP-001-2024-045', 'date' => '15 Des 2024', 'status' => 'Lulus'],
                    ['name' => 'Programmer Aplikasi', 'no' => 'LSP-002-2024-032', 'date' => '20 Nov 2024', 'status' => 'Lulus'],
                    ['name' => 'Digital Marketing', 'no' => 'LSP-003-2024-018', 'date' => '10 Okt 2024', 'status' => 'Lulus'],
                ] as $cert)
                <div class="flex items-center gap-4 px-6 py-4.5 hover:bg-gray-50/50 dark:hover:bg-[#101b15]/30 transition-colors">
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 text-sm truncate dark:text-white">{{ $cert['name'] }}</p>
                        <p class="text-xs text-gray-400 font-semibold mt-0.5">{{ $cert['no'] }} • {{ $cert['date'] }}</p>
                    </div>
                    <span class="badge-success">{{ $cert['status'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Upcoming Schedule --}}
        <div class="card p-0 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
                <h3 class="font-extrabold text-gray-900 text-lg dark:text-white">Jadwal Mendatang</h3>
                <a href="#" class="text-primary-750 text-sm font-bold hover:text-primary-900 transition-colors">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100/70 dark:divide-emerald-950/10">
                @foreach([
                    ['title' => 'Pelatihan Advanced Networking', 'date' => '15 Jan 2025', 'time' => '09:00 - 17:00', 'location' => 'Jakarta Training Center', 'type' => 'Pelatihan'],
                    ['title' => 'Uji Kompetensi Web Developer', 'date' => '20 Jan 2025', 'time' => '10:00 - 12:00', 'location' => 'Online', 'type' => 'Ujian'],
                ] as $sched)
                <div class="flex items-start gap-4 px-6 py-4.5 hover:bg-gray-50/50 dark:hover:bg-[#101b15]/30 transition-colors">
                    <div class="flex-1">
                        <p class="font-bold text-gray-900 text-sm dark:text-white leading-snug">{{ $sched['title'] }}</p>
                        <p class="text-xs text-gray-400 font-semibold mt-1">{{ $sched['date'] }} • {{ $sched['time'] }}</p>
                        <p class="text-xs text-gray-400 font-bold mt-0.5">📍 {{ $sched['location'] }}</p>
                    </div>
                    <span class="{{ $sched['type'] === 'Ujian' ? 'badge-warning' : 'badge-primary' }}">{{ $sched['type'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Active Courses --}}
    <div class="card p-0 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
            <h3 class="font-extrabold text-gray-900 text-lg dark:text-white">Kursus Aktif</h3>
            <a href="#" class="text-primary-750 text-sm font-bold hover:text-primary-900 transition-colors">Lihat Semua Kursus</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            @foreach([
                ['name' => 'Full Stack Developer Bootcamp', 'progress' => 75, 'next' => 'Database Design - 10 Jan 2025', 'instructor' => 'Dr. Ahmad Rahman'],
                ['name' => 'Cloud Computing Fundamentals', 'progress' => 45, 'next' => 'AWS Services - 12 Jan 2025', 'instructor' => 'Ibu Siti Aminah'],
            ] as $course)
            <div class="border border-gray-100 dark:border-emerald-950/30 rounded-2xl p-5 hover:shadow-md transition-shadow dark:bg-[#080d0b]">
                <h4 class="font-extrabold text-gray-900 text-base mb-1 dark:text-white">{{ $course['name'] }}</h4>
                <p class="text-xs text-gray-400 font-bold mb-4">Instruktur: {{ $course['instructor'] }}</p>
                <div class="mb-4">
                    <div class="flex justify-between text-xs text-gray-400 font-bold mb-2">
                        <span>Pencapaian Belajar</span>
                        <span class="text-primary-700 dark:text-primary-400">{{ $course['progress'] }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $course['progress'] }}%"></div>
                    </div>
                </div>
                <p class="text-xs text-gray-405 dark:text-gray-500 font-semibold mb-4">📍 Sesi Berikutnya: {{ $course['next'] }}</p>
                <div class="flex gap-2">
                    <button class="btn-primary text-xs px-4 py-2 border-0">Lanjut Belajar</button>
                    <button class="btn-secondary text-xs px-4 py-2">Silabus</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card p-8">
        <h3 class="font-extrabold text-gray-900 text-lg mb-6 dark:text-white">Aksi Cepat</h3>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label' => 'Daftar Kursus', 'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6', 'href' => '#', 'style' => 'bg-gradient-to-r from-primary-900 to-primary-800 text-white hover:from-primary-800 hover:to-primary-700 shadow-md shadow-primary-900/10'],
                ['label' => 'Daftar Ujian', 'icon' => 'M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'href' => '#', 'style' => 'bg-white dark:bg-[#111e19]/60 border border-gray-150 dark:border-emerald-900/30 text-gray-700 dark:text-primary-300 hover:bg-gray-50 dark:hover:bg-primary-950/40'],
                ['label' => 'Sertifikat Saya', 'icon' => 'M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'href' => '#', 'style' => 'bg-white dark:bg-[#111e19]/60 border border-gray-150 dark:border-emerald-900/30 text-gray-700 dark:text-primary-300 hover:bg-gray-50 dark:hover:bg-primary-950/40'],
                ['label' => 'Jadwal Saya', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'href' => '#', 'style' => 'bg-white dark:bg-[#111e19]/60 border border-gray-150 dark:border-emerald-900/30 text-gray-700 dark:text-primary-300 hover:bg-gray-50 dark:hover:bg-primary-950/40'],
            ] as $action)
            <a href="{{ $action['href'] }}" class="flex flex-col items-center justify-center gap-2.5 h-24 rounded-2xl font-bold text-sm transition-all duration-350 active:scale-95 text-center p-3 {{ $action['style'] }}">
                {{ $action['label'] }}
            </a>
            @endforeach
        </div>
    </div>

</div>
@endsection
