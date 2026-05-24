<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Lemdiklat Permapendis') - Lembaga Pendidikan dan Pelatihan</title>
    <meta name="description" content="@yield('description', 'Lembaga Pendidikan dan Pelatihan Permapendis - Pusat pelatihan yang berdedikasi untuk meningkatkan kompetensi tenaga pendidik dan kependidikan di Indonesia.')">
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
<body class="bg-gray-50 text-gray-900 antialiased dark:bg-gray-950 dark:text-gray-100 dark:bg-gray-800 dark:text-white">

{{-- Navbar --}}
<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-bold text-primary-900 hover:opacity-90 transition-opacity">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Lemdiklat" class="h-10 w-10 object-contain" onerror="this.style.display='none'">
                <span class="text-sm sm:text-base leading-tight">Lemdiklat<br><span class="text-secondary-600 font-normal">Permapendis</span></span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'nav-link-active' : 'nav-link' }}">
                    
                    Beranda
                </a>
                <a href="{{ route('articles') }}" class="{{ request()->routeIs('articles*') ? 'nav-link-active' : 'nav-link' }}">
                    
                    Artikel
                </a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'nav-link-active' : 'nav-link' }}">
                    
                    Tentang
                </a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'nav-link-active' : 'nav-link' }}">
                    
                    Kontak
                </a>
            </nav>

            {{-- Auth Buttons & Theme Toggle --}}
            <div class="hidden md:flex items-center gap-2">
                <button onclick="toggleTheme()" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors mr-1 dark:hover:bg-gray-800/50" aria-label="Toggle Theme">
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:block">☀️</span>
                </button>
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        
                        Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-red-600 hover:bg-red-50">
                            
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary py-2 px-4 text-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary py-2 px-4 text-sm">Daftar</a>
                @endauth
            </div>

            {{-- Mobile Buttons --}}
            <div class="flex items-center gap-2 md:hidden">
                <button onclick="toggleTheme()" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors dark:hover:bg-gray-800/50" aria-label="Toggle Theme">
                    <span class="dark:hidden">🌙</span>
                    <span class="hidden dark:block">☀️</span>
                </button>
                <button id="mobile-menu-btn" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800/50">
                    ☰
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 bg-white dark:bg-gray-900 dark:border-gray-800">
        <nav class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'sidebar-link-active' : 'sidebar-link' }}">Beranda</a>
            <a href="{{ route('articles') }}" class="{{ request()->routeIs('articles*') ? 'sidebar-link-active' : 'sidebar-link' }}">Artikel</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'sidebar-link-active' : 'sidebar-link' }}">Tentang</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'sidebar-link-active' : 'sidebar-link' }}">Kontak</a>
            <div class="pt-2 border-t border-gray-200 flex gap-2 dark:border-gray-800">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary py-2 px-4 text-sm w-full justify-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary py-2 px-4 text-sm flex-1 justify-center">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary py-2 px-4 text-sm flex-1 justify-center">Daftar</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

{{-- Flash Messages --}}
@if(session('success'))
<div class="fixed top-20 right-4 z-50 alert-success shadow-lg animate-slide-in max-w-sm" id="flash-msg">
    <div class="flex items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button onclick="document.getElementById('flash-msg').remove()" class="text-current hover:opacity-70">×</button>
    </div>
</div>
@endif
@if(session('error'))
<div class="fixed top-20 right-4 z-50 alert-error shadow-lg animate-slide-in max-w-sm" id="flash-msg-err">
    <div class="flex items-center justify-between gap-3">
        <span class="text-sm font-medium">{{ session('error') }}</span>
        <button onclick="document.getElementById('flash-msg-err').remove()" class="text-current hover:opacity-70">×</button>
    </div>
</div>
@endif

{{-- Main Content --}}
<main>
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-gray-900 text-gray-300 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <h3 class="text-white font-bold text-lg mb-3">Lemdiklat Permapendis</h3>
                <p class="text-sm leading-relaxed text-gray-400">Lembaga Pendidikan dan Pelatihan yang berdedikasi untuk meningkatkan kompetensi tenaga pendidik dan kependidikan di Indonesia.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Navigasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('articles') }}" class="hover:text-white transition-colors">Artikel</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Kontak</h4>
                <address class="text-sm not-italic text-gray-400 space-y-2">
                    <p>Jl. Gedebage Selatan No.137, Kel. Cisaranteun Kidul, Kec. Gedebage, Kota Bandung 40295</p>
                    <p><a href="mailto:info@lemdiklat-permapendis.com" class="hover:text-white transition-colors">info@lemdiklat-permapendis.com</a></p>
                </address>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-xs text-gray-500 dark:text-gray-400">
            <p>&copy; {{ date('Y') }} Lemdiklat Permapendis. Semua hak cipta dilindungi.</p>
        </div>
    </div>
</footer>

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

    // Mobile menu toggle
    document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
    // Auto dismiss flash messages
    setTimeout(() => {
        document.getElementById('flash-msg')?.remove();
        document.getElementById('flash-msg-err')?.remove();
    }, 5000);
</script>
</body>
</html>
