<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BoardMemberController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('profile', 'role');
        $members = BoardMember::orderBy('category')->orderBy('sort_order')->get();
        return view('dashboard.board-members.index', compact('user', 'members'));
    }

    public function create()
    {
        $user = Auth::user()->load('profile', 'role');
        return view('dashboard.board-members.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'category' => 'required|in:Dewan Pembina,Dewan Pengarah,Direktur,Wakil Direktur',
            'color' => 'required|string|max:10',
            'is_leader' => 'required|boolean',
            'sort_order' => 'required|integer|min:0',
            'photo_file' => 'nullable|image|max:512000',
        ]);

        $data = $request->except('photo_file');
        
        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = 'board_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/board'), $filename);
            $data['photo'] = asset('uploads/board/' . $filename);
        }

        BoardMember::create($data);

        return redirect()->route('dashboard.board-members')->with('success', 'Anggota pengurus berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = Auth::user()->load('profile', 'role');
        $member = BoardMember::findOrFail($id);
        return view('dashboard.board-members.edit', compact('user', 'member'));
    }

    public function update(Request $request, $id)
    {
        $member = BoardMember::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'category' => 'required|in:Dewan Pembina,Dewan Pengarah,Direktur,Wakil Direktur',
            'color' => 'required|string|max:10',
            'is_leader' => 'required|boolean',
            'sort_order' => 'required|integer|min:0',
            'photo_file' => 'nullable|image|max:512000',
        ]);

        $data = $request->except('photo_file');

        if ($request->hasFile('photo_file')) {
            // Delete old local file if exists
            if ($member->photo && str_contains($member->photo, 'uploads/board/')) {
                $oldPath = public_path(str_replace(asset(''), '', $member->photo));
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('photo_file');
            $filename = 'board_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/board'), $filename);
            $data['photo'] = asset('uploads/board/' . $filename);
        }

        $member->update($data);

        return redirect()->route('dashboard.board-members')->with('success', 'Data anggota pengurus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $member = BoardMember::findOrFail($id);

        // Delete photo from storage if exists
        if ($member->photo && str_contains($member->photo, 'uploads/board/')) {
            $oldPath = public_path(str_replace(asset(''), '', $member->photo));
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $member->delete();

        return redirect()->route('dashboard.board-members')->with('success', 'Anggota pengurus berhasil dihapus!');
    }
}
