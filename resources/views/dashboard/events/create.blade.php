@extends('layouts.dashboard')
@section('title', 'Buat Agenda Baru')
@section('page-title', 'Buat Agenda Baru')
@section('page-subtitle', 'Buat agenda atau event organisasi baru')

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

        <form action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="form-label">Judul Agenda <span class="text-red-500">*</span></label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required
                       class="form-input" placeholder="Masukkan judul agenda atau event">
            </div>

            {{-- Type, Start Date, End Date --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="type" class="form-label">Tipe Kegiatan <span class="text-red-500">*</span></label>
                    <select id="type" name="type" required class="form-input">
                        <option value="">Pilih Tipe</option>
                        <option value="rapat" {{ old('type') == 'rapat' ? 'selected' : '' }}>Rapat</option>
                        <option value="seminar" {{ old('type') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                        <option value="pelatihan" {{ old('type') == 'pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                        <option value="webinar" {{ old('type') == 'webinar' ? 'selected' : '' }}>Webinar</option>
                        <option value="musyawarah" {{ old('type') == 'musyawarah' ? 'selected' : '' }}>Musyawarah</option>
                        <option value="lainnya" {{ old('type') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label for="start_date" class="form-label">Waktu Mulai <span class="text-red-500">*</span></label>
                    <input id="start_date" name="start_date" type="datetime-local" value="{{ old('start_date') }}" required
                           class="form-input">
                </div>
                <div>
                    <label for="end_date" class="form-label">Waktu Selesai</label>
                    <input id="end_date" name="end_date" type="datetime-local" value="{{ old('end_date') }}"
                           class="form-input">
                </div>
            </div>

            {{-- Location & Contact Person --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="location" class="form-label">Lokasi Kegiatan</label>
                    <input id="location" name="location" type="text" value="{{ old('location') }}"
                           class="form-input" placeholder="Contoh: Zoom / Gedung Aula Rektorat">
                </div>
                <div>
                    <label for="contact_person" class="form-label">Narahubung (Contact Person)</label>
                    <input id="contact_person" name="contact_person" type="text" value="{{ old('contact_person') }}"
                           class="form-input" placeholder="Contoh: Budi (0812-3456-7890)">
                </div>
            </div>

            {{-- Registration URL --}}
            <div>
                <label for="registration_url" class="form-label">Link Pendaftaran (Opsional)</label>
                <input id="registration_url" name="registration_url" type="url" value="{{ old('registration_url') }}"
                       class="form-input" placeholder="https://example.com/daftar">
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="form-label">Deskripsi Agenda</label>
                <textarea id="description" name="description" rows="8"
                          class="form-input font-mono text-sm"
                          placeholder="Tulis rincian, rundown, atau informasi lengkap agenda di sini...">{{ old('description') }}</textarea>
            </div>

            {{-- Cover Image --}}
            <div>
                <label for="cover_image" class="form-label">Foto/Poster Agenda</label>
                <input id="cover_image" name="cover_image" type="file" accept="image/*"
                       class="form-input" onchange="previewCover(this)">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WebP • Maks. 5MB</p>
                <div id="cover-preview" class="hidden mt-3">
                    <img id="cover-img" src="" alt="Preview" class="max-h-48 rounded-xl object-cover border border-gray-200 dark:border-gray-800">
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
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tampilkan sebagai Agenda Utama</span>
                </label>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">
                    Simpan Agenda
                </button>
                <a href="{{ route('dashboard.events') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    CKEDITOR.replace('description', {
        height: 250,
        removeButtons: 'PasteFromWord,Image',
        language: 'id',
    });

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
</script>
@endsection
