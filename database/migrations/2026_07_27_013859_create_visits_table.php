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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            // Identitas pengunjung
            $table->ipAddress('ip_address')->index();
            $table->string('user_agent', 255);
            $table->string('referer', 255)->nullable();
            // Informasi halaman
            $table->string('path', 255);
            $table->string('query', 255)->nullable();
            // Waktu kunjungan
            $table->timestamp('visited_at')->useCurrent();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
