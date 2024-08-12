<?php

use App\Models\Language;
use App\Models\PostCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_category_texts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PostCategory::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Language::class)->nullable();
            $table->string('name');
            $table->text('description');
            $table->string('seo_url')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_category_texts');
    }
};
