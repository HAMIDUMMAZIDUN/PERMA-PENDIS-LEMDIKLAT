@extends('layouts.app')
@section('title', 'Tentang Kami')
@section('description', 'Tentang Lemdiklat Permapendis - Lembaga Pendidikan dan Pelatihan yang berdedikasi meningkatkan kompetensi tenaga pendidik Indonesia')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-primary-900 to-primary-700 text-white py-20 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        
    </div>
    <div class="relative max-w-4xl mx-auto px-4 animate-slide-up">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-5">Tentang Lemdiklat Permapendis</h1>
        <p class="text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Lembaga Pendidikan dan Pelatihan berkomitmen meningkatkan kompetensi melalui program pelatihan terstruktur, instruktur berpengalaman, serta pendekatan pembelajaran modern yang berorientasi pada hasil.
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Visi & Misi --}}
    <div class="grid md:grid-cols-2 gap-8 mb-16">
        <div class="card border-l-4 border-primary-600">
            <div class="flex items-center gap-3 mb-4">
                
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Visi</h2>
            </div>
            <p class="text-gray-600 leading-relaxed dark:text-gray-400">Menjadi pusat unggulan pengembangan kompetensi yang relevan dengan kebutuhan industri dan mendorong pembelajaran sepanjang hayat.</p>
        </div>
        <div class="card border-l-4 border-secondary-600">
            <div class="flex items-center gap-3 mb-4">
                
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Misi</h2>
            </div>
            <ul class="text-gray-600 space-y-2 dark:text-gray-400">
                <li class="flex items-start gap-2"><span class="text-teal-500 mt-1">✓</span> Menyelenggarakan pelatihan berbasis praktik terbaik.</li>
                <li class="flex items-start gap-2"><span class="text-teal-500 mt-1">✓</span> Memfasilitasi sertifikasi dan peningkatan keterampilan.</li>
                <li class="flex items-start gap-2"><span class="text-teal-500 mt-1">✓</span> Berjejaring dengan dunia industri dan komunitas.</li>
            </ul>
        </div>
    </div>

    {{-- Values --}}
    <div class="grid md:grid-cols-3 gap-6 mb-16">
        @foreach([
            ['icon' => '⭐', 'title' => 'Profesional', 'desc' => 'Instruktur berpengalaman dengan kurikulum adaptif dan terkini.', 'color' => 'bg-emerald-50 text-blue-800'],
            ['icon' => '🤝', 'title' => 'Kolaboratif', 'desc' => 'Kemitraan strategis untuk peluang belajar dan karier yang lebih luas.', 'color' => 'bg-teal-50 text-teal-800'],
            ['icon' => '🎯', 'title' => 'Berorientasi Hasil', 'desc' => 'Fokus pada kompetensi nyata dan output yang terukur.', 'color' => 'bg-purple-50 text-purple-800'],
        ] as $val)
        <div class="rounded-2xl p-6 {{ $val['color'] }}">
            <h3 class="font-bold text-lg mb-2">{{ $val['title'] }}</h3>
            <p class="text-sm leading-relaxed opacity-80">{{ $val['desc'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="mb-8">
        <a href="{{ route('contact') }}" class="btn-primary">Hubungi Kami</a>
    </div>

    {{-- Susunan Pengurus --}}
    <h2 class="text-3xl font-extrabold text-primary-900 mb-8 border-b-2 border-primary-100 pb-4">Susunan Pengurus</h2>

    {{-- Dewan Pembina --}}
    @if($pembinaLeader || $pembinaMembers->count() > 0)
    <div class="mb-12">
        <h3 class="text-xl font-bold text-primary-800 mb-6 flex items-center gap-2">
            Dewan Pembina
        </h3>
        @if($pembinaLeader)
        <div class="flex justify-center mb-6">
            @include('pages.partials.org-card', ['name' => $pembinaLeader->name, 'role' => $pembinaLeader->role, 'color' => $pembinaLeader->color, 'photo' => $pembinaLeader->photo])
        </div>
        @endif
        @if($pembinaMembers->count() > 0)
        <h4 class="text-sm font-semibold text-gray-500 uppercase mb-4 dark:text-gray-400">Anggota</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($pembinaMembers as $member)
            @include('pages.partials.org-card', ['name' => $member->name, 'role' => $member->role, 'color' => $member->color, 'photo' => $member->photo])
            @endforeach
        </div>
        @endif
    </div>
    @endif

    {{-- Dewan Pengarah --}}
    @if($pengarahLeader || $pengarahMembers->count() > 0)
    <div class="mb-12">
        <h3 class="text-xl font-bold text-primary-800 mb-6 flex items-center gap-2">
            Dewan Pengarah
        </h3>
        @if($pengarahLeader)
        <div class="flex justify-center mb-6">
            @include('pages.partials.org-card', ['name' => $pengarahLeader->name, 'role' => $pengarahLeader->role, 'color' => $pengarahLeader->color, 'photo' => $pengarahLeader->photo])
        </div>
        @endif
        @if($pengarahMembers->count() > 0)
        <h4 class="text-sm font-semibold text-gray-500 uppercase mb-4 dark:text-gray-400">Anggota</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($pengarahMembers as $member)
            @include('pages.partials.org-card', ['name' => $member->name, 'role' => $member->role, 'color' => $member->color, 'photo' => $member->photo])
            @endforeach
        </div>
        @endif
    </div>
    @endif

    {{-- Direktur --}}
    @if($direktur)
    <div class="mb-12">
        <h3 class="text-xl font-bold text-primary-800 mb-6 flex items-center gap-2">
            Direktur
        </h3>
        <div class="flex justify-center">
            @include('pages.partials.org-card', ['name' => $direktur->name, 'role' => $direktur->role, 'color' => $direktur->color, 'photo' => $direktur->photo])
        </div>
    </div>
    @endif

    {{-- Wakil Direktur --}}
    @if($wakilDirekturs->count() > 0)
    <div class="mb-12">
        <h3 class="text-xl font-bold text-primary-800 mb-6 flex items-center gap-2">
            Wakil Direktur
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($wakilDirekturs as $member)
            @include('pages.partials.org-card', ['name' => $member->name, 'role' => $member->role, 'color' => $member->color, 'photo' => $member->photo])
            @endforeach
        </div>
    </div>
    @endif

</section>
@endsection
