@extends('layouts.dashboard')
@section('title', 'Kelola Pengurus')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-100 pb-4 dark:border-gray-800 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-900 dark:text-white">Kelola Pengurus</h1>
            <p class="text-gray-500 text-sm mt-1 dark:text-gray-400">Atur susunan Dewan Pembina, Dewan Pengarah, Direktur, Wakil Direktur, Sekretaris & Bendahara, serta Kepala Bagian dan Unit.</p>
        </div>
        <a href="{{ route('dashboard.board-members.create') }}" class="btn-primary inline-flex items-center gap-2 self-start">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Pengurus
        </a>
    </div>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Groups --}}
    @foreach(['Dewan Pembina', 'Dewan Pengarah', 'Direktur', 'Wakil Direktur', 'Sekretaris & Bendahara', 'Kepala Bagian dan Unit'] as $category)
    @php
        $categoryMembers = $members->where('category', $category);
    @endphp

    <div class="card">
        <h2 class="text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4 dark:text-white dark:border-gray-850 flex items-center justify-between">
            <span>{{ $category }}</span>
            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">
                {{ $categoryMembers->count() }} Orang
            </span>
        </h2>

        @if($categoryMembers->count() === 0)
        <p class="text-gray-400 text-sm text-center py-6 dark:text-gray-500">Tidak ada pengurus di kategori ini.</p>
        @else
        <div class="overflow-x-auto overflow-y-auto w-full max-h-[500px] border border-gray-100 rounded-none dark:border-gray-800">
            <table class="w-full min-w-[650px] text-left text-sm text-gray-500 dark:text-gray-400">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/20">
                        <th class="py-3 px-4 font-semibold">Profil</th>
                        <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                        <th class="py-3 px-4 font-semibold">Nama</th>
                        <th class="py-3 px-4 font-semibold">Jabatan</th>
                        <th class="py-3 px-4 font-semibold text-center">Status</th>
                        <th class="py-3 px-4 font-semibold text-center">Urutan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-855">
                    @foreach($categoryMembers as $member)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/30 transition">
                        <td class="py-4 px-4">
                            @if($member->photo)
                                <img src="{{ $member->photo }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-none object-cover shadow-sm border border-gray-100 dark:border-gray-850">
                            @else
                                <div class="w-12 h-12 rounded-none flex items-center justify-center text-white font-bold text-sm"
                                     style="background-color: #{{ $member->color }};">
                                    {{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('') }}
                                </div>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('dashboard.board-members.edit', $member->id) }}" class="p-1.5 text-gray-400 hover:text-primary-700 dark:hover:text-primary-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition" title="Edit Pengurus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('dashboard.board-members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengurus ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/30 transition" title="Hapus Pengurus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="py-4 px-4 font-semibold text-gray-900 dark:text-white">
                            {{ $member->name }}
                        </td>
                        <td class="py-4 px-4 text-xs">
                            {{ $member->role }}
                        </td>
                        <td class="py-4 px-4 text-center">
                            @if($member->is_leader)
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-amber-300">
                                    Pimpinan
                                </span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-medium rounded bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    Anggota
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-center font-mono text-xs">
                            {{ $member->sort_order }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection
