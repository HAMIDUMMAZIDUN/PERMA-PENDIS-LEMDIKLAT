<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Lemdiklat Permapendis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .method-tab-active {
            background-color: #10b981;
            color: #ffffff;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-primary-900 via-primary-800 to-secondary-700 flex items-center justify-center px-4 py-12">

<div class="w-full max-w-lg animate-slide-up">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden dark:bg-gray-900">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-primary-900 to-primary-700 px-8 py-7 text-center text-white">
            <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 mb-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-12 object-contain" onerror="this.style.display='none'">
            </a>
            <h1 class="text-2xl font-bold">Buat Akun Baru</h1>
            <p class="text-emerald-200 text-sm mt-1 font-medium">Bergabung dengan Lemdiklat Permapendis</p>
        </div>

        <div class="px-8 py-8">
            @if($errors->any())
            <div class="alert-error mb-5">
                <p class="font-medium text-sm mb-1">Terdapat kesalahan:</p>
                <ul class="text-sm list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Method Switcher Tabs --}}
            <div class="flex p-1.5 bg-slate-100 dark:bg-gray-800 rounded-2xl mb-6">
                <button type="button" id="tab-pass" onclick="switchMethod('pass')" class="flex-1 py-2.5 text-xs font-bold rounded-xl transition duration-300 method-tab-active">
                    Username & Password
                </button>
                <button type="button" id="tab-google" onclick="switchMethod('google')" class="flex-1 py-2.5 text-xs font-bold rounded-xl text-gray-500 dark:text-gray-400 transition duration-300">
                    Google SSO
                </button>
            </div>

            {{-- 1. Standard Password Form --}}
            <form id="form-password" action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required
                               class="form-input @error('name') border-red-400 @enderror"
                               placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                               class="form-input @error('email') border-red-400 @enderror"
                               placeholder="nama@example.com">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" name="username" type="text" value="{{ old('username') }}" required
                               class="form-input @error('username') border-red-400 @enderror"
                               placeholder="Pilih username (min. 3 karakter)" pattern="[a-zA-Z0-9_-]+">
                        <p class="text-xs text-gray-400 mt-1">Hanya huruf, angka, underscore, dan strip.</p>
                    </div>
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" required
                               class="form-input @error('password') border-red-400 @enderror"
                               placeholder="Min. 6 karakter">
                    </div>
                    <div>
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="form-input"
                               placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full justify-center py-3.5 text-base shadow-lg hover:shadow-emerald-500/25">
                    Kirim Pendaftaran
                </button>
            </form>

            {{-- 2. Google SSO Block --}}
            <div id="block-google" class="hidden space-y-6 text-center py-4">
                <div class="w-16 h-16 mx-auto bg-slate-50 dark:bg-gray-850 rounded-2xl flex items-center justify-center border border-gray-100 dark:border-gray-800 shadow-sm">
                    <svg class="w-8 h-8 text-blue-500" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12.24 10.285V14.4h6.887c-.648 2.41-2.519 4.114-5.136 4.114A5.89 5.89 0 0 1 8 12.629a5.89 5.89 0 0 1 5.99-5.89c1.62 0 3.085.57 4.24 1.62l3.19-3.19C19.497 3.38 16.943 2 13.99 2C8.473 2 4 6.473 4 12c0 5.527 4.473 10 9.99 10c5.753 0 10.01-4.045 10.01-10c0-.685-.06-1.343-.162-1.715H12.24z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-white">Pendaftaran dengan Google SSO</h3>
                    <p class="text-xs text-gray-400 mt-1 dark:text-gray-500 max-w-xs mx-auto">Daftar secara instan menggunakan Akun Google Anda tanpa perlu mengingat kata sandi.</p>
                </div>

                <button type="button" onclick="openGoogleModal()" class="w-full inline-flex items-center justify-center gap-3 px-6 py-3.5 bg-white hover:bg-slate-50 text-gray-700 dark:bg-gray-800 dark:hover:bg-gray-750 dark:text-white font-bold rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm transition transform active:scale-98">
                    <svg class="w-5 h-5" viewBox="0 0 24 24"><path fill="currentColor" d="M12.24 10.285V14.4h6.887c-.648 2.41-2.519 4.114-5.136 4.114A5.89 5.89 0 0 1 8 12.629a5.89 5.89 0 0 1 5.99-5.89c1.62 0 3.085.57 4.24 1.62l3.19-3.19C19.497 3.38 16.943 2 13.99 2C8.473 2 4 6.473 4 12c0 5.527 4.473 10 9.99 10c5.753 0 10.01-4.045 10.01-10c0-.685-.06-1.343-.162-1.715H12.24z"/></svg>
                    Daftar dengan Google
                </button>
            </div>

            <p class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-primary-700 font-semibold hover:underline">Masuk di sini</a>
            </p>
            <p class="mt-2 text-center text-sm">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-600 text-xs">← Kembali ke Beranda</a>
            </p>
        </div>
    </div>
</div>

{{-- Google SSO Mock Modal --}}
<div id="google-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center px-4 hidden">
    <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-gray-100 transform scale-95 transition-all duration-300">
        {{-- Header --}}
        <div class="flex flex-col items-center text-center pb-4 border-b border-gray-100">
            <svg class="w-8 h-8 text-blue-500 mb-2" viewBox="0 0 24 24"><path fill="currentColor" d="M12.24 10.285V14.4h6.887c-.648 2.41-2.519 4.114-5.136 4.114A5.89 5.89 0 0 1 8 12.629a5.89 5.89 0 0 1 5.99-5.89c1.62 0 3.085.57 4.24 1.62l3.19-3.19C19.497 3.38 16.943 2 13.99 2C8.473 2 4 6.473 4 12c0 5.527 4.473 10 9.99 10c5.753 0 10.01-4.045 10.01-10c0-.685-.06-1.343-.162-1.715H12.24z"/></svg>
            <h4 class="font-bold text-gray-800 text-base">Masuk dengan Google</h4>
            <p class="text-xs text-gray-400 mt-0.5">Pilih akun untuk melanjutkan ke Lemdiklat</p>
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
            <button onclick="selectGoogleAccount('Lemdiklat Permapendis', 'permapendis.lemdiklat@gmail.com')" class="w-full flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition text-left">
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">L</div>
                <div>
                    <p class="text-xs font-bold text-gray-800">Lemdiklat Permapendis</p>
                    <p class="text-[10px] text-gray-400">permapendis.lemdiklat@gmail.com</p>
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
            tabPass.classList.remove('text-gray-500', 'dark:text-gray-400');
            tabGoogle.classList.remove('method-tab-active', 'text-white');
            tabGoogle.classList.add('text-gray-500', 'dark:text-gray-400');
            formPassword.classList.remove('hidden');
            blockGoogle.classList.add('hidden');
        } else {
            tabGoogle.classList.add('method-tab-active', 'text-white');
            tabGoogle.classList.remove('text-gray-500', 'dark:text-gray-400');
            tabPass.classList.remove('method-tab-active', 'text-white');
            tabPass.classList.add('text-gray-500', 'dark:text-gray-400');
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
