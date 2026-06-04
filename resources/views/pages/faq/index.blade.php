@extends('layouts.app')

@section('title', 'FAQ - Pertanyaan Umum')
@section('description', 'Pertanyaan yang sering diajukan seputar PERMA PENDIS Indonesia, keanggotaan, program, dan layanan.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4 dark:bg-emerald-900/40 dark:text-emerald-400">Bantuan</span>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Pertanyaan Umum (FAQ)</h1>
        <p class="text-gray-500 dark:text-gray-400 max-w-xl mx-auto">Temukan jawaban atas pertanyaan yang sering diajukan seputar PERMA PENDIS Indonesia.</p>
    </div>

    @if($faqs->isEmpty())
        <div class="text-center py-16">
            <div class="text-5xl mb-3">❓</div>
            <p class="text-gray-500 dark:text-gray-400">Belum ada FAQ tersedia.</p>
        </div>
    @else
        @foreach($faqs as $category => $items)
        <div class="mb-10">
            @if($category)
            <h2 class="text-sm font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-4">{{ $category }}</h2>
            @endif
            <div class="space-y-3">
                @foreach($items as $faq)
                <div x-data="{ open: false }" class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                    <button @click="open = !open"
                            class="w-full flex items-center justify-between gap-4 p-5 text-left bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <span class="font-medium text-gray-900 dark:text-white text-sm leading-snug">{{ $faq->question }}</span>
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="px-5 pb-5 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed pt-4">{{ $faq->answer }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    @endif

    {{-- Bantuan WhatsApp --}}
    <div class="mt-12 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl p-8 text-center text-white">
        <h2 class="text-xl font-bold mb-2">Pertanyaan Anda belum terjawab?</h2>
        <p class="text-emerald-100 text-sm mb-5">Hubungi tim helpdesk kami melalui WhatsApp untuk bantuan lebih lanjut.</p>
        @php $wa = \App\Models\Setting::get('contact_phone', '6281234567890'); $wa = preg_replace('/[^0-9]/', '', $wa); if(str_starts_with($wa,'0')) $wa = '62'.substr($wa,1); @endphp
        <a href="https://wa.me/{{ $wa }}?text=Halo+PERMA+PENDIS,+saya+ingin+bertanya..." target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 bg-white text-emerald-700 font-bold px-6 py-3 rounded-xl hover:bg-emerald-50 transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Chat WhatsApp
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
