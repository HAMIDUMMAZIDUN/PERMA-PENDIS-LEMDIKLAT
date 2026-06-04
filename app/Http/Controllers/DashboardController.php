<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('profile', 'role');
        
        // Fetch real metrics from DB
        $totalArticles = \App\Models\Article::count();
        $totalBoardMembers = \App\Models\BoardMember::count();
        $pendingApprovals = \App\Models\User::where('is_activated', false)->count();
        $activeUsers = \App\Models\User::where('is_activated', true)->count();
        $unreadMessages = \App\Models\ContactMessage::where('is_read', false)->count();
        
        // Fetch recent records
        $recentArticles = \App\Models\Article::with('category')->latest()->take(3)->get();
        $recentBoardMembers = \App\Models\BoardMember::latest()->take(3)->get();
        $recentPendingUsers = \App\Models\User::where('is_activated', false)->with('profile', 'role')->latest()->take(3)->get();
        $recentMessages = \App\Models\ContactMessage::latest()->take(3)->get();
        
        return view('dashboard.index', compact(
            'user', 
            'totalArticles', 
            'totalBoardMembers', 
            'pendingApprovals', 
            'activeUsers',
            'unreadMessages',
            'recentArticles',
            'recentBoardMembers',
            'recentPendingUsers',
            'recentMessages'
        ));
    }

    public function settings(Request $request)
    {
        $user = Auth::user()->load('profile', 'role');
        $activeTab = $request->query('tab', 'hero');
        
        $settings = [
            'app_logo' => \App\Models\Setting::get('app_logo', asset('img/logo.png')),
            'home_welcome_title' => \App\Models\Setting::get('home_welcome_title', "Selamat Datang di\nPERMA PENDIS\nPerkumpulan Manajer Pendidikan Islam\nIndonesia"),
            'home_welcome_desc' => \App\Models\Setting::get('home_welcome_desc', 'Perkumpulan Manajer Pendidikan Islam Indonesia adalah wadah berdedikasi untuk meningkatkan kompetensi manajer dan tenaga pendidik Islam di Indonesia.'),
            'home_bg_type' => \App\Models\Setting::get('home_bg_type', 'color'),
            'home_bg_color' => \App\Models\Setting::get('home_bg_color', '#e8f4fd'),
            'home_bg_color_dark' => \App\Models\Setting::get('home_bg_color_dark', '#070e17'),
            'home_bg_image' => \App\Models\Setting::get('home_bg_image', ''),
            'home_img_1' => \App\Models\Setting::get('home_img_1', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=300&h=200&fit=crop'),
            'home_img_2' => \App\Models\Setting::get('home_img_2', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=200&h=130&fit=crop'),
            'home_img_3' => \App\Models\Setting::get('home_img_3', 'https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=200&h=130&fit=crop'),
            'home_img_4' => \App\Models\Setting::get('home_img_4', 'https://images.unsplash.com/photo-1588702547923-7408e47e5d6e?w=200&h=130&fit=crop'),
            'home_img_5' => \App\Models\Setting::get('home_img_5', 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=200&h=130&fit=crop'),
            'home_program_img_1' => \App\Models\Setting::get('home_program_img_1', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=250&fit=crop'),
            'home_program_img_2' => \App\Models\Setting::get('home_program_img_2', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=400&h=250&fit=crop'),
            'home_program_img_3' => \App\Models\Setting::get('home_program_img_3', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400&h=250&fit=crop'),
            'stat_alumni' => \App\Models\Setting::get('stat_alumni', '500+'),
            'stat_instruktur' => \App\Models\Setting::get('stat_instruktur', '20+'),
            'stat_program' => \App\Models\Setting::get('stat_program', '3'),
            'stat_tahun' => \App\Models\Setting::get('stat_tahun', '10+'),
            'why_title' => \App\Models\Setting::get('why_title', 'Mengapa Memilih Kami?'),
            'why_desc' => \App\Models\Setting::get('why_desc', 'Komitmen kami adalah meningkatkan kualitas SDM pendidikan nasional melalui program terakreditasi dan profesional.'),
            'why_card_title_1' => \App\Models\Setting::get('why_card_title_1', 'Pengalaman & Kompeten'),
            'why_card_desc_1' => \App\Models\Setting::get('why_card_desc_1', 'Didukung oleh instruktur profesional bersertifikasi nasional dengan pengalaman puluhan tahun.'),
            'why_card_title_2' => \App\Models\Setting::get('why_card_title_2', 'Kurikulum Relevan'),
            'why_card_desc_2' => \App\Models\Setting::get('why_card_desc_2', 'Materi pelatihan disesuaikan dengan kurikulum nasional terbaru serta kebutuhan digitalisasi sekolah.'),
            'why_card_title_3' => \App\Models\Setting::get('why_card_title_3', 'Inovasi Digital'),
            'why_card_desc_3' => \App\Models\Setting::get('why_card_desc_3', 'Metode pembelajaran berbasis teknologi tinggi yang praktis, fleksibel, dan mudah diimplementasikan.'),
            'why_card_title_4' => \App\Models\Setting::get('why_card_title_4', 'Jejaring Nasional'),
            'why_card_desc_4' => \App\Models\Setting::get('why_card_desc_4', 'Hubungan erat dengan ribuan pengurus dan kepala sekolah se-Indonesia untuk berbagi ide.'),
            'scheme_title' => \App\Models\Setting::get('scheme_title', 'Skema Pendidikan & Pelatihan'),
            'scheme_desc' => \App\Models\Setting::get('scheme_desc', 'Beberapa program pelatihan berjenjang yang kami tawarkan untuk kepala sekolah di seluruh tingkat satuan pendidikan.'),
            'scheme_title_1' => \App\Models\Setting::get('scheme_title_1', 'Pelatihan Kepala Sekolah SD / MI'),
            'scheme_desc_1' => \App\Models\Setting::get('scheme_desc_1', 'Membekali kepala sekolah dasar dalam merancang strategi pembelajaran inovatif, pengelolaan tim pendidik dasar, serta komunikasi kemitraan dengan wali murid.'),
            'scheme_title_2' => \App\Models\Setting::get('scheme_title_2', 'Pelatihan Kepala Sekolah SMP / MTs'),
            'scheme_desc_2' => \App\Models\Setting::get('scheme_desc_2', 'Program penguatan manajemen kesiswaan remaja, tata laksana manajemen sekolah menengah pertama, serta kepemimpinan transformatif era global.'),
            'scheme_title_3' => \App\Models\Setting::get('scheme_title_3', 'Pelatihan Kepala Sekolah SMA / SMK / MA'),
            'scheme_desc_3' => \App\Models\Setting::get('scheme_desc_3', 'Fokus pada kurikulum kesiapan karir, kerja sama industri modern (link and match), tata kelola sekolah tingkat menengah atas, dan kepemimpinan visioner digital.'),
            'about_badge' => \App\Models\Setting::get('about_badge', 'Mengenal Lembaga Kami'),
            'about_title' => \App\Models\Setting::get('about_title', 'Tentang PERMA PENDIS'),
            'about_desc' => \App\Models\Setting::get('about_desc', 'Lembaga Pendidikan dan Pelatihan berkomitmen tinggi meningkatkan kompetensi melalui program pelatihan terstruktur, kurikulum mutakhir, instruktur berpengalaman, serta pendekatan modern yang berorientasi hasil nyata.'),
            'about_visi' => \App\Models\Setting::get('about_visi', 'Menjadi pusat keunggulan (center of excellence) pengembangan kompetensi pendidik dan kependidikan yang berdaya saing tinggi, relevan dengan kemajuan digital, serta mendorong terciptanya budaya belajar sepanjang hayat di Indonesia.'),
            'about_misi' => \App\Models\Setting::get('about_misi', "- Menyelenggarakan program pelatihan berbasis kompetensi riil dan praktik manajemen terbaik.\n- Memfasilitasi ujian sertifikasi profesi untuk memvalidasi kualifikasi keahlian pendidik.\n- Membangun kolaborasi strategis dengan kementerian, dinas pendidikan, serta lembaga internasional."),
            'about_value_title_1' => \App\Models\Setting::get('about_value_title_1', 'Profesional & Teruji'),
            'about_value_desc_1' => \App\Models\Setting::get('about_value_desc_1', 'Instruktur bersertifikat BNSP, kurikulum adaptif standar industri, and fasilitas memadai.'),
            'about_value_title_2' => \App\Models\Setting::get('about_value_title_2', 'Kolaborasi Luas'),
            'about_value_desc_2' => \App\Models\Setting::get('about_value_desc_2', 'Kemitraan global & dinas pendidikan daerah untuk perluasan kesempatan karir alumni.'),
            'about_value_title_3' => \App\Models\Setting::get('about_value_title_3', 'Berorientasi Output'),
            'about_value_desc_3' => \App\Models\Setting::get('about_value_desc_3', 'Fokus utama kami adalah keberhasilan lulusan dalam menerapkan program belajar inovatif di sekolah.'),
            'contact_page_title' => \App\Models\Setting::get('contact_page_title', 'Hubungi Kami'),
            'contact_page_desc' => \App\Models\Setting::get('contact_page_desc', 'Kami siap melayani kebutuhan informasi program pelatihan, sertifikasi pengajar, serta kerja sama kelembagaan.'),
            'contact_address' => \App\Models\Setting::get('contact_address', 'Jl. Gedebage Selatan No.137 Kel. Cisaranteun Kidul, Kec. Gedebage, Kota Bandung, Jawa Barat 40295'),
            'contact_email' => \App\Models\Setting::get('contact_email', 'info@permapendis.com'),
            'contact_phone' => \App\Models\Setting::get('contact_phone', '0812-3456-7890'),
            'contact_map_embed' => \App\Models\Setting::get('contact_map_embed', 'https://maps.google.com/maps?width=100%25&height=320&hl=id&q=Jl.+Gedebage+Selatan+No.137,+Bandung&t=&z=14&ie=UTF8&iwloc=B&output=embed'),
            'cta_title' => \App\Models\Setting::get('cta_title', 'Siap Untuk Meningkatkan Kualitas Sekolah Anda?'),
            'cta_desc' => \App\Models\Setting::get('cta_desc', 'Daftarkan diri Anda sekarang sebagai peserta pelatihan profesional dan kembangkan kompetensi kepemimpinan institusi pendidikan.'),
            'gallery_title' => \App\Models\Setting::get('gallery_title', 'Arsip Dokumentasi'),
            'gallery_desc' => \App\Models\Setting::get('gallery_desc', 'Galeri momentum kegiatan pelatihan, sertifikasi, dan kemitraan strategis PERMA PENDIS.'),
            'gallery_items' => (function() {
                $galleryItemsJson = \App\Models\Setting::get('gallery_items');
                if ($galleryItemsJson) {
                    return json_decode($galleryItemsJson, true);
                }
                $galleryItems = [];
                $defaultImages = [
                    1 => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&h=400&fit=crop',
                    2 => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=600&h=400&fit=crop',
                    3 => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=600&h=400&fit=crop',
                    4 => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&h=400&fit=crop',
                    5 => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=600&h=400&fit=crop',
                    6 => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600&h=400&fit=crop',
                ];
                $defaultCaptions = [
                    1 => 'Wisuda Kelulusan Kepala Sekolah',
                    2 => 'Seminar Kepemimpinan Transformasional',
                    3 => 'Lokakarya Kurikulum Digital',
                    4 => 'Pemaparan Program Kerja',
                    5 => 'Sesi Pelatihan Interaktif',
                    6 => 'Pusat Sumber Belajar Modern',
                ];
                for ($i = 1; $i <= 6; $i++) {
                    $img = \App\Models\Setting::get("gallery_img_{$i}", $defaultImages[$i]);
                    $caption = \App\Models\Setting::get("gallery_caption_{$i}", $defaultCaptions[$i]);
                    if ($img) {
                        $galleryItems[] = [
                            'image' => $img,
                            'caption' => $caption ?: '',
                        ];
                    }
                }
                return $galleryItems;
            })(),
        ];

        return view('dashboard.settings', compact('user', 'settings', 'activeTab'));
    }

    public function updateSettings(Request $request)
    {
        $activeTab = $request->input('tab', 'hero');

        $rules = [];
        if ($activeTab === 'hero') {
            $rules = [
                'home_welcome_title' => 'required|string|max:255',
                'home_welcome_desc' => 'required|string',
                'stat_alumni' => 'required|string|max:50',
                'stat_instruktur' => 'required|string|max:50',
                'stat_program' => 'required|string|max:50',
                'stat_tahun' => 'required|string|max:50',
            ];
        } elseif ($activeTab === 'background') {
            $rules = [
                'app_logo_url' => 'nullable|url',
                'app_logo_file' => 'nullable|image|max:512000',
                'home_bg_type' => 'required|in:color,image',
                'home_bg_color' => 'nullable|string|max:20',
                'home_bg_color_dark' => 'nullable|string|max:20',
                'home_bg_image_url' => 'nullable|url',
                'home_bg_image_file' => 'nullable|image|max:512000',
            ];
        } elseif ($activeTab === 'why') {
            $rules = [
                'why_title' => 'required|string|max:255',
                'why_desc' => 'required|string',
                'why_card_title_1' => 'required|string|max:255',
                'why_card_desc_1' => 'required|string',
                'why_card_title_2' => 'required|string|max:255',
                'why_card_desc_2' => 'required|string',
                'why_card_title_3' => 'required|string|max:255',
                'why_card_desc_3' => 'required|string',
                'why_card_title_4' => 'required|string|max:255',
                'why_card_desc_4' => 'required|string',
            ];
        } elseif ($activeTab === 'scheme') {
            $rules = [
                'scheme_title' => 'required|string|max:255',
                'scheme_desc' => 'required|string',
                'scheme_title_1' => 'required|string|max:255',
                'scheme_desc_1' => 'required|string',
                'scheme_title_2' => 'required|string|max:255',
                'scheme_desc_2' => 'required|string',
                'scheme_title_3' => 'required|string|max:255',
                'scheme_desc_3' => 'required|string',
                'home_program_img_url_1' => 'nullable|url',
                'home_program_img_url_2' => 'nullable|url',
                'home_program_img_url_3' => 'nullable|url',
                'home_program_img_file_1' => 'nullable|image|max:512000',
                'home_program_img_file_2' => 'nullable|image|max:512000',
                'home_program_img_file_3' => 'nullable|image|max:512000',
            ];
        } elseif ($activeTab === 'about') {
            $rules = [
                'about_badge' => 'required|string|max:255',
                'about_title' => 'required|string|max:255',
                'about_desc' => 'required|string',
                'about_visi' => 'required|string',
                'about_misi' => 'required|string',
                'about_value_title_1' => 'required|string|max:255',
                'about_value_desc_1' => 'required|string',
                'about_value_title_2' => 'required|string|max:255',
                'about_value_desc_2' => 'required|string',
                'about_value_title_3' => 'required|string|max:255',
                'about_value_desc_3' => 'required|string',
            ];
        } elseif ($activeTab === 'contact') {
            $rules = [
                'contact_page_title' => 'required|string|max:255',
                'contact_page_desc' => 'required|string',
                'contact_address' => 'required|string',
                'contact_email' => 'required|email|max:255',
                'contact_phone' => 'required|string|max:100',
                'contact_map_embed' => 'required|string',
            ];
        } elseif ($activeTab === 'cta') {
            $rules = [
                'cta_title' => 'required|string|max:255',
                'cta_desc' => 'required|string',
            ];
        } elseif ($activeTab === 'gallery') {
            $rules = [
                'gallery_title' => 'required|string|max:255',
                'gallery_desc' => 'required|string',
                'gallery_items' => 'nullable|array',
                'gallery_items.*.caption' => 'nullable|string|max:255',
                'gallery_items.*.url' => 'nullable|url',
                'gallery_items.*.file' => 'nullable|image|max:512000',
                'gallery_items.*.sub_items' => 'nullable|array',
                'gallery_items.*.sub_items.*.url' => 'nullable|url',
                'gallery_items.*.sub_items.*.file' => 'nullable|image|max:512000',
            ];
        }

        $request->validate($rules);

        if ($activeTab === 'hero') {
            \App\Models\Setting::set('home_welcome_title', $request->home_welcome_title);
            \App\Models\Setting::set('home_welcome_desc', $request->home_welcome_desc);
            \App\Models\Setting::set('stat_alumni', $request->stat_alumni);
            \App\Models\Setting::set('stat_instruktur', $request->stat_instruktur);
            \App\Models\Setting::set('stat_program', $request->stat_program);
            \App\Models\Setting::set('stat_tahun', $request->stat_tahun);
        } elseif ($activeTab === 'background') {
            if ($request->hasFile('app_logo_file')) {
                $file = $request->file('app_logo_file');
                $filename = "app_logo_" . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                \App\Models\Setting::set('app_logo', asset('uploads/settings/' . $filename));
            } elseif ($request->filled('app_logo_url')) {
                \App\Models\Setting::set('app_logo', $request->app_logo_url);
            }
            \App\Models\Setting::set('home_bg_type', $request->home_bg_type);
            \App\Models\Setting::set('home_bg_color', $request->home_bg_color ?? '#e8f4fd');
            \App\Models\Setting::set('home_bg_color_dark', $request->home_bg_color_dark ?? '#070e17');
            if ($request->hasFile('home_bg_image_file')) {
                $file = $request->file('home_bg_image_file');
                $filename = "home_bg_" . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                \App\Models\Setting::set('home_bg_image', asset('uploads/settings/' . $filename));
            } elseif ($request->filled('home_bg_image_url')) {
                \App\Models\Setting::set('home_bg_image', $request->home_bg_image_url);
            }
        } elseif ($activeTab === 'why') {
            \App\Models\Setting::set('why_title', $request->why_title);
            \App\Models\Setting::set('why_desc', $request->why_desc);
            \App\Models\Setting::set('why_card_title_1', $request->why_card_title_1);
            \App\Models\Setting::set('why_card_desc_1', $request->why_card_desc_1);
            \App\Models\Setting::set('why_card_title_2', $request->why_card_title_2);
            \App\Models\Setting::set('why_card_desc_2', $request->why_card_desc_2);
            \App\Models\Setting::set('why_card_title_3', $request->why_card_title_3);
            \App\Models\Setting::set('why_card_desc_3', $request->why_card_desc_3);
            \App\Models\Setting::set('why_card_title_4', $request->why_card_title_4);
            \App\Models\Setting::set('why_card_desc_4', $request->why_card_desc_4);
        } elseif ($activeTab === 'scheme') {
            \App\Models\Setting::set('scheme_title', $request->scheme_title);
            \App\Models\Setting::set('scheme_desc', $request->scheme_desc);
            \App\Models\Setting::set('scheme_title_1', $request->scheme_title_1);
            \App\Models\Setting::set('scheme_desc_1', $request->scheme_desc_1);
            \App\Models\Setting::set('scheme_title_2', $request->scheme_title_2);
            \App\Models\Setting::set('scheme_desc_2', $request->scheme_desc_2);
            \App\Models\Setting::set('scheme_title_3', $request->scheme_title_3);
            \App\Models\Setting::set('scheme_desc_3', $request->scheme_desc_3);
            for ($i = 1; $i <= 3; $i++) {
                $fileKey = "home_program_img_file_{$i}";
                $urlKey = "home_program_img_url_{$i}";
                $settingKey = "home_program_img_{$i}";
                if ($request->hasFile($fileKey)) {
                    $file = $request->file($fileKey);
                    $filename = "home_program_img_{$i}_" . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/settings'), $filename);
                    \App\Models\Setting::set($settingKey, asset('uploads/settings/' . $filename));
                } elseif ($request->filled($urlKey)) {
                    \App\Models\Setting::set($settingKey, $request->$urlKey);
                }
            }
        } elseif ($activeTab === 'about') {
            \App\Models\Setting::set('about_badge', $request->about_badge);
            \App\Models\Setting::set('about_title', $request->about_title);
            \App\Models\Setting::set('about_desc', $request->about_desc);
            \App\Models\Setting::set('about_visi', $request->about_visi);
            \App\Models\Setting::set('about_misi', $request->about_misi);
            \App\Models\Setting::set('about_value_title_1', $request->about_value_title_1);
            \App\Models\Setting::set('about_value_desc_1', $request->about_value_desc_1);
            \App\Models\Setting::set('about_value_title_2', $request->about_value_title_2);
            \App\Models\Setting::set('about_value_desc_2', $request->about_value_desc_2);
            \App\Models\Setting::set('about_value_title_3', $request->about_value_title_3);
            \App\Models\Setting::set('about_value_desc_3', $request->about_value_desc_3);
        } elseif ($activeTab === 'contact') {
            \App\Models\Setting::set('contact_page_title', $request->contact_page_title);
            \App\Models\Setting::set('contact_page_desc', $request->contact_page_desc);
            \App\Models\Setting::set('contact_address', $request->contact_address);
            \App\Models\Setting::set('contact_email', $request->contact_email);
            \App\Models\Setting::set('contact_phone', $request->contact_phone);
            \App\Models\Setting::set('contact_map_embed', $request->contact_map_embed);
        } elseif ($activeTab === 'cta') {
            \App\Models\Setting::set('cta_title', $request->cta_title);
            \App\Models\Setting::set('cta_desc', $request->cta_desc);
        } elseif ($activeTab === 'gallery') {
            \App\Models\Setting::set('gallery_title', $request->gallery_title);
            \App\Models\Setting::set('gallery_desc', $request->gallery_desc);

            // Get old gallery items for cleanup
            $oldGalleryItemsJson = \App\Models\Setting::get('gallery_items');
            $oldImages = [];
            if ($oldGalleryItemsJson) {
                $oldItems = json_decode($oldGalleryItemsJson, true);
                if (is_array($oldItems)) {
                    foreach ($oldItems as $oldItem) {
                        if (!empty($oldItem['image'])) {
                            $oldImages[] = $oldItem['image'];
                        }
                        if (!empty($oldItem['images']) && is_array($oldItem['images'])) {
                            foreach ($oldItem['images'] as $subImg) {
                                $oldImages[] = $subImg;
                            }
                        }
                    }
                }
            } else {
                // Fallback old structure cleanup
                for ($i = 1; $i <= 6; $i++) {
                    $img = \App\Models\Setting::get("gallery_img_{$i}");
                    if ($img) {
                        $oldImages[] = $img;
                    }
                    // Clear the old settings keys
                    \App\Models\Setting::set("gallery_img_{$i}", null);
                    \App\Models\Setting::set("gallery_caption_{$i}", null);
                }
            }

            $galleryItems = [];
            $itemsInput = $request->input('gallery_items', []);
            $filesInput = $request->file('gallery_items', []);

            foreach ($itemsInput as $index => $itemData) {
                $image = $itemData['image'] ?? null;
                $caption = $itemData['caption'] ?? '';

                if (isset($filesInput[$index]['file'])) {
                    $file = $filesInput[$index]['file'];
                    $filename = "gallery_dynamic_" . $index . "_" . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/settings'), $filename);
                    $image = asset('uploads/settings/' . $filename);
                } elseif (isset($itemData['url'])) {
                    if (!empty($itemData['url'])) {
                        $image = $itemData['url'];
                    } else {
                        $image = null;
                    }
                }

                if ($image) {
                    $subImages = [];
                    if (isset($itemData['sub_items']) && is_array($itemData['sub_items'])) {
                        foreach ($itemData['sub_items'] as $subIndex => $subItemData) {
                            $subImg = $subItemData['image'] ?? null;
                            if (isset($filesInput[$index]['sub_items'][$subIndex]['file'])) {
                                $subFile = $filesInput[$index]['sub_items'][$subIndex]['file'];
                                $subFilename = "gallery_sub_" . $index . "_" . $subIndex . "_" . time() . '.' . $subFile->getClientOriginalExtension();
                                $subFile->move(public_path('uploads/settings'), $subFilename);
                                $subImg = asset('uploads/settings/' . $subFilename);
                            } elseif (isset($subItemData['url'])) {
                                if (!empty($subItemData['url'])) {
                                    $subImg = $subItemData['url'];
                                } else {
                                    $subImg = null;
                                }
                            }
                            if ($subImg) {
                                $subImages[] = $subImg;
                            }
                        }
                    }

                    $galleryItems[] = [
                        'image' => $image,
                        'caption' => $caption,
                        'images' => $subImages,
                    ];
                }
            }

            \App\Models\Setting::set('gallery_items', json_encode($galleryItems));

            // Delete unused old uploads
            $newImages = [];
            foreach ($galleryItems as $gi) {
                if (!empty($gi['image'])) {
                    $newImages[] = $gi['image'];
                }
                if (!empty($gi['images']) && is_array($gi['images'])) {
                    foreach ($gi['images'] as $imgUrl) {
                        $newImages[] = $imgUrl;
                    }
                }
            }
            foreach ($oldImages as $oldImage) {
                if (!in_array($oldImage, $newImages)) {
                    $parsedUrl = parse_url($oldImage);
                    if (isset($parsedUrl['path'])) {
                        $filePath = public_path(ltrim($parsedUrl['path'], '/'));
                        if (file_exists($filePath) && strpos($filePath, 'uploads/settings') !== false) {
                            @unlink($filePath);
                        }
                    }
                }
            }
        }

        return redirect()->route('dashboard.settings', ['tab' => $activeTab])->with('success', 'Pengaturan tampilan berhasil diperbarui!');
    }


    public function approvals()
    {
        $user = Auth::user()->load('profile', 'role');
        
        // Fetch all users that are not activated, with their profile and role
        $pendingUsers = \App\Models\User::where('is_activated', false)->with('profile', 'role')->get();

        return view('dashboard.approvals.index', compact('user', 'pendingUsers'));
    }

    public function approveUser($id)
    {
        $targetUser = \App\Models\User::findOrFail($id);
        $targetUser->is_activated = true;
        $targetUser->save();

        return redirect()->route('dashboard.approvals')->with('success', "Akun {$targetUser->display_name} telah berhasil diaktifkan!");
    }

    public function rejectUser($id)
    {
        $targetUser = \App\Models\User::findOrFail($id);
        $profile = $targetUser->profile;

        $targetUser->delete();
        if ($profile) {
            $profile->delete();
        }

        return redirect()->route('dashboard.approvals')->with('success', 'Pendaftaran akun telah ditolak dan dihapus.');
    }

    public function messages()
    {
        $user = Auth::user()->load('profile', 'role');
        $messages = \App\Models\ContactMessage::latest()->get();

        return view('dashboard.messages.index', compact('user', 'messages'));
    }

    public function toggleReadMessage($id)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);
        $message->is_read = !$message->is_read;
        $message->save();

        $status = $message->is_read ? 'dibaca' : 'belum dibaca';
        return back()->with('success', "Status pesan dari {$message->name} berhasil diubah menjadi {$status}.");
    }

    public function destroyMessage($id)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);
        $name = $message->name;
        $message->delete();

        return back()->with('success', "Pesan dari {$name} telah dihapus.");
    }
}
