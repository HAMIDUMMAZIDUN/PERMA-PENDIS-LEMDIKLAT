<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\DownloadCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadController extends Controller
{
    // ─── Public ──────────────────────────────────────────────────────────────

    public function index()
    {
        $categories = DownloadCategory::where('is_active', true)
            ->with(['downloads' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        return view('pages.downloads.index', compact('categories'));
    }

    public function download(Download $download)
    {
        // Allow public downloads or require auth for private docs
        if (!$download->is_public) {
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Silakan masuk untuk mengunduh dokumen ini.');
            }
        }

        $filePath = public_path($download->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $download->increment('download_count');

        return response()->download($filePath, $download->file_name ?? basename($download->file_path));
    }

    // ─── Admin ────────────────────────────────────────────────────────────────

    public function adminIndex()
    {
        $downloads   = Download::with('category')->orderBy('download_category_id')->orderBy('sort_order')->get();
        $categories  = DownloadCategory::orderBy('sort_order')->get();
        $user        = auth()->user()->load('profile', 'role');
        return view('dashboard.downloads.index', compact('downloads', 'categories', 'user'));
    }

    public function create()
    {
        $categories = DownloadCategory::where('is_active', true)->orderBy('sort_order')->get();
        $user       = auth()->user()->load('profile', 'role');
        return view('dashboard.downloads.create', compact('categories', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'download_category_id' => 'required|exists:download_categories,id',
            'title'       => 'required|string|max:200',
            'description' => 'nullable|string',
            'file'        => 'required|file|max:51200|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png',
            'is_public'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $file     = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $fileSize = Download::formatBytes($file->getSize());
        $fileExt  = strtolower($file->getClientOriginalExtension());
        $stored   = 'downloads/' . Str::random(12) . '_' . time() . '.' . $fileExt;

        $file->move(public_path('uploads/downloads'), basename($stored));

        Download::create([
            'download_category_id' => $request->download_category_id,
            'title'       => $request->title,
            'description' => $request->description,
            'file_path'   => 'uploads/downloads/' . basename($stored),
            'file_name'   => $fileName,
            'file_size'   => $fileSize,
            'file_type'   => $fileExt,
            'is_public'   => $request->boolean('is_public', true),
            'sort_order'  => $request->sort_order ?? 0,
            'is_active'   => true,
        ]);

        return redirect()->route('dashboard.downloads')->with('success', 'Dokumen berhasil diunggah!');
    }

    public function edit(Download $download)
    {
        $categories = DownloadCategory::where('is_active', true)->orderBy('sort_order')->get();
        $user       = auth()->user()->load('profile', 'role');
        return view('dashboard.downloads.edit', compact('download', 'categories', 'user'));
    }

    public function update(Request $request, Download $download)
    {
        $request->validate([
            'download_category_id' => 'required|exists:download_categories,id',
            'title'       => 'required|string|max:200',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|max:51200|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png',
            'is_public'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $data = [
            'download_category_id' => $request->download_category_id,
            'title'       => $request->title,
            'description' => $request->description,
            'is_public'   => $request->boolean('is_public', true),
            'sort_order'  => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            $oldPath = public_path($download->file_path);
            if (file_exists($oldPath)) @unlink($oldPath);

            $file = $request->file('file');
            $fileExt  = strtolower($file->getClientOriginalExtension());
            $fileName = $file->getClientOriginalName();
            $stored   = Str::random(12) . '_' . time() . '.' . $fileExt;
            $file->move(public_path('uploads/downloads'), $stored);

            $data['file_path'] = 'uploads/downloads/' . $stored;
            $data['file_name'] = $fileName;
            $data['file_size'] = Download::formatBytes($file->getSize());
            $data['file_type'] = $fileExt;
        }

        $download->update($data);

        return redirect()->route('dashboard.downloads')->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy(Download $download)
    {
        $filePath = public_path($download->file_path);
        if (file_exists($filePath)) @unlink($filePath);

        $download->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }

    // ─── Category Management ──────────────────────────────────────────────────

    public function categories()
    {
        $categories = DownloadCategory::withCount('downloads')->orderBy('sort_order')->get();
        $user       = auth()->user()->load('profile', 'role');
        return view('dashboard.downloads.categories', compact('categories', 'user'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'icon'        => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer',
        ]);

        DownloadCategory::create($request->only('name', 'icon', 'description', 'sort_order'));

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroyCategory(DownloadCategory $downloadCategory)
    {
        // Remove associated files
        foreach ($downloadCategory->downloads as $dl) {
            $path = public_path($dl->file_path);
            if (file_exists($path)) @unlink($path);
        }
        $downloadCategory->delete();
        return back()->with('success', 'Kategori dan semua dokumennya berhasil dihapus.');
    }
}
