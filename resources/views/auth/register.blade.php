<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - PERMA PENDIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Google Font for Premium Typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Theme detection --}}
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .grid-pattern {
            background-image: radial-gradient(rgba(16, 185, 129, 0.07) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .dark .grid-pattern {
            background-image: radial-gradient(rgba(16, 185, 129, 0.15) 1px, transparent 1px);
        }
        .bg-glow-1 {
            filter: blur(120px);
            background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, rgba(20, 184, 166, 0.04) 50%, transparent 100%);
        }
        .bg-glow-2 {
            filter: blur(120px);
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, rgba(99, 102, 241, 0.03) 50%, transparent 100%);
        }
        .method-tab-active {
            background-color: #10b981;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
        }
        .dark .method-tab-active {
            background-color: #059669;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50 dark:bg-slate-950 flex flex-col items-center justify-center p-4 md:p-8 relative overflow-x-hidden transition-colors duration-300">

    {{-- Decorative backgrounds --}}
    <div class="absolute inset-0 grid-pattern pointer-events-none opacity-60"></div>
    <div class="absolute top-10 left-10 w-96 h-96 bg-glow-1 rounded-full pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-glow-2 rounded-full pointer-events-none"></div>

    <div class="w-full max-w-xl z-10 my-8 animate-slide-up">
        
        {{-- Card Container --}}
        <div class="bg-white dark:bg-slate-900/70 backdrop-blur-xl rounded-3xl border border-slate-200/50 dark:border-white/5 shadow-xl shadow-slate-100/40 dark:shadow-none overflow-hidden">
            
            {{-- Header (Premium Gradient Banner) --}}
            <div class="bg-slate-900 dark:bg-slate-950 px-8 py-5 text-center relative overflow-hidden border-b border-slate-800">
                <div class="absolute -top-24 -left-24 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
                
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 mb-2">
                    <img src="{{ \App\Models\Setting::get('app_logo', asset('img/logo.png')) }}" alt="Logo" class="h-8 w-8 object-contain" onerror="this.style.display='none'">
                </a>
                <h1 class="text-xl font-extrabold text-white tracking-tight">Buat Akun Baru</h1>
                <p class="text-[11px] text-slate-400 mt-0.5">Lengkapi data Anda untuk mendaftar ke sistem PERMA PENDIS</p>
            </div>

            {{-- Body Content --}}
            <div class="p-8">
                @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-700 dark:text-red-300 rounded-2xl text-xs font-semibold space-y-1">
                    <p class="font-bold text-[13px] mb-1.5 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span>Terdapat kesalahan pengisian data:</span>
                    </p>
                    <ul class="list-disc list-inside space-y-0.5 pl-1.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Method Switcher Tabs --}}
                <div class="flex p-1 bg-slate-100 dark:bg-slate-900 rounded-xl mb-5 border border-slate-200/20 dark:border-white/5">
                    <button type="button" id="tab-pass" onclick="switchMethod('pass')" class="flex-1 py-2 text-xs font-bold rounded-lg transition duration-300 method-tab-active">
                        Username & Password
                    </button>
                    <button type="button" id="tab-google" onclick="switchMethod('google')" class="flex-1 py-2 text-xs font-bold rounded-lg text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-white transition duration-300">
                        Google SSO
                    </button>
                </div>

                {{-- 1. Standard Password Form --}}
                <form id="form-password" action="{{ route('register.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2 space-y-1">
                            <label for="name" class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </span>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                       class="w-full pl-9 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-900 dark:text-white rounded-xl outline-none placeholder:text-slate-400 text-xs font-medium transition-all shadow-sm"
                                       placeholder="Masukkan nama lengkap">
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-1">
                            <label for="email" class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                       class="w-full pl-9 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-900 dark:text-white rounded-xl outline-none placeholder:text-slate-400 text-xs font-medium transition-all shadow-sm"
                                       placeholder="nama@example.com">
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-1">
                            <label for="username" class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Username</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </span>
                                <input id="username" name="username" type="text" value="{{ old('username') }}" required
                                       class="w-full pl-9 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-900 dark:text-white rounded-xl outline-none placeholder:text-slate-400 text-xs font-medium transition-all shadow-sm"
                                       placeholder="Pilih username" pattern="[a-zA-Z0-9_-]+">
                            </div>
                            <p class="text-[9px] text-slate-450 dark:text-slate-500 mt-1 font-semibold pl-2 leading-none">Hanya huruf, angka, underscore, dan strip (minimal 3 karakter).</p>
                        </div>

                        <div class="space-y-1">
                            <label for="password" class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </span>
                                <input id="password" name="password" type="password" required
                                       class="w-full pl-9 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-900 dark:text-white rounded-xl outline-none placeholder:text-slate-400 text-xs font-medium transition-all shadow-sm"
                                       placeholder="Min. 6 karakter">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label for="password_confirmation" class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Konfirmasi Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </span>
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                       class="w-full pl-9 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-slate-900 dark:text-white rounded-xl outline-none placeholder:text-slate-400 text-xs font-medium transition-all shadow-sm"
                                       placeholder="Ulangi password">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold rounded-xl shadow-md shadow-emerald-500/10 hover:shadow-emerald-500/20 hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 text-center flex items-center justify-center gap-1.5 text-xs mt-4">
                        <span>Kirim Pendaftaran</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </form>

                {{-- 2. Google SSO Block --}}
                <div id="block-google" class="hidden space-y-4 text-center py-4">
                    <div class="w-12 h-12 mx-auto bg-slate-50 dark:bg-slate-900 rounded-xl flex items-center justify-center border border-slate-200/50 dark:border-white/5 shadow-md">
                        <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 dark:text-white text-sm">Pendaftaran Google SSO</h3>
                        <p class="text-xs text-slate-450 dark:text-slate-400 mt-1 max-w-xs mx-auto leading-relaxed">Daftar secara instan menggunakan Akun Google Anda tanpa perlu membuat kata sandi secara manual.</p>
                    </div>

                    <button type="button" onclick="openGoogleModal()" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-white font-bold rounded-xl border border-slate-200 dark:border-slate-850 shadow-sm transition transform active:scale-98 text-[11px]">
                        <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="currentColor" d="M12.24 10.285V14.4h6.887c-.648 2.41-2.519 4.114-5.136 4.114A5.89 5.89 0 0 1 8 12.629a5.89 5.89 0 0 1 5.99-5.89c1.62 0 3.085.57 4.24 1.62l3.19-3.19C19.497 3.38 16.943 2 13.99 2C8.473 2 4 6.473 4 12c0 5.527 4.473 10 9.99 10c5.753 0 10.01-4.045 10.01-10c0-.685-.06-1.343-.162-1.715H12.24z"/></svg>
                        <span>Daftar Akun dengan Google</span>
                    </button>
                </div>

                {{-- Footer Info --}}
                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center text-xs space-y-3">
                    <p class="text-slate-500 dark:text-slate-400">
                        Sudah memiliki akun? 
                        <a href="{{ route('login') }}" class="text-emerald-600 dark:text-emerald-400 font-bold hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                    <p>
                        <a href="{{ route('home') }}" class="text-slate-400 hover:text-slate-600 dark:hover:text-white font-semibold transition inline-flex items-center gap-1">
                            ← Kembali ke Beranda
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Copyright --}}
    <div class="text-[10px] text-slate-400 dark:text-slate-500 text-center pb-6 z-10">
        &copy; {{ date('Y') }} PERMA PENDIS. Hak Cipta Dilindungi.
    </div>

{{-- Google SSO Mock Modal --}}
<div id="google-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center px-4 hidden">
    <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-gray-100 transform scale-95 transition-all duration-300">
        {{-- Header --}}
        <div class="flex flex-col items-center text-center pb-4 border-b border-gray-100">
            <svg class="w-8 h-8 text-blue-500 mb-2" viewBox="0 0 24 24"><path fill="currentColor" d="M12.24 10.285V14.4h6.887c-.648 2.41-2.519 4.114-5.136 4.114A5.89 5.89 0 0 1 8 12.629a5.89 5.89 0 0 1 5.99-5.89c1.62 0 3.085.57 4.24 1.62l3.19-3.19C19.497 3.38 16.943 2 13.99 2C8.473 2 4 6.473 4 12c0 5.527 4.473 10 9.99 10c5.753 0 10.01-4.045 10.01-10c0-.685-.06-1.343-.162-1.715H12.24z"/></svg>
            <h4 class="font-bold text-gray-800 text-base">Masuk dengan Google</h4>
            <p class="text-xs text-gray-400 mt-0.5">Pilih akun untuk melanjutkan</p>
        </div>

        {{-- Loading Overlay --}}
        <div id="google-loading" class="flex flex-col items-center justify-center py-10 hidden">
            <div class="w-8 h-8 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-xs font-semibold text-gray-500 mt-3 animate-pulse">Menghubungkan dengan Google...</p>
        </div>

        {{-- Accounts List --}}
        <div id="google-accounts" class="divide-y divide-gray-50 pt-2">
            <button onclick="selectGoogleAccount('Hamidun', 'hamidun.dev@gmail.com')" class="w-full flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition text-left">
                <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm">H</div>
                <div>
                    <p class="text-xs font-bold text-gray-800">Hamidun</p>
                    <p class="text-[10px] text-gray-400">hamidun.dev@gmail.com</p>
                </div>
            </button>
            <button onclick="selectGoogleAccount('PERMA PENDIS', 'permapendis@gmail.com')" class="w-full flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition text-left">
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">L</div>
                <div>
                    <p class="text-xs font-bold text-gray-800">PERMA PENDIS</p>
                    <p class="text-[10px] text-gray-400">permapendis@gmail.com</p>
                </div>
            </button>
            <button onclick="selectGoogleAccount('Ahmad Fauzi', 'ahmad.fauzi@gmail.com')" class="w-full flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition text-left">
                <div class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center font-bold text-sm">A</div>
                <div>
                    <p class="text-xs font-bold text-gray-800">Ahmad Fauzi</p>
                    <p class="text-[10px] text-gray-400">ahmad.fauzi@gmail.com</p>
                </div>
            </button>
            
            <div class="pt-3 pb-1">
                <button onclick="closeGoogleModal()" class="w-full py-2 text-center text-xs font-bold text-gray-500 hover:text-gray-700 bg-slate-50 hover:bg-slate-100 rounded-xl transition">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Hidden Form for posting Google SSO details --}}
<form id="form-google" action="{{ route('register.google') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="name" id="google-input-name">
    <input type="hidden" name="email" id="google-input-email">
</form>

<script>
    function switchMethod(method) {
        const tabPass = document.getElementById('tab-pass');
        const tabGoogle = document.getElementById('tab-google');
        const formPassword = document.getElementById('form-password');
        const blockGoogle = document.getElementById('block-google');

        if (method === 'pass') {
            tabPass.classList.add('method-tab-active', 'text-white');
            tabPass.classList.remove('text-slate-500', 'dark:text-slate-400');
            tabGoogle.classList.remove('method-tab-active', 'text-white');
            tabGoogle.classList.add('text-slate-500', 'dark:text-slate-400');
            formPassword.classList.remove('hidden');
            blockGoogle.classList.add('hidden');
        } else {
            tabGoogle.classList.add('method-tab-active', 'text-white');
            tabGoogle.classList.remove('text-slate-500', 'dark:text-slate-400');
            tabPass.classList.remove('method-tab-active', 'text-white');
            tabPass.classList.add('text-slate-500', 'dark:text-slate-400');
            formPassword.classList.add('hidden');
            blockGoogle.classList.remove('hidden');
        }
    }

    function openGoogleModal() {
        const modal = document.getElementById('google-modal');
        modal.classList.remove('hidden');
    }

    function closeGoogleModal() {
        const modal = document.getElementById('google-modal');
        modal.classList.add('hidden');
    }

    function selectGoogleAccount(name, email) {
        // Show loading spinner
        document.getElementById('google-accounts').classList.add('hidden');
        document.getElementById('google-loading').classList.remove('hidden');

        setTimeout(() => {
            // Set input values
            document.getElementById('google-input-name').value = name;
            document.getElementById('google-input-email').value = email;

            // Submit Google Form
            document.getElementById('form-google').submit();
        }, 1000);
    }
</script>

</body>
</html>
