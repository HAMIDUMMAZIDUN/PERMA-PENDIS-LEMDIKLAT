@extends('layouts.app')

@section('title', $gallery->title)
@section('description', $gallery->description ?? 'Dokumentasi kegiatan ' . $gallery->title . ' - PERMA PENDIS Indonesia.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors">Beranda</a>
        <span>/</span>
        <a href="{{ route('gallery') }}" class="hover:text-emerald-600 transition-colors">Dokumentasi</a>
        <span>/</span>
        <span class="text-gray-900 dark:text-white font-medium truncate max-w-xs">{{ $gallery->title }}</span>
    </nav>

    {{-- Gallery Header --}}
    <div class="mb-8">
        @if($gallery->category)
        <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
            {{ $gallery->category->name }}
        </span>
        @endif
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $gallery->title }}</h1>

        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
            @if($gallery->event_date)
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $gallery->event_date->translatedFormat('l, d F Y') }}
            </span>
            @endif
            @if($gallery->location)
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $gallery->location }}
            </span>
            @endif
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $gallery->items->count() }} Foto
            </span>
        </div>

        @if($gallery->description)
        <p class="mt-4 text-gray-600 dark:text-gray-400 leading-relaxed max-w-3xl">{{ $gallery->description }}</p>
        @endif
    </div>

    {{-- Lightbox Gallery --}}
    @if($gallery->items->count() > 0)
    <div class="columns-1 sm:columns-2 lg:columns-3 gap-3 space-y-3" id="lightbox-gallery">
        @foreach($gallery->items as $i => $item)
        @if($item->file_type === 'image')
        <div class="break-inside-avoid">
            <button onclick="openLightbox({{ $i }})"
                    class="block w-full group relative overflow-hidden rounded-xl cursor-pointer">
                <img src="{{ asset($item->file_path) }}"
                     alt="{{ $item->caption ?? $gallery->title . ' - Foto ' . ($i+1) }}"
                     class="w-full object-cover group-hover:scale-105 transition-transform duration-500 rounded-xl"
                     loading="lazy">
                {{-- Caption overlay --}}
                @if($item->caption)
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-end p-3">
                    <p class="text-white text-xs font-medium leading-snug">{{ $item->caption }}</p>
                </div>
                @endif
                {{-- Expand icon --}}
                <div class="absolute top-2 right-2 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                </div>
            </button>
            @if($item->caption)
            <p class="text-xs text-gray-500 dark:text-gray-400 px-1 pt-1.5">{{ $item->caption }}</p>
            @endif
        </div>
        @endif
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-gray-50 dark:bg-gray-900 rounded-2xl">
        <p class="text-gray-500 dark:text-gray-400">Belum ada foto dalam galeri ini.</p>
    </div>
    @endif

    {{-- Related Galleries --}}
    @if($related->count() > 0)
    <div class="mt-16">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Dokumentasi Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($related as $rel)
            <a href="{{ route('gallery.show', $rel) }}"
               class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden hover:shadow-lg transition-all">
                <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800">
                    @if($rel->cover_image)
                    <img src="{{ asset($rel->cover_image) }}" alt="{{ $rel->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @endif
                </div>
                <div class="p-3">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-emerald-600 transition-colors line-clamp-2">{{ $rel->title }}</h3>
                    @if($rel->event_date)
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $rel->event_date->translatedFormat('d M Y') }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

{{-- Lightbox Modal --}}
@if($gallery->items->count() > 0)
<div id="lightbox-modal" class="fixed inset-0 z-[100] hidden bg-black/95 flex items-center justify-center" onclick="closeLightboxOnBg(event)">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-10">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-10">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <div class="max-w-5xl max-h-screen px-16 py-10 flex flex-col items-center gap-3" id="lightbox-content">
        <img id="lightbox-img" src="" alt="" class="max-h-[75vh] max-w-full object-contain rounded-lg shadow-2xl">
        <p id="lightbox-caption" class="text-white/80 text-sm text-center"></p>
        <p id="lightbox-counter" class="text-white/50 text-xs"></p>
    </div>
    <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-10">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
</div>

<script>
const images = @json($gallery->items->where('file_type','image')->values()->map(fn($i) => ['src' => asset($i->file_path), 'caption' => $i->caption]));
let currentIdx = 0;

function openLightbox(index) {
    currentIdx = index;
    showImage();
    document.getElementById('lightbox-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox-modal').classList.add('hidden');
    document.body.style.overflow = '';
}
function closeLightboxOnBg(e) {
    if (e.target === document.getElementById('lightbox-modal')) closeLightbox();
}
function showImage() {
    const img = images[currentIdx];
    document.getElementById('lightbox-img').src = img.src;
    document.getElementById('lightbox-caption').textContent = img.caption || '';
    document.getElementById('lightbox-counter').textContent = (currentIdx + 1) + ' / ' + images.length;
}
function nextImage() { currentIdx = (currentIdx + 1) % images.length; showImage(); }
function prevImage() { currentIdx = (currentIdx - 1 + images.length) % images.length; showImage(); }

document.addEventListener('keydown', function(e) {
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
    if (e.key === 'Escape') closeLightbox();
});
</script>
@endif
@endsection
