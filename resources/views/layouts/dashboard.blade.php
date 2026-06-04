<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - PERMA PENDIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ \App\Models\Setting::get('app_logo', asset('img/logo.png')) }}" type="image/png">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
        if (localStorage.getItem('sidebar-collapsed') === 'true') {
            document.documentElement.classList.add('sidebar-collapsed')
        }
    </script>
    <style>
        @media (min-width: 1024px) {
            /* Sidebar minimize transition */
            #sidebar, #main-content {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            }
            /* Sidebar minimize styles */
            .sidebar-collapsed #sidebar {
                width: 5rem !important; /* w-20 */
            }
            .sidebar-collapsed #main-content {
                margin-left: 5rem !important; /* lg:ml-20 */
            }
            .sidebar-collapsed .sidebar-text,
            .sidebar-collapsed .sidebar-user-text,
            .sidebar-collapsed .sidebar-link-text,
            .sidebar-collapsed .sidebar-section-title,
            .sidebar-collapsed .sidebar-badge {
                display: none !important;
            }
            .sidebar-collapsed .sidebar-brand,
            .sidebar-collapsed .sidebar-user-container {
                justify-content: center !important;
                gap: 0 !important;
            }
            .sidebar-collapsed .sidebar-link,
            .sidebar-collapsed .sidebar-link-active,
            .sidebar-collapsed nav a,
            .sidebar-collapsed .border-t a,
            .sidebar-collapsed .border-t button {
                justify-content: center !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                gap: 0 !important;
            }
            .sidebar-collapsed #sidebar hr {
                margin-left: 0.5rem !important;
                margin-right: 0.5rem !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 antialiased dark:bg-gray-950 dark:text-gray-100 dark:bg-gray-800/40">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside id="sidebar" class="w-72 bg-white shadow-xl flex flex-col fixed h-full z-40 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out dark:bg-gray-900 dark:border-r dark:border-gray-800">
        {{-- Brand --}}
        <div class="p-5 border-b border-gray-100 dark:border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 sidebar-brand transition-all duration-300">
                <img src="{{ \App\Models\Setting::get('app_logo', asset('img/logo.png')) }}" alt="Logo" class="h-10 w-10 object-contain" onerror="this.style.display='none'">
                <div class="sidebar-text">
                    <p class="font-bold text-primary-900 text-sm leading-tight dark:text-white">PERMA PENDIS</p>
                    <p class="text-secondary-600 text-xs font-medium dark:text-secondary-400">Dashboard</p>
                </div>
            </a>
        </div>

        {{-- User Info --}}
        <div class="p-4 border-b border-gray-100 bg-gradient-to-r from-primary-50 to-emerald-50 dark:border-gray-800 dark:from-gray-800/40 dark:to-gray-900/40">
            <div class="flex items-center gap-3 sidebar-user-container transition-all duration-300">
                @php $user = auth()->user()->load('profile', 'role'); @endphp
                @if($user->profile?->profile_picture)
                    <img src="{{ asset('uploads/profile-photos/' . $user->profile->profile_picture) }}"
                         alt="Foto Profil" class="w-12 h-12 rounded-full object-cover border-2 border-primary-200 dark:border-primary-800">
                @else
                    <div class="w-12 h-12 rounded-full bg-primary-900 flex items-center justify-center text-white font-bold text-sm dark:bg-primary-750">
                        {{ $user->initials }}
                    </div>
                @endif
                <div class="min-w-0 sidebar-user-text">
                    <p class="font-medium text-gray-900 text-sm truncate dark:text-white">{{ $user->display_name }}</p>
                    <p class="text-xs text-gray-500 truncate dark:text-gray-400">{{ $user->role?->name ?? 'User' }}</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto p-3 space-y-1">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 py-2 sidebar-section-title">Menu Utama</p>

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') && !request()->routeIs('dashboard.*') ? 'sidebar-link-active' : 'sidebar-link' }}"
               title="Beranda Dashboard">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="sidebar-link-text">Beranda Dashboard</span>
            </a>

            <a href="{{ route('dashboard.profile') }}"
               class="{{ request()->routeIs('dashboard.profile') ? 'sidebar-link-active' : 'sidebar-link' }}"
               title="Profil Saya">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="sidebar-link-text">Profil Saya</span>
            </a>

            @if(auth()->user()->isAdmin())
            <div class="pt-2">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 py-2 sidebar-section-title">Admin</p>
                <a href="{{ route('dashboard.articles') }}"
                   class="{{ request()->routeIs('dashboard.articles*') ? 'sidebar-link-active' : 'sidebar-link' }}"
                   title="Kelola Artikel">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <span class="sidebar-link-text">Kelola Artikel</span>
                </a>
                <a href="{{ route('dashboard.board-members') }}"
                   class="{{ request()->routeIs('dashboard.board-members*') ? 'sidebar-link-active' : 'sidebar-link' }}"
                   title="Kelola Pengurus">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="sidebar-link-text">Kelola Pengurus</span>
                </a>
                <a href="{{ route('dashboard.members') }}"
                   class="{{ request()->routeIs('dashboard.members*') ? 'sidebar-link-active' : 'sidebar-link' }}"
                   title="Kelola Anggota">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="sidebar-link-text">Kelola Anggota</span>
                </a>
                @php
                    $unreadMessagesCount = \App\Models\ContactMessage::where('is_read', false)->count();
                @endphp
                <a href="{{ route('dashboard.messages') }}"
                   class="flex items-center justify-between {{ request()->routeIs('dashboard.messages*') ? 'sidebar-link-active' : 'sidebar-link' }}"
                   title="Pesan Masuk">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="sidebar-link-text">Pesan Masuk</span>
                    </div>
                    @if($unreadMessagesCount > 0)
                        <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-emerald-500 text-white dark:bg-emerald-600 animate-pulse sidebar-badge">
                            {{ $unreadMessagesCount }}
                        </span>
                    @endif
                </a>

                {{-- Konten Modul Baru --}}
                <div class="pt-1 mt-1 border-t border-gray-100 dark:border-gray-800">
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 py-2 sidebar-section-title">Konten & Media</p>
                    <a href="{{ route('dashboard.gallery') }}"
                       class="{{ request()->routeIs('dashboard.gallery*') ? 'sidebar-link-active' : 'sidebar-link' }}"
                       title="Galeri Kegiatan">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="sidebar-link-text">Galeri Kegiatan</span>
                    </a>
                    <a href="{{ route('dashboard.settings', ['tab' => 'gallery']) }}"
                       class="{{ request()->routeIs('dashboard.settings') && request()->query('tab') === 'gallery' ? 'sidebar-link-active' : 'sidebar-link' }}"
                       title="Galeri Video YouTube">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('dashboard.settings') && request()->query('tab') === 'gallery' ? 'text-white' : 'text-red-500' }} fill-current" viewBox="0 0 24 24">
                            <path d="M23.498 6.163c-.272-1.002-1.064-1.794-2.066-2.066C19.605 3.5 12 3.5 12 3.5s-7.605 0-9.432.597c-1.002.272-1.794 1.064-2.066 2.066C0 7.995 0 12 0 12s0 4.005.597 5.837c.272 1.002 1.064 1.794 2.066 2.066C4.395 20.5 12 20.5 12 20.5s7.605 0 9.432-.597c1.002-.272 1.794-1.064 2.066-2.066C24 16.005 24 12 24 12s0-4.005-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        <span class="sidebar-link-text">Galeri Video YouTube</span>
                    </a>
                    <a href="{{ route('dashboard.events') }}"
                       class="{{ request()->routeIs('dashboard.events*') ? 'sidebar-link-active' : 'sidebar-link' }}"
                       title="Agenda & Event">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="sidebar-link-text">Agenda & Event</span>
                    </a>
                    <a href="{{ route('dashboard.downloads') }}"
                       class="{{ request()->routeIs('dashboard.downloads*') ? 'sidebar-link-active' : 'sidebar-link' }}"
                       title="Download Center">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span class="sidebar-link-text">Download Center</span>
                    </a>
                    <a href="{{ route('dashboard.faqs') }}"
                       class="{{ request()->routeIs('dashboard.faqs*') ? 'sidebar-link-active' : 'sidebar-link' }}"
                       title="Kelola FAQ">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="sidebar-link-text">Kelola FAQ</span>
                    </a>
                </div>
            </div>

            <div class="pt-2">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 py-2 sidebar-section-title">Pengaturan Tampilan</p>
                
                {{-- Hero & Stats --}}
                <a href="{{ route('dashboard.settings', ['tab' => 'hero']) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('dashboard.settings') && request()->query('tab', 'hero') === 'hero' ? 'bg-primary-900 text-white dark:bg-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white dark:hover:text-gray-100' }}"
                   title="Hero & Statistik">
                    <span class="text-lg shrink-0">🏠</span>
                    <span class="sidebar-link-text">Hero & Statistik</span>
                </a>

                {{-- Logo & Background --}}
                <a href="{{ route('dashboard.settings', ['tab' => 'background']) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('dashboard.settings') && request()->query('tab') === 'background' ? 'bg-primary-900 text-white dark:bg-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white dark:hover:text-gray-100' }}"
                   title="Latar & Logo">
                    <span class="text-lg shrink-0">🎨</span>
                    <span class="sidebar-link-text">Latar & Logo</span>
                </a>


                {{-- About Us (Visi Misi) --}}
                <a href="{{ route('dashboard.settings', ['tab' => 'about']) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('dashboard.settings') && request()->query('tab') === 'about' ? 'bg-primary-900 text-white dark:bg-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white dark:hover:text-gray-100' }}"
                   title="Tentang Lembaga">
                    <span class="text-lg shrink-0">🏢</span>
                    <span class="sidebar-link-text">Tentang Lembaga</span>
                </a>

                {{-- Gallery / Documentation --}}
                <a href="{{ route('dashboard.settings', ['tab' => 'gallery']) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('dashboard.settings') && request()->query('tab') === 'gallery' ? 'bg-primary-900 text-white dark:bg-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white dark:hover:text-gray-100' }}"
                   title="Arsip Dokumentasi">
                    <span class="text-lg shrink-0">📸</span>
                    <span class="sidebar-link-text">Arsip Dokumentasi</span>
                </a>

                {{-- Contact --}}
                <a href="{{ route('dashboard.settings', ['tab' => 'contact']) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('dashboard.settings') && request()->query('tab') === 'contact' ? 'bg-primary-900 text-white dark:bg-primary-800' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white dark:hover:text-gray-100' }}"
                   title="Hubungi Kami">
                    <span class="text-lg shrink-0">📞</span>
                    <span class="sidebar-link-text">Hubungi Kami</span>
                </a>

            </div>
            @endif
        </nav>

        {{-- Bottom links --}}
        <div class="border-t border-gray-100 p-3 space-y-1 dark:border-gray-800">
            <a href="{{ route('home') }}" class="sidebar-link text-gray-500 dark:text-gray-400" title="Kembali ke Beranda">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="sidebar-link-text">Kembali ke Beranda</span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-full text-red-500 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/30" title="Keluar">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 01-3-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span class="sidebar-link-text">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div id="main-content" class="flex-1 flex flex-col lg:ml-72 transition-all duration-300 ease-in-out">
        {{-- Top Bar --}}
        <header class="bg-white shadow-sm z-30 px-6 py-4 flex items-center justify-between sticky top-0 dark:bg-gray-900 dark:border-b dark:border-gray-800 dark:shadow-none">
            <div class="flex items-center gap-3">
                <button id="sidebar-toggle" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:bg-gray-800/50">
                    ☰
                </button>
                <button id="desktop-sidebar-toggle" class="hidden lg:flex p-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:bg-gray-800/50 transition-colors" aria-label="Toggle Sidebar">
                    <svg id="collapse-icon-left" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                    <svg id="collapse-icon-right" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                    </svg>
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
    const desktopSidebarToggle = document.getElementById('desktop-sidebar-toggle');
    const collapseIconLeft = document.getElementById('collapse-icon-left');
    const collapseIconRight = document.getElementById('collapse-icon-right');

    function toggleDesktopSidebar() {
        if (document.documentElement.classList.contains('sidebar-collapsed')) {
            document.documentElement.classList.remove('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', 'false');
            collapseIconLeft?.classList.remove('hidden');
            collapseIconRight?.classList.add('hidden');
        } else {
            document.documentElement.classList.add('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', 'true');
            collapseIconLeft?.classList.add('hidden');
            collapseIconRight?.classList.remove('hidden');
        }
    }

    desktopSidebarToggle?.addEventListener('click', toggleDesktopSidebar);

    // Initial icon state on page load
    if (localStorage.getItem('sidebar-collapsed') === 'true') {
        collapseIconLeft?.classList.add('hidden');
        collapseIconRight?.classList.remove('hidden');
    }

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
