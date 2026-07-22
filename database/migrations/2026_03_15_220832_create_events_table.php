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
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->date('date_start');
            $table->date('date_end');

            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();

            $table->string('location');

            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();

            $table->integer('ticket_price')->nullable();
            $table->boolean('is_free')->default(true);

            $table->string('cover')->nullable();

            $table->string('organizer')->nullable(); // nama penyelenggara

            $table->string('contact_phone')->nullable();
            $table->string('website')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
