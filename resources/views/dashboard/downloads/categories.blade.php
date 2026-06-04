@extends('layouts.dashboard')
@section('title', 'Kategori Dokumen')
@section('page-title', 'Kategori Dokumen')
@section('page-subtitle', 'Kelola kategori klasifikasi berkas unduhan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Form Tambah Kategori --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 dark:bg-gray-900 dark:border-gray-800">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Kategori Baru</h3>

            <form action="{{ route('dashboard.downloads.categories.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="form-label">Nama Kategori <span class="text-red-500">*</span></label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                           class="form-input text-sm" placeholder="Contoh: Formulir Pendaftaran">
                </div>

                <div>
                    <label for="icon" class="form-label">Ikon / Emoji</label>
                    <input id="icon" name="icon" type="text" value="{{ old('icon', '📄') }}"
                           class="form-input text-sm" placeholder="Contoh: 📄 / 📂">
                </div>

                <div>
                    <label for="sort_order" class="form-label">Urutan Tampilan</label>
                    <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', 0) }}"
                           class="form-input text-sm" placeholder="0">
                </div>

                <div>
                    <label for="description" class="form-label">Keterangan</label>
                    <textarea id="description" name="description" rows="3" class="form-input text-sm"
                              placeholder="Keterangan singkat..."></textarea>
                </div>

                <button type="submit" class="btn-primary w-full py-2.5">
                    Simpan Kategori
                </button>
            </form>
        </div>
    </div>

    {{-- Daftar Kategori --}}
    <div class="lg:col-span-2 space-y-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-900 dark:border-gray-800">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="table-head w-16 text-center">Ikon</th>
                        <th class="table-head">Nama Kategori / Deskripsi</th>
                        <th class="table-head w-24 text-center">Dokumen</th>
                        <th class="table-head w-20 text-center">Urutan</th>
                        <th class="table-head w-16 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr class="table-row">
                        <td class="table-cell text-center text-xl">
                            {{ $cat->icon ?: '📄' }}
                        </td>
                        <td class="table-cell">
                            <span class="font-semibold text-gray-900 text-sm block dark:text-white">{{ $cat->name }}</span>
                            <span class="text-xs text-gray-400 block max-w-sm truncate" title="{{ $cat->description }}">{{ $cat->description ?: 'Tidak ada keterangan.' }}</span>
                        </td>
                        <td class="table-cell text-center">
                            <span class="inline-flex items-center justify-center bg-gray-50 text-gray-700 dark:bg-gray-800 dark:text-gray-300 px-2 py-0.5 rounded text-xs font-semibold">
                                {{ $cat->downloads_count }} berkas
                            </span>
                        </td>
                        <td class="table-cell text-center text-xs text-gray-500 dark:text-gray-400">
                            {{ $cat->sort_order }}
                        </td>
                        <td class="table-cell text-right">
                            <form action="{{ route('dashboard.downloads.categories.destroy', $cat->id) }}" method="POST"
                                  onsubmit="return confirm('PENTING: Menghapus kategori ini juga akan menghapus seluruh file dokumen yang berkaitan! Anda yakin?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-gray-500 hover:text-red-650 hover:bg-red-50 rounded-lg transition dark:text-gray-400 dark:hover:bg-gray-800 flex items-center justify-center inline-block" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            Belum ada kategori dokumen.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{ route('dashboard.downloads') }}" class="btn-secondary text-xs inline-block">
            ← Kembali ke Download Center
        </a>
    </div>

</div>
@endsection
