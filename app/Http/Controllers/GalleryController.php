<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    // ─── Public ──────────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        $query = Gallery::with(['category', 'items'])
            ->where('is_published', true)
            ->orderBy('event_date', 'desc');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('year')) {
            $query->whereYear('event_date', $request->year);
        }

        $galleries  = $query->paginate(12)->withQueryString();
        $categories = GalleryCategory::where('is_active', true)->withCount('galleries')->get();
        $years      = Gallery::where('is_published', true)
            ->selectRaw('YEAR(event_date) as year')
            ->whereNotNull('event_date')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('pages.gallery.index', compact('galleries', 'categories', 'years'));
    }

    public function show(Gallery $gallery)
    {
        if (!$gallery->is_published) abort(404);
        $gallery->load(['category', 'items' => fn($q) => $q->orderBy('sort_order')]);
        $related = Gallery::where('id', '!=', $gallery->id)
            ->where('is_published', true)
            ->where('gallery_category_id', $gallery->gallery_category_id)
            ->orderBy('event_date', 'desc')
            ->take(4)
            ->get();
        return view('pages.gallery.show', compact('gallery', 'related'));
    }

    // ─── Admin ────────────────────────────────────────────────────────────────

    public function adminIndex()
    {
        $galleries  = Gallery::with(['category', 'items'])->orderBy('event_date', 'desc')->paginate(15);
        $user       = auth()->user()->load('profile', 'role');
        return view('dashboard.gallery.index', compact('galleries', 'user'));
    }

    public function create()
    {
        $categories = GalleryCategory::where('is_active', true)->orderBy('name')->get();
        $user       = auth()->user()->load('profile', 'role');
        return view('dashboard.gallery.create', compact('categories', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'               => 'required|string|max:200',
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'event_date'          => 'nullable|date',
            'location'            => 'nullable|string|max:200',
            'description'         => 'nullable|string',
            'cover_image'         => 'nullable|image|max:5120',
            'photos.*'            => 'nullable|image|max:5120',
            'captions.*'          => 'nullable|string|max:500',
            'is_featured'         => 'nullable|boolean',
            'is_published'        => 'nullable|boolean',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $file      = $request->file('cover_image');
            $filename  = 'gallery_cover_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $filename);
            $coverPath = 'uploads/gallery/' . $filename;
        }

        $gallery = Gallery::create([
            'title'               => $request->title,
            'gallery_category_id' => $request->gallery_category_id,
            'event_date'          => $request->event_date,
            'location'            => $request->location,
            'description'         => $request->description,
            'cover_image'         => $coverPath,
            'is_featured'         => $request->boolean('is_featured'),
            'is_published'        => $request->boolean('is_published', true),
        ]);

        // Store uploaded photos
        if ($request->hasFile('photos')) {
            $captions = $request->input('captions', []);
            $items = [];
            foreach ($request->file('photos') as $i => $photo) {
                $fname = 'gallery_item_' . $gallery->id . '_' . $i . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/gallery'), $fname);
                $items[] = [
                    'gallery_id'  => $gallery->id,
                    'file_path'   => 'uploads/gallery/' . $fname,
                    'file_type'   => 'image',
                    'caption'     => $captions[$i] ?? null,
                    'sort_order'  => $i,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
            if (!empty($items)) {
                GalleryItem::insert($items);
            }
        }

        return redirect()->route('dashboard.gallery')->with('success', 'Galeri kegiatan berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        $gallery->load('items');
        $categories = GalleryCategory::where('is_active', true)->orderBy('name')->get();
        $user       = auth()->user()->load('profile', 'role');
        return view('dashboard.gallery.edit', compact('gallery', 'categories', 'user'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'               => 'required|string|max:200',
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'event_date'          => 'nullable|date',
            'location'            => 'nullable|string|max:200',
            'description'         => 'nullable|string',
            'cover_image'         => 'nullable|image|max:5120',
            'photos.*'            => 'nullable|image|max:5120',
            'captions.*'          => 'nullable|string|max:500',
            'is_featured'         => 'nullable|boolean',
            'is_published'        => 'nullable|boolean',
        ]);

        $data = [
            'title'               => $request->title,
            'gallery_category_id' => $request->gallery_category_id,
            'event_date'          => $request->event_date,
            'location'            => $request->location,
            'description'         => $request->description,
            'is_featured'         => $request->boolean('is_featured'),
            'is_published'        => $request->boolean('is_published', true),
        ];

        if ($request->hasFile('cover_image')) {
            if ($gallery->cover_image && file_exists(public_path($gallery->cover_image))) {
                @unlink(public_path($gallery->cover_image));
            }
            $file = $request->file('cover_image');
            $fname = 'gallery_cover_' . $gallery->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $fname);
            $data['cover_image'] = 'uploads/gallery/' . $fname;
        }

        $gallery->update($data);

        // Add new photos
        if ($request->hasFile('photos')) {
            $captions   = $request->input('captions', []);
            $maxOrder   = $gallery->items()->max('sort_order') ?? -1;
            $items = [];
            foreach ($request->file('photos') as $i => $photo) {
                $maxOrder++;
                $fname = 'gallery_item_' . $gallery->id . '_' . $maxOrder . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/gallery'), $fname);
                $items[] = [
                    'gallery_id'  => $gallery->id,
                    'file_path'   => 'uploads/gallery/' . $fname,
                    'file_type'   => 'image',
                    'caption'     => $captions[$i] ?? null,
                    'sort_order'  => $maxOrder,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
            if (!empty($items)) {
                GalleryItem::insert($items);
            }
        }

        return redirect()->route('dashboard.gallery')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete cover
        if ($gallery->cover_image && file_exists(public_path($gallery->cover_image))) {
            @unlink(public_path($gallery->cover_image));
        }
        // Delete all items
        foreach ($gallery->items as $item) {
            if (file_exists(public_path($item->file_path))) {
                @unlink(public_path($item->file_path));
            }
        }
        $gallery->delete();
        return back()->with('success', 'Galeri berhasil dihapus.');
    }

    public function destroyItem(GalleryItem $galleryItem)
    {
        if (file_exists(public_path($galleryItem->file_path))) {
            @unlink(public_path($galleryItem->file_path));
        }
        $galleryItem->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
