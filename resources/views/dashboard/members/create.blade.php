@extends('layouts.dashboard')
@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota')
@section('page-subtitle', 'Tambahkan anggota baru ke direktori keanggotaan resmi')

@section('content')
<div class="max-w-4xl space-y-6 animate-fade-in">
    <div class="flex items-center gap-3 border-b border-gray-100 pb-4 dark:border-emerald-950/20">
        <a href="{{ route('dashboard.members') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-xl hover:bg-gray-100 dark:hover:bg-emerald-950/30 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
    </div>

    <form action="{{ route('dashboard.members.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Row 1: Informasi Dasar --}}
        <div class="card p-8">
            <h3 class="text-base font-bold text-gray-900 mb-5 dark:text-white flex items-center gap-2">
                <span class="w-2 h-5 bg-primary-750 rounded-sm"></span>
                Informasi Dasar Keanggotaan
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Nama Lengkap & Gelar <span class="text-red-500">*</span></label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                           placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Pd."
                           class="form-input @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="member_number" class="form-label">Nomor KTA Resmi <span class="text-red-500">*</span></label>
                    <input id="member_number" name="member_number" type="text" value="{{ old('member_number') }}" required
                           placeholder="Contoh: KTA.PP.2023.0041"
                           class="form-input @error('member_number') border-red-400 @enderror">
                    @error('member_number')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="email" class="form-label">Alamat Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           placeholder="Contoh: fauzi@example.com"
                           class="form-input @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="form-label">Nomor Telepon / WA</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                           placeholder="Contoh: 08123456789"
                           class="form-input @error('phone') border-red-400 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="membership_status" class="form-label">Status Keanggotaan <span class="text-red-500">*</span></label>
                    <select id="membership_status" name="membership_status" required class="form-input">
                        <option value="aktif" {{ old('membership_status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif (Tampil di Direktori)</option>
                        <option value="nonaktif" {{ old('membership_status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif (Disembunyikan)</option>
                    </select>
                    @error('membership_status')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Row 2: Afiliasi Akademik & Wilayah --}}
        <div class="card p-8">
            <h3 class="text-base font-bold text-gray-900 mb-5 dark:text-white flex items-center gap-2">
                <span class="w-2 h-5 bg-emerald-600 rounded-sm"></span>
                Afiliasi Akademik & Wilayah
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="institution" class="form-label">Universitas / Institusi</label>
                    <input id="institution" name="institution" type="text" value="{{ old('institution') }}"
                           placeholder="Contoh: UIN Sunan Gunung Djati"
                           class="form-input @error('institution') border-red-400 @enderror">
                    @error('institution')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="study_program" class="form-label">Program Studi</label>
                    <input id="study_program" name="study_program" type="text" value="{{ old('study_program') }}"
                           placeholder="Contoh: Manajemen Pendidikan Islam"
                           class="form-input @error('study_program') border-red-400 @enderror">
                    @error('study_program')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nim" class="form-label">NIM / NIDN / NIP</label>
                    <input id="nim" name="nim" type="text" value="{{ old('nim') }}"
                           placeholder="Masukkan Nomor Induk"
                           class="form-input @error('nim') border-red-400 @enderror">
                    @error('nim')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="wilayah" class="form-label">Wilayah (Kepengurusan Daerah)</label>
                    <input id="wilayah" name="wilayah" type="text" value="{{ old('wilayah') }}"
                           placeholder="Contoh: Wilayah Jawa Barat"
                           class="form-input @error('wilayah') border-red-400 @enderror">
                    @error('wilayah')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="province" class="form-label">Provinsi</label>
                    <input id="province" name="province" type="text" value="{{ old('province') }}"
                           placeholder="Contoh: Jawa Barat"
                           class="form-input @error('province') border-red-400 @enderror">
                    @error('province')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Row 3: Domisili & Masa Berlaku --}}
        <div class="card p-8">
            <h3 class="text-base font-bold text-gray-900 mb-5 dark:text-white flex items-center gap-2">
                <span class="w-2 h-5 bg-teal-600 rounded-sm"></span>
                Domisili & Administrasi KTA
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <input id="address" name="address" type="text" value="{{ old('address') }}"
                           placeholder="Contoh: Jl. Gedebage Selatan No. 137"
                           class="form-input @error('address') border-red-400 @enderror">
                    @error('address')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="city" class="form-label">Kota / Kabupaten</label>
                    <input id="city" name="city" type="text" value="{{ old('city') }}"
                           placeholder="Contoh: Kota Bandung"
                           class="form-input @error('city') border-red-400 @enderror">
                    @error('city')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="kta_issued_at" class="form-label">Tanggal Terbit KTA</label>
                    <input id="kta_issued_at" name="kta_issued_at" type="date" value="{{ old('kta_issued_at') }}"
                           class="form-input @error('kta_issued_at') border-red-400 @enderror">
                    @error('kta_issued_at')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="kta_expired_at" class="form-label">Tanggal Kadaluarsa KTA</label>
                    <input id="kta_expired_at" name="kta_expired_at" type="date" value="{{ old('kta_expired_at') }}"
                           class="form-input @error('kta_expired_at') border-red-400 @enderror">
                    @error('kta_expired_at')
                        <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="profile_picture_file" class="form-label">Foto Profil Anggota (Opsional)</label>
                <input id="profile_picture_file" name="profile_picture_file" type="file" accept="image/*" onchange="previewThumb(this)"
                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-750 hover:file:bg-primary-100 dark:file:bg-emerald-950/40 dark:file:text-emerald-300 dark:hover:file:bg-emerald-900/30 transition">
                <p class="text-gray-400 text-xs mt-2 font-medium">Format berkas didukung: PNG, JPG, JPEG dengan batas ukuran maksimal 1MB.</p>
                @error('profile_picture_file')
                    <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
                <div id="thumb-preview" class="hidden mt-4">
                    <img id="thumb-img" src="" alt="Preview" class="w-20 h-20 object-cover shadow-md border-2 border-white dark:border-[#0c1410]" style="border-radius: 9999px !important;">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('dashboard.members') }}" class="btn-secondary py-3 px-8 text-sm">Batal</a>
            <button type="submit" class="btn-primary py-3 px-8 text-sm">Simpan Anggota Baru</button>
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
