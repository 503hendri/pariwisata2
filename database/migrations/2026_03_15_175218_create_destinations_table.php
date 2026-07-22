<?php

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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->string('thumbnail')->nullable();
            $table->string('cover')->nullable();

            $table->string('address');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->decimal('rating', 3, 2)->default(0);
            $table->unsignedSmallInteger('review_count')->default(0);
            $table->unsignedInteger('view_count')->default(0);

            $table->decimal('entry_fee', 12, 2)->unsigned()->nullable();
            $table->decimal('price_range_min', 12, 2)->unsigned()->nullable();
            $table->decimal('price_range_max', 12, 2)->unsigned()->nullable();

            $table->json('operating_hours')->nullable();  // e.g., ["Senin": "08:00-17:00", "Selasa": "08:00-17:00"]

            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();

            $table->boolean('is_popular')->default(false);
            $table->boolean('is_published')->default(false);

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_tags')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index('is_published');
            $table->index('is_popular');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
