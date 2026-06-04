<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 220)->unique();
            $table->text('description')->nullable();
            $table->string('location', 200)->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->string('cover_image', 500)->nullable();
            $table->enum('type', ['rapat', 'seminar', 'pelatihan', 'webinar', 'musyawarah', 'lainnya'])->default('lainnya');
            $table->string('registration_url', 500)->nullable();
            $table->string('contact_person', 200)->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('answer');
            $table->string('category', 100)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('events');
    }
};
