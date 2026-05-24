<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('profile', 'role');
        return view('dashboard.index', compact('user'));
    }

    public function settings()
    {
        $user = Auth::user()->load('profile', 'role');
        
        $settings = [
            'home_welcome_title' => \App\Models\Setting::get('home_welcome_title', 'Selamat Datang di Lemdiklat Permapendis'),
            'home_welcome_desc' => \App\Models\Setting::get('home_welcome_desc', 'Lembaga Pendidikan dan Pelatihan Permapendis adalah pusat pelatihan yang berdedikasi untuk meningkatkan kompetensi tenaga pendidik dan kependidikan di Indonesia.'),
            'home_img_1' => \App\Models\Setting::get('home_img_1', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=300&h=200&fit=crop'),
            'home_img_2' => \App\Models\Setting::get('home_img_2', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=200&h=130&fit=crop'),
            'home_img_3' => \App\Models\Setting::get('home_img_3', 'https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=200&h=130&fit=crop'),
            'home_img_4' => \App\Models\Setting::get('home_img_4', 'https://images.unsplash.com/photo-1588702547923-7408e47e5d6e?w=200&h=130&fit=crop'),
            'home_img_5' => \App\Models\Setting::get('home_img_5', 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=200&h=130&fit=crop'),
            'home_program_img_1' => \App\Models\Setting::get('home_program_img_1', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=250&fit=crop'),
            'home_program_img_2' => \App\Models\Setting::get('home_program_img_2', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=400&h=250&fit=crop'),
            'home_program_img_3' => \App\Models\Setting::get('home_program_img_3', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400&h=250&fit=crop'),
        ];

        return view('dashboard.settings', compact('user', 'settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'home_welcome_title' => 'required|string|max:255',
            'home_welcome_desc' => 'required|string',
            'home_img_url_1' => 'nullable|url',
            'home_img_url_2' => 'nullable|url',
            'home_img_url_3' => 'nullable|url',
            'home_img_url_4' => 'nullable|url',
            'home_img_url_5' => 'nullable|url',
            'home_img_file_1' => 'nullable|image|max:2048',
            'home_img_file_2' => 'nullable|image|max:2048',
            'home_img_file_3' => 'nullable|image|max:2048',
            'home_img_file_4' => 'nullable|image|max:2048',
            'home_img_file_5' => 'nullable|image|max:2048',
            'home_program_img_url_1' => 'nullable|url',
            'home_program_img_url_2' => 'nullable|url',
            'home_program_img_url_3' => 'nullable|url',
            'home_program_img_file_1' => 'nullable|image|max:2048',
            'home_program_img_file_2' => 'nullable|image|max:2048',
            'home_program_img_file_3' => 'nullable|image|max:2048',
        ]);

        \App\Models\Setting::set('home_welcome_title', $request->home_welcome_title);
        \App\Models\Setting::set('home_welcome_desc', $request->home_welcome_desc);

        // Process each image setting
        for ($i = 1; $i <= 5; $i++) {
            $fileKey = "home_img_file_{$i}";
            $urlKey = "home_img_url_{$i}";
            $settingKey = "home_img_{$i}";

            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = "home_img_{$i}_" . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                \App\Models\Setting::set($settingKey, asset('uploads/settings/' . $filename));
            } elseif ($request->filled($urlKey)) {
                \App\Models\Setting::set($settingKey, $request->$urlKey);
            }
        }

        // Process each program image setting
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = "home_program_img_file_{$i}";
            $urlKey = "home_program_img_url_{$i}";
            $settingKey = "home_program_img_{$i}";

            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = "home_program_img_{$i}_" . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                \App\Models\Setting::set($settingKey, asset('uploads/settings/' . $filename));
            } elseif ($request->filled($urlKey)) {
                \App\Models\Setting::set($settingKey, $request->$urlKey);
            }
        }

        return redirect()->back()->with('success', 'Pengaturan tampilan berhasil diperbarui!');
    }

    public function approvals()
    {
        $user = Auth::user()->load('profile', 'role');
        
        // Fetch all users that are not activated, with their profile and role
        $pendingUsers = \App\Models\User::where('is_activated', false)->with('profile', 'role')->get();

        return view('dashboard.approvals.index', compact('user', 'pendingUsers'));
    }

    public function approveUser($id)
    {
        $targetUser = \App\Models\User::findOrFail($id);
        $targetUser->is_activated = true;
        $targetUser->save();

        return redirect()->route('dashboard.approvals')->with('success', "Akun {$targetUser->display_name} telah berhasil diaktifkan!");
    }

    public function rejectUser($id)
    {
        $targetUser = \App\Models\User::findOrFail($id);
        $profile = $targetUser->profile;

        $targetUser->delete();
        if ($profile) {
            $profile->delete();
        }

        return redirect()->route('dashboard.approvals')->with('success', 'Pendaftaran akun telah ditolak dan dihapus.');
    }
}
