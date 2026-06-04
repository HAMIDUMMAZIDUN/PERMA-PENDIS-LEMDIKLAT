@extends('layouts.dashboard')
@section('title', 'Edit Dokumen')
@section('page-title', 'Edit Dokumen')
@section('page-subtitle', 'Perbarui detail atau file berkas unduhan')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 dark:bg-gray-900 dark:border-gray-800">

        @if($errors->any())
        <div class="alert-error mb-6">
            <p class="font-medium mb-2">Terdapat kesalahan:</p>
            <ul class="text-sm list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('dashboard.downloads.update', $download->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="form-label">Nama / Judul Dokumen <span class="text-red-500">*</span></label>
                <input id="title" name="title" type="text" value="{{ old('title', $download->title) }}" required
                       class="form-input" placeholder="Masukkan nama atau judul dokumen">
            </div>

            {{-- Category & Sort Order --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="download_category_id" class="form-label">Kategori Dokumen <span class="text-red-500">*</span></label>
                    <select id="download_category_id" name="download_category_id" required class="form-input">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('download_category_id', $download->download_category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="sort_order" class="form-label">Urutan Tampilan</label>
                    <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $download->sort_order) }}"
                           class="form-input" placeholder="0">
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="form-label">Keterangan / Deskripsi Dokumen</label>
                <textarea id="description" name="description" rows="4" class="form-input"
                          placeholder="Masukkan keterangan singkat mengenai dokumen ini...">{{ old('description', $download->description) }}</textarea>
            </div>

            {{-- File Upload --}}
            <div>
                <label for="file" class="form-label">Ganti Berkas (Opsional)</label>
                <div class="mb-3 p-3 bg-gray-50 border border-gray-150 rounded-xl flex items-center justify-between dark:bg-gray-800/40 dark:border-gray-800">
                    <div class="min-w-0">
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Berkas Saat Ini</p>
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 truncate" title="{{ $download->file_name }}">{{ $download->file_name }}</p>
                        <p class="text-xs text-gray-500">{{ $download->file_size }} • {{ strtoupper($download->file_type) }}</p>
                    </div>
                    <a href="{{ route('downloads.file', $download) }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 bg-white px-3 py-1.5 rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        Download File
                    </a>
                </div>
                <input id="file" name="file" type="file"
                       class="form-input" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,image/*">
                <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti file. Maksimal 50MB.</p>
            </div>

            {{-- Access Switches --}}
            <div class="flex items-center gap-3 py-4 border-y border-gray-150 dark:border-gray-800">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="is_public" value="1" id="is_public"
                           {{ old('is_public', $download->is_public) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-700">
                    <div>
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 block">Dokumen Publik</span>
                        <span class="text-xs text-gray-400 block font-normal">Dapat diunduh oleh siapa saja tanpa perlu masuk/login.</span>
                    </div>
                </label>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard.downloads') }}" class="btn-secondary">Batal</a>

                <button type="button" class="btn-danger ml-auto" onclick="if(confirm('Hapus berkas unduhan ini?')) document.getElementById('delete-download-form').submit();">
                    Hapus Dokumen
                </button>
            </div>
        </form>

        <form id="delete-download-form" action="{{ route('dashboard.downloads.destroy', $download->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection
