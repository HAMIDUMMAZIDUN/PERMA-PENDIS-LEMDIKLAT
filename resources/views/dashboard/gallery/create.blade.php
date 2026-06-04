@extends('layouts.dashboard')
@section('title', 'Buat Galeri Baru')
@section('page-title', 'Buat Galeri Baru')
@section('page-subtitle', 'Buat dokumentasi kegiatan baru beserta galeri fotonya')

@section('content')
<div class="max-w-4xl">
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

        <form action="{{ route('dashboard.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="form-label">Judul Kegiatan <span class="text-red-500">*</span></label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required
                       class="form-input" placeholder="Masukkan judul kegiatan">
            </div>

            {{-- Category, Date, Location --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="gallery_category_id" class="form-label">Kategori</label>
                    <select id="gallery_category_id" name="gallery_category_id" class="form-input">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('gallery_category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="event_date" class="form-label">Tanggal Kegiatan</label>
                    <input id="event_date" name="event_date" type="date" value="{{ old('event_date') }}"
                           class="form-input">
                </div>
                <div>
                    <label for="location" class="form-label">Lokasi</label>
                    <input id="location" name="location" type="text" value="{{ old('location') }}"
                           class="form-input" placeholder="Contoh: Jakarta / Gedung Aula">
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="form-label">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="form-input"
                          placeholder="Masukkan ringkasan atau keterangan kegiatan...">{{ old('description') }}</textarea>
            </div>

            {{-- Cover Image --}}
            <div>
                <label for="cover_image" class="form-label">Foto Sampul (Cover Image)</label>
                <input id="cover_image" name="cover_image" type="file" accept="image/*"
                       class="form-input" onchange="previewCover(this)">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WebP • Maks. 5MB</p>
                <div id="cover-preview" class="hidden mt-3">
                    <img id="cover-img" src="" alt="Preview" class="max-h-48 rounded-xl object-cover border border-gray-200 dark:border-gray-800">
                </div>
            </div>

            {{-- Multi Photo Uploads --}}
            <div class="border-t border-gray-150 pt-6 dark:border-gray-800">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">Upload Foto Dokumentasi</h3>
                <p class="text-xs text-gray-400 mb-4">Pilih satu atau beberapa foto kegiatan yang ingin disertakan.</p>

                <div class="relative flex items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-8 hover:border-primary-500 transition-colors cursor-pointer dark:border-gray-700 dark:hover:border-primary-750" id="drop-zone">
                    <input type="file" id="photos-input" name="photos[]" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="text-center space-y-2 pointer-events-none">
                        <span class="text-4xl">📸</span>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Klik atau seret file ke sini untuk mengupload</p>
                        <p class="text-xs text-gray-400">Mendukung format gambar (JPG, PNG, WebP, dll)</p>
                    </div>
                </div>

                {{-- Photo List Preview --}}
                <div id="photos-preview-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6 hidden">
                    <!-- Dynamic preview cards go here -->
                </div>
            </div>

            {{-- Switches: Published / Featured --}}
            <div class="flex flex-wrap items-center gap-6 py-4 border-y border-gray-150 dark:border-gray-800">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="is_published" value="1" id="is_published" checked
                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-700">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Terbitkan langsung</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured"
                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-700">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tampilkan sebagai Galeri Unggulan</span>
                </label>
            </div>

            {{-- Submit and Cancel --}}
            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">
                    Simpan Galeri
                </button>
                <a href="{{ route('dashboard.gallery') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
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
                                Foto ${index + 1}
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
