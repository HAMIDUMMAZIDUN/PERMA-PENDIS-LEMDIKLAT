@extends('layouts.dashboard')
@section('title', 'Ubah Pengurus')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-3 border-b border-gray-100 pb-4 dark:border-gray-800">
        <a href="{{ route('dashboard.board-members') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-primary-900 dark:text-white">Ubah Data Pengurus</h1>
            <p class="text-gray-500 text-sm mt-1 dark:text-gray-400 font-medium">Perbarui informasi jabatan atau profil pengurus.</p>
        </div>
    </div>

    <form action="{{ route('dashboard.board-members.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card space-y-5">
            {{-- Image / Profile Preview --}}
            <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-gray-50/50 dark:border-gray-800 dark:bg-gray-900/30">
                @if($member->photo)
                    <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-16 h-16 rounded-full object-cover shadow-sm border border-slate-200 dark:border-gray-800">
                @else
                    <div class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-lg"
                         style="background-color: #{{ $member->color }};">
                        {{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('') }}
                    </div>
                @endif
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-white">Preview Tampilan Profil</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500">Gaya foto profil atau inisial nama saat ini.</p>
                </div>
            </div>

            <div>
                <label for="name" class="form-label">Nama Lengkap & Gelar</label>
                <input id="name" name="name" type="text" value="{{ old('name', $member->name) }}" required
                       placeholder="Contoh: Prof. Dr. H. Badrudin"
                       class="form-input @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="form-label">Jabatan Organisasi</label>
                <input id="role" name="role" type="text" value="{{ old('role', $member->role) }}" required
                       placeholder="Contoh: Ketua Dewan Pembina atau Anggota Dewan Pembina"
                       class="form-input @error('role') border-red-400 @enderror">
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="category" class="form-label">Kategori Jabatan</label>
                    <select id="category" name="category" required class="form-input">
                        <option value="Dewan Pembina" {{ old('category', $member->category) == 'Dewan Pembina' ? 'selected' : '' }}>Dewan Pembina</option>
                        <option value="Dewan Pengarah" {{ old('category', $member->category) == 'Dewan Pengarah' ? 'selected' : '' }}>Dewan Pengarah</option>
                        <option value="Direktur" {{ old('category', $member->category) == 'Direktur' ? 'selected' : '' }}>Direktur</option>
                        <option value="Wakil Direktur" {{ old('category', $member->category) == 'Wakil Direktur' ? 'selected' : '' }}>Wakil Direktur</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="is_leader" class="form-label">Status Kepemimpinan</label>
                    <select id="is_leader" name="is_leader" required class="form-input">
                        <option value="0" {{ old('is_leader', $member->is_leader) == '0' ? 'selected' : '' }}>Anggota Biasa</option>
                        <option value="1" {{ old('is_leader', $member->is_leader) == '1' ? 'selected' : '' }}>Pimpinan Utama (Ketua / Direktur)</option>
                    </select>
                    @error('is_leader')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="color" class="form-label font-bold">Warna Latar Inisial (Tanpa #)</label>
                    <input id="color" name="color" type="text" value="{{ old('color', $member->color) }}" required
                           placeholder="Contoh: 1e3a8a atau 10b981"
                           class="form-input font-mono @error('color') border-red-400 @enderror">
                    @error('color')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="form-label font-bold">Urutan Tampilan</label>
                    <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $member->sort_order) }}" required min="0"
                           class="form-input font-mono @error('sort_order') border-red-400 @enderror">
                    @error('sort_order')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="photo_file" class="form-label">Ganti Foto Profil (Opsional)</label>
                <input id="photo_file" name="photo_file" type="file" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-gray-800 dark:file:text-gray-300 dark:hover:file:bg-gray-700/50 transition">
                <p class="text-gray-400 text-xs mt-1.5 dark:text-gray-500">Mendukung format PNG, JPG, JPEG dengan batas ukuran maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto profil.</p>
                @error('photo_file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('dashboard.board-members') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-250 dark:hover:bg-gray-700 transition">Batal</a>
            <button type="submit" class="btn-primary px-8">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
