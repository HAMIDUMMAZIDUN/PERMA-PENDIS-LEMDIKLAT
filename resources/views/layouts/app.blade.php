<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PERMA PENDIS') - Perkumpulan Manajer Pendidikan Islam Indonesia</title>
    <meta name="description" content="@yield('description', 'Perkumpulan Manajer Pendidikan Islam Indonesia - Wadah berdedikasi untuk meningkatkan kompetensi manajer dan tenaga pendidik Islam di Indonesia.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ \App\Models\Setting::get('app_logo', asset('img/logo.png')) }}" type="image/png">
    <style>
        /* White navbar theme classes */
        #main-header.is-transparent-white .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            background-color: transparent !important;
            border-color: transparent !important;
        }
        #main-header.is-transparent-white .nav-link:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        #main-header.is-transparent-white .nav-link-active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.25) !important;
        }
        #main-header.is-transparent-white .navbar-logo {
            color: #ffffff !important;
        }
        #main-header.is-transparent-white .navbar-logo span {
            color: #ffffff !important;
        }
        #main-header.is-transparent-white button {
            color: rgba(255, 255, 255, 0.85) !important;
        }
        #main-header.is-transparent-white button:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        #main-header.is-transparent-white #mobile-menu-btn {
            color: #ffffff !important;
        }
    </style>
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
<header id="main-header" class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm dark:border-gray-800 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="navbar-logo flex items-center gap-2.5 font-bold text-primary-900 hover:opacity-90 transition-opacity">
                <img src="{{ \App\Models\Setting::get('app_logo', asset('img/logo.png')) }}" alt="Logo PERMA PENDIS" class="h-10 w-10 object-contain" onerror="this.style.display='none'">
                <div class="flex flex-col text-left">
                    <span class="text-xs sm:text-sm font-bold text-emerald-600 dark:text-emerald-400 leading-tight uppercase tracking-wide">PERMA PENDIS</span>
                    <span class="text-[9px] text-gray-500 font-medium leading-none tracking-tight dark:text-gray-400">Perkumpulan Manajer Pendidikan Islam</span>
                    <span class="text-[8px] text-gray-400 font-bold leading-none tracking-wider dark:text-gray-500 uppercase">Indonesia</span>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-1" id="main-nav">
                <a href="{{ request()->routeIs('home') ? '#hero' : route('home') . '#hero' }}" class="{{ request()->routeIs('home') ? 'nav-link-active' : 'nav-link' }}" data-section="hero">Beranda</a>
                <a href="{{ request()->routeIs('home') ? '#articles' : route('articles') }}" class="{{ request()->routeIs('articles*') ? 'nav-link-active' : 'nav-link' }}" data-section="articles">Artikel</a>
                <a href="{{ request()->routeIs('home') ? '#gallery' : route('gallery') }}" class="{{ request()->routeIs('gallery*') ? 'nav-link-active' : 'nav-link' }}" data-section="gallery">Galeri</a>
                <a href="{{ request()->routeIs('home') ? '#events' : route('events') }}" class="{{ request()->routeIs('events*') ? 'nav-link-active' : 'nav-link' }}" data-section="events">Agenda</a>
                <a href="{{ request()->routeIs('home') ? '#downloads' : route('downloads') }}" class="{{ request()->routeIs('downloads*') ? 'nav-link-active' : 'nav-link' }}" data-section="downloads">Download</a>
                <a href="{{ route('members') }}" class="{{ request()->routeIs('members*') ? 'nav-link-active' : 'nav-link' }}">Anggota</a>
                <a href="{{ request()->routeIs('home') ? '#about' : route('about') }}" class="{{ request()->routeIs('about') ? 'nav-link-active' : 'nav-link' }}" data-section="about">Tentang</a>
                <a href="{{ request()->routeIs('home') ? '#contact' : route('contact') }}" class="{{ request()->routeIs('contact') ? 'nav-link-active' : 'nav-link' }}" data-section="contact">Kontak</a>
            </nav>
            
            {{-- Auth Buttons & Theme Toggle --}}
            <div class="hidden lg:flex items-center gap-2">
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
                    <a href="{{ route('login') }}" class="btn-primary py-2 px-4 text-sm">Masuk</a>
                @endauth
            </div>

            {{-- Mobile Buttons --}}
            <div class="flex items-center gap-2 lg:hidden">
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
    <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-200 bg-white dark:bg-gray-900 dark:border-gray-800">
        <nav class="px-4 py-3 space-y-1" id="mobile-nav">
            <a href="{{ request()->routeIs('home') ? '#hero' : route('home') . '#hero' }}" class="{{ request()->routeIs('home') ? 'sidebar-link-active' : 'sidebar-link' }}" data-section="hero">Beranda</a>
            <a href="{{ request()->routeIs('home') ? '#articles' : route('articles') }}" class="{{ request()->routeIs('articles*') ? 'sidebar-link-active' : 'sidebar-link' }}" data-section="articles">Artikel</a>
            <a href="{{ request()->routeIs('home') ? '#gallery' : route('gallery') }}" class="{{ request()->routeIs('gallery*') ? 'sidebar-link-active' : 'sidebar-link' }}" data-section="gallery">Galeri</a>
            <a href="{{ request()->routeIs('home') ? '#events' : route('events') }}" class="{{ request()->routeIs('events*') ? 'sidebar-link-active' : 'sidebar-link' }}" data-section="events">Agenda</a>
            <a href="{{ request()->routeIs('home') ? '#downloads' : route('downloads') }}" class="{{ request()->routeIs('downloads*') ? 'sidebar-link-active' : 'sidebar-link' }}" data-section="downloads">Download</a>
            <a href="{{ route('members') }}" class="{{ request()->routeIs('members*') ? 'sidebar-link-active' : 'sidebar-link' }}">Anggota</a>
            <a href="{{ request()->routeIs('home') ? '#about' : route('about') }}" class="{{ request()->routeIs('about') ? 'sidebar-link-active' : 'sidebar-link' }}" data-section="about">Tentang</a>
            <a href="{{ request()->routeIs('home') ? '#contact' : route('contact') }}" class="{{ request()->routeIs('contact') ? 'sidebar-link-active' : 'sidebar-link' }}" data-section="contact">Kontak</a>
            <div class="pt-2 border-t border-gray-200 flex gap-2 dark:border-gray-800">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary py-2 px-4 text-sm w-full justify-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary py-2 px-4 text-sm w-full justify-center">Masuk</a>
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
                <h3 class="text-white font-bold text-lg mb-3">PERMA PENDIS</h3>
                <p class="text-sm leading-relaxed text-gray-400">Perkumpulan Manajer Pendidikan Islam (Perma Pendis) Indonesia sebagai wadah profesional berperan dalam pengembangan dan penguatan manajer pendidikan Islam di seluruh Indonesia melalui pembinaan kompetensi, penegakan etika profesi, dan peningkatan standar layanan manajemen pendidikan Islam. Organisasi ini juga berkontribusi dalam memperkuat tata kelola lembaga pendidikan Islam yang bermutu, akuntabel, dan berdaya saing melalui pelatihan, pendampingan,
serta pengembangan praktik manajemen yang profesional. Selain itu, Perkumpulan Manajer Pendidikan Indonesia berperan sebagai mitra strategis pemerintah dan pemangku kepentingan dalam perumusan kebijakan, advokasi profesi, serta peningkatan kualitas sumber daya manusia pendidikan Islam, sekaligus mendorong kepedulian sosial dan pengabdian kepada masyarakat di bidang pendidikan Islam.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-3">Navigasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('articles') }}" class="hover:text-white transition-colors">Artikel & Berita</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-white transition-colors">Galeri Kegiatan</a></li>
                    <li><a href="{{ route('events') }}" class="hover:text-white transition-colors">Agenda & Kalender</a></li>
                    <li><a href="{{ route('downloads') }}" class="hover:text-white transition-colors">Download Center</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-3">Kontak</h4>
                <address class="text-sm not-italic text-gray-400 space-y-2">
                    <p>Jl. Gedebage Selatan No.137, Kel. Cisaranteun Kidul, Kec. Gedebage, Kota Bandung 40295</p>
                    <p><a href="mailto:lspmanajemenpendidikanislam@gmail.com " class="hover:text-white transition-colors">lspmanajemenpendidikanislam@gmail.com </a></p>
                </address>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-xs text-gray-500 dark:text-gray-400">
            <p>&copy; {{ date('Y') }} PERMA PENDIS. Semua hak cipta dilindungi.</p>
        </div>
    </div>
</footer>

{{-- WhatsApp Floating Helpdesk Button --}}
@php
    $waPhone = \App\Models\Setting::get('contact_phone', '6281234567890');
    $waPhone = preg_replace('/[^0-9]/', '', $waPhone);
    if (str_starts_with($waPhone, '0')) $waPhone = '62' . substr($waPhone, 1);
@endphp
<a href="https://wa.me/{{ $waPhone }}?text=Halo+PERMA+PENDIS,+saya+ingin+bertanya..."
   target="_blank" rel="noopener"
   id="wa-float"
   class="fixed bottom-6 right-6 z-50 flex items-center gap-2.5 bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 group"
   aria-label="Chat WhatsApp">
    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
    <span class="text-sm font-semibold max-w-0 overflow-hidden group-hover:max-w-xs transition-all duration-300 whitespace-nowrap">Hubungi Kami</span>
</a>

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

    // Smooth scrolling and scroll spy for single-page app behavior on homepage
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('main-header');
        const isHome = window.location.pathname === '/' || window.location.pathname === '/index.php' || window.location.pathname === '';

        if (isHome && header) {
            function handleScroll() {
                if (window.scrollY > 50) {
                    header.classList.remove('absolute', 'w-full', 'bg-transparent', 'border-transparent', 'shadow-none', 'dark:border-transparent', 'is-transparent-white');
                    header.classList.add('sticky', 'bg-white/90', 'backdrop-blur-md', 'border-b', 'border-gray-200', 'shadow-sm', 'dark:bg-gray-950/90', 'dark:border-gray-800');
                } else {
                    header.classList.remove('sticky', 'bg-white/90', 'backdrop-blur-md', 'border-b', 'border-gray-200', 'shadow-sm', 'dark:bg-gray-950/90', 'dark:border-gray-800');
                    header.classList.add('absolute', 'w-full', 'bg-transparent', 'border-transparent', 'shadow-none', 'dark:border-transparent', 'is-transparent-white');
                }
            }
            handleScroll();
            window.addEventListener('scroll', handleScroll);
        }

        const desktopLinks = document.querySelectorAll('#main-nav a[data-section]');
        const mobileLinks = document.querySelectorAll('#mobile-nav a[data-section]');
        const sections = document.querySelectorAll('section[id]');

        // Update active class helper
        function updateActiveLink(sectionId) {
            desktopLinks.forEach(link => {
                if (link.getAttribute('data-section') === sectionId) {
                    link.classList.add('nav-link-active');
                    link.classList.remove('nav-link');
                } else {
                    link.classList.remove('nav-link-active');
                    link.classList.add('nav-link');
                }
            });

            mobileLinks.forEach(link => {
                if (link.getAttribute('data-section') === sectionId) {
                    link.classList.add('sidebar-link-active');
                    link.classList.remove('sidebar-link');
                } else {
                    link.classList.remove('sidebar-link-active');
                    link.classList.add('sidebar-link');
                }
            });
        }

        // Only run Scroll Spy on home page
        if (window.location.pathname === '/' || window.location.pathname === '/index.php') {
            // Scroll spy
            window.addEventListener('scroll', function() {
                let currentSection = 'hero';
                const scrollPosition = window.scrollY + 200;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;

                    if (scrollPosition >= sectionTop && scrollPosition < (sectionTop + sectionHeight)) {
                        currentSection = section.getAttribute('id');
                    }
                });

                if (['hero', 'about', 'articles', 'gallery', 'events', 'downloads', 'contact'].includes(currentSection)) {
                    updateActiveLink(currentSection);
                }
            });

            // Smooth scroll click handler
            const allLinks = [...desktopLinks, ...mobileLinks];
            allLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    const hashIndex = href.indexOf('#');
                    if (hashIndex !== -1) {
                        const targetId = href.substring(hashIndex + 1);
                        const targetSection = document.getElementById(targetId);
                        if (targetSection) {
                            e.preventDefault();
                            // Close mobile menu if open
                            document.getElementById('mobile-menu')?.classList.add('hidden');
                            
                            window.scrollTo({
                                top: targetSection.offsetTop - 70, // navbar height offset
                                behavior: 'smooth'
                            });
                            // Update hash in URL
                            window.history.pushState(null, null, '#' + targetId);
                        }
                    }
                });
            });

            // Handle initial hash on page load
            if (window.location.hash) {
                const targetId = window.location.hash.substring(1);
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    setTimeout(() => {
                        window.scrollTo({
                            top: targetSection.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }, 300);
                }
            }
        }
    });
</script>
</body>
</html>
