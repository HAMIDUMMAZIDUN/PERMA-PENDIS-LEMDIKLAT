<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->load('profile', 'role');
        
        $search = $request->query('search');
        $query = UserProfile::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('member_number', 'like', '%' . $search . '%')
                  ->orWhere('institution', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $members = $query->orderBy('name', 'asc')->paginate(15)->withQueryString();

        return view('dashboard.members.index', compact('user', 'members', 'search'));
    }

    public function create()
    {
        $user = Auth::user()->load('profile', 'role');
        return view('dashboard.members.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'nullable|email|max:255',
            'phone'                 => 'nullable|string|max:20',
            'address'               => 'nullable|string|max:500',
            'city'                  => 'nullable|string|max:100',
            'member_number'         => 'required|string|max:50|unique:user_profiles,member_number',
            'wilayah'               => 'nullable|string|max:100',
            'province'              => 'nullable|string|max:100',
            'institution'           => 'nullable|string|max:200',
            'study_program'         => 'nullable|string|max:200',
            'nim'                   => 'nullable|string|max:50',
            'membership_status'     => 'required|in:aktif,nonaktif',
            'kta_issued_at'         => 'nullable|date',
            'kta_expired_at'        => 'nullable|date',
            'profile_picture_file'  => 'nullable|image|max:1024',
        ]);

        $data = $request->except('profile_picture_file');

        if ($request->hasFile('profile_picture_file')) {
            $file = $request->file('profile_picture_file');
            $filename = 'profile_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile-photos'), $filename);
            $data['profile_picture'] = $filename;
        }

        UserProfile::create($data);

        return redirect()->route('dashboard.members')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = Auth::user()->load('profile', 'role');
        $member = UserProfile::findOrFail($id);
        return view('dashboard.members.edit', compact('user', 'member'));
    }

    public function update(Request $request, $id)
    {
        $member = UserProfile::findOrFail($id);

        $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'nullable|email|max:255',
            'phone'                 => 'nullable|string|max:20',
            'address'               => 'nullable|string|max:500',
            'city'                  => 'nullable|string|max:100',
            'member_number'         => 'required|string|max:50|unique:user_profiles,member_number,' . $id,
            'wilayah'               => 'nullable|string|max:100',
            'province'              => 'nullable|string|max:100',
            'institution'           => 'nullable|string|max:200',
            'study_program'         => 'nullable|string|max:200',
            'nim'                   => 'nullable|string|max:50',
            'membership_status'     => 'required|in:aktif,nonaktif',
            'kta_issued_at'         => 'nullable|date',
            'kta_expired_at'        => 'nullable|date',
            'profile_picture_file'  => 'nullable|image|max:1024',
        ]);

        $data = $request->except('profile_picture_file');

        if ($request->hasFile('profile_picture_file')) {
            // Delete old picture if exists
            if ($member->profile_picture) {
                $oldPath = public_path('uploads/profile-photos/' . $member->profile_picture);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('profile_picture_file');
            $filename = 'profile_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile-photos'), $filename);
            $data['profile_picture'] = $filename;
        }

        $member->update($data);

        return redirect()->route('dashboard.members')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $member = UserProfile::findOrFail($id);

        // Delete associated login user account if exists, to avoid orphaned users
        User::where('user_profile_id', $member->id)->delete();

        // Delete photo
        if ($member->profile_picture) {
            $oldPath = public_path('uploads/profile-photos/' . $member->profile_picture);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $member->delete();

        return redirect()->route('dashboard.members')->with('success', 'Anggota berhasil dihapus!');
    }
}
