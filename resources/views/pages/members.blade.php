@extends('layouts.app')
@section('title', 'Direktori Anggota')
@section('description', 'Cari dan verifikasi keanggotaan resmi PERMA PENDIS Indonesia (Perkumpulan Manajer Pendidikan Islam).')

@section('content')
{{-- Elegant Page Header --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-emerald-950 text-white py-20 text-center overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(252,211,77,0.06),transparent_45%)]"></div>
    <div class="relative max-w-4xl mx-auto px-4 space-y-4 animate-slide-up">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-medium tracking-wide backdrop-blur-md">
            Database Resmi Keanggotaan
        </span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight">Direktori Anggota</h1>
        <div class="w-16 h-1 bg-gradient-to-r from-primary-600 to-secondary-500 mx-auto rounded-full"></div>
        <p class="text-sm md:text-base text-emerald-100/70 max-w-2xl mx-auto leading-relaxed font-medium">
            Verifikasi status keanggotaan dan Kartu Tanda Anggota (KTA) resmi Perkumpulan Manajer Pendidikan Islam Indonesia periode 2019-2025.
        </p>
    </div>
</section>

{{-- Search & List Section --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
    {{-- Search Bar --}}
    <div class="card p-6 md:p-8 max-w-3xl mx-auto border border-gray-150 shadow-sm rounded-3xl dark:bg-[#0b120f] dark:border-emerald-950/20">
        <form action="{{ route('members') }}" method="GET" class="space-y-4">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 pointer-events-none">
                        🔍
                    </span>
                    <input type="text" name="search" value="{{ $search }}" 
                           placeholder="Cari berdasarkan Nama, KTA, atau Universitas/Sekolah..." 
                           class="form-input w-full pl-10 pr-4 py-3 rounded-2xl border-gray-250 bg-gray-50/50 focus:bg-white dark:bg-[#080d0b] dark:border-emerald-950/40 text-sm">
                </div>
                <button type="submit" class="btn-primary py-3 px-8 text-sm rounded-2xl flex items-center justify-center gap-2">
                    <span>Cari Anggota</span>
                </button>
            </div>
            @if($search)
                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                    <p>Menampilkan hasil pencarian untuk: <strong class="text-primary-750 dark:text-emerald-400">"{{ $search }}"</strong></p>
                    <a href="{{ route('members') }}" class="text-red-500 hover:underline font-bold">Hapus Pencarian</a>
                </div>
            @endif
        </form>
    </div>

    {{-- Members Directory Table --}}
    <div class="card p-0 overflow-hidden border border-gray-100 dark:bg-[#0b120f] dark:border-emerald-950/20 rounded-3xl shadow-sm">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-emerald-950/20 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-gray-900 text-lg dark:text-white">Daftar Anggota Aktif</h2>
                <p class="text-xs text-gray-450 dark:text-gray-500 font-medium">Total Terdaftar: {{ $membersList->total() }} Anggota</p>
            </div>
        </div>

        @if($membersList->count() === 0)
            <div class="text-center py-20">
                <span class="text-5xl block mb-4">🔍</span>
                <h3 class="font-bold text-gray-800 dark:text-white text-base">Anggota Tidak Ditemukan</h3>
                <p class="text-gray-400 text-xs mt-1 max-w-sm mx-auto">Kami tidak dapat menemukan anggota dengan kriteria pencarian tersebut. Periksa ejaan atau gunakan kata kunci lain.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/50 dark:bg-emerald-950/5 border-b border-gray-100 dark:border-emerald-950/20">
                            <th class="py-4 px-6 font-semibold text-center w-16">No</th>
                            <th class="py-4 px-6 font-semibold">No. KTA</th>
                            <th class="py-4 px-6 font-semibold">Nama Lengkap</th>
                            <th class="py-4 px-6 font-semibold">Unit Kerja / Institusi</th>
                            <th class="py-4 px-6 font-semibold text-center w-32">Status KTA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-emerald-950/10 font-medium">
                        @foreach($membersList as $index => $member)
                        <tr class="hover:bg-gray-50/30 dark:hover:bg-[#101b15]/10 transition-colors">
                            <td class="py-4 px-6 text-center text-gray-400 dark:text-gray-600 font-mono text-xs">
                                {{ ($membersList->currentPage() - 1) * $membersList->perPage() + $loop->iteration }}
                            </td>
                            <td class="py-4 px-6 font-mono text-xs text-primary-750 dark:text-emerald-450 font-bold">
                                {{ $member->member_number }}
                            </td>
                            <td class="py-4 px-6 text-gray-900 dark:text-white font-semibold">
                                {{ $member->name }}
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 dark:text-gray-300">
                                {{ $member->institution ?: '-' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Aktif
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Custom Beautiful Pagination --}}
            <div class="px-6 py-5 border-t border-gray-100 dark:border-emerald-950/20">
                {{ $membersList->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
