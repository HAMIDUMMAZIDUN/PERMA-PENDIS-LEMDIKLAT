@extends('layouts.dashboard')
@section('title', 'Download Center')
@section('page-title', 'Download Center')
@section('page-subtitle', 'Unggah dan kelola berkas, dokumen, serta formulir unduhan')

@section('content')
<div class="space-y-6">

    {{-- Header Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Dokumen</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total dokumen terdaftar: {{ count($downloads) }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('dashboard.downloads.categories') }}" class="btn-secondary whitespace-nowrap">
                📂 Kelola Kategori
            </a>
            <a href="{{ route('dashboard.downloads.create') }}" class="btn-primary whitespace-nowrap">
                Unggah Dokumen
            </a>
        </div>
    </div>

    {{-- Downloads Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-900 dark:border-gray-800">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="table-head">Judul / Dokumen</th>
                        <th class="table-head">Kategori</th>
                        <th class="table-head">Akses</th>
                        <th class="table-head">Ukuran</th>
                        <th class="table-head">Unduhan</th>
                        <th class="table-head text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($downloads as $download)
                    <tr class="table-row">
                        <td class="table-cell">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-950/30 flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-400 font-bold uppercase text-xs">
                                    {{ $download->file_type }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900 text-sm truncate max-w-xs dark:text-white" title="{{ $download->title }}">{{ $download->title }}</p>
                                    <p class="text-xs text-gray-400 truncate max-w-xs" title="{{ $download->file_name }}">{{ $download->file_name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="table-cell">
                            @if($download->category)
                                <span class="badge-primary text-xs">{{ $download->category->name }}</span>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            @if($download->is_public)
                                <span class="inline-flex items-center gap-1 text-xs text-emerald-600 bg-emerald-50 dark:text-emerald-400 dark:bg-emerald-950/30 px-2 py-0.5 rounded-full font-medium">
                                    🔓 Publik
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs text-blue-600 bg-blue-50 dark:text-blue-400 dark:bg-blue-950/30 px-2 py-0.5 rounded-full font-medium">
                                    🔒 Anggota
                                </span>
                            @endif
                        </td>
                        <td class="table-cell text-xs text-gray-500 dark:text-gray-400">
                            {{ $download->file_size }}
                        </td>
                        <td class="table-cell text-xs text-gray-900 dark:text-white font-medium">
                            📥 {{ $download->download_count }} kali
                        </td>
                        <td class="table-cell">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('downloads.file', $download) }}"
                                   class="p-2 text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition dark:text-gray-400 dark:hover:bg-gray-800 flex items-center justify-center" title="Unduh File">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                                <a href="{{ route('dashboard.downloads.edit', $download->id) }}"
                                   class="p-2 text-gray-500 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition dark:text-gray-400 dark:hover:bg-gray-800 flex items-center justify-center" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('dashboard.downloads.destroy', $download->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas ini?')" class="inline">
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
                            <p class="text-gray-400 font-medium">Belum ada berkas unduhan</p>
                            <a href="{{ route('dashboard.downloads.create') }}" class="btn-primary mt-4 inline-block text-sm">Unggah Dokumen Pertama</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
