<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Lemdiklat Permapendis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ \App\Models\Setting::get('app_logo', asset('img/logo.png')) }}" type="image/png">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-gray-100 antialiased dark:bg-gray-950 dark:text-gray-100 dark:bg-gray-800/40">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside id="sidebar" class="w-72 bg-white shadow-xl flex flex-col fixed h-full z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out dark:bg-gray-900 dark:border-r dark:border-gray-800">
        {{-- Brand --}}
        <div class="p-5 border-b border-gray-100 dark:border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <img src="{{ \App\Models\Setting::get('app_logo', asset('img/logo.png')) }}" alt="Logo" class="h-10 w-10 object-contain" onerror="this.style.display='none'">
                <div>
                    <p class="font-bold text-primary-900 text-sm leading-tight dark:text-white">Lemdiklat</p>
                    <p class="text-secondary-600 text-xs font-medium dark:text-secondary-400">Permapendis</p>
                </div>
            </a>
        </div>

        {{-- User Info --}}
        <div class="p-4 border-b border-gray-100 bg-gradient-to-r from-primary-50 to-emerald-50 dark:border-gray-800 dark:from-gray-800/40 dark:to-gray-900/40">
            <div class="flex items-center gap-3">
                @php $user = auth()->user()->load('profile', 'role'); @endphp
                @if($user->profile?->profile_picture)
                    <img src="{{ asset('uploads/profile-photos/' . $user->profile->profile_picture) }}"
                         alt="Foto Profil" class="w-12 h-12 rounded-full object-cover border-2 border-primary-200 dark:border-primary-800">
                @else
                    <div class="w-12 h-12 rounded-full bg-primary-900 flex items-center justify-center text-white font-bold text-sm dark:bg-primary-750">
                        {{ $user->initials }}
                    </div>
                @endif
                <div class="min-w-0">
                    <p class="font-semibold text-gray-900 text-sm truncate dark:text-white">{{ $user->display_name }}</p>
                    <p class="text-xs text-gray-500 truncate dark:text-gray-400">{{ $user->role?->name ?? 'User' }}</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto p-3 space-y-1">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 py-2">Menu Utama</p>

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') && !request()->routeIs('dashboard.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Beranda Dashboard
            </a>

            <a href="{{ route('dashboard.profile') }}"
               class="{{ request()->routeIs('dashboard.profile') ? 'sidebar-link-active' : 'sidebar-link' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil Saya
            </a>

            @if(auth()->user()->isAdmin())
            <div class="pt-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 py-2">Admin</p>
                <a href="{{ route('dashboard.articles') }}"
                   class="{{ request()->routeIs('dashboard.articles*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Kelola Artikel
                </a>
                <a href="{{ route('dashboard.settings') }}"
                   class="{{ request()->routeIs('dashboard.settings*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan Tampilan
                </a>
                <a href="{{ route('dashboard.board-members') }}"
                   class="{{ request()->routeIs('dashboard.board-members*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Kelola Pengurus
                </a>
                @php
                    $pendingCount = \App\Models\User::where('is_activated', false)->count();
                @endphp
                <a href="{{ route('dashboard.approvals') }}"
                   class="flex items-center justify-between {{ request()->routeIs('dashboard.approvals*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Persetujuan Akun</span>
                    </div>
                    @if($pendingCount > 0)
                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-amber-500 text-white dark:bg-amber-600">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>
            </div>
            @endif
        </nav>

        {{-- Bottom links --}}
        <div class="border-t border-gray-100 p-3 space-y-1 dark:border-gray-800">
            <a href="{{ route('home') }}" class="sidebar-link text-gray-500 dark:text-gray-400">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-full text-red-500 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/30">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 01-3-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col lg:ml-72">
        {{-- Top Bar --}}
        <header class="bg-white shadow-sm z-30 px-6 py-4 flex items-center justify-between sticky top-0 dark:bg-gray-900 dark:border-b dark:border-gray-800 dark:shadow-none">
            <div class="flex items-center gap-3">
                <button id="sidebar-toggle" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:bg-gray-800/50">
                    ☰
                </button>
                <div>
                    <h1 class="font-bold text-gray-900 text-lg dark:text-white">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">@yield('page-subtitle', 'Selamat datang kembali!')</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="toggleTheme()" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors mr-1 dark:hover:bg-gray-800/50 text-lg" aria-label="Toggle Theme">
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:block">☀️</span>
                </button>
                <a href="{{ route('dashboard.profile') }}" class="flex items-center gap-2 hover:opacity-80 transition">
                    @if(auth()->user()->profile?->profile_picture)
                        <img src="{{ asset('uploads/profile-photos/' . auth()->user()->profile->profile_picture) }}"
                             class="w-9 h-9 rounded-full object-cover" alt="Foto Profil">
                    @else
                        <div class="w-9 h-9 rounded-full bg-primary-900 flex items-center justify-center text-white text-xs font-bold dark:bg-primary-750">
                            {{ auth()->user()->initials }}
                        </div>
                    @endif
                    <span class="hidden sm:block text-sm font-medium text-gray-700 dark:text-gray-300">{{ auth()->user()->display_name }}</span>
                </a>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mx-6 mt-4 alert-success flex items-center justify-between" id="flash-success">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-4 hover:opacity-70">×</button>
        </div>
        @endif
        @if(session('error'))
        <div class="mx-6 mt-4 alert-error flex items-center justify-between" id="flash-error">
            <span>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-4 hover:opacity-70">×</button>
        </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

{{-- Sidebar overlay for mobile --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-30 lg:hidden hidden"><!-- overlay --></div>

<script>
    // Theme toggle function
    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    }

    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    }
    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }

    sidebarToggle?.addEventListener('click', openSidebar);
    overlay?.addEventListener('click', closeSidebar);

    // Auto dismiss flash
    setTimeout(() => {
        document.getElementById('flash-success')?.remove();
        document.getElementById('flash-error')?.remove();
    }, 5000);
</script>
</body>
</html>
