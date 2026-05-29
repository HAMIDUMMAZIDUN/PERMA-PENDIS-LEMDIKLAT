<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Public: list articles
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categoryId = $request->get('category');

        $query = Article::with('category')->published()->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $articles = $query->paginate(9)->withQueryString();
        $categories = ArticleCategory::all();

        return view('pages.articles.index', compact('articles', 'categories', 'search', 'categoryId'));
    }

    // Public: show single article
    public function show(string $slug)
    {
        $article = Article::with('category')->where('slug', $slug)->published()->firstOrFail();
        $related = Article::with('category')
            ->published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.articles.show', compact('article', 'related'));
    }

    // Admin: list all articles
    public function adminIndex(Request $request)
    {
        $search = $request->get('search');
        $query = Article::with('category')->latest();

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $articles = $query->paginate(10)->withQueryString();
        $categories = ArticleCategory::all();

        return view('dashboard.articles.index', compact('articles', 'categories', 'search'));
    }

    // Admin: show create form
    public function create()
    {
        $categories = ArticleCategory::all();
        return view('dashboard.articles.create', compact('categories'));
    }

    // Admin: store article
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:200',
            'content'     => 'required|string',
            'author'      => 'required|string|max:100',
            'category_id' => 'nullable|exists:article_categories,id',
            'is_published'=> 'boolean',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:512000',
        ]);

        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/thumbnails'), $thumbnailName);
        }

        $article = Article::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(6),
            'content'      => $request->content,
            'author'       => $request->author,
            'category_id'  => $request->category_id,
            'is_published' => $request->boolean('is_published'),
            'thumbnail'    => $thumbnailName,
        ]);

        return redirect()->route('dashboard.articles')->with('success', 'Artikel berhasil dibuat!');
    }

    // Admin: show edit form
    public function edit(int $id)
    {
        $article = Article::findOrFail($id);
        $categories = ArticleCategory::all();
        return view('dashboard.articles.edit', compact('article', 'categories'));
    }

    // Admin: update article
    public function update(Request $request, int $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:200',
            'content'     => 'required|string',
            'author'      => 'required|string|max:100',
            'category_id' => 'nullable|exists:article_categories,id',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:512000',
        ]);

        $thumbnailName = $article->thumbnail;
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($thumbnailName && file_exists(public_path('uploads/thumbnails/' . $thumbnailName))) {
                unlink(public_path('uploads/thumbnails/' . $thumbnailName));
            }
            $file = $request->file('thumbnail');
            $thumbnailName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/thumbnails'), $thumbnailName);
        }

        $article->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(6),
            'content'      => $request->content,
            'author'       => $request->author,
            'category_id'  => $request->category_id,
            'is_published' => $request->boolean('is_published'),
            'thumbnail'    => $thumbnailName,
        ]);

        return redirect()->route('dashboard.articles')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Admin: delete article
    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);

        if ($article->thumbnail && file_exists(public_path('uploads/thumbnails/' . $article->thumbnail))) {
            unlink(public_path('uploads/thumbnails/' . $article->thumbnail));
        }

        $article->delete();
        return redirect()->route('dashboard.articles')->with('success', 'Artikel berhasil dihapus!');
    }
}
