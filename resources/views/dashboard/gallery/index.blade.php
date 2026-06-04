@extends('layouts.dashboard')
@section('title', 'Kelola Galeri Kegiatan')
@section('page-title', 'Kelola Galeri Kegiatan')
@section('page-subtitle', 'Buat, edit, dan kelola semua dokumentasi kegiatan')

@section('content')
<div class="space-y-6">

    {{-- Header Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Galeri</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total galeri terdaftar: {{ $galleries->total() }}</p>
        </div>
        <a href="{{ route('dashboard.gallery.create') }}" class="btn-primary whitespace-nowrap">
            Galeri Baru
        </a>
    </div>

    {{-- Gallery Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-900 dark:border-gray-800">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="table-head">Galeri</th>
                        <th class="table-head">Kategori</th>
                        <th class="table-head">Tanggal & Lokasi</th>
                        <th class="table-head">Media</th>
                        <th class="table-head">Status</th>
                        <th class="table-head text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleries as $gallery)
                    <tr class="table-row">
                        <td class="table-cell">
                            <div class="flex items-center gap-3">
                                @if($gallery->cover_image)
                                    <img src="{{ asset($gallery->cover_image) }}" alt="{{ $gallery->title }}"
                                         class="w-14 h-10 rounded-lg object-cover flex-shrink-0 border border-gray-100 dark:border-gray-800">
                                @else
                                    <div class="w-14 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center flex-shrink-0 border border-gray-100 dark:border-gray-800 text-gray-400 text-xs">
                                        Cover
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm line-clamp-1 max-w-xs dark:text-white" title="{{ $gallery->title }}">{{ $gallery->title }}</p>
                                    @if($gallery->is_featured)
                                        <span class="inline-flex items-center gap-0.5 text-[10px] font-semibold text-amber-600 bg-amber-50 dark:text-amber-400 dark:bg-amber-950/30 px-1.5 py-0.2 rounded mt-0.5">
                                            ⭐ Unggulan
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="table-cell">
                            @if($gallery->category)
                                <span class="badge-primary text-xs">{{ $gallery->category->name }}</span>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            <div class="text-xs text-gray-900 dark:text-white">
                                {{ $gallery->event_date ? $gallery->event_date->translatedFormat('d M Y') : '-' }}
                            </div>
                            <div class="text-[11px] text-gray-400 max-w-xs truncate" title="{{ $gallery->location }}">
                                {{ $gallery->location ?: '-' }}
                            </div>
                        </td>
                        <td class="table-cell">
                            <span class="inline-flex items-center gap-1 text-xs text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-800 px-2 py-1 rounded-md">
                                📷 {{ $gallery->items->count() }} Foto
                            </span>
                        </td>
                        <td class="table-cell">
                            @if($gallery->is_published)
                                <span class="badge-success">Terbit</span>
                            @else
                                <span class="badge bg-gray-150 text-gray-600 dark:bg-gray-800/40 dark:text-gray-400">Draft</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('gallery.show', $gallery->slug) }}" target="_blank"
                                   class="p-2 text-gray-500 hover:text-primary-750 hover:bg-primary-50 rounded-lg transition dark:text-gray-400 dark:hover:bg-gray-800 flex items-center justify-center" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('dashboard.gallery.edit', $gallery->id) }}"
                                   class="p-2 text-gray-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition dark:text-gray-400 dark:hover:bg-gray-800 flex items-center justify-center" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('dashboard.gallery.destroy', $gallery->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini dan seluruh foto di dalamnya?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-500 hover:text-red-650 hover:bg-red-50 rounded-lg transition dark:text-gray-400 dark:hover:bg-gray-800 flex items-center justify-center" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <p class="text-gray-400 font-medium">Belum ada galeri kegiatan</p>
                            <a href="{{ route('dashboard.gallery.create') }}" class="btn-primary mt-4 inline-block text-sm">Buat Galeri Pertama</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($galleries->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
            {{ $galleries->withQueryString()->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>

    <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan {{ $galleries->count() }} dari {{ $galleries->total() }} galeri</p>
</div>
@endsection
