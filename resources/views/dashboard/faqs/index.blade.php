@extends('layouts.dashboard')
@section('title', 'Kelola FAQ')
@section('page-title', 'Kelola FAQ')
@section('page-subtitle', 'Buat, edit, dan kelola semua Pertanyaan yang Sering Diajukan (FAQ)')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    @php
        $editingFaq = null;
        if (request()->filled('edit')) {
            $editingFaq = \App\Models\Faq::find(request('edit'));
        }
    @endphp

    {{-- Form Tambah/Edit FAQ --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 dark:bg-gray-900 dark:border-gray-800 sticky top-24">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">
                {{ $editingFaq ? 'Edit Pertanyaan' : 'Tambah Pertanyaan Baru' }}
            </h3>

            @if($errors->any())
            <div class="alert-error mb-4">
                <ul class="text-xs list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form action="{{ $editingFaq ? route('dashboard.faqs.update', $editingFaq) : route('dashboard.faqs.store') }}" method="POST" class="space-y-4">
                @csrf
                @if($editingFaq)
                    @method('PUT')
                @endif

                <div>
                    <label for="category" class="form-label text-xs">Kategori FAQ</label>
                    <input id="category" name="category" type="text" value="{{ old('category', $editingFaq ? $editingFaq->category : 'Umum') }}"
                           class="form-input text-sm" placeholder="Contoh: Keanggotaan / Program">
                </div>

                <div>
                    <label for="question" class="form-label text-xs">Pertanyaan <span class="text-red-500">*</span></label>
                    <textarea id="question" name="question" rows="3" required class="form-input text-sm"
                              placeholder="Masukkan pertanyaan...">{{ old('question', $editingFaq ? $editingFaq->question : '') }}</textarea>
                </div>

                <div>
                    <label for="answer" class="form-label text-xs">Jawaban <span class="text-red-500">*</span></label>
                    <textarea id="answer" name="answer" rows="6" required class="form-input text-sm"
                              placeholder="Masukkan jawaban...">{{ old('answer', $editingFaq ? $editingFaq->answer : '') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="sort_order" class="form-label text-xs">Urutan</label>
                        <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $editingFaq ? $editingFaq->sort_order : 0) }}"
                               class="form-input text-sm">
                    </div>
                    <div class="flex items-end pb-3">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="is_active" value="1" id="is_active"
                                   {{ old('is_active', $editingFaq ? $editingFaq->is_active : true) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:bg-gray-800 dark:border-gray-700">
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn-primary flex-1 py-2.5">
                        {{ $editingFaq ? 'Perbarui FAQ' : 'Simpan FAQ' }}
                    </button>
                    @if($editingFaq)
                        <a href="{{ route('dashboard.faqs') }}" class="btn-secondary py-2.5 text-center">
                            Batal
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar FAQ --}}
    <div class="lg:col-span-2 space-y-6">
        @if(count($faqs) === 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center dark:bg-gray-900 dark:border-gray-800">
                <span class="text-4xl">❓</span>
                <p class="text-gray-400 font-medium mt-3">Belum ada daftar FAQ.</p>
            </div>
        @else
            @php
                $grouped = $faqs->groupBy('category');
            @endphp

            @foreach($grouped as $category => $items)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-900 dark:border-gray-800">
                <div class="bg-gray-50/50 px-6 py-3 border-b border-gray-100 dark:bg-gray-800/40 dark:border-gray-800">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $category ?: 'Umum' }}</h4>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-850">
                    @foreach($items as $faq)
                    <div class="p-6 space-y-3 relative group {{ $editingFaq && $editingFaq->id == $faq->id ? 'bg-primary-50/10 dark:bg-primary-950/10' : '' }}">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block mb-1">Urutan: {{ $faq->sort_order }}</span>
                                <h5 class="font-semibold text-gray-900 text-sm dark:text-white flex items-center gap-2">
                                    {{ $faq->question }}
                                    @if(!$faq->is_active)
                                        <span class="px-1.5 py-0.2 text-[9px] font-semibold text-gray-500 bg-gray-100 rounded dark:bg-gray-800 dark:text-gray-400">Nonaktif</span>
                                    @endif
                                </h5>
                            </div>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('dashboard.faqs', ['edit' => $faq->id]) }}"
                                   class="p-1.5 text-gray-500 hover:text-teal-700 hover:bg-teal-50 rounded transition dark:text-gray-400 dark:hover:bg-gray-800" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('dashboard.faqs.destroy', $faq->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-500 hover:text-red-650 hover:bg-red-50 rounded transition dark:text-gray-400 dark:hover:bg-gray-800" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed dark:text-gray-400">
                            {{ $faq->answer }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        @endif
    </div>

</div>
@endsection
