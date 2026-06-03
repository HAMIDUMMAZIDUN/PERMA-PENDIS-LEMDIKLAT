@extends('layouts.dashboard')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('page-subtitle', 'Kelola pesan dan detail konsultasi dari pengunjung website.')

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="border-b border-gray-150 pb-4 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-primary-900 dark:text-white">Pesan Masuk</h1>
            <p class="text-gray-500 text-sm mt-1 dark:text-gray-400">Tanggapi pertanyaan, saran, atau detail konsultasi dari formulir Hubungi Kami.</p>
        </div>
        
        {{-- Filter Buttons using JS --}}
        <div class="flex items-center gap-2 self-start sm:self-center bg-gray-100 p-1 rounded-xl dark:bg-gray-900">
            <button onclick="filterMessages('all')" id="btn-filter-all" class="px-4 py-2 text-xs font-semibold rounded-lg bg-white text-gray-900 shadow-sm transition dark:bg-gray-800 dark:text-white">
                Semua ({{ $messages->count() }})
            </button>
            <button onclick="filterMessages('unread')" id="btn-filter-unread" class="px-4 py-2 text-xs font-semibold rounded-lg text-gray-500 hover:text-gray-900 transition dark:hover:text-white">
                Belum Dibaca ({{ $messages->where('is_read', false)->count() }})
            </button>
            <button onclick="filterMessages('read')" id="btn-filter-read" class="px-4 py-2 text-xs font-semibold rounded-lg text-gray-500 hover:text-gray-900 transition dark:hover:text-white">
                Sudah Dibaca ({{ $messages->where('is_read', true)->count() }})
            </button>
        </div>
    </div>

    @if($messages->count() === 0)
    <div class="card text-center py-16">
        <div class="w-20 h-20 bg-gray-50 dark:bg-gray-900/50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100 dark:border-gray-800">
            <span class="text-4xl">📥</span>
        </div>
        <h3 class="font-bold text-gray-800 dark:text-white text-lg">Kotak Masuk Kosong</h3>
        <p class="text-gray-400 text-sm mt-1 max-w-sm mx-auto dark:text-gray-500">Belum ada pesan masuk dari pengunjung website. Pesan yang dikirim melalui form kontak akan muncul di sini.</p>
    </div>
    @else
    
    {{-- Search / Live Filter Input --}}
    <div class="relative max-w-md">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </span>
        <input type="text" id="message-search" onkeyup="searchMessages()" placeholder="Cari nama, email, atau isi pesan..." class="form-input pl-11 text-sm">
    </div>

    {{-- Message Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="messages-grid">
        @foreach($messages as $msg)
        <div class="message-card card-hover flex flex-col justify-between" data-read="{{ $msg->is_read ? 'true' : 'false' }}">
            <div>
                {{-- Card Header --}}
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div class="min-w-0">
                        <h3 class="font-bold text-gray-900 dark:text-white truncate text-base message-name" title="{{ $msg->name }}">
                            {{ $msg->name }}
                        </h3>
                        <p class="text-xs text-gray-400 font-medium truncate dark:text-gray-500 message-email" title="{{ $msg->email }}">
                            {{ $msg->email }}
                        </p>
                    </div>
                    @if(!$msg->is_read)
                        <span class="badge bg-emerald-500 text-white dark:bg-emerald-600 animate-pulse text-[10px] py-0.5 px-2">Baru</span>
                    @else
                        <span class="badge bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 text-[10px] py-0.5 px-2">Dibaca</span>
                    @endif
                </div>

                {{-- Message Excerpt --}}
                <div class="text-gray-600 text-sm dark:text-gray-300 leading-relaxed mb-6 message-body-text">
                    {{ Str::limit($msg->message, 150) }}
                </div>
            </div>

            <div>
                {{-- Date / Time --}}
                <div class="text-[11px] text-gray-400 dark:text-gray-500 font-medium mb-4 flex items-center gap-1.5 border-t border-gray-50 pt-3 dark:border-gray-850">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ $msg->created_at->format('d M Y, H:i') }}</span>
                    <span class="text-gray-300 dark:text-gray-700">•</span>
                    <span>{{ $msg->created_at->diffForHumans() }}</span>
                </div>

                {{-- Action Panel --}}
                <div class="flex items-center gap-2">
                    {{-- Open Detail Modal Button --}}
                    <button onclick="openDetailModal({{ json_encode($msg) }})" class="btn-secondary text-xs px-3 py-2 flex-1 shadow-sm">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Detail
                    </button>

                    {{-- Toggle Read/Unread Form --}}
                    <form action="{{ route('dashboard.messages.toggle-read', $msg->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 rounded-xl border border-gray-250 text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition dark:border-emerald-950/40 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-900/60" title="{{ $msg->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                            @if($msg->is_read)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.22 0l-2.25 1.5"></path></svg>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            @endif
                        </button>
                    </form>

                    {{-- Delete Form --}}
                    <form action="{{ route('dashboard.messages.destroy', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari {{ $msg->name }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-xl border border-red-100 text-red-500 hover:bg-red-50 hover:text-red-700 transition dark:border-red-950/20 dark:hover:bg-red-950/30" title="Hapus Pesan">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- Message Detail Modal --}}
<div id="detail-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden" onclick="closeDetailModalOnOutsideClick(event)">
    <div class="bg-white dark:bg-[#0b120f] rounded-3xl border border-gray-150 dark:border-emerald-950/30 w-full max-w-2xl overflow-hidden shadow-2xl animate-slide-up" onclick="event.stopPropagation()">
        
        {{-- Modal Header --}}
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-gray-900/20">
            <div class="flex items-center gap-3">
                <span class="text-2xl">✉️</span>
                <div>
                    <h2 class="font-bold text-gray-900 dark:text-white text-lg">Detail Pesan</h2>
                    <p class="text-xs text-gray-400 dark:text-gray-500">Tinjau informasi lengkap pengirim.</p>
                </div>
            </div>
            <button onclick="closeDetailModal()" class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 dark:bg-gray-850 dark:text-gray-400 dark:hover:bg-gray-850 flex items-center justify-center text-xl font-bold transition">
                &times;
            </button>
        </div>

        {{-- Modal Content --}}
        <div class="p-6 space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold tracking-wider block">Pengirim</label>
                    <p class="font-bold text-gray-900 dark:text-white text-base mt-1" id="modal-name"></p>
                </div>
                <div>
                    <label class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold tracking-wider block">Email</label>
                    <a href="" id="modal-email-link" class="text-primary-600 dark:text-primary-400 font-semibold hover:underline block mt-1"></a>
                </div>
                <div>
                    <label class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold tracking-wider block">Waktu Kirim</label>
                    <p class="text-gray-700 dark:text-gray-300 font-medium text-sm mt-1" id="modal-date"></p>
                </div>
                <div>
                    <label class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold tracking-wider block">Status</label>
                    <div id="modal-status-badge" class="mt-1"></div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-4 dark:border-gray-800">
                <label class="text-xs text-gray-400 dark:text-gray-500 uppercase font-bold tracking-wider block mb-2">Isi Pesan / Detail Konsultasi</label>
                <div class="bg-gray-50 dark:bg-gray-900/40 border border-gray-100 dark:border-emerald-950/20 rounded-2xl p-5 text-gray-700 dark:text-gray-300 text-sm leading-relaxed whitespace-pre-line overflow-y-auto max-h-64 font-medium" id="modal-message-body">
                </div>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 dark:bg-gray-900/20 dark:border-gray-850 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            {{-- Quick action to toggle read status --}}
            <form action="" method="POST" id="modal-toggle-form">
                @csrf
                <button type="submit" class="btn-secondary text-xs px-4 py-2.5">
                    <span id="modal-toggle-text">Tandai Sudah/Belum Dibaca</span>
                </button>
            </form>

            <div class="flex items-center gap-2 self-end sm:self-auto">
                {{-- Direct Reply Mailto Button --}}
                <a href="" id="modal-reply-btn" class="btn-primary text-xs px-4 py-2.5">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg> Balas Email
                </a>

                {{-- Close Button --}}
                <button onclick="closeDetailModal()" class="btn-secondary text-xs px-4 py-2.5 bg-white dark:bg-gray-850 text-gray-750 dark:text-gray-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // JS Filtering function
    function filterMessages(type) {
        // Reset active filter button states
        const btnAll = document.getElementById('btn-filter-all');
        const btnUnread = document.getElementById('btn-filter-unread');
        const btnRead = document.getElementById('btn-filter-read');
        
        [btnAll, btnUnread, btnRead].forEach(btn => {
            btn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm', 'dark:bg-gray-800', 'dark:text-white');
            btn.classList.add('text-gray-500', 'hover:text-gray-900', 'dark:hover:text-white');
        });
        
        // Mark active button
        const activeBtn = document.getElementById('btn-filter-' + type);
        activeBtn.classList.add('bg-white', 'text-gray-900', 'shadow-sm', 'dark:bg-gray-800', 'dark:text-white');
        activeBtn.classList.remove('text-gray-500', 'hover:text-gray-900', 'dark:hover:text-white');
        
        // Show/hide cards
        const cards = document.querySelectorAll('.message-card');
        cards.forEach(card => {
            const isRead = card.getAttribute('data-read') === 'true';
            if (type === 'all') {
                card.style.display = '';
            } else if (type === 'unread') {
                card.style.display = isRead ? 'none' : '';
            } else if (type === 'read') {
                card.style.display = isRead ? '' : 'none';
            }
        });
    }

    // Live search function
    function searchMessages() {
        const query = document.getElementById('message-search').value.toLowerCase();
        const cards = document.querySelectorAll('.message-card');
        
        cards.forEach(card => {
            const name = card.querySelector('.message-name').textContent.toLowerCase();
            const email = card.querySelector('.message-email').textContent.toLowerCase();
            const body = card.querySelector('.message-body-text').textContent.toLowerCase();
            
            if (name.includes(query) || email.includes(query) || body.includes(query)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Modal Control
    function openDetailModal(msg) {
        document.getElementById('modal-name').textContent = msg.name;
        
        const emailLink = document.getElementById('modal-email-link');
        emailLink.textContent = msg.email;
        emailLink.href = 'mailto:' + msg.email;
        
        // Format Date
        const dateObj = new Date(msg.created_at);
        const options = { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
        document.getElementById('modal-date').textContent = dateObj.toLocaleDateString('id-ID', options);
        
        // Set Status Badge
        const badgeContainer = document.getElementById('modal-status-badge');
        if (!msg.is_read) {
            badgeContainer.innerHTML = '<span class="badge bg-emerald-500 text-white dark:bg-emerald-600 animate-pulse text-[10px]">Baru / Belum Dibaca</span>';
            document.getElementById('modal-toggle-text').textContent = 'Tandai Sudah Dibaca';
        } else {
            badgeContainer.innerHTML = '<span class="badge bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 text-[10px]">Sudah Dibaca</span>';
            document.getElementById('modal-toggle-text').textContent = 'Tandai Belum Dibaca';
        }
        
        document.getElementById('modal-message-body').textContent = msg.message;
        
        // Action Forms Setup
        const toggleForm = document.getElementById('modal-toggle-form');
        toggleForm.action = `/dashboard/messages/${msg.id}/toggle-read`;
        
        const replyBtn = document.getElementById('modal-reply-btn');
        const subject = encodeURIComponent('Tanggapan Pesan: PERMA PENDIS');
        const bodyText = encodeURIComponent(`Halo ${msg.name},\n\nTerima kasih telah menghubungi kami. Terkait pesan Anda:\n"${msg.message}"\n\n[Tulis balasan Anda di sini]\n\nSalam hangat,\nAdmin PERMA PENDIS`);
        replyBtn.href = `mailto:${msg.email}?subject=${subject}&body=${bodyText}`;
        
        // Show Modal
        const modal = document.getElementById('detail-modal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Lock background scroll

        // Auto mark as read in background if it was unread
        if (!msg.is_read) {
            fetch(`/dashboard/messages/${msg.id}/toggle-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).catch(err => console.error('Failed to auto-mark as read:', err));
        }
    }

    function closeDetailModal() {
        const modal = document.getElementById('detail-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = ''; // Unlock background scroll
        // Reload page to reflect auto-read status if needed
        window.location.reload();
    }

    function closeDetailModalOnOutsideClick(event) {
        closeDetailModal();
    }
</script>
@endsection
