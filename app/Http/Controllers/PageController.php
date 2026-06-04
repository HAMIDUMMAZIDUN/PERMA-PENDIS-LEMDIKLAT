<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;

class PageController extends Controller
{
    public function home()
    {
        $articles = Article::with('category')
            ->published()
            ->latest()
            ->take(3)
            ->get();

        $events = \App\Models\Event::published()
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();

        $downloads = \App\Models\Download::with('category')
            ->where('is_active', true)
            ->where('is_public', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $galleries = \App\Models\Gallery::with(['category', 'items'])
            ->where('is_published', true)
            ->orderBy('event_date', 'desc')
            ->take(6)
            ->get();

        $boardMembers = \App\Models\BoardMember::orderByRaw("CASE 
            WHEN category = 'Dewan Pakar' THEN 1 
            WHEN category = 'Dewan Pengawas' THEN 2 
            WHEN category = 'Pengurus Harian' THEN 3 
            WHEN category = 'Divisi I' THEN 4 
            WHEN category = 'Divisi II' THEN 5 
            WHEN category = 'Divisi III' THEN 6 
            WHEN category = 'Divisi IV' THEN 7 
            WHEN category = 'Divisi V' THEN 8 
            WHEN category = 'Divisi VI' THEN 9 
            WHEN category = 'Divisi VII' THEN 10 
            WHEN category = 'Divisi VIII' THEN 11 
            WHEN category = 'Koordinator Wilayah' THEN 12 
            ELSE 13 END")
            ->orderBy('is_leader', 'desc')
            ->orderBy('sort_order', 'asc')
            ->take(8)
            ->get();

        return view('pages.home', compact(
            'articles',
            'events',
            'downloads',
            'galleries',
            'boardMembers'
        ));
    }

    public function about()
    {
        $boardMembers = \App\Models\BoardMember::orderByRaw("CASE 
            WHEN category = 'Dewan Pakar' THEN 1 
            WHEN category = 'Dewan Pengawas' THEN 2 
            WHEN category = 'Pengurus Harian' THEN 3 
            WHEN category = 'Divisi I' THEN 4 
            WHEN category = 'Divisi II' THEN 5 
            WHEN category = 'Divisi III' THEN 6 
            WHEN category = 'Divisi IV' THEN 7 
            WHEN category = 'Divisi V' THEN 8 
            WHEN category = 'Divisi VI' THEN 9 
            WHEN category = 'Divisi VII' THEN 10 
            WHEN category = 'Divisi VIII' THEN 11 
            WHEN category = 'Koordinator Wilayah' THEN 12 
            ELSE 13 END")
            ->orderBy('is_leader', 'desc')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.about', compact('boardMembers'));
    }
    
    public function members(\Illuminate\Http\Request $request)
    {
        $search = $request->query('search');
        $query = \App\Models\UserProfile::whereNotNull('member_number')
            ->where('membership_status', 'aktif');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('member_number', 'like', '%' . $search . '%')
                  ->orWhere('institution', 'like', '%' . $search . '%');
            });
        }

        $membersList = $query->orderBy('member_number', 'asc')->paginate(20)->withQueryString();

        return view('pages.members', compact('membersList', 'search'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        \App\Models\ContactMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Terima kasih! Pesan Anda telah dikirim.');
    }

    public function adArt()
    {
        return view('pages.ad-art');
    }
}
