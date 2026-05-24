<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
        }

        if (!$user->is_activated) {
            return back()->withErrors(['username' => 'Akun Anda belum diaktifkan.'])->withInput();
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showRegister()
    {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|max:255',
            'username'              => 'required|string|min:3|max:50|unique:users,username|alpha_dash',
            'password'              => ['required', 'confirmed', Password::min(6)],
        ]);

        // Check if email already registered
        $existing = UserProfile::where('email', $request->email)->first();
        if ($existing) {
            return back()->withErrors(['email' => 'Email ini sudah terdaftar.'])->withInput();
        }

        $profile = UserProfile::create([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        User::create([
            'username'        => $request->username,
            'password'        => Hash::make($request->password),
            'role_id'         => 3, // Default: User
            'user_profile_id' => $profile->id,
            'is_activated'    => false, // Require admin approval!
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Pendaftaran Anda sedang dalam peninjauan (approval) oleh administrator. Silakan hubungi admin atau tunggu hingga diaktifkan.');
    }

    public function loginGoogle(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $profile = UserProfile::where('email', $request->email)->first();

        if (!$profile) {
            return back()->withErrors(['username' => 'Akun Google ini belum terdaftar. Silakan daftar terlebih dahulu.'])->withInput();
        }

        $user = User::where('user_profile_id', $profile->id)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Akun Google ini belum terhubung ke sistem login.'])->withInput();
        }

        if (!$user->is_activated) {
            return back()->withErrors(['username' => 'Pendaftaran Akun Anda sedang menunggu persetujuan (approval) oleh administrator.'])->withInput();
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function registerGoogle(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|max:255',
        ]);

        // Check if email already registered
        $existing = UserProfile::where('email', $request->email)->first();
        if ($existing) {
            return back()->withErrors(['email' => 'Email Google ini sudah terdaftar. Silakan login langsung.'])->withInput();
        }

        $profile = UserProfile::create([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        User::create([
            'username'        => 'google_' . strstr($request->email, '@', true) . '_' . rand(100, 999),
            'password'        => Hash::make(\Illuminate\Support\Str::random(24)),
            'role_id'         => 3, // Default: User
            'user_profile_id' => $profile->id,
            'is_activated'    => false, // Require approval
        ]);

        return redirect()->route('login')->with('success', 'Registrasi dengan Google Berhasil! Pendaftaran Anda sedang dalam peninjauan (approval) oleh administrator. Silakan hubungi admin atau tunggu hingga diaktifkan.');
    }
}
