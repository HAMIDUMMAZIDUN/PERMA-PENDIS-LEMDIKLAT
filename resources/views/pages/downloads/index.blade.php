@extends('layouts.app')

@section('title', 'Download Center')
@section('description', 'Unduh dokumen resmi, pedoman kerja, modul pelatihan, dan surat-surat resmi PERMA PENDIS Indonesia.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Page Header --}}
    <div class="text-center mb-12">
        <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4 dark:bg-emerald-900/40 dark:text-emerald-400">
            Pusat Unduhan
        </span>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Download Center</h1>
        <p class="text-gray-500 max-w-2xl mx-auto text-base dark:text-gray-400">
            Unduh dokumen resmi, modul pelatihan, pedoman kerja, dan surat-surat resmi PERMA PENDIS Indonesia.
        </p>
    </div>

    @if($categories->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">📂</div>
            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Belum ada dokumen tersedia</h3>
            <p class="text-gray-500 dark:text-gray-400">Dokumen akan segera ditambahkan oleh administrator.</p>
        </div>
    @else
        @foreach($categories as $category)
            @if($category->downloads->count() > 0)
            <div class="mb-12">
                {{-- Category Header --}}
                <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-emerald-100 dark:border-emerald-900">
                    @if($category->icon)
                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white text-lg flex-shrink-0">
                        {{ $category->icon }}
                    </div>
                    @else
                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                    @endif
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $category->name }}</h2>
                        @if($category->description)
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->description }}</p>
                        @endif
                    </div>
                    <span class="ml-auto text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 px-3 py-1 rounded-full">
                        {{ $category->downloads->count() }} Dokumen
                    </span>
                </div>

                {{-- Documents Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($category->downloads as $doc)
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:shadow-lg hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-300 group flex flex-col">
                        <div class="flex items-start gap-4 mb-4">
                            {{-- File type icon --}}
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                                {{ in_array($doc->file_type, ['pdf']) ? 'bg-red-100 dark:bg-red-900/30' : '' }}
                                {{ in_array($doc->file_type, ['doc','docx']) ? 'bg-blue-100 dark:bg-blue-900/30' : '' }}
                                {{ in_array($doc->file_type, ['xls','xlsx']) ? 'bg-green-100 dark:bg-green-900/30' : '' }}
                                {{ in_array($doc->file_type, ['ppt','pptx']) ? 'bg-orange-100 dark:bg-orange-900/30' : '' }}
                                {{ in_array($doc->file_type, ['zip','rar']) ? 'bg-yellow-100 dark:bg-yellow-900/30' : '' }}
                                {{ !in_array($doc->file_type, ['pdf','doc','docx','xls','xlsx','ppt','pptx','zip','rar']) ? 'bg-gray-100 dark:bg-gray-800' : '' }}
                            ">
                                @php
                                    $ext = strtolower($doc->file_type ?? '');
                                    $color = match(true) {
                                        $ext === 'pdf'              => 'text-red-600 dark:text-red-400',
                                        in_array($ext,['doc','docx']) => 'text-blue-600 dark:text-blue-400',
                                        in_array($ext,['xls','xlsx']) => 'text-green-600 dark:text-green-400',
                                        in_array($ext,['ppt','pptx']) => 'text-orange-600 dark:text-orange-400',
                                        in_array($ext,['zip','rar']) => 'text-yellow-600 dark:text-yellow-400',
                                        default => 'text-gray-500 dark:text-gray-400',
                                    };
                                @endphp
                                <span class="text-xl font-bold {{ $color }}">
                                    {{ strtoupper($ext ?: 'DOC') }}
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 dark:text-white text-sm leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ $doc->title }}
                                </h3>
                                @if($doc->description)
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">{{ $doc->description }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-100 dark:border-gray-800">
                            <div class="flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500">
                                @if($doc->file_size)
                                <span>{{ $doc->file_size }}</span>
                                @endif
                                @if(!$doc->is_public)
                                <span class="flex items-center gap-1 text-amber-600 dark:text-amber-500">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Login Diperlukan
                                </span>
                                @endif
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    {{ number_format($doc->download_count) }}x
                                </span>
                            </div>
                            <a href="{{ route('downloads.file', $doc) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Unduh
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    @endif
</div>
@endsection
