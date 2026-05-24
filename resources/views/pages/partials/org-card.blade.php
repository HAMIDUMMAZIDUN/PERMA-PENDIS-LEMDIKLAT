<div class="flex flex-col items-center bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition text-center dark:bg-gray-900 dark:border-gray-800">
    @if(isset($photo) && $photo)
        <img src="{{ $photo }}" alt="{{ $name }}" class="w-14 h-14 rounded-full object-cover mb-3 shadow-sm border border-slate-100 dark:border-gray-800">
    @else
        <div class="w-14 h-14 rounded-full flex items-center justify-center text-white font-bold text-lg mb-3"
             style="background-color: #{{ $color ?? '10b981' }};">
            {{ collect(explode(' ', $name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('') }}
        </div>
    @endif
    <p class="font-semibold text-gray-900 text-sm leading-snug dark:text-white">{{ $name }}</p>
    <p class="text-xs text-gray-500 mt-1 dark:text-gray-400">{{ $role }}</p>
</div>
