@extends('layouts.app')
@section('title', $article->title)
@section('description', $article->excerpt)

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8 dark:text-gray-400">
        <a href="{{ route('home') }}" class="hover:text-primary-700">Beranda</a>
        
        <a href="{{ route('articles') }}" class="hover:text-primary-700">Artikel</a>
        
        <span class="text-gray-900 font-medium truncate max-w-xs dark:text-white">{{ $article->title }}</span>
    </nav>

    {{-- Article Header --}}
    <div class="mb-8 animate-slide-up">
        @if($article->category)
        <span class="badge-primary mb-4 inline-block">{{ $article->category->name }}</span>
        @endif
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight dark:text-white">{{ $article->title }}</h1>
        <div class="flex items-center gap-6 text-sm text-gray-500 dark:text-gray-400">
            <div class="flex items-center gap-2">
                
                <span>{{ $article->author }}</span>
            </div>
            <div class="flex items-center gap-1">
                
                {{ $article->updated_at->locale('id')->isoFormat('D MMMM YYYY') }}
            </div>
        </div>
    </div>

    {{-- Thumbnail --}}
    @if($article->thumbnail)
    <div class="rounded-2xl overflow-hidden mb-10 shadow-xl">
        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="w-full max-h-[480px] object-cover">
    </div>
    @endif

    {{-- Article Content --}}
    <div class="bg-white rounded-2xl shadow-md p-8 md:p-10 mb-10 dark:bg-gray-900">
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed prose-headings:text-primary-900 prose-headings:font-bold prose-a:text-primary-700 prose-a:underline prose-img:rounded-xl prose-img:shadow-md dark:text-gray-300">
            {!! $article->content !!}
        </div>
    </div>

    {{-- Related Articles --}}
    @if($related->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 dark:text-white">Artikel Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($related as $rel)
            <a href="{{ route('articles.show', $rel->slug) }}" class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col dark:bg-gray-900">
                <div class="h-40 overflow-hidden">
                    <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 text-sm group-hover:text-primary-700 transition line-clamp-2 dark:text-white">{{ $rel->title }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $rel->updated_at->locale('id')->isoFormat('D MMM YYYY') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('articles') }}" class="btn-secondary">
            
            Kembali ke Artikel
        </a>
    </div>
</div>
@endsection
