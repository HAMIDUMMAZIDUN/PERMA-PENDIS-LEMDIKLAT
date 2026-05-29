<div class="group flex flex-col items-center bg-white/70 backdrop-blur rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] border border-gray-100/80 hover:shadow-[0_20px_40px_rgb(0,0,0,0.03)] hover:-translate-y-1 hover:border-primary-100 transition-all duration-300 text-center dark:bg-[#0b120f]/80 dark:border-emerald-950/20 dark:hover:border-primary-900/30 w-full">
    <div class="relative mb-4">
        {{-- Avatar Outer Gradient Ring --}}
        <div class="absolute -inset-1 bg-gradient-to-tr from-primary-600 to-secondary-400 rounded-full opacity-60 blur-sm group-hover:opacity-100 transition duration-500"></div>
        
        @if(isset($photo) && $photo)
            <img src="{{ $photo }}" alt="{{ $name }}" class="relative w-16 h-16 rounded-full object-cover shadow-md border-2 border-white dark:border-gray-900">
        @else
            <div class="relative w-16 h-16 rounded-full flex items-center justify-center text-white font-extrabold text-lg shadow-md border-2 border-white dark:border-gray-900 transition-transform duration-500 group-hover:scale-105"
                 style="background-color: #{{ $color ?? '208457' }};">
                {{ collect(explode(' ', $name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('') }}
            </div>
        @endif
    </div>
    
    <p class="font-extrabold text-gray-900 text-sm leading-snug group-hover:text-primary-800 transition dark:text-white dark:group-hover:text-primary-300">{{ $name }}</p>
    <p class="text-xs font-bold text-gray-400 mt-1 dark:text-gray-500 uppercase tracking-widest">{{ $role }}</p>
</div>
