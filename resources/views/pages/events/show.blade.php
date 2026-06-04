@extends('layouts.app')

@section('title', $event->title)
@section('description', strip_tags($event->description ?? 'Detail kegiatan ' . $event->title . ' - PERMA PENDIS Indonesia.'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-emerald-600">Beranda</a>
        <span>/</span>
        <a href="{{ route('events') }}" class="hover:text-emerald-600">Agenda</a>
        <span>/</span>
        <span class="text-gray-900 dark:text-white font-medium truncate">{{ $event->title }}</span>
    </nav>

    @if($event->cover_image)
    <div class="aspect-video overflow-hidden rounded-2xl mb-8 bg-gray-100 dark:bg-gray-800">
        <img src="{{ asset($event->cover_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
    </div>
    @endif

    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $event->type_color }} mb-4">{{ ucfirst($event->type) }}</span>
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ $event->title }}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5 bg-emerald-50 dark:bg-emerald-950/30 rounded-xl border border-emerald-100 dark:border-emerald-900 mb-8">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center text-white flex-shrink-0">📅</div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Tanggal</p>
                <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $event->start_date->translatedFormat('l, d F Y') }}</p>
                @if($event->end_date && $event->end_date->ne($event->start_date))
                <p class="text-xs text-gray-500 dark:text-gray-400">s/d {{ $event->end_date->translatedFormat('d F Y') }}</p>
                @endif
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center text-white flex-shrink-0">🕐</div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Waktu</p>
                <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $event->start_date->format('H:i') }} WIB</p>
            </div>
        </div>
        @if($event->location)
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center text-white flex-shrink-0">📍</div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Lokasi</p>
                <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $event->location }}</p>
            </div>
        </div>
        @endif
        @if($event->contact_person)
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center text-white flex-shrink-0">👤</div>
            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Contact Person</p>
                <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $event->contact_person }}</p>
            </div>
        </div>
        @endif
    </div>

    @if($event->description)
    <div class="prose prose-gray dark:prose-invert max-w-none mb-8">
        {!! nl2br(e($event->description)) !!}
    </div>
    @endif

    @if($event->registration_url)
    <div class="bg-emerald-600 rounded-2xl p-6 text-center text-white mb-8">
        <p class="font-semibold text-lg mb-2">Daftar Sekarang!</p>
        <p class="text-emerald-100 text-sm mb-4">Klik tombol di bawah untuk mendaftar ke kegiatan ini.</p>
        <a href="{{ $event->registration_url }}" target="_blank" rel="noopener"
           class="inline-block bg-white text-emerald-700 font-bold px-6 py-2.5 rounded-xl hover:bg-emerald-50 transition-colors">
            Daftar Sekarang →
        </a>
    </div>
    @endif

    @if($related->count() > 0)
    <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-8">
        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Event Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($related as $rel)
            <a href="{{ route('events.show', $rel) }}" class="group block p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl hover:shadow-md transition-all">
                <span class="text-xs px-2 py-0.5 rounded-full {{ $rel->type_color }}">{{ ucfirst($rel->type) }}</span>
                <h3 class="font-medium text-sm text-gray-900 dark:text-white mt-2 group-hover:text-emerald-600 transition-colors line-clamp-2">{{ $rel->title }}</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $rel->start_date->translatedFormat('d M Y') }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
