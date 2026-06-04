<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user()->load('profile', 'role');
        return view('dashboard.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user()->load('profile');

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:500',
            'city'     => 'nullable|string|max:100',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update user account details
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();

        if ($user->profile) {
            $user->profile->update($request->only('name', 'email', 'phone', 'address', 'city'));
        }

        return back()->with('success', 'Profil dan akun berhasil diperbarui!');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:512000',
        ]);

        $user = Auth::user()->load('profile');

        // Delete old photo
        if ($user->profile?->profile_picture) {
            $oldPath = public_path('uploads/profile-photos/' . $user->profile->profile_picture);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        $file = $request->file('photo');
        $fileName = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile-photos'), $fileName);

        if ($user->profile) {
            $user->profile->update(['profile_picture' => $fileName]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}
