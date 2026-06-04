@extends('layouts.app')

@section('title', 'Dokumentasi Kegiatan')
@section('description', 'Galeri foto dan dokumentasi kegiatan, seminar, pelatihan, dan program PERMA PENDIS Indonesia.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Page Header --}}
    <div class="text-center mb-10">
        <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4 dark:bg-emerald-900/40 dark:text-emerald-400">
            Arsip Visual
        </span>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Dokumentasi Kegiatan</h1>
        <p class="text-gray-500 max-w-2xl mx-auto dark:text-gray-400">
            Rekam jejak kegiatan, seminar, rapat kerja, dan program PERMA PENDIS Indonesia dalam gambar.
        </p>
    </div>

    {{-- Filters --}}
    <div class="flex flex-wrap items-center gap-3 mb-8">
        {{-- Category Filter --}}
        <a href="{{ route('gallery') }}"
           class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ !request('category') ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">
            Semua
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('gallery', ['category' => $cat->slug] + (request()->except('category', 'page'))) }}"
           class="px-4 py-1.5 rounded-full text-sm font-medium transition-all {{ request('category') === $cat->slug ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">
            {{ $cat->name }}
            <span class="ml-1 text-xs opacity-70">({{ $cat->galleries_count }})</span>
        </a>
        @endforeach

        {{-- Year Filter --}}
        @if($years->isNotEmpty())
        <div class="ml-auto">
            <select onchange="if(this.value) window.location='{{ route('gallery') }}?year='+this.value+'{{ request('category') ? '&category='.request('category') : '' }}'"
                    class="text-sm border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-1.5 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300">
                <option value="">Semua Tahun</option>
                @foreach($years as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>

    {{-- Gallery Grid --}}
    @if($galleries->isEmpty())
    <div class="text-center py-20">
        <div class="text-6xl mb-4">📷</div>
        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Belum ada dokumentasi</h3>
        <p class="text-gray-500 dark:text-gray-400">Dokumentasi kegiatan akan segera ditambahkan.</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($galleries as $gallery)
        <a href="{{ route('gallery.show', $gallery) }}"
           class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            {{-- Cover Image --}}
            <div class="relative aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800">
                @if($gallery->cover_image)
                <img src="{{ asset($gallery->cover_image) }}" alt="{{ $gallery->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-50 to-teal-100 dark:from-emerald-950 dark:to-teal-950">
                    <svg class="w-12 h-12 text-emerald-300 dark:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif

                {{-- Photo count badge --}}
                @if($gallery->items_count ?? $gallery->items->count() > 0)
                <div class="absolute bottom-2 right-2 bg-black/60 text-white text-xs px-2 py-0.5 rounded-full backdrop-blur-sm">
                    📷 {{ $gallery->items->count() }} Foto
                </div>
                @endif

                {{-- Category badge --}}
                @if($gallery->category)
                <div class="absolute top-2 left-2 bg-emerald-600/90 text-white text-xs px-2.5 py-0.5 rounded-full backdrop-blur-sm font-medium">
                    {{ $gallery->category->name }}
                </div>
                @endif
            </div>

            {{-- Content --}}
            <div class="p-4">
                <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2 leading-snug">
                    {{ $gallery->title }}
                </h3>
                <div class="flex items-center gap-3 mt-2 text-xs text-gray-500 dark:text-gray-400">
                    @if($gallery->event_date)
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $gallery->event_date->translatedFormat('d M Y') }}
                    </span>
                    @endif
                    @if($gallery->location)
                    <span class="flex items-center gap-1 truncate">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="truncate">{{ $gallery->location }}</span>
                    </span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($galleries->hasPages())
    <div class="mt-10 flex justify-center">
        {{ $galleries->links() }}
    </div>
    @endif
    @endif
</div>
@endsection
