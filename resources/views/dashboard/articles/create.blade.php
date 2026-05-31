@extends('layouts.dashboard')
@section('title', 'Buat Artikel Baru')
@section('page-title', 'Buat Artikel Baru')
@section('page-subtitle', 'Tulis dan terbitkan artikel baru')

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

        <form action="{{ route('dashboard.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="form-label">Judul Artikel <span class="text-red-500">*</span></label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required
                       class="form-input" placeholder="Masukkan judul artikel">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="author" class="form-label">Penulis <span class="text-red-500">*</span></label>
                    <input id="author" name="author" type="text" value="{{ old('author', auth()->user()->display_name) }}" required
                           class="form-input" placeholder="Nama penulis">
                </div>
                <div>
                    <label for="category_id" class="form-label">Kategori</label>
                    <select id="category_id" name="category_id" class="form-input">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="thumbnail" class="form-label">Thumbnail Artikel</label>
                <input id="thumbnail" name="thumbnail" type="file" accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="form-input" onchange="previewThumb(this)">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WebP • Maks. 500MB</p>
                <div id="thumb-preview" class="hidden mt-3">
                    <img id="thumb-img" src="" alt="Preview" class="max-h-48 rounded-xl object-cover border border-gray-200 dark:border-gray-800">
                </div>
            </div>

            <div>
                <label for="content" class="form-label">Isi Artikel <span class="text-red-500">*</span></label>
                <textarea id="content" name="content" rows="14"
                          class="form-input font-mono text-sm"
                          placeholder="Tulis konten artikel di sini...">{{ old('content') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Mendukung HTML dan formatting kaya.</p>
            </div>

            <div class="flex items-center gap-3 py-4 border-t border-gray-100 dark:border-gray-800">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <div class="relative">
                        <input type="checkbox" name="is_published" value="1" id="is_published"
                               {{ old('is_published') ? 'checked' : '' }}
                               class="sr-only peer">
                        
                        
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Terbitkan sekarang</span>
                </label>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">
                    
                    Simpan Artikel
                </button>
                <a href="{{ route('dashboard.articles') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    CKEDITOR.replace('content', {
        height: 400,
        removeButtons: 'PasteFromWord,Image', // remove buttons that might not be fully configured/needed
        language: 'id',
    });

    function previewThumb(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('thumb-img').src = e.target.result;
                document.getElementById('thumb-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
