<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // ─── Public ──────────────────────────────────────────────────────────────

    public function index()
    {
        $faqs = Faq::active()
            ->get()
            ->groupBy('category');

        return view('pages.faq.index', compact('faqs'));
    }

    // ─── Admin ────────────────────────────────────────────────────────────────

    public function adminIndex()
    {
        $faqs = Faq::orderBy('category')->orderBy('sort_order')->get();
        $user = auth()->user()->load('profile', 'role');
        return view('dashboard.faqs.index', compact('faqs', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'   => 'required|string',
            'answer'     => 'required|string',
            'category'   => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        Faq::create([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'category'   => $request->category ?? 'Umum',
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question'   => 'required|string',
            'answer'     => 'required|string',
            'category'   => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        $faq->update([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'category'   => $request->category ?? 'Umum',
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus.');
    }
}
