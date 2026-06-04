@extends('layouts.dashboard')
@section('title', 'Kelola Anggota')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-100 pb-4 dark:border-gray-800 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-900 dark:text-white">Kelola Anggota</h1>
            <p class="text-gray-500 text-sm mt-1 dark:text-gray-400">Kelola direktori keanggotaan resmi PERMA PENDIS Indonesia.</p>
        </div>
        <a href="{{ route('dashboard.members.create') }}" class="btn-primary inline-flex items-center gap-2 self-start">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Anggota
        </a>
    </div>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Search Filter --}}
    <div class="card p-5">
        <form action="{{ route('dashboard.members') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 pointer-events-none">
                    🔍
                </span>
                <input type="text" name="search" value="{{ $search }}" 
                       placeholder="Cari berdasarkan Nama, KTA, atau Institusi..." 
                       class="form-input w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-200 dark:bg-gray-900 dark:border-gray-800 text-sm">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn-primary py-2.5 px-6 text-sm">
                    Cari
                </button>
                @if($search)
                    <a href="{{ route('dashboard.members') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 text-sm font-semibold rounded-xl flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="card p-0 overflow-hidden">
        @if($members->count() === 0)
        <div class="text-center py-16 text-gray-400">
            <span class="text-4xl block mb-2">🔍</span>
            <p class="text-sm">Tidak ada data anggota ditemukan.</p>
        </div>
        @else
        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[850px] text-left text-sm text-gray-500 dark:text-gray-400">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/20">
                        <th class="py-3 px-6 font-semibold w-16">Foto</th>
                        <th class="py-3 px-6 font-semibold">No. KTA</th>
                        <th class="py-3 px-6 font-semibold">Nama Lengkap</th>
                        <th class="py-3 px-6 font-semibold">Email & Kontak</th>
                        <th class="py-3 px-6 font-semibold">Institusi / NIM</th>
                        <th class="py-3 px-6 font-semibold text-center">Status</th>
                        <th class="py-3 px-6 font-semibold text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach($members as $member)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/30 transition">
                        <td class="py-4.5 px-6">
                            @if($member->profile_picture)
                                <img src="{{ asset('uploads/profile-photos/' . $member->profile_picture) }}" alt="{{ $member->name }}" class="w-10 h-10 object-cover shadow-sm border border-gray-100 dark:border-gray-800" style="border-radius: 9999px !important;">
                            @else
                                <div class="w-10 h-10 flex items-center justify-center bg-primary-900 text-white font-bold text-xs" style="border-radius: 9999px !important;">
                                    {{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('') }}
                                </div>
                            @endif
                        </td>
                        <td class="py-4.5 px-6 font-mono text-xs text-primary-700 dark:text-emerald-400 font-bold">
                            {{ $member->member_number ?: '-' }}
                        </td>
                        <td class="py-4.5 px-6 font-semibold text-gray-900 dark:text-white">
                            {{ $member->name }}
                        </td>
                        <td class="py-4.5 px-6 text-xs">
                            <div>{{ $member->email ?: '-' }}</div>
                            <div class="text-gray-400 mt-0.5">{{ $member->phone ?: '-' }}</div>
                        </td>
                        <td class="py-4.5 px-6 text-xs">
                            <div>{{ $member->institution ?: '-' }}</div>
                            @if($member->nim)
                                <div class="text-gray-400 mt-0.5">NIM: {{ $member->nim }}</div>
                            @endif
                        </td>
                        <td class="py-4.5 px-6 text-center">
                            @if($member->membership_status === 'aktif')
                                <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 inline-flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 text-[10px] font-medium rounded-full bg-gray-100 text-gray-650 dark:bg-gray-800 dark:text-gray-400 inline-flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="py-4.5 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('dashboard.members.edit', $member->id) }}" class="p-2 text-gray-400 hover:text-primary-750 dark:hover:text-primary-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition" title="Edit Anggota">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('dashboard.members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/30 transition" title="Hapus Anggota">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="px-6 py-4.5 border-t border-gray-100 dark:border-gray-800">
            {{ $members->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
