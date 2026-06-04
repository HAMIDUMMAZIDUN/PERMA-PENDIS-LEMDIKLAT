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

        $pembinaLeader = \App\Models\BoardMember::where('category', 'Dewan Pembina')->where('is_leader', true)->first();
        $pembinaMembers = \App\Models\BoardMember::where('category', 'Dewan Pembina')->where('is_leader', false)->orderBy('sort_order')->get();
        
        $pengarahLeader = \App\Models\BoardMember::where('category', 'Dewan Pengarah')->where('is_leader', true)->first();
        $pengarahMembers = \App\Models\BoardMember::where('category', 'Dewan Pengarah')->where('is_leader', false)->orderBy('sort_order')->get();
        
        $direktur = \App\Models\BoardMember::where('category', 'Dewan Direksi')->first() ?: \App\Models\BoardMember::where('category', 'Direktur')->first();
        $wakilDirekturs = \App\Models\BoardMember::where('category', 'Wakil Direktur')->orderBy('sort_order')->get();

        $sekretarisBendaharas = \App\Models\BoardMember::where('category', 'Sekretaris & Bendahara')->orderBy('sort_order')->get();
        $kabags = \App\Models\BoardMember::where('category', 'Kepala Bagian dan Unit')->orderBy('sort_order')->get();

        return view('pages.home', compact(
            'articles',
            'events',
            'downloads',
            'galleries',
            'pembinaLeader', 'pembinaMembers',
            'pengarahLeader', 'pengarahMembers',
            'direktur', 'wakilDirekturs',
            'sekretarisBendaharas', 'kabags'
        ));
    }

    public function about()
    {
        $pembinaLeader = \App\Models\BoardMember::where('category', 'Dewan Pembina')->where('is_leader', true)->first();
        $pembinaMembers = \App\Models\BoardMember::where('category', 'Dewan Pembina')->where('is_leader', false)->orderBy('sort_order')->get();
        
        $pengarahLeader = \App\Models\BoardMember::where('category', 'Dewan Pengarah')->where('is_leader', true)->first();
        $pengarahMembers = \App\Models\BoardMember::where('category', 'Dewan Pengarah')->where('is_leader', false)->orderBy('sort_order')->get();
        
        $direktur = \App\Models\BoardMember::where('category', 'Direktur')->first();
        $wakilDirekturs = \App\Models\BoardMember::where('category', 'Wakil Direktur')->orderBy('sort_order')->get();

        $sekretarisBendaharas = \App\Models\BoardMember::where('category', 'Sekretaris & Bendahara')->orderBy('sort_order')->get();
        $kabags = \App\Models\BoardMember::where('category', 'Kepala Bagian dan Unit')->orderBy('sort_order')->get();

        return view('pages.about', compact(
            'pembinaLeader', 'pembinaMembers',
            'pengarahLeader', 'pengarahMembers',
            'direktur', 'wakilDirekturs',
            'sekretarisBendaharas', 'kabags'
        ));
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
}
