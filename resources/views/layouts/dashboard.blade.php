<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Lemdiklat Permapendis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
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
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain" onerror="this.style.display='none'">
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
                
                Beranda Dashboard
            </a>

            <a href="{{ route('dashboard.profile') }}"
               class="{{ request()->routeIs('dashboard.profile') ? 'sidebar-link-active' : 'sidebar-link' }}">
                
                Profil Saya
            </a>

            @if(auth()->user()->isAdmin())
            <div class="pt-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 py-2">Admin</p>
                <a href="{{ route('dashboard.articles') }}"
                   class="{{ request()->routeIs('dashboard.articles*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    
                    Kelola Artikel
                </a>
                <a href="{{ route('dashboard.settings') }}"
                   class="{{ request()->routeIs('dashboard.settings*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    
                    Pengaturan Tampilan
                </a>
                <a href="{{ route('dashboard.board-members') }}"
                   class="{{ request()->routeIs('dashboard.board-members*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    
                    Kelola Pengurus
                </a>
                @php
                    $pendingCount = \App\Models\User::where('is_activated', false)->count();
                @endphp
                <a href="{{ route('dashboard.approvals') }}"
                   class="flex items-center justify-between {{ request()->routeIs('dashboard.approvals*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span>Persetujuan Akun</span>
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
                
                Kembali ke Beranda
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-full text-red-500 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/30">
                    
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
                <button onclick="toggleTheme()" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors mr-1 dark:hover:bg-gray-800/50" aria-label="Toggle Theme">
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
