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
                <h2 class="text-xl md:text-2xl font-bold tracking-tight">Selamat Datang, {{ auth()->user()->display_name }}!</h2>
                <p class="text-emerald-200/90 text-sm font-medium tracking-wide">Pusat tata kelola pembelajaran dan penguatan kompetensi digital Anda.</p>
            </div>
        </div>
    </div>

    {{-- High-End Stat Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([
            [
                'label' => 'Total Artikel', 
                'value' => $totalArticles, 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />',
                'color' => 'text-primary-700 bg-primary-50 dark:bg-primary-950/20 dark:text-primary-400'
            ],
            [
                'label' => 'Total Pengurus', 
                'value' => $totalBoardMembers, 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z" />',
                'color' => 'text-teal-700 bg-teal-50 dark:bg-teal-950/20 dark:text-teal-400'
            ],
            [
                'label' => 'Total Anggota', 
                'value' => $totalMembers, 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                'color' => 'text-indigo-700 bg-indigo-50 dark:bg-indigo-950/20 dark:text-indigo-400'
            ],
            [
                'label' => 'Pesan Unread', 
                'value' => $unreadMessages, 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
                'color' => 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/20 dark:text-emerald-400'
            ],
        ] as $stat)
        <div class="dashboard-stat-card group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">{{ $stat['label'] }}</p>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $stat['color'] }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $stat['icon'] !!}
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-medium text-gray-900 dark:text-white tracking-tight">{{ $stat['value'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Main Sections Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Recent Articles --}}
        <div class="card p-0 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
                <h3 class="font-bold text-gray-900 text-base dark:text-white">Artikel Terbaru</h3>
                <a href="{{ route('dashboard.articles') }}" class="text-primary-750 text-sm font-medium hover:text-primary-900 transition-colors">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100/70 dark:divide-emerald-950/10">
                @forelse($recentArticles as $art)
                <div class="flex items-center gap-4 px-6 py-4.5 hover:bg-gray-50/50 dark:hover:bg-[#101b15]/30 transition-colors">
                    <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-950/20 flex items-center justify-center text-primary-700 dark:text-primary-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 text-sm truncate dark:text-white">{{ $art->title }}</p>
                        <p class="text-xs text-gray-400 font-normal mt-0.5">{{ $art->category?->name ?? 'Kategori Umum' }} • {{ $art->created_at->format('d M Y') }}</p>
                    </div>
                    @if($art->is_published)
                        <span class="badge-success">Published</span>
                    @else
                        <span class="badge-warning">Draft</span>
                    @endif
                </div>
                @empty
                <div class="px-6 py-8 text-center text-gray-400 text-sm">
                    Belum ada artikel terbit.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Right Side Stack --}}
        <div class="space-y-8">
            {{-- Registered Board Members --}}
            <div class="card p-0 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 text-base dark:text-white">Pengurus Baru</h3>
                    <a href="{{ route('dashboard.board-members') }}" class="text-primary-750 text-sm font-medium hover:text-primary-900 transition-colors">Lihat Semua</a>
                </div>
                <div class="divide-y divide-gray-100/70 dark:divide-emerald-950/10">
                    @forelse($recentBoardMembers as $member)
                    <div class="flex items-center gap-4 px-6 py-4.5 hover:bg-gray-50/50 dark:hover:bg-[#101b15]/30 transition-colors">
                        @if($member->photo)
                            <img src="{{ $member->photo }}" class="w-10 h-10 rounded-xl object-cover shrink-0" alt="{{ $member->name }}">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/20 text-teal-700 dark:text-teal-400 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 text-sm truncate dark:text-white">{{ $member->name }}</p>
                            <p class="text-xs text-gray-400 font-normal mt-0.5">{{ $member->category ?? 'Pengurus PERMA PENDIS' }}</p>
                        </div>
                        <span class="badge-primary">{{ $member->role }}</span>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-400 text-sm">
                        Belum ada pengurus terdaftar.
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Contact Messages --}}
            <div class="card p-0 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 text-base dark:text-white">Pesan Masuk Terbaru</h3>
                    <a href="{{ route('dashboard.messages') }}" class="text-primary-750 text-sm font-medium hover:text-primary-900 transition-colors">Lihat Semua</a>
                </div>
                <div class="divide-y divide-gray-100/70 dark:divide-emerald-950/10">
                    @forelse($recentMessages as $msg)
                    <div class="flex items-start gap-4 px-6 py-4.5 hover:bg-gray-50/50 dark:hover:bg-[#101b15]/30 transition-colors">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <p class="font-medium text-gray-900 text-sm truncate dark:text-white">{{ $msg->name }}</p>
                                <span class="text-[10px] text-gray-400 shrink-0 font-normal">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-gray-500 truncate dark:text-gray-400 mt-0.5 font-medium">{{ Str::limit($msg->message, 80) }}</p>
                        </div>
                        @if(!$msg->is_read)
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded-full bg-emerald-500 text-white shrink-0">New</span>
                        @endif
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-400 text-sm">
                        Belum ada pesan masuk.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
