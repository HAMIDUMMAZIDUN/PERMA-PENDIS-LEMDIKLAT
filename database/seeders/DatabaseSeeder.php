<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\ArticleCategory;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        Role::create(['name' => 'Admin', 'level' => 1]);
        Role::create(['name' => 'Manager', 'level' => 2]);
        Role::create(['name' => 'User', 'level' => 3]);

        // Article Categories
        ArticleCategory::create(['name' => 'Berita']);
        ArticleCategory::create(['name' => 'Pengumuman']);
        ArticleCategory::create(['name' => 'Kegiatan']);
        ArticleCategory::create(['name' => 'Artikel']);

        // Admin user
        $profile = UserProfile::create([
            'name'  => 'Administrator',
            'email' => 'admin@lemdiklat.id',
        ]);

        User::create([
            'username'        => 'admin',
            'password'        => Hash::make('admin123'),
            'role_id'         => 1,
            'user_profile_id' => $profile->id,
            'is_activated'    => true,
        ]);
    }
}
