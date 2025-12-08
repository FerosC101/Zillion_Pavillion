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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->string('name');
            $table->string('type'); // Standard, Deluxe, Suite, Family, Executive
            $table->text('description');
            $table->decimal('price_per_night', 10, 2);
            $table->integer('max_occupancy');
            $table->integer('bed_count');
            $table->string('bed_type'); // Single, Double, Queen, King
            $table->decimal('size_sqm', 10, 2);
            $table->json('amenities'); // WiFi, AC, TV, Mini Bar, etc
            $table->json('images'); // Array of image paths
            $table->string('view_type')->nullable(); // City, Garden, Pool, Ocean
            $table->boolean('is_available')->default(true);
            $table->integer('floor_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
