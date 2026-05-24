<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 255)->unique();
            $table->longText('content');
            $table->string('author', 100);
            $table->boolean('is_published')->default(false);
            $table->foreignId('category_id')->nullable()->constrained('article_categories')->onDelete('set null');
            $table->string('thumbnail', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
