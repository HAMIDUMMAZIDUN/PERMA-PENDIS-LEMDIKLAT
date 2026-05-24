@extends('layouts.dashboard')
@section('title', 'Persetujuan Pendaftaran')

@section('content')
<div class="space-y-6">
    <div class="border-b border-gray-100 pb-4 dark:border-gray-800">
        <h1 class="text-3xl font-extrabold text-primary-900 dark:text-white">Persetujuan Pendaftaran</h1>
        <p class="text-gray-500 text-sm mt-1 dark:text-gray-400">Tinjau dan setujui pendaftaran akun baru Lemdiklat Permapendis.</p>
    </div>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <h2 class="text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4 dark:text-white dark:border-gray-850">
            Pendaftaran Tertunda (Pending)
        </h2>

        @if($pendingUsers->count() === 0)
        <div class="text-center py-12">
            <span class="text-4xl">🎉</span>
            <h3 class="font-bold text-gray-800 dark:text-white mt-3">Semua Beres!</h3>
            <p class="text-gray-400 text-sm mt-1 dark:text-gray-500">Tidak ada pendaftaran akun yang tertunda saat ini.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100 dark:border-gray-800">
                        <th class="py-3 px-4 font-semibold">Nama Lengkap</th>
                        <th class="py-3 px-4 font-semibold">Email</th>
                        <th class="py-3 px-4 font-semibold">Username</th>
                        <th class="py-3 px-4 font-semibold text-center">Metode Daftar</th>
                        <th class="py-3 px-4 font-semibold text-center">Tanggal Daftar</th>
                        <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-850">
                    @foreach($pendingUsers as $pending)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/30 transition">
                        <td class="py-4 px-4 font-semibold text-gray-900 dark:text-white">
                            {{ $pending->display_name }}
                        </td>
                        <td class="py-4 px-4 text-xs font-medium">
                            {{ $pending->profile?->email }}
                        </td>
                        <td class="py-4 px-4 font-mono text-xs">
                            {{ $pending->username }}
                        </td>
                        <td class="py-4 px-4 text-center">
                            @if(str_starts_with($pending->username, 'google_'))
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300">
                                    <svg class="w-3 h-3" viewBox="0 0 24 24"><path fill="currentColor" d="M12.24 10.285V14.4h6.887c-.648 2.41-2.519 4.114-5.136 4.114A5.89 5.89 0 0 1 8 12.629a5.89 5.89 0 0 1 5.99-5.89c1.62 0 3.085.57 4.24 1.62l3.19-3.19C19.497 3.38 16.943 2 13.99 2C8.473 2 4 6.473 4 12c0 5.527 4.473 10 9.99 10c5.753 0 10.01-4.045 10.01-10c0-.685-.06-1.343-.162-1.715H12.24z"/></svg>
                                    Google SSO
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">
                                    Username & Pass
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-center text-xs">
                            {{ $pending->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('dashboard.approvals.approve', $pending->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition shadow-sm">
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.approvals.reject', $pending->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini? Data pendaftar akan dihapus.');">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
