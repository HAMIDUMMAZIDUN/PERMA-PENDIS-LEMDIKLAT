@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali, ' . auth()->user()->display_name . '!')

@section('content')
<div class="space-y-8">

    {{-- Welcome Card --}}
    <div class="bg-gradient-to-r from-primary-900 to-secondary-700 rounded-2xl p-6 text-white animate-slide-in">
        <div class="flex items-center gap-4">
            @if(auth()->user()->profile?->profile_picture)
                <img src="{{ asset('uploads/profile-photos/' . auth()->user()->profile->profile_picture) }}"
                     class="w-16 h-16 rounded-full object-cover border-4 border-white/30" alt="Foto Profil">
            @else
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center text-2xl font-bold">
                    {{ auth()->user()->initials }}
                </div>
            @endif
            <div>
                <h2 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->display_name }}!</h2>
                <p class="text-emerald-200 mt-1">Dashboard pembelajaran dan pengembangan kompetensi Anda</p>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach([
            ['label' => 'Total Sertifikat', 'value' => '3', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'bg-emerald-500', 'bg' => 'bg-emerald-50'],
            ['label' => 'Kursus Aktif', 'value' => '2', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'bg-teal-500', 'bg' => 'bg-teal-50'],
            ['label' => 'Ujian Mendatang', 'value' => '1', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'bg-purple-500', 'bg' => 'bg-purple-50'],
            ['label' => 'Kursus Selesai', 'value' => '5', 'icon' => 'M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'bg-orange-500', 'bg' => 'bg-orange-50'],
        ] as $stat)
        <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition dark:bg-gray-900 dark:border-gray-800">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm text-gray-500 font-medium dark:text-gray-400">{{ $stat['label'] }}</p>
                
            </div>
            <p class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $stat['value'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Certifications --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-900 dark:border-gray-800">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between dark:border-gray-800">
                <h3 class="font-bold text-gray-900 text-lg dark:text-white">Sertifikat Terbaru</h3>
                <a href="#" class="text-primary-700 text-sm font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-50 dark:divide-gray-800">
                @foreach([
                    ['name' => 'Teknisi Jaringan Komputer', 'no' => 'LSP-001-2024-045', 'date' => '15 Des 2024', 'status' => 'Lulus'],
                    ['name' => 'Programmer Aplikasi', 'no' => 'LSP-002-2024-032', 'date' => '20 Nov 2024', 'status' => 'Lulus'],
                    ['name' => 'Digital Marketing', 'no' => 'LSP-003-2024-018', 'date' => '10 Okt 2024', 'status' => 'Lulus'],
                ] as $cert)
                <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition dark:hover:bg-gray-800/50">
                    
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 text-sm truncate dark:text-white">{{ $cert['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $cert['no'] }} • {{ $cert['date'] }}</p>
                    </div>
                    <span class="badge-success whitespace-nowrap">{{ $cert['status'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Upcoming Schedule --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-900 dark:border-gray-800">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between dark:border-gray-800">
                <h3 class="font-bold text-gray-900 text-lg dark:text-white">Jadwal Mendatang</h3>
                <a href="#" class="text-primary-700 text-sm font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-50 dark:divide-gray-800">
                @foreach([
                    ['title' => 'Pelatihan Advanced Networking', 'date' => '15 Jan 2025', 'time' => '09:00 - 17:00', 'location' => 'Jakarta Training Center', 'type' => 'Pelatihan'],
                    ['title' => 'Uji Kompetensi Web Developer', 'date' => '20 Jan 2025', 'time' => '10:00 - 12:00', 'location' => 'Online', 'type' => 'Ujian'],
                ] as $sched)
                <div class="flex items-start gap-4 px-6 py-4 hover:bg-gray-50 transition dark:hover:bg-gray-800/50">
                    
                    <div class="flex-1">
                        <p class="font-medium text-gray-900 text-sm dark:text-white">{{ $sched['title'] }}</p>
                        <p class="text-xs text-gray-400">{{ $sched['date'] }} • {{ $sched['time'] }}</p>
                        <p class="text-xs text-gray-400">📍 {{ $sched['location'] }}</p>
                    </div>
                    <span class="{{ $sched['type'] === 'Ujian' ? 'badge-warning' : 'badge-primary' }} whitespace-nowrap text-xs">{{ $sched['type'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Active Courses --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-900 dark:border-gray-800">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between dark:border-gray-800">
            <h3 class="font-bold text-gray-900 text-lg dark:text-white">Kursus Aktif</h3>
            <a href="#" class="text-primary-700 text-sm font-medium hover:underline">Lihat Semua Kursus</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            @foreach([
                ['name' => 'Full Stack Developer Bootcamp', 'progress' => 75, 'next' => 'Database Design - 10 Jan 2025', 'instructor' => 'Dr. Ahmad Rahman'],
                ['name' => 'Cloud Computing Fundamentals', 'progress' => 45, 'next' => 'AWS Services - 12 Jan 2025', 'instructor' => 'Ibu Siti Aminah'],
            ] as $course)
            <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition dark:border-gray-800">
                <h4 class="font-bold text-gray-900 mb-1 dark:text-white">{{ $course['name'] }}</h4>
                <p class="text-sm text-gray-500 mb-4 dark:text-gray-400">Instruktur: {{ $course['instructor'] }}</p>
                <div class="mb-3">
                    <div class="flex justify-between text-xs text-gray-500 mb-1.5 dark:text-gray-400">
                        <span>Progress</span>
                        <span class="font-semibold text-primary-700">{{ $course['progress'] }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $course['progress'] }}%"></div>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-4">Sesi berikutnya: {{ $course['next'] }}</p>
                <div class="flex gap-2">
                    <button class="btn-primary text-xs px-3 py-1.5">Lanjut Belajar</button>
                    <button class="btn-secondary text-xs px-3 py-1.5">Jadwal Lengkap</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 dark:bg-gray-900 dark:border-gray-800">
        <h3 class="font-bold text-gray-900 text-lg mb-5 dark:text-white">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                ['label' => 'Daftar Kursus', 'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6', 'href' => '#', 'style' => 'bg-primary-900 text-white hover:bg-primary-800'],
                ['label' => 'Daftar Ujian', 'icon' => 'M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'href' => '#', 'style' => 'border-2 border-gray-200 text-gray-700 hover:border-primary-300 hover:bg-primary-50'],
                ['label' => 'Sertifikat Saya', 'icon' => 'M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'href' => '#', 'style' => 'border-2 border-gray-200 text-gray-700 hover:border-primary-300 hover:bg-primary-50'],
                ['label' => 'Jadwal Saya', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'href' => '#', 'style' => 'border-2 border-gray-200 text-gray-700 hover:border-primary-300 hover:bg-primary-50'],
            ] as $action)
            <a href="{{ $action['href'] }}" class="flex flex-col items-center justify-center gap-2 h-20 rounded-xl font-medium text-sm transition {{ $action['style'] }}">
                
                {{ $action['label'] }}
            </a>
            @endforeach
        </div>
    </div>

</div>
@endsection
