<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('download_category_id')->constrained('download_categories')->onDelete('cascade');
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->string('file_path', 500);
            $table->string('file_name', 255)->nullable();
            $table->string('file_size', 30)->nullable();
            $table->string('file_type', 50)->nullable();
            $table->boolean('is_public')->default(true);
            $table->integer('download_count')->default(0);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
