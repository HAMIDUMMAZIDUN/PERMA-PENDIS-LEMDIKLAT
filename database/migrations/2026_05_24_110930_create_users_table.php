<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the default Laravel users table first if it exists
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->foreignId('role_id')->default(3)->constrained('roles')->onDelete('restrict');
            $table->uuid('user_profile_id')->nullable();
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->onDelete('set null');
            $table->boolean('is_activated')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
