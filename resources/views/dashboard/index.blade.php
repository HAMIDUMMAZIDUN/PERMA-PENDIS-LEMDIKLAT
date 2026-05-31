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
                'label' => 'Persetujuan Tertunda', 
                'value' => $pendingApprovals, 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />',
                'color' => 'text-indigo-700 bg-indigo-50 dark:bg-indigo-950/20 dark:text-indigo-400'
            ],
            [
                'label' => 'Anggota Aktif', 
                'value' => $activeUsers, 
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                'color' => 'text-amber-700 bg-amber-50 dark:bg-amber-950/20 dark:text-amber-400'
            ],
        ] as $stat)
        <div class="dashboard-stat-card group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $stat['label'] }}</p>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $stat['color'] }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $stat['icon'] !!}
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">{{ $stat['value'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Main Sections Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Recent Articles --}}
        <div class="card p-0 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
                <h3 class="font-extrabold text-gray-900 text-lg dark:text-white">Artikel Terbaru</h3>
                <a href="{{ route('dashboard.articles') }}" class="text-primary-750 text-sm font-bold hover:text-primary-900 transition-colors">Lihat Semua</a>
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
                        <p class="font-bold text-gray-900 text-sm truncate dark:text-white">{{ $art->title }}</p>
                        <p class="text-xs text-gray-400 font-semibold mt-0.5">{{ $art->category?->name ?? 'Kategori Umum' }} • {{ $art->created_at->format('d M Y') }}</p>
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

        {{-- Registered Board Members --}}
        <div class="card p-0 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
                <h3 class="font-extrabold text-gray-900 text-lg dark:text-white">Pengurus Baru</h3>
                <a href="{{ route('dashboard.board-members') }}" class="text-primary-750 text-sm font-bold hover:text-primary-900 transition-colors">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100/70 dark:divide-emerald-950/10">
                @forelse($recentBoardMembers as $member)
                <div class="flex items-center gap-4 px-6 py-4.5 hover:bg-gray-50/50 dark:hover:bg-[#101b15]/30 transition-colors">
                    @if($member->photo)
                        <img src="{{ asset('uploads/board/' . $member->photo) }}" class="w-10 h-10 rounded-xl object-cover shrink-0" alt="{{ $member->name }}">
                    @else
                        <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/20 text-teal-700 dark:text-teal-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 text-sm truncate dark:text-white">{{ $member->name }}</p>
                        <p class="text-xs text-gray-400 font-semibold mt-0.5">{{ $member->category ?? 'Pengurus Lemdiklat' }}</p>
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
    </div>

    {{-- Pending User Registrations --}}
    <div class="card p-0 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex items-center justify-between">
            <h3 class="font-extrabold text-gray-900 text-lg dark:text-white">Persetujuan Akun Tertunda</h3>
            <a href="{{ route('dashboard.approvals') }}" class="text-primary-750 text-sm font-bold hover:text-primary-900 transition-colors">Lihat Semua Persetujuan</a>
        </div>
        <div class="p-6">
            @forelse($recentPendingUsers as $pendingUser)
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border border-gray-100 dark:border-emerald-950/30 rounded-2xl p-5 hover:shadow-md transition-shadow dark:bg-[#080d0b] mb-4 last:mb-0 gap-4">
                <div class="flex items-center gap-4">
                    @if($pendingUser->profile?->profile_picture)
                        <img src="{{ asset('uploads/profile-photos/' . $pendingUser->profile->profile_picture) }}" class="w-12 h-12 rounded-full object-cover" alt="Foto">
                    @else
                        <div class="w-12 h-12 rounded-full bg-primary-900 flex items-center justify-center text-white text-sm font-bold dark:bg-primary-750">
                            {{ $pendingUser->initials }}
                        </div>
                    @endif
                    <div>
                        <h4 class="font-extrabold text-gray-900 text-base dark:text-white leading-tight">{{ $pendingUser->display_name }}</h4>
                        <p class="text-xs text-gray-450 dark:text-gray-400 font-semibold mt-1">{{ $pendingUser->email }} • Role: {{ $pendingUser->role?->name ?? 'User' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 sm:self-center">
                    <form action="{{ route('dashboard.approvals.approve', $pendingUser->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-primary text-xs px-4 py-2 border-0 shadow-none">Setujui</button>
                    </form>
                    <form action="{{ route('dashboard.approvals.reject', $pendingUser->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-danger text-xs px-4 py-2 border-0 shadow-none">Tolak</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 text-center">
                <div class="w-16 h-16 rounded-full bg-teal-50 dark:bg-teal-950/20 text-teal-700 dark:text-teal-400 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h4 class="font-extrabold text-gray-900 dark:text-white text-base">Semua Akun Telah Diproses</h4>
                <p class="text-xs text-gray-400 mt-1">Tidak ada pendaftaran akun yang tertunda untuk persetujuan saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card p-8">
        <h3 class="font-extrabold text-gray-900 text-lg mb-6 dark:text-white">Aksi Cepat</h3>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                [
                    'label' => 'Tulis Artikel', 
                    'icon' => 'M12 4v16m8-8H4', 
                    'href' => route('dashboard.articles.create'), 
                    'style' => 'bg-gradient-to-r from-primary-900 to-primary-800 text-white hover:from-primary-800 hover:to-primary-700 shadow-md shadow-primary-900/10'
                ],
                [
                    'label' => 'Kelola Pengurus', 
                    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 
                    'href' => route('dashboard.board-members'), 
                    'style' => 'bg-white dark:bg-[#111e19]/60 border border-gray-150 dark:border-emerald-900/30 text-gray-700 dark:text-primary-300 hover:bg-gray-50 dark:hover:bg-primary-950/40'
                ],
                [
                    'label' => 'Atur Tampilan', 
                    'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z', 
                    'href' => route('dashboard.settings'), 
                    'style' => 'bg-white dark:bg-[#111e19]/60 border border-gray-150 dark:border-emerald-900/30 text-gray-700 dark:text-primary-300 hover:bg-gray-50 dark:hover:bg-primary-950/40'
                ],
                [
                    'label' => 'Persetujuan Akun', 
                    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 
                    'href' => route('dashboard.approvals'), 
                    'style' => 'bg-white dark:bg-[#111e19]/60 border border-gray-150 dark:border-emerald-900/30 text-gray-700 dark:text-primary-300 hover:bg-gray-50 dark:hover:bg-primary-950/40'
                ],
            ] as $action)
            <a href="{{ $action['href'] }}" class="flex flex-col items-center justify-center gap-2.5 h-24 rounded-2xl font-bold text-sm transition-all duration-350 active:scale-95 text-center p-3 {{ $action['style'] }}">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}" />
                </svg>
                {{ $action['label'] }}
            </a>
            @endforeach
        </div>
    </div>

</div>
@endsection
