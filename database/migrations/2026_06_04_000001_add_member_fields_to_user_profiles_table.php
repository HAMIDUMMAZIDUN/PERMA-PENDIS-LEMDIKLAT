<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('member_number', 50)->nullable()->after('profile_picture');
            $table->string('wilayah', 100)->nullable()->after('member_number');
            $table->string('province', 100)->nullable()->after('wilayah');
            $table->string('institution', 200)->nullable()->after('province');
            $table->string('study_program', 200)->nullable()->after('institution');
            $table->string('nim', 50)->nullable()->after('study_program');
            $table->enum('membership_status', ['aktif', 'nonaktif'])->default('nonaktif')->after('nim');
            $table->date('kta_issued_at')->nullable()->after('membership_status');
            $table->date('kta_expired_at')->nullable()->after('kta_issued_at');
        });
    }

    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'member_number',
                'wilayah',
                'province',
                'institution',
                'study_program',
                'nim',
                'membership_status',
                'kta_issued_at',
                'kta_expired_at',
            ]);
        });
    }
};
