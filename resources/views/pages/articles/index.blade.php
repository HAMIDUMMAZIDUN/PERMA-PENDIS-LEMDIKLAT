@extends('layouts.app')
@section('title', 'Artikel & Berita')

@section('content')

<section class="bg-gradient-to-br from-primary-900 to-primary-700 text-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Artikel & Berita</h1>
        <p class="text-xl text-emerald-100">Temukan informasi terbaru, kegiatan, dan pengumuman dari Lemdiklat Permapendis.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('articles') }}" class="flex flex-col sm:flex-row gap-4 mb-10">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari artikel..."
               class="form-input flex-1">
        <select name="category" class="form-input sm:w-48">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-primary px-6">
            
            Cari
        </button>
        @if($search || $categoryId)
        <a href="{{ route('articles') }}" class="btn-secondary px-4">Reset</a>
        @endif
    </form>

    {{-- Articles Grid --}}
    @if($articles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
        @foreach($articles as $article)
        <a href="{{ route('articles.show', $article->slug) }}" class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col dark:bg-gray-900">
            <div class="relative overflow-hidden h-52">
                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                
                @if($article->category)
                    <span class="absolute top-3 left-3 badge-primary text-xs font-semibold">{{ $article->category->name }}</span>
                @endif
            </div>
            <div class="p-5 flex flex-col flex-1">
                <h2 class="font-bold text-gray-900 text-base mb-2 group-hover:text-primary-700 transition leading-snug line-clamp-2 dark:text-white">{{ $article->title }}</h2>
                <p class="text-gray-500 text-sm flex-1 line-clamp-3 dark:text-gray-400">{{ $article->excerpt }}</p>
                <div class="mt-4 flex items-center justify-between text-xs text-gray-400 border-t border-gray-100 pt-3 dark:border-gray-800">
                    <span class="font-medium">{{ $article->author }}</span>
                    <span>{{ $article->updated_at->locale('id')->isoFormat('D MMM YYYY') }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    {{ $articles->links('vendor.pagination.tailwind') }}

    @else
    <div class="text-center py-20 text-gray-400">
        
        <h3 class="text-xl font-semibold text-gray-500 mb-2 dark:text-gray-400">Tidak ada artikel ditemukan</h3>
        <p class="text-sm">@if($search) Coba kata kunci lain. @else Artikel akan muncul di sini. @endif</p>
    </div>
    @endif
</section>
@endsection
