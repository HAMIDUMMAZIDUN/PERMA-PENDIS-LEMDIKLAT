@extends('layouts.dashboard')
@section('title', 'Kelola Artikel')
@section('page-title', 'Kelola Artikel')
@section('page-subtitle', 'Buat, edit, dan kelola semua artikel')

@section('content')
<div class="space-y-6">

    {{-- Header + New Button --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <form method="GET" action="{{ route('dashboard.articles') }}" class="flex gap-3 flex-1 max-w-lg">
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Cari artikel..." class="form-input flex-1">
            <button type="submit" class="btn-primary px-5">Cari</button>
        </form>
        <a href="{{ route('dashboard.articles.create') }}" class="btn-primary whitespace-nowrap">
            
            Artikel Baru
        </a>
    </div>

    {{-- Articles Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-900 dark:border-gray-800">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="table-head">Artikel</th>
                        <th class="table-head">Kategori</th>
                        <th class="table-head">Status</th>
                        <th class="table-head">Tanggal</th>
                        <th class="table-head text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr class="table-row">
                        <td class="table-cell">
                            <div class="flex items-center gap-3">
                                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                     class="w-14 h-10 rounded-lg object-cover flex-shrink-0">
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm line-clamp-1 max-w-xs dark:text-white">{{ $article->title }}</p>
                                    <p class="text-xs text-gray-400">{{ $article->author }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="table-cell">
                            @if($article->category)
                                <span class="badge-primary text-xs">{{ $article->category->name }}</span>
                            @else
                                <span class="text-gray-300 text-xs">-</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            @if($article->is_published)
                                <span class="badge-success">Terbit</span>
                            @else
                                <span class="badge bg-gray-100 text-gray-600 dark:bg-gray-800/40 dark:text-gray-400">Draft</span>
                            @endif
                        </td>
                        <td class="table-cell text-xs text-gray-500 dark:text-gray-400">{{ $article->updated_at->locale('id')->isoFormat('D MMM YYYY') }}</td>
                        <td class="table-cell">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                                   class="p-2 text-gray-500 hover:text-primary-700 hover:bg-primary-50 rounded-lg transition dark:text-gray-400" title="Lihat">
                                    
                                </a>
                                <a href="{{ route('dashboard.articles.edit', $article->id) }}"
                                   class="p-2 text-gray-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition dark:text-gray-400" title="Edit">
                                    
                                </a>
                                <form action="{{ route('dashboard.articles.destroy', $article->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition dark:text-gray-400" title="Hapus">
                                        
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            
                            <p class="text-gray-400 font-medium">Belum ada artikel</p>
                            <a href="{{ route('dashboard.articles.create') }}" class="btn-primary mt-4 text-sm">Buat Artikel Pertama</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($articles->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
            {{ $articles->withQueryString()->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>

    <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan {{ $articles->count() }} dari {{ $articles->total() }} artikel</p>
</div>
@endsection
