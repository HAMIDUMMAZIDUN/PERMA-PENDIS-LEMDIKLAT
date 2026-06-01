@extends('layouts.dashboard')
@section('title', 'Ubah Pengurus')
@section('page-title', 'Ubah Pengurus')
@section('page-subtitle', 'Perbarui informasi struktural dan data diri pengurus')

@section('content')
<div class="max-w-3xl space-y-6 animate-fade-in">
    <div class="flex items-center gap-3 border-b border-gray-100 pb-4 dark:border-emerald-950/20">
        <a href="{{ route('dashboard.board-members') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-xl hover:bg-gray-100 dark:hover:bg-emerald-950/30 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
    </div>

    <form action="{{ route('dashboard.board-members.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card p-8 space-y-6">
            {{-- Image / Profile Preview --}}
            <div class="flex items-center gap-4 p-5 rounded-2xl border border-gray-100 bg-gray-50/50 dark:border-emerald-950/20 dark:bg-[#080d0b]/40">
                @if($member->photo)
                    <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-16 h-16 object-cover shadow-md border-2 border-white dark:border-[#0c1410]" style="border-radius: 9999px !important;">
                @else
                    <div class="w-16 h-16 flex items-center justify-center text-white font-bold text-lg border-2 border-white dark:border-[#0c1410]"
                         style="background-color: #{{ $member->color }}; border-radius: 9999px !important;">
                        {{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('') }}
                    </div>
                @endif
                <div>
                    <h3 class="font-extrabold text-gray-800 dark:text-white">Pratinjau Profil Saat Ini</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500 font-medium">Gaya foto profil atau inisial nama saat ini.</p>
                </div>
            </div>

            <div>
                <label for="name" class="form-label">Nama Lengkap & Gelar <span class="text-red-500">*</span></label>
                <input id="name" name="name" type="text" value="{{ old('name', $member->name) }}" required
                       placeholder="Contoh: Prof. Dr. H. Badrudin, M.Ag."
                       class="form-input @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="form-label">Jabatan Struktural Organisasi <span class="text-red-500">*</span></label>
                <input id="role" name="role" type="text" value="{{ old('role', $member->role) }}" required
                       placeholder="Contoh: Ketua Dewan Pembina atau Anggota Eksekutif"
                       class="form-input @error('role') border-red-400 @enderror">
                @error('role')
                    <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category" class="form-label">Kategori Komponen Jabatan <span class="text-red-500">*</span></label>
                    <select id="category" name="category" required class="form-input">
                        <option value="Dewan Pembina" {{ old('category', $member->category) == 'Dewan Pembina' ? 'selected' : '' }}>Dewan Pembina</option>
                        <option value="Dewan Pengarah" {{ old('category', $member->category) == 'Dewan Pengarah' ? 'selected' : '' }}>Dewan Pengarah</option>
                        <option value="Direktur" {{ old('category', $member->category) == 'Direktur' ? 'selected' : '' }}>Direktur</option>
                        <option value="Wakil Direktur" {{ old('category', $member->category) == 'Wakil Direktur' ? 'selected' : '' }}>Wakil Direktur</option>
                        <option value="Sekretaris & Bendahara" {{ old('category', $member->category) == 'Sekretaris & Bendahara' ? 'selected' : '' }}>Sekretaris & Bendahara</option>
                        <option value="Kepala Bagian dan Unit" {{ old('category', $member->category) == 'Kepala Bagian dan Unit' ? 'selected' : '' }}>Kepala Bagian dan Unit</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="is_leader" class="form-label">Tingkat Kepemimpinan <span class="text-red-500">*</span></label>
                    <select id="is_leader" name="is_leader" required class="form-input">
                        <option value="0" {{ old('is_leader', $member->is_leader) == '0' ? 'selected' : '' }}>Anggota / Staf Biasa</option>
                        <option value="1" {{ old('is_leader', $member->is_leader) == '1' ? 'selected' : '' }}>Pimpinan Utama (Ketua / Direktur)</option>
                    </select>
                    @error('is_leader')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="color" class="form-label font-bold">Warna Latar Inisial Avatar (HEX tanpa #) <span class="text-red-500">*</span></label>
                    <input id="color" name="color" type="text" value="{{ old('color', $member->color) }}" required
                           placeholder="Contoh: 208457 (Emerald) atau cca43b (Gold)"
                           class="form-input font-mono @error('color') border-red-400 @enderror">
                    @error('color')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="form-label font-bold">Urutan Penampilan Urutan <span class="text-red-500">*</span></label>
                    <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $member->sort_order) }}" required min="0"
                           class="form-input font-mono @error('sort_order') border-red-400 @enderror">
                    @error('sort_order')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="photo_file" class="form-label">Ganti Foto Profil (Opsional)</label>
                <input id="photo_file" name="photo_file" type="file" accept="image/*" onchange="previewThumb(this)"
                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                <p class="text-gray-400 text-xs mt-2 font-medium">Format berkas didukung: PNG, JPG, JPEG dengan batas ukuran maksimal 500MB. Biarkan kosong jika tidak ingin mengubah foto profil.</p>
                @error('photo_file')
                    <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
                <div id="thumb-preview" class="hidden mt-4">
                    <img id="thumb-img" src="" alt="Preview" class="w-16 h-16 object-cover shadow-md border-2 border-white dark:border-[#0c1410]" style="border-radius: 9999px !important;">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('dashboard.board-members') }}" class="btn-secondary py-3 px-8 text-sm">Batal</a>
            <button type="submit" class="btn-primary py-3 px-8 text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
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
