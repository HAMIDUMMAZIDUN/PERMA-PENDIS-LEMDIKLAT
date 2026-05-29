<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BoardMember;

class BoardMemberSeeder extends Seeder
{
    public function run(): void
    {
        BoardMember::truncate();

        $members = [
            // Dewan Pembina
            [
                'name' => 'Prof. Dr. H. Badrudin',
                'role' => 'Ketua Dewan Pembina',
                'category' => 'Dewan Pembina',
                'color' => '3b82f6',
                'is_leader' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Prof. Dr. KH Moh. Khusnuridlo',
                'role' => 'Anggota Dewan Pembina',
                'category' => 'Dewan Pembina',
                'color' => '2563eb',
                'is_leader' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Prof. Dr. H. Fatah Syukur',
                'role' => 'Anggota Dewan Pembina',
                'category' => 'Dewan Pembina',
                'color' => 'ea580c',
                'is_leader' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Prof. Dr. Risnita',
                'role' => 'Anggota Dewan Pembina',
                'category' => 'Dewan Pembina',
                'color' => '059669',
                'is_leader' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Prof. Dr. Hj. Aan Komariah',
                'role' => 'Anggota Dewan Pembina',
                'category' => 'Dewan Pembina',
                'color' => 'db2777',
                'is_leader' => false,
                'sort_order' => 5,
            ],
            [
                'name' => 'Prof. Dr. H. Subaidi',
                'role' => 'Anggota Dewan Pembina',
                'category' => 'Dewan Pembina',
                'color' => '7c3aed',
                'is_leader' => false,
                'sort_order' => 6,
            ],
            [
                'name' => 'Prof. Dr. Dedy Achmad Kurniady',
                'role' => 'Anggota Dewan Pembina',
                'category' => 'Dewan Pembina',
                'color' => 'd97706',
                'is_leader' => false,
                'sort_order' => 7,
            ],

            // Dewan Pengarah
            [
                'name' => 'Prof. Dr. H. Atiqullah',
                'role' => 'Ketua Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => 'dc2626',
                'is_leader' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Prof. Dr. H. Budiman',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => '0284c7',
                'is_leader' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Prof. Dr. KH. Zamroni',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => 'c084fc',
                'is_leader' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Prof. Dr. H. Imam Makruf',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => '15803d',
                'is_leader' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Prof. Dr. Imam Machali',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => 'c2410c',
                'is_leader' => false,
                'sort_order' => 5,
            ],
            [
                'name' => 'Prof. Dr. Hj. Siti Patimah',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => '4338ca',
                'is_leader' => false,
                'sort_order' => 6,
            ],
            [
                'name' => 'Dr. KH. Hasan Baharun',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => '0f766e',
                'is_leader' => false,
                'sort_order' => 7,
            ],
            [
                'name' => 'Dr. Fahrurrozi',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => 'b45309',
                'is_leader' => false,
                'sort_order' => 8,
            ],
            [
                'name' => 'Dr. H. Badrud Tamam',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => '7e22ce',
                'is_leader' => false,
                'sort_order' => 9,
            ],
            [
                'name' => 'Dr. Junaidah',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => 'c2410c',
                'is_leader' => false,
                'sort_order' => 10,
            ],
            [
                'name' => 'Dr. H. Cece Nurhikmah',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => '0d9488',
                'is_leader' => false,
                'sort_order' => 11,
            ],
            [
                'name' => 'Dr. Hj. St. Syamsudduha',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => 'e11d48',
                'is_leader' => false,
                'sort_order' => 12,
            ],
            [
                'name' => 'Dr. H. Abdullah Aminuddin Aziz',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => '1d4ed8',
                'is_leader' => false,
                'sort_order' => 13,
            ],
            [
                'name' => 'Dr. Fatkuroji',
                'role' => 'Anggota Dewan Pengarah',
                'category' => 'Dewan Pengarah',
                'color' => '059669',
                'is_leader' => false,
                'sort_order' => 14,
            ],

            // Direktur
            [
                'name' => 'Dr. H. Dadan F Ramdhan',
                'role' => 'Direktur Lemdiklat PERMA Pendis Indonesia',
                'category' => 'Direktur',
                'color' => 'dc2626',
                'is_leader' => true,
                'sort_order' => 1,
            ],

            // Wakil Direktur
            [
                'name' => 'Dr. M. Wafiyul Ahdi',
                'role' => 'Wakil Bidang Program dan Kurikulum Diklat',
                'category' => 'Wakil Direktur',
                'color' => '059669',
                'is_leader' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Dr. H. Cece Hidayat',
                'role' => 'Wakil Bidang Administrasi dan Umum',
                'category' => 'Wakil Direktur',
                'color' => '6366f1',
                'is_leader' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dr. Mona Novita',
                'role' => 'Wakil Bidang Kemitraan, Publikasi, dan Humas',
                'category' => 'Wakil Direktur',
                'color' => 'ea580c',
                'is_leader' => false,
                'sort_order' => 3,
            ],

            // Sekretaris & Bendahara
            [
                'name' => 'Dr. H. Akmal Mundiri',
                'role' => 'Sekretaris',
                'category' => 'Sekretaris & Bendahara',
                'color' => '0284c7',
                'is_leader' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Chyril Futuhana Ahmad',
                'role' => 'Wakil Sekretaris',
                'category' => 'Sekretaris & Bendahara',
                'color' => '0d9488',
                'is_leader' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dr. Ambar Sri Lestari',
                'role' => 'Bendahara',
                'category' => 'Sekretaris & Bendahara',
                'color' => 'c2410c',
                'is_leader' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Dr. Hj. Euis Damayanti',
                'role' => 'Wakil Bendahara',
                'category' => 'Sekretaris & Bendahara',
                'color' => 'db2777',
                'is_leader' => false,
                'sort_order' => 4,
            ],

            // Kepala Bagian dan Unit
            [
                'name' => 'Dr. H. Abu Choir',
                'role' => 'Kepala Bagian Perencanaan dan Penyelenggaraan Diklat',
                'category' => 'Kepala Bagian dan Unit',
                'color' => 'c2410c',
                'is_leader' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Dr. Hj. Atiyah Suharti',
                'role' => 'Kepala Bagian Pengembangan Kurikulum Diklat',
                'category' => 'Kepala Bagian dan Unit',
                'color' => 'a855f7',
                'is_leader' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dr. Abdulloh Hamid',
                'role' => 'Kepala Bagian SDM Kediklatan',
                'category' => 'Kepala Bagian dan Unit',
                'color' => '15803d',
                'is_leader' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Dr. Yudin Citriadin',
                'role' => 'Kepala Bagian Evaluasi Diklat',
                'category' => 'Kepala Bagian dan Unit',
                'color' => '1d4ed8',
                'is_leader' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Ilham Agustian Widia Yusuf',
                'role' => 'Kepala Bagian Administrasi dan Umum',
                'category' => 'Kepala Bagian dan Unit',
                'color' => 'b45309',
                'is_leader' => false,
                'sort_order' => 5,
            ],
            [
                'name' => 'Dr. Nunu Mahnun',
                'role' => 'Kepala Bagian Publikasi dan Humas',
                'category' => 'Kepala Bagian dan Unit',
                'color' => 'dc2626',
                'is_leader' => false,
                'sort_order' => 6,
            ],
            [
                'name' => 'Aqil Baihaqi',
                'role' => 'Kepala Bagian Kemitraan',
                'category' => 'Kepala Bagian dan Unit',
                'color' => '3b82f6',
                'is_leader' => false,
                'sort_order' => 7,
            ],
            [
                'name' => 'Dr. H. Enjang Yusuf Ali',
                'role' => 'Kepala Bagian TIK',
                'category' => 'Kepala Bagian dan Unit',
                'color' => '0d9488',
                'is_leader' => false,
                'sort_order' => 8,
            ],
            [
                'name' => 'Dr. Atep Suherman',
                'role' => 'Kepala Unit Sarana dan Prasarana',
                'category' => 'Kepala Bagian dan Unit',
                'color' => 'b45309',
                'is_leader' => false,
                'sort_order' => 9,
            ],
            [
                'name' => 'Dr. H. Hasbiyallah',
                'role' => 'Kepala Unit Pengendalian Mutu',
                'category' => 'Kepala Bagian dan Unit',
                'color' => 'a855f7',
                'is_leader' => false,
                'sort_order' => 10,
            ],
        ];

        foreach ($members as $m) {
            BoardMember::create($m);
        }
    }
}
