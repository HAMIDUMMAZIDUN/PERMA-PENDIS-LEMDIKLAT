@extends('layouts.dashboard')
@section('title', 'Edit Galeri')
@section('page-title', 'Edit Galeri')
@section('page-subtitle', 'Perbarui detail galeri dan dokumentasi kegiatan')

@section('content')
<div class="max-w-4xl space-y-8">
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

        <form action="{{ route('dashboard.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="form-label">Judul Kegiatan <span class="text-red-500">*</span></label>
                <input id="title" name="title" type="text" value="{{ old('title', $gallery->title) }}" required
                       class="form-input" placeholder="Masukkan judul kegiatan">
            </div>

            {{-- Category, Date, Location --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="gallery_category_id" class="form-label">Kategori</label>
                    <select id="gallery_category_id" name="gallery_category_id" class="form-input">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('gallery_category_id', $gallery->gallery_category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="event_date" class="form-label">Tanggal Kegiatan</label>
                    <input id="event_date" name="event_date" type="date" value="{{ old('event_date', $gallery->event_date ? $gallery->event_date->format('Y-m-d') : '') }}"
                           class="form-input">
                </div>
                <div>
                    <label for="location" class="form-label">Lokasi</label>
                    <input id="location" name="location" type="text" value="{{ old('location', $gallery->location) }}"
                           class="form-input" placeholder="Contoh: Jakarta / Gedung Aula">
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="form-input"
                          placeholder="Masukkan ringkasan atau keterangan kegiatan...">{{ old('description', $gallery->description) }}</textarea>
            </div>

            {{-- Cover Image --}}
            <div>
                <label for="cover_image" class="form-label">Foto Sampul (Cover Image)</label>
                @if($gallery->cover_image)
                <div class="mb-3">
                    <img src="{{ asset($gallery->cover_image) }}" alt="Cover" class="h-40 rounded-xl object-cover border border-gray-200 dark:border-gray-800">
                    <p class="text-xs text-gray-400 mt-1 font-medium">Cover saat ini. Upload file baru di bawah jika ingin menggantinya.</p>
                </div>
                @endif
                <input id="cover_image" name="cover_image" type="file" accept="image/*"
                       class="form-input" onchange="previewCover(this)">
                <div id="cover-preview" class="hidden mt-3">
                    <img id="cover-img" src="" alt="Preview" class="max-h-48 rounded-xl object-cover border border-gray-200 dark:border-gray-800">
                </div>
            </div>

            {{-- Switch: Published & Featured --}}
            <div class="flex flex-wrap items-center gap-6 py-4 border-y border-gray-150 dark:border-gray-800">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="is_published" value="1" id="is_published"
                           {{ old('is_published', $gallery->is_published) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-700">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Terbitkan kegiatan ini</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured"
                           {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-700">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tampilkan sebagai Galeri Unggulan</span>
                </label>
            </div>

            {{-- Upload New Photos --}}
            <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100 dark:bg-gray-900/40 dark:border-gray-800 space-y-4">
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Tambah Foto Baru</h3>
                    <p class="text-xs text-gray-400">Pilih satu atau beberapa foto tambahan untuk ditambahkan ke galeri ini.</p>
                </div>

                <div class="relative flex items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-8 hover:border-primary-500 transition-colors cursor-pointer dark:border-gray-700 dark:hover:border-primary-750" id="drop-zone">
                    <input type="file" id="photos-input" name="photos[]" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="text-center space-y-2 pointer-events-none">
                        <span class="text-3xl">📥</span>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Klik atau seret file baru ke sini</p>
                    </div>
                </div>

                {{-- New Photo Previews --}}
                <div id="photos-preview-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6 hidden">
                    <!-- Dynamic preview cards go here -->
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3 pt-4 border-t border-gray-150 dark:border-gray-800">
                <button type="submit" class="btn-primary">
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard.gallery') }}" class="btn-secondary">Batal</a>

                <button type="button" class="btn-danger ml-auto" onclick="if(confirm('Hapus seluruh galeri ini beserta fotonya?')) document.getElementById('delete-gallery-form').submit();">
                    Hapus Galeri
                </button>
            </div>
        </form>

        <form id="delete-gallery-form" action="{{ route('dashboard.gallery.destroy', $gallery->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    {{-- Current Photos List --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 dark:bg-gray-900 dark:border-gray-800">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Foto Saat Ini</h3>
        <p class="text-xs text-gray-400 mb-6">Berikut adalah foto-foto yang ada di dalam galeri ini. Anda dapat menghapusnya jika diperlukan.</p>

        @if($gallery->items->isEmpty())
            <div class="text-center py-10 border border-dashed border-gray-200 dark:border-gray-800 rounded-xl">
                <p class="text-gray-400 text-sm">Belum ada foto tambahan di galeri ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($gallery->items as $item)
                <div class="bg-gray-50 border border-gray-150 rounded-xl p-3 flex flex-col justify-between dark:bg-gray-800/40 dark:border-gray-800 group">
                    <div class="space-y-2">
                        <div class="relative aspect-video rounded-lg overflow-hidden bg-black/5">
                            <img src="{{ asset($item->file_path) }}" class="w-full h-full object-cover">
                        </div>
                        <p class="text-xs text-gray-700 dark:text-gray-300 italic min-h-[1.5rem] px-1 line-clamp-2">
                            {{ $item->caption ?: 'Tidak ada keterangan.' }}
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-gray-150 dark:border-gray-700 flex items-center justify-between">
                        <span class="text-[10px] text-gray-400 font-medium uppercase tracking-wider">Foto #{{ $loop->iteration }}</span>
                        
                        <form action="{{ route('dashboard.gallery.item.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-semibold flex items-center gap-1 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    function previewCover(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('cover-img').src = e.target.result;
                document.getElementById('cover-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    const photosInput = document.getElementById('photos-input');
    const container = document.getElementById('photos-preview-container');
    const dropZone = document.getElementById('drop-zone');

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, e => {
            e.preventDefault();
            dropZone.classList.add('border-primary-500', 'bg-primary-50/20');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, e => {
            e.preventDefault();
            dropZone.classList.remove('border-primary-500', 'bg-primary-50/20');
        }, false);
    });

    photosInput.addEventListener('change', function() {
        container.innerHTML = '';
        if (this.files && this.files.length > 0) {
            container.classList.remove('hidden');
            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = e => {
                    const card = document.createElement('div');
                    card.className = 'bg-gray-50 border border-gray-200 rounded-xl p-3 flex flex-col gap-2.5 dark:bg-gray-800/40 dark:border-gray-800';
                    card.innerHTML = `
                        <div class="relative aspect-video rounded-lg overflow-hidden bg-black/5">
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[10px] px-1.5 py-0.5 rounded backdrop-blur-sm">
                                Foto Baru ${index + 1}
                            </span>
                        </div>
                        <div>
                            <label class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider block mb-1">Keterangan Foto</label>
                            <input type="text" name="captions[${index}]" class="form-input text-xs py-1 px-2.5 rounded-lg" placeholder="Tulis caption (opsional)...">
                        </div>
                    `;
                    container.appendChild(card);
                };
                reader.readAsDataURL(file);
            });
        } else {
            container.classList.add('hidden');
        }
    });
</script>
@endsection
