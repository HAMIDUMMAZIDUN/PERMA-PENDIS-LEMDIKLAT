@extends('layouts.app')
@section('title', 'AD / ART PERMA PENDIS')
@section('description', 'Anggaran Dasar & Anggaran Rumah Tangga resmi Perkumpulan Manajer Pendidikan Islam Indonesia.')

@section('content')
{{-- Elegant Page Header --}}
<section class="relative bg-gradient-to-br from-primary-950 via-primary-900 to-emerald-950 text-white py-12 text-center overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(252,211,77,0.05),transparent_40%)]"></div>
    <div class="relative max-w-4xl mx-auto px-4 space-y-3">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-semibold tracking-wide backdrop-blur-md">
            Konstitusi Organisasi
        </span>
        <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Anggaran Dasar & Anggaran Rumah Tangga</h1>
        <p class="text-xs md:text-sm text-emerald-100/70 max-w-2xl mx-auto leading-relaxed font-medium">
            Perkumpulan Manajer Pendidikan Islam (Perma Pendis) Indonesia.
        </p>
    </div>
</section>

{{-- Sticky Navigation & Filter Bar --}}
<section class="sticky top-16 z-30 bg-white/95 dark:bg-[#080d0b]/95 border-b border-gray-150 dark:border-emerald-950/20 backdrop-blur-md shadow-sm transition">
    <div class="max-w-none w-full px-4 sm:px-6 lg:px-12 py-4 flex flex-col md:flex-row items-center justify-between gap-4">
        {{-- Tabs --}}
        <div class="flex p-1 bg-gray-100 dark:bg-emerald-950/20 rounded-2xl w-full md:w-auto">
            <button onclick="switchTab('ad')" id="tab-btn-ad" class="flex-1 md:flex-none px-6 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 bg-white text-emerald-900 shadow-sm dark:bg-[#0e1713] dark:text-emerald-300">
                Anggaran Dasar (AD)
            </button>
            <button onclick="switchTab('art')" id="tab-btn-art" class="flex-1 md:flex-none px-6 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 text-gray-500 hover:text-emerald-900 dark:text-gray-400 dark:hover:text-emerald-300">
                Anggaran Rumah Tangga (ART)
            </button>
        </div>

        {{-- Mobile Chapter Selector --}}
        <div class="block lg:hidden w-full md:w-72">
            <select id="mobile-chapter-select" onchange="showChapter(this.value)" class="form-select w-full py-2.5 px-3 rounded-xl border-gray-200 dark:bg-[#0b120f] dark:border-emerald-950/40 text-xs font-bold text-emerald-800 dark:text-emerald-300">
                <!-- Will be populated dynamically by JavaScript -->
            </select>
        </div>
    </div>
</section>

{{-- Main Content Section --}}
<section class="max-w-none w-full px-4 sm:px-6 lg:px-12 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- Left Column: Navigation Sidebar (Chapters) --}}
        <div class="hidden lg:block lg:col-span-3 bg-white dark:bg-[#0b120f] border border-gray-150 dark:border-emerald-950/20 rounded-3xl p-5 max-h-[600px] overflow-y-auto sticky top-[170px] shadow-sm">
            <h3 class="font-bold text-gray-900 dark:text-white text-xs tracking-wider uppercase mb-4 px-2">Daftar Bab</h3>
            
            {{-- AD Chapter List --}}
            <div id="sidebar-ad" class="space-y-1">
                <!-- Populated dynamically -->
            </div>

            {{-- ART Chapter List --}}
            <div id="sidebar-art" class="space-y-1 hidden">
                <!-- Populated dynamically -->
            </div>
        </div>

        {{-- Right Column: Reader Card --}}
        <div class="lg:col-span-9 bg-white dark:bg-[#0b120f] border border-gray-150 dark:border-emerald-950/20 rounded-3xl p-6 sm:p-8 shadow-sm min-h-[500px] flex flex-col justify-between">
            
            {{-- Document content panels --}}
            <div id="content-container">
                
                {{-- ================= ANGGARAN DASAR PANELS ================= --}}
                
                {{-- AD BAB 1 --}}
                <div id="ad-panel-1" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB I<br>NAMA, JANGKA WAKTU dan TEMPAT KEDUDUKAN</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 1</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Organisasi ini bernama Perkumpulan Manajer Pendidikan Islam, selanjutnya disingkat Perma Pendis.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 2</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Perma Pendis adalah organisasi perkumpulan Profesi di bawah Perkumpulan Program Studi Manajemen Pendidikan Islam (PPMPI) sebagai wadah berhimpunnya manajer dalam bidang manajerial Pendidikan Islam, yang berpegang teguh pada Kode Etik Manajer Pendidikan Islam Indonesia.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 3</span>
                            <div class="space-y-2 text-sm text-gray-700 dark:text-gray-350">
                                <p class="font-medium">(1) Perma Pendis berkedudukan di Indonesia.</p>
                                <p class="font-medium">(2) Pusat organisasi Perma Pendis Indonesia berkedudukan di mana Ketua Umum berdomisili.</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300 md:col-span-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 4</span>
                            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-350">
                                <p class="font-medium">(1) Perma Pendis Indonesia dapat didirikan di seluruh wilayah Negara Kesatuan Republik Indonesia sebagai pengembangan tugas dan fungsi koordinasi kewilayahan serta merupakan bagian tak terpisahkan dari Perma Pendis Indonesia; selanjutnya disebut Pengurus Wilayah (PW) Perma Pendis Indonesia.</p>
                                <p class="font-medium">(2) Pengurus wilayah dibentuk berdasarkan 8 (delapan) zona wilayah kepulauan di Indonesia, meliputi:</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs mt-2 pl-2 border-l-2 border-emerald-500">
                                    <p><strong>Wilayah I:</strong> Banten, DKI Jakarta, Jawa Barat</p>
                                    <p><strong>Wilayah II:</strong> Jawa Tengah, Yogyakarta, Jawa Timur</p>
                                    <p><strong>Wilayah III:</strong> Bali, NTB, NTT, Sumbawa</p>
                                    <p><strong>Wilayah IV:</strong> Lampung, Sumsel, Bengkulu, Babel, Jambi</p>
                                    <p><strong>Wilayah V:</strong> Aceh, Sumut, Sumbar, Riau, Kepri</p>
                                    <p><strong>Wilayah VI:</strong> Kalbar, Kalteng, Kalsel, Kaltim, Kaltara</p>
                                    <p><strong>Wilayah VII:</strong> Sulsel, Sultra, Sulbar, Sulteng, Sulut, Gorontalo</p>
                                    <p><strong>Wilayah VIII:</strong> Papua, Papua Barat, Maluku, Maluku Utara</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 2 --}}
                <div id="ad-panel-2" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB II<br>ASAS dan LANDASAN</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 5</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Perma Pendis Indonesia berasaskan Pancasila dan berlandaskan Undang Undang Dasar Negara Republik Indonesia Tahun 1945 beserta perubahan-perubahannya, serta tidak berafiliasi pada organisasi politik tertentu.</p>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 3 --}}
                <div id="ad-panel-3" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB III<br>VISI, MISI, dan TUJUAN</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 6 - Visi</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed font-semibold text-emerald-800 dark:text-emerald-300">Menjadi organisasi profesi bermutu dalam dalam pengembangan kompetensi tenaga kependidikan, tenaga analisis dan peneliti pendidikan.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 7 - Misi</span>
                            <div class="space-y-2 text-xs sm:text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>(1)</strong> Memelihara integritas, komitmen, dan kompetensi anggota dalam mengembangkan manajemen pendidikan Islam yang bermutu.</p>
                                <p><strong>(2)</strong> Mengembangkan profesionalisme manajer melalui peningkatan kompetensi manajerial.</p>
                                <p><strong>(3)</strong> Membangun jaringan manajer pendidikan Islam sebagai wadah produktifitas dan inovasi.</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 8 - Tujuan</span>
                            <div class="space-y-2 text-xs sm:text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>a.</strong> Mewujudkan integritas, komitmen, dan kompetensi anggota dalam manajemen bermutu.</p>
                                <p><strong>b.</strong> Meningkatkan profesionalisme manajer melalui kompetensi manajerial.</p>
                                <p><strong>c.</strong> Mewujudkan jaringan manajer untuk kontribusi pembangunan manusia Indonesia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 4 --}}
                <div id="ad-panel-4" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB IV<br>KEANGGOTAAN</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 9 - Kategori</span>
                            <div class="space-y-2 text-sm text-gray-700 dark:text-gray-350">
                                <p>Anggota Perma Pendis Indonesia terdiri dari:</p>
                                <p class="font-medium">1) Seluruh Anggota Perkumpulan Program Studi MPI (PPMPI)</p>
                                <p class="font-medium">2) Praktisi dan pemerhati Kependidikan.</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 10 - Hak & Kewajiban</span>
                            <div class="space-y-2 text-sm text-gray-700 dark:text-gray-350">
                                <p class="font-medium">(1) Setiap anggota Perma Pendis Indonesia mempunyai hak dan kewajiban yang sama.</p>
                                <p class="font-medium">(2) Hak dan kewajiban anggota diatur lebih lanjut dalam Anggaran Rumah Tangga.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 5 --}}
                <div id="ad-panel-5" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB V<br>KODE ETIK MANAJER PENDIDIKAN ISLAM</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 11</span>
                            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>(1)</strong> Kode Etik Manajer Pendidikan Islam adalah pedoman normatif tentang perilaku yang harus dipatuhi dalam melaksanakan kegiatan profesi bagi manajer Pendidikan Islam.</p>
                                <p><strong>(2)</strong> Kode Etik Manajer Pendidikan Islam berfungsi memberikan jaminan pelayanan profesional manajer Pendidikan Islam bagi pengguna jasa layanan manajerial pendidikan Islam.</p>
                                <p><strong>(3)</strong> Kode Etik Manajer Pendidikan Islam diatur tersendiri dan menjadi landasan bagi Anggaran Dasar dan Anggaran Rumah Tangga Perma Pendis Indonesia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 6 --}}
                <div id="ad-panel-6" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB VI<br>PERANGKAT PENYELENGGARA ORGANISASI</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">1. DPP</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Penyelenggara organisasi tertinggi Perma Pendis Indonesia di tingkat pusat yang wilayah kerjanya meliputi Negara Kesatuan Republik Indonesia.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">2. DPW</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Penyelenggara organisasi di tingkat wilayah yang lingkup kerjanya meliputi beberapa propinsi di Indonesia.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">3. Ikatan Profesi</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Penyelenggara organisasi yang bertanggung jawab untuk pengembangan kompetensi profesi manajer pendidikan Islam.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">4. Dewan Pengawas</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Perangkat organisasi yang memberikan pertimbangan etis dan normatif kaitannya dengan kompetensi profesi manajer.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">5. Dewan Pakar</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Perangkat pendukung organisasi yang terdiri dari akademisi/guru besar bidang manajemen pendidikan Islam dan manajer perguruan tinggi.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">6. Dewan Kehormatan</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Para pengambil kebijakan ditingkat birokrat pemerintahan pusat dan daerah.</p>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 7 --}}
                <div id="ad-panel-7" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB VII<br>TATA HUBUNGAN ANTAR PERANGKAT PENYELENGGARA ORGANISASI</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 13</span>
                            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>(1)</strong> Dewan Pimpinan Pusat, Dewan Pimpinan Wilayah, Pengurus Ikatan profesi manajer pendidikan Islam dan Dewan Pengawas Perma Pendis Indonesia merupakan bagian yang tidak terpisahkan dalam organisasi Perma Pendis Indonesia.</p>
                                <p><strong>(2)</strong> Tata hubungan Dewan Pimpinan Pusat, Dewan Pimpinan Wilayah, Pengurus Ikatan profesi manajer pendidikan Islam serta Dewan Pengawas Perma Pendis Indonesia diatur dalam Anggaran Rumah Tangga.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 8 --}}
                <div id="ad-panel-8" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB VIII<br>PENGAMBILAN KEPUTUSAN</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300 md:col-span-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 14</span>
                            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-350">
                                <p class="font-semibold">(1) Pengambilan keputusan organisasi dilaksanakan dalam forum musyawarah dan mufakat.</p>
                                <p class="font-semibold">(2) Forum musyawarah dan mufakat diselenggarakan dalam bentuk:</p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs mt-2 pl-3 border-l-2 border-emerald-500">
                                    <p><strong>Tingkat Pusat:</strong><br>Kongres, Rapat Kerja Pengurus Pusat, Rapat Pengurus harian.</p>
                                    <p><strong>Tingkat Wilayah:</strong><br>Musyawarah Wilayah, Rapat Anggota wilayah, Rapat Pengurus harian wilayah.</p>
                                    <p><strong>Ikatan Profesi:</strong><br>Konferensi, Rapat Anggota, Rapat Pegurus.</p>
                                </div>
                                <p class="font-semibold mt-3">(3) Apabila mufakat tidak tercapai, keputusan diambil dengan pemungutan suara (voting) terbanyak secara bebas dan rahasia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 9 --}}
                <div id="ad-panel-9" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB IX<br>KEDUDUKAN DENGAN ORGANISASI LAIN</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 15</span>
                            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>(1)</strong> Perma Pendis Indonesia merupakan organisasi profesi manajer pendidikan Islam yang merepresentasikan profesi manajer pendidikan Islam di tingkat nasional.</p>
                                <p><strong>(2)</strong> Perma Pendis Indonesia dapat melakukan kerjasama dengan instansi dan/atau organisasi lain kaitannya dengan peningkatan profesi manajer pendidikan Islam.</p>
                                <p><strong>(3)</strong> Ketentuan lebih lanjut tentang kerjasama sebagaimana dimaksud pada pasal 15 ayat 2 diatur dalam Anggaran Rumah Tangga.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 10 --}}
                <div id="ad-panel-10" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB X<br>PENDANAAN</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 16</span>
                            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>(1) Dana organisasi diperoleh dari:</strong> a. Uang pangkal, b. Iuran Anggota, c. Sumber lain yang sah, halal, dan tidak mengikat.</p>
                                <p><strong>(2)</strong> Dana Organisasi hanya dapat dimanfaatkan untuk kepentingan organisasi.</p>
                                <p><strong>(3)</strong> Pemanfaatan dana organisasi harus menganut asas manfaat, keterbukaan, kewajaran, kepantasan dan tanggung jawab.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 11 --}}
                <div id="ad-panel-11" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XI<br>BENDERA, LAMBANG dan LAGU</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 17</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Ketentuan mengenai Bendera, Lambang dan Lagu organisasi diatur dalam Anggaran Rumah Tangga.</p>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 12 --}}
                <div id="ad-panel-12" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XII<br>ANGGARAN RUMAH TANGGA</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 18</span>
                            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>(1)</strong> Anggaran Rumah Tangga disusun dan disahkan oleh Kongres.</p>
                                <p><strong>(2)</strong> Hal-hal yang belum atau tidak diatur dalam Anggaran Dasar ini diatur dalam Anggaran Rumah Tangga.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 13 --}}
                <div id="ad-panel-13" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XIII<br>PERUBAHAN ANGGARAN DASAR</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 19</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Perubahan Anggaran Dasar hanya dapat dilakukan oleh Kongres dan disetujui paling sedikit dua per tiga (2/3) dari jumlah peserta yang memiliki hak suara yang hadir dalam Kongres tersebut.</p>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 14 --}}
                <div id="ad-panel-14" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XIV<br>PEMBUBARAN ORGANISASI</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 20</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Perma Pendis Indonesia hanya dapat dibubarkan oleh Kongres yang khusus diadakan untuk keperluan tersebut.</p>
                        </div>
                    </div>
                </div>

                {{-- AD BAB 15 --}}
                <div id="ad-panel-15" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN DASAR</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XV<br>PENUTUP</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 21 - Pengesahan</span>
                            <div class="space-y-3 text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>(1)</strong> Anggaran Dasar ini disahkan pada Kongres ke-I Tanggal 9 Bulan Februari tahun 2019 bertempat di Pondok Pesantren Tebuireng Jombang Jawa Timur.</p>
                                <p><strong>(2)</strong> Anggaran Dasar ini berlaku sejak saat disahkan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                
                {{-- ================= ANGGARAN RUMAH TANGGA PANELS ================= --}}

                {{-- ART BAB 1 --}}
                <div id="art-panel-1" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB I<br>NAMA dan KEDUDUKAN</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 1</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed"><strong>(1)</strong> Nama: Perkumpulan Manajer Pendidikan Islam, didirikan 27 September 2018 sesuai Akta Notaris Handi S.H., M.Kn. & Keputusan Menkumham RI No. AHU-0011862.AH.01.07.2018.<br><strong>(2)</strong> Disingkat Perma Pendis.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 2</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed"><strong>(1)</strong> Kedudukan di Indonesia meliputi wilayah NKRI.<br><strong>(2)</strong> Disebut Perma Pendis Indonesia.<br><strong>(3)</strong> Kantor Pusat berdomisili di tempat tinggal Ketua Umum terpilih.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 3</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed"><strong>(1)</strong> Perma Pendis Wilayah berkedudukan di propinsi dan memiliki wewenang pada wilayah propinsi bersangkutan.<br><strong>(2)</strong> Pengurus Wilayah didirikan sebagai koordinator daerah.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 2 --}}
                <div id="art-panel-2" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB II<br>TUJUAN</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 4</span>
                            <div class="space-y-2 text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>1)</strong> Mewujudkan integritas, komitmen, dan kompetensi anggota dalam mengembangkan manajemen pendidikan Islam yang bermutu.</p>
                                <p><strong>2)</strong> Meningkatkan profesionalisme manajer pendidikan Islam melalui peningkatan kompetensi manajerial.</p>
                                <p><strong>3)</strong> Mewujudkan jaringan manajer pendidikan Islam sebagai wahana untuk meningkatkan produktifitas dan inovasi yang mampu memberikan kontribusi terhadap pembangunan manusia Indonesia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 3 --}}
                <div id="art-panel-3" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB III<br>KEANGGOTAAN</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 5 - Kategori</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">1) Anggota PPMPI.<br>2) Praktisi (Kepala Sekolah, pustakawan, laboran, birokrat) dan pemerhati Kependidikan.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 6 - Syarat</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Memiliki kartu anggota PPMPI untuk akademisi/prodi, atau surat keterangan/sertifikat profesi yang relevan bagi praktisi.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 7 - Hak</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Mendapat perlindungan hukum/profesi, pembinaan kompetensi, hak suara (memilih dan dipilih), mengajukan saran, dan mengikuti kegiatan.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 8 - Kewajiban</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Menjunjung tinggi Kode Etik, taat AD/ART, menjaga reputasi lembaga, dan membayar iuran rutin anggota.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 9 & 10 - Berhenti</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Kehilangan keanggotaan karena wafat, mundur, atau diberhentikan oleh DPP atas rekomendasi wilayah akibat pelanggaran berat.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 11 - Pembelaan</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Anggota yang terancam sanksi pemberhentian berhak mengajukan pembelaan diri secara tertulis di depan sidang Dewan Pengawas.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 4 --}}
                <div id="art-panel-4" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB IV<br>KODE ETIK MANAJER PENDIDIKAN ISLAM</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 12</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed"><strong>(1)</strong> Kode Etik manajer pendidikan Islam merupakan panduan normatif tentang perilaku yang harus dipatuhi dalam melaksanakan kegiatan profesional bagi manajer pendidikan Islam.<br><strong>(2)</strong> Kode etik mencakup: relasi profesi, asesmen manajerial, pelaksanaan intervensi, penelitian, evaluasi kerja, dan konsultasi pendidikan.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 5 --}}
                <div id="art-panel-5" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB V<br>PERANGKAT PENYELENGGARA ORGANISASI</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 13</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Perangkat Penyelenggara organisasi terdiri atas:<br><strong>a.</strong> Dewan Pimpinan Pusat (DPP)<br><strong>b.</strong> Dewan Pimpinan Wilayah (DPW)<br><strong>c.</strong> Pengurus Ikatan Profesi Manajer Pendidikan Islam<br><strong>d.</strong> Dewan Pengawas<br><strong>e.</strong> Dewan Pakar<br><strong>f.</strong> Dewan Kehormatan</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 6 --}}
                <div id="art-panel-6" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB VI<br>PERANGKAT PENYELENGGARA ORGANISASI DI TINGKAT PUSAT</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 14 & 15</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Masa bakti DPP 4 tahun. Ketua Umum dibatasi maksimal 2 periode berturut-turut. Pengurus wajib menjalankan keputusan kongres dan membuat pelaporan akhir.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 16 s.d 19</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Pengurus dilantik secara resmi dan mengucapkan sumpah/janji jabatan di depan kongres. Susunan pengurus pusat disahkan maksimal 30 hari pasca pemilihan.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 7 --}}
                <div id="art-panel-7" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB VII<br>PERANGKAT PENYELENGGARA ORGANISASI DI TINGKAT WILAYAH</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 20 & 21</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">PW dipimpin Ketua Wilayah yang dipilih di Musyawarah Wilayah (Muswil) untuk masa bakti 4 tahun demi mengawal pergerakan program di tingkat provinsi.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 22 & 23</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Pengurus Wilayah memiliki wewenang mengeluarkan aturan pelaksanaan program kerja lokal asal selaras dengan AD/ART dan arahan umum DPP.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 8 --}}
                <div id="art-panel-8" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB VIII<br>PERANGKAT PENYELENGGARA IKATAN PROFESI</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 24 s.d 26</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Ikatan Profesi dibentuk guna memfokuskan pengembangan bidang minat dan keterampilan spesifik para manajer pendidikan Islam Indonesia.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 27 & 28</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Pengurus Ikatan Profesi dipilih dalam konferensi nasional dan bertanggung jawab kepada DPP atas kemajuan bidang keprofesian yang bersangkutan.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 9 --}}
                <div id="art-panel-9" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB IX<br>DEWAN PENGAWAS</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 29 s.d 31</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Dewan Pengawas bertugas memberikan pertimbangan etis normatif kepada pengurus dan memeriksa kepatuhan kerja terhadap anggaran dasar.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 32 s.d 34</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Terdiri atas 3 hingga 5 orang tokoh berpengalaman di bidang kepemimpinan pendidikan Islam dengan masa bakti kepengurusan selama 2 tahun.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 35 s.d 37</span>
                            <p class="text-xs text-gray-650 dark:text-gray-400">Dewan Pengawas berhak memanggil pengurus apabila terdapat dugaan penyelewengan visi-misi organisasi secara substansial.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 10 --}}
                <div id="art-panel-10" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB X<br>TATA HUBUNGAN ANTAR PERANGKAT PENYELENGGARA ORGANISASI</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 38</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Segala bentuk regulasi di tingkat Wilayah (PW) dan Ikatan Profesi wajib merujuk serta dilarang bertentangan dengan keputusan strategis yang dikeluarkan DPP.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 11 --}}
                <div id="art-panel-11" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XI<br>PENGAMBILAN KEPUTUSAN</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 39</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Pengambilan keputusan di semua tingkatan (Pusat, Wilayah, dan Ikatan Profesi) wajib mengedepankan asas musyawarah mufakat demi persatuan organisasi.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 12 --}}
                <div id="art-panel-12" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XII<br>PENGAMBILAN KEPUTUSAN TINGKAT PUSAT</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 40 s.d 43 - Kongres</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Kongres nasional diselenggarakan 4 tahun sekali. Merupakan lembaga legislatif tertinggi yang menetapkan AD/ART, memilih Ketum, dan evaluasi laporan.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 44 s.d 47 - Raker</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Rapat Kerja Nasional (Rakernas) dilaksanakan minimal 3 kali dalam satu masa jabatan untuk menyusun teknis operasional dan koordinasi.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 13 --}}
                <div id="art-panel-13" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XIII<br>PENGAMBILAN KEPUTUSAN TINGKAT WILAYAH</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 48 s.d 51 - Muswil</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Musyawarah Wilayah (Muswil) diadakan sekali dalam 4 tahun, berwenang memilih kepengurusan daerah dan menyusun arah program kerja propinsi.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 52 s.d 55 - Rakerwil</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Rakerwil diselenggarakan secara berkala untuk mengevaluasi realisasi ketetapan Muswil dan menyusun anggaran belanja kepengurusan daerah.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 14 --}}
                <div id="art-panel-14" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XIV<br>PENGAMBILAN KEPUTUSAN IKATAN PROFESI</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 56 s.d 59 - Konferensi</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Merupakan forum tertinggi pengambilan keputusan di tubuh Ikatan Profesi, diadakan sekali dalam 4 tahun untuk menentukan visi-misi spesialisasi.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 60 s.d 63 - Rapat Kerja</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Rapat Kerja Ikatan Profesi fokus merancang modul peningkatan skill, standar sertifikasi, dan kurikulum pembinaan khusus keilmuan manajer.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 15 --}}
                <div id="art-panel-15" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XV<br>SANKSI ORGANISASI</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 64</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Pengurus Pusat (DPP) berhak mengambil sanksi pembekuan sementara atau permanen terhadap PW/Ikatan Profesi jika melanggar ketentuan AD/ART.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 16 --}}
                <div id="art-panel-16" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XVI<br>KEDUDUKAN PERMA PENDIS INDONESIA DENGAN ORGANISASI PROFESI LAIN</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 65</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Perma Pendis Indonesia berhak menjadi perwakilan tunggal kemitraan profesi manajer pendidikan Islam pada lembaga standarisasi nasional.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 66</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Membangun kerjasama tripartit dengan perguruan tinggi, lembaga penjamin mutu, dan asosiasi manajer pendidikan luar negeri.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 17 --}}
                <div id="art-panel-17" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XVII<br>KEUANGAN</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 67</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed"><strong>(1)</strong> Tarif uang pangkal dan iuran anggota diputuskan di Rakernas.<br><strong>(2)</strong> Pembagian persentase dana: 50% uang pangkal awal diserahkan ke DPP, 25% iuran rutin wilayah disetor ke DPP, dan 10% iuran ikatan disetor ke kas DPP.<br><strong>(3)</strong> Laporan audit keuangan wajib dipaparkan di depan forum Kongres oleh pengurus.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 18 --}}
                <div id="art-panel-18" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XVIII<br>BENDERA, LAMBANG, dan LAGU</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 68 - Arti Lambang</span>
                            <div class="space-y-2 text-xs sm:text-sm text-gray-700 dark:text-gray-350">
                                <p><strong>Logo Madrasah Modern:</strong> Melambangkan visi pendidikan masa depan berciri khas islami.</p>
                                <p><strong>Bingkai Hurup "P" Ganda:</strong> Representasi erat nama organisasi Perma Pendis.</p>
                                <p><strong>Kaligrafi & Bulan Bintang:</strong> Menunjukkan pondasi keislaman dan orientasi nilai spiritual.</p>
                                <p><strong>Siluet Jabat Tangan:</strong> Komitmen kekeluargaan, kolaborasi, dan kemitraan antarmanajer.</p>
                                <p><strong>Warna Hijau & Gold:</strong> Menunjukkan integrasi Iman, Ilmu, Amal, serta kemakmuran profesi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 19 --}}
                <div id="art-panel-19" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XIX<br>PERUBAHAN ANGGARAN DASAR Dan ANGGARAN RUMAH TANGGA</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 69</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Usulan perubahan materi AD/ART hanya dapat diajukan di sidang komisi legislasi Kongres dan disetujui minimal 2/3 delegasi utusan wilayah.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 20 --}}
                <div id="art-panel-20" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XX<br>PEMBUBARAN ORGANISASI</h2>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 70</span>
                            <p class="text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Pembubaran perkumpulan Perma Pendis hanya sah jika disetujui sekurang-kurangnya 2/3 suara utusan dalam Kongres Luar Biasa khusus pembubaran.</p>
                        </div>
                    </div>
                </div>

                {{-- ART BAB 21 --}}
                <div id="art-panel-21" class="chapter-panel hidden space-y-6">
                    <div class="text-center space-y-2 mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 dark:text-emerald-450 uppercase">ANGGARAN RUMAH TANGGA</span>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white uppercase">BAB XXI<br>PENUTUP</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 71</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Hal-hal teknis administratif yang belum diatur dalam Anggaran Rumah Tangga ini akan ditetapkan lebih lanjut oleh DPP melalui keputusan/peraturan organisasi.</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-emerald-950/10 border border-gray-100 dark:border-emerald-950/20 p-5 rounded-2xl shadow-sm hover:shadow-md transition duration-300">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300 mb-3">Pasal 72</span>
                            <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-350 leading-relaxed">Anggaran Rumah Tangga ini disahkan secara resmi pada Kongres Nasional ke-I Perma Pendis di Jombang Jawa Timur, 9 Februari 2019, dan berlaku sejak tanggal disahkan.</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Bottom Navigation Controls --}}
            <div class="flex items-center justify-between border-t border-gray-100 dark:border-emerald-950/10 pt-6 mt-8">
                <button id="prev-btn" onclick="prevChapter()" class="flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-gray-650 bg-gray-50 hover:bg-gray-100 dark:bg-emerald-950/10 dark:text-gray-300 dark:hover:bg-emerald-950/20 transition">
                    ← Bab Sebelumnya
                </button>
                <span id="chapter-progress" class="text-xs font-semibold text-gray-400">
                    Bab 1 dari 15
                </span>
                <button id="next-btn" onclick="nextChapter()" class="flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-white bg-primary-650 hover:bg-primary-700 transition">
                    Bab Selanjutnya →
                </button>
            </div>

        </div>

    </div>
</section>

{{-- Setup chapters metadata and handlers --}}
<script>
    // Chapter definitions
    const adChapters = [
        { id: 1, title: 'Bab I: Nama, Jangka Waktu, & Kedudukan' },
        { id: 2, title: 'Bab II: Asas & Landasan' },
        { id: 3, title: 'Bab III: Visi, Misi, & Tujuan' },
        { id: 4, title: 'Bab IV: Keanggotaan' },
        { id: 5, title: 'Bab V: Kode Etik Profesi' },
        { id: 6, title: 'Bab VI: Perangkat Penyelenggara' },
        { id: 7, title: 'Bab VII: Tata Hubungan Perangkat' },
        { id: 8, title: 'Bab VIII: Pengambilan Keputusan' },
        { id: 9, title: 'Bab IX: Hubungan Organisasi Lain' },
        { id: 10, title: 'Bab X: Pendanaan' },
        { id: 11, title: 'Bab XI: Bendera, Lambang, & Lagu' },
        { id: 12, title: 'Bab XII: Anggaran Rumah Tangga' },
        { id: 13, title: 'Bab XIII: Perubahan Anggaran Dasar' },
        { id: 14, title: 'Bab XIV: Pembubaran Organisasi' },
        { id: 15, title: 'Bab XV: Penutup & Pengesahan' }
    ];

    const artChapters = [
        { id: 1, title: 'Bab I: Nama & Kedudukan' },
        { id: 2, title: 'Bab II: Tujuan Organisasi' },
        { id: 3, title: 'Bab III: Keanggotaan' },
        { id: 4, title: 'Bab IV: Kode Etik Profesi' },
        { id: 5, title: 'Bab V: Perangkat Penyelenggara' },
        { id: 6, title: 'Bab VI: Perangkat Tingkat Pusat' },
        { id: 7, title: 'Bab VII: Perangkat Tingkat Wilayah' },
        { id: 8, title: 'Bab VIII: Perangkat Ikatan Profesi' },
        { id: 9, title: 'Bab IX: Dewan Pengawas' },
        { id: 10, title: 'Bab X: Tata Hubungan Perangkat' },
        { id: 11, title: 'Bab XI: Pengambilan Keputusan' },
        { id: 12, title: 'Bab XII: Keputusan Tingkat Pusat' },
        { id: 13, title: 'Bab XIII: Keputusan Tingkat Wilayah' },
        { id: 14, title: 'Bab XIV: Keputusan Ikatan Profesi' },
        { id: 15, title: 'Bab XV: Sanksi Organisasi' },
        { id: 16, title: 'Bab XVI: Hubungan Organisasi Lain' },
        { id: 17, title: 'Bab XVII: Keuangan Organisasi' },
        { id: 18, title: 'Bab XVIII: Atribut Lambang & Lagu' },
        { id: 19, title: 'Bab XIX: Perubahan AD/ART' },
        { id: 20, title: 'Bab XX: Pembubaran Organisasi' },
        { id: 21, title: 'Bab XXI: Penutup & Pengesahan' }
    ];

    let currentTab = 'ad'; // 'ad' or 'art'
    let currentAdChapter = 1;
    let currentArtChapter = 1;

    // Build sidebar and selectors
    function renderNavigation() {
        const sidebarAd = document.getElementById('sidebar-ad');
        const sidebarArt = document.getElementById('sidebar-art');
        const mobileSelect = document.getElementById('mobile-chapter-select');
        
        // Render AD Sidebar
        sidebarAd.innerHTML = adChapters.map(ch => `
            <button onclick="showChapter(${ch.id})" id="btn-ad-${ch.id}" class="w-full text-left py-2.5 px-4 rounded-xl text-xs font-semibold transition border border-transparent hover:bg-gray-55 dark:hover:bg-emerald-950/20 text-gray-600 dark:text-gray-400">
                ${ch.title}
            </button>
        `).join('');

        // Render ART Sidebar
        sidebarArt.innerHTML = artChapters.map(ch => `
            <button onclick="showChapter(${ch.id})" id="btn-art-${ch.id}" class="w-full text-left py-2.5 px-4 rounded-xl text-xs font-semibold transition border border-transparent hover:bg-gray-55 dark:hover:bg-emerald-950/20 text-gray-600 dark:text-gray-400">
                ${ch.title}
            </button>
        `).join('');

        updateUI();
    }

    function switchTab(tab) {
        currentTab = tab;
        
        const adSidebar = document.getElementById('sidebar-ad');
        const artSidebar = document.getElementById('sidebar-art');
        
        if (tab === 'ad') {
            adSidebar.classList.remove('hidden');
            artSidebar.classList.add('hidden');
            
            document.getElementById('tab-btn-ad').className = "flex-1 md:flex-none px-6 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 bg-white text-emerald-900 shadow-sm dark:bg-[#0e1713] dark:text-emerald-300";
            document.getElementById('tab-btn-art').className = "flex-1 md:flex-none px-6 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 text-gray-500 hover:text-emerald-900 dark:text-gray-400 dark:hover:text-emerald-300";
            
            showChapter(currentAdChapter);
        } else {
            adSidebar.classList.add('hidden');
            artSidebar.classList.remove('hidden');
            
            document.getElementById('tab-btn-ad').className = "flex-1 md:flex-none px-6 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 text-gray-500 hover:text-emerald-900 dark:text-gray-400 dark:hover:text-emerald-300";
            document.getElementById('tab-btn-art').className = "flex-1 md:flex-none px-6 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 bg-white text-emerald-900 shadow-sm dark:bg-[#0e1713] dark:text-emerald-300";
            
            showChapter(currentArtChapter);
        }
    }

    function showChapter(id) {
        id = parseInt(id);
        if (currentTab === 'ad') {
            currentAdChapter = id;
        } else {
            currentArtChapter = id;
        }
        updateUI();
        
        // Smooth scroll reader into view for mobile devices
        if (window.innerWidth < 1024) {
            const container = document.getElementById('content-container');
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
            window.scrollTo({ top: 220, behavior: 'smooth' });
        }
    }

    function updateUI() {
        const activeId = currentTab === 'ad' ? currentAdChapter : currentArtChapter;
        const chaptersList = currentTab === 'ad' ? adChapters : artChapters;
        
        // Populate Mobile Select Options based on active tab
        const mobileSelect = document.getElementById('mobile-chapter-select');
        mobileSelect.innerHTML = chaptersList.map(ch => `
            <option value="${ch.id}" ${ch.id === activeId ? 'selected' : ''}>
                ${currentTab.toUpperCase()} - ${ch.title}
            </option>
        `).join('');

        // Hide all chapter panels
        document.querySelectorAll('.chapter-panel').forEach(panel => {
            panel.classList.add('hidden');
        });

        // Show active panel
        const activePanel = document.getElementById(`${currentTab}-panel-${activeId}`);
        if (activePanel) {
            activePanel.classList.remove('hidden');
        }

        // Update sidebar styling
        chaptersList.forEach(ch => {
            const btn = document.getElementById(`btn-${currentTab}-${ch.id}`);
            if (btn) {
                if (ch.id === activeId) {
                    btn.className = "w-full text-left py-2.5 px-4 rounded-xl text-xs font-bold transition bg-emerald-50 text-emerald-705 border border-emerald-500/10 dark:bg-emerald-950/20 dark:text-emerald-300";
                } else {
                    btn.className = "w-full text-left py-2.5 px-4 rounded-xl text-xs font-semibold transition border border-transparent hover:bg-gray-55 dark:hover:bg-emerald-950/10 text-gray-500 dark:text-gray-450";
                }
            }
        });

        // Update progress text
        document.getElementById('chapter-progress').innerText = `Bab ${activeId} dari ${chaptersList.length}`;

        // Disable/enable prev/next buttons
        document.getElementById('prev-btn').disabled = (activeId === 1);
        document.getElementById('prev-btn').style.opacity = (activeId === 1) ? '0.4' : '1';

        document.getElementById('next-btn').disabled = (activeId === chaptersList.length);
        document.getElementById('next-btn').style.opacity = (activeId === chaptersList.length) ? '0.4' : '1';
    }

    function nextChapter() {
        const activeId = currentTab === 'ad' ? currentAdChapter : currentArtChapter;
        const chaptersList = currentTab === 'ad' ? adChapters : artChapters;
        if (activeId < chaptersList.length) {
            showChapter(activeId + 1);
        }
    }

    function prevChapter() {
        const activeId = currentTab === 'ad' ? currentAdChapter : currentArtChapter;
        if (activeId > 1) {
            showChapter(activeId - 1);
        }
    }

    // Initialize layout on load
    if (document.readyState === "complete" || document.readyState === "interactive") {
        renderNavigation();
        switchTab('ad');
    } else {
        document.addEventListener("DOMContentLoaded", function() {
            renderNavigation();
            switchTab('ad');
        });
    }
</script>
@endsection
