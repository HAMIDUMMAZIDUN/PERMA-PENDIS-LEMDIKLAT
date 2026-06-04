@extends('layouts.app')

@section('title', 'Agenda & Kalender Kegiatan')
@section('description', 'Jadwal rapat kerja, seminar nasional, pelatihan, dan event PERMA PENDIS Indonesia.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-10">
        <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4 dark:bg-emerald-900/40 dark:text-emerald-400">Jadwal & Kegiatan</span>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Agenda Kegiatan</h1>
        <p class="text-gray-500 max-w-2xl mx-auto dark:text-gray-400">Jadwal rapat kerja, seminar, pelatihan, dan program kegiatan PERMA PENDIS Indonesia.</p>
    </div>

    {{-- Tabs --}}
    <div class="flex border-b border-gray-200 dark:border-gray-700 mb-8">
        @foreach(['calendar' => '📅 Kalender', 'upcoming' => '🔜 Akan Datang', 'past' => '📚 Arsip'] as $key => $label)
        <a href="{{ route('events', ['tab' => $key]) }}"
           class="px-5 py-3 font-medium text-sm border-b-2 transition-colors {{ $tab === $key ? 'border-emerald-600 text-emerald-600' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    @if($tab === 'calendar')
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm mb-6">
            <div id="calendar-container"></div>
        </div>
        <div class="flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-400">
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-blue-500"></span> Seminar</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-green-500"></span> Pelatihan</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-yellow-500"></span> Rapat</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-purple-500"></span> Webinar</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-orange-500"></span> Musyawarah</div>
        </div>
    @elseif($tab === 'upcoming')
        @if($upcoming->isEmpty())
            <div class="text-center py-20"><div class="text-5xl mb-3">📅</div><p class="text-gray-500 dark:text-gray-400">Belum ada agenda mendatang.</p></div>
        @else
            <div class="space-y-4">
                @foreach($upcoming as $event)
                <a href="{{ route('events.show', $event) }}" class="flex gap-5 p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl hover:shadow-lg hover:border-emerald-300 dark:hover:border-emerald-700 transition-all group">
                    <div class="flex-shrink-0 w-16 text-center">
                        <div class="bg-emerald-600 text-white rounded-xl py-2 px-1">
                            <div class="text-xs uppercase opacity-80">{{ $event->start_date->format('M') }}</div>
                            <div class="text-2xl font-bold leading-none">{{ $event->start_date->format('d') }}</div>
                            <div class="text-xs opacity-80">{{ $event->start_date->format('Y') }}</div>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-emerald-600 transition-colors">{{ $event->title }}</h3>
                            <span class="text-xs px-2.5 py-0.5 rounded-full font-medium flex-shrink-0 {{ $event->type_color }}">{{ ucfirst($event->type) }}</span>
                        </div>
                        @if($event->location)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">📍 {{ $event->location }}</p>@endif
                        @if($event->description)<p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">{{ strip_tags($event->description) }}</p>@endif
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    @else
        @if($past->isEmpty())
            <div class="text-center py-20"><div class="text-5xl mb-3">📚</div><p class="text-gray-500 dark:text-gray-400">Belum ada arsip kegiatan.</p></div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($past as $event)
                <a href="{{ route('events.show', $event) }}" class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden hover:shadow-lg transition-all">
                    @if($event->cover_image)
                    <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800">
                        <img src="{{ asset($event->cover_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    @endif
                    <div class="p-4">
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $event->type_color }}">{{ ucfirst($event->type) }}</span>
                        <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-emerald-600 mt-2 line-clamp-2">{{ $event->title }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $event->start_date->translatedFormat('d F Y') }}@if($event->location) · {{ $event->location }}@endif</p>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    @endif
</div>

@if($tab === 'calendar')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css' rel='stylesheet'>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<style>.fc-button{background:#059669!important;border-color:#059669!important}.fc-button:hover{background:#047857!important}</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new FullCalendar.Calendar(document.getElementById('calendar-container'), {
        initialView: window.innerWidth < 640 ? 'listMonth' : 'dayGridMonth',
        locale: 'id',
        headerToolbar: { left:'prev,next today', center:'title', right:'dayGridMonth,listMonth' },
        events: '{{ route("events.calendar") }}',
        eventClick: function(info) { window.location.href = info.event.url; info.jsEvent.preventDefault(); },
        height: 'auto',
    }).render();
});
</script>
@endif
@endsection
