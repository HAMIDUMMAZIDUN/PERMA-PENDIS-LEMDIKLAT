<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Lemdiklat Permapendis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Theme detection to prevent flash of unstyled content --}}
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="min-h-screen bg-slate-50 dark:bg-slate-950 flex flex-col md:flex-row w-full overflow-x-hidden transition-colors duration-300">

    {{-- Left Side: Brand Panel --}}
    <div class="w-full md:w-5/12 bg-white dark:bg-[#0b0f19] flex flex-col justify-between p-8 md:p-12 border-b md:border-b-0 md:border-r border-slate-200/60 dark:border-white/5">
        {{-- Spacer --}}
        <div class="hidden md:block"></div>
        
        {{-- Brand Info --}}
        <div class="flex flex-col items-center justify-center text-center my-auto py-8 md:py-0 animate-slide-up">
            <a href="{{ route('home') }}" class="group flex flex-col items-center gap-5 transition-transform hover:scale-102 duration-300">
                {{-- Beautiful Glassmorphic Logo Ring --}}
                <div class="w-24 h-24 rounded-full bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center shadow-inner p-4 border border-emerald-100/50 dark:border-emerald-900/30">
                    <img src="{{ \App\Models\Setting::get('app_logo', asset('img/logo.png')) }}" alt="Logo" class="w-full h-full object-contain" onerror="this.style.display='none'">
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-black tracking-wider text-slate-800 dark:text-white uppercase leading-tight">
                        LEMDIKLAT<br>
                        <span class="text-emerald-600 dark:text-emerald-400 font-extrabold text-lg md:text-xl">DASHBOARD</span>
                    </h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 font-medium max-w-[280px]">
                        Lembaga Pendidikan & Pelatihan Permapendis
                    </p>
                </div>
            </a>
        </div>
        
        {{-- Footer branding --}}
        <div class="text-center text-[10px] text-slate-400 dark:text-slate-500 hidden md:block">
            &copy; {{ date('Y') }} Lemdiklat Permapendis. Hak Cipta Dilindungi.
        </div>
    </div>

    {{-- Right Side: Login Form Panel (Full Height & Centered) --}}
    <div class="flex-1 bg-emerald-800 dark:bg-emerald-950 flex flex-col justify-center p-8 md:p-16 text-white min-h-[500px] md:min-h-screen overflow-y-auto">
        
        <div class="max-w-sm w-full mx-auto space-y-6 py-8 animate-slide-up">
            <div>
                <h2 class="text-2xl font-black tracking-tight">Selamat Datang Kembali!</h2>
                <p class="text-emerald-200 text-xs mt-1 font-medium">Silakan masukkan akun Anda untuk masuk ke sistem dashboard.</p>
            </div>

            @if(session('success'))
            <div class="p-3.5 bg-emerald-900/60 border border-emerald-500/30 text-emerald-200 rounded-2xl text-xs font-semibold">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="p-3.5 bg-red-950/60 border border-red-500/30 text-red-200 rounded-2xl text-xs font-semibold">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                
                {{-- Username Input --}}
                <div class="space-y-1">
                    <label for="username" class="block text-xs font-semibold text-emerald-100">Username Anda</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required autofocus
                           class="w-full px-4 py-3 bg-white/10 focus:bg-white/20 border border-white/15 focus:border-white/40 text-white rounded-xl outline-none placeholder:text-white/45 text-sm transition-all shadow-inner" 
                           placeholder="Masukkan username Anda">
                </div>

                {{-- Password Input --}}
                {{-- Password Input --}}
                <div class="space-y-1">
                    <label for="password" class="block text-xs font-semibold text-emerald-100">Kata Sandi (Password)</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required
                               class="w-full pl-4 pr-12 py-3 bg-white/10 focus:bg-white/20 border border-white/15 focus:border-white/40 text-white rounded-xl outline-none placeholder:text-white/45 text-sm transition-all shadow-inner" 
                               placeholder="Masukkan password Anda">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-emerald-300 hover:text-white transition-colors duration-200" title="Tampilkan/Sembunyikan Password">
                            {{-- Show Eye Icon --}}
                            <svg id="eye-icon-show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{-- Hide Eye Icon (Crossed) --}}
                            <svg id="eye-icon-hide" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Options row --}}
                <div class="flex items-center text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 bg-white/10 text-emerald-600 rounded border-white/20 focus:ring-0">
                        <span class="text-emerald-100 font-medium">Ingat saya</span>
                    </label>
                </div>

                {{-- Sign In Button --}}
                <button type="submit" class="btn-primary w-full py-3.5 mt-2">
                    Masuk Sekarang
                </button>

                {{-- OR divider --}}
                <div class="flex items-center gap-3 my-2">
                    <hr class="flex-1 border-white/10">
                    <span class="text-[9px] text-emerald-200 uppercase tracking-widest font-bold">atau</span>
                    <hr class="flex-1 border-white/10">
                </div>

                {{-- Google SSO Login Button (Icon Only) --}}
                <div class="flex justify-center mt-2">
                    <button type="button" onclick="openGoogleLoginModal()" class="w-11 h-11 bg-white hover:bg-emerald-50 text-slate-800 rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 transform active:scale-95 border border-white/10" title="Masuk dengan Google">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </button>
                </div>
            </form>

            {{-- Back home link --}}
            <div class="text-center pt-2">
                <a href="{{ route('home') }}" class="text-emerald-300 hover:text-white text-xs font-semibold transition-all">
                    ← Kembali ke Beranda Utama
                </a>
            </div>
        </div>

    </div>

{{-- Google SSO Mock Modal --}}
<div id="google-login-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center px-4 hidden">
    <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-gray-100 transform scale-95 transition-all duration-300">
        {{-- Header --}}
        <div class="flex flex-col items-center text-center pb-4 border-b border-gray-100">
            <svg class="w-8 h-8 mb-2" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <h4 class="font-bold text-gray-800 text-base">Masuk dengan Google</h4>
            <p class="text-xs text-gray-400 mt-0.5">Pilih akun untuk masuk ke Lemdiklat</p>
        </div>

        {{-- Loading Overlay --}}
        <div id="google-loading" class="flex flex-col items-center justify-center py-10 hidden">
            <div class="w-8 h-8 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-xs font-semibold text-gray-500 mt-3 animate-pulse">Menghubungkan dengan Google...</p>
        </div>

        {{-- Accounts List --}}
        <div id="google-accounts" class="divide-y divide-gray-50 pt-2">
            <button onclick="selectGoogleLogin('hamidun.dev@gmail.com')" class="w-full flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition text-left">
                <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm">H</div>
                <div>
                    <p class="text-xs font-bold text-gray-800">Hamidun</p>
                    <p class="text-[10px] text-gray-400">hamidun.dev@gmail.com</p>
                </div>
            </button>
            <button onclick="selectGoogleLogin('permapendis.lemdiklat@gmail.com')" class="w-full flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition text-left">
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">L</div>
                <div>
                    <p class="text-xs font-bold text-gray-800">Lemdiklat Permapendis</p>
                    <p class="text-[10px] text-gray-400">permapendis.lemdiklat@gmail.com</p>
                </div>
            </button>
            <button onclick="selectGoogleLogin('ahmad.fauzi@gmail.com')" class="w-full flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition text-left">
                <div class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center font-bold text-sm">A</div>
                <div>
                    <p class="text-xs font-bold text-gray-800">Ahmad Fauzi</p>
                    <p class="text-[10px] text-gray-400">ahmad.fauzi@gmail.com</p>
                </div>
            </button>
            
            <div class="pt-3 pb-1">
                <button onclick="closeGoogleLoginModal()" class="w-full py-2 text-center text-xs font-bold text-gray-500 hover:text-gray-700 bg-slate-50 hover:bg-slate-100 rounded-xl transition">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Hidden Form for Google Login --}}
<form id="form-google-login" action="{{ route('login.google') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="email" id="google-login-email">
</form>

<script>
    function openGoogleLoginModal() {
        document.getElementById('google-login-modal').classList.remove('hidden');
    }
    function closeGoogleLoginModal() {
        document.getElementById('google-login-modal').classList.add('hidden');
    }
    function selectGoogleLogin(email) {
        document.getElementById('google-accounts').classList.add('hidden');
        document.getElementById('google-loading').classList.remove('hidden');

        setTimeout(() => {
            document.getElementById('google-login-email').value = email;
            document.getElementById('form-google-login').submit();
        }, 1000);
    }
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const showIcon = document.getElementById('eye-icon-show');
        const hideIcon = document.getElementById('eye-icon-hide');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showIcon.classList.add('hidden');
            hideIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            showIcon.classList.remove('hidden');
            hideIcon.classList.add('hidden');
        }
    }
</script>

</body>
</html>
