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
        Schema::table('bookings', function (Blueprint $table) {
            // Add new columns for hotel booking system
            $table->date('check_in_date')->after('client_id')->nullable();
            $table->date('check_out_date')->after('check_in_date')->nullable();
            $table->integer('number_of_rooms')->after('check_out_date')->default(1);
            $table->integer('adults')->after('number_of_rooms')->default(1);
            $table->integer('children')->after('adults')->default(0);
            $table->string('room_type')->after('children')->nullable();
            
            // Make event columns nullable since we're transitioning
            $table->string('event_type')->nullable()->change();
            $table->date('event_date')->nullable()->change();
            $table->time('event_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'check_in_date',
                'check_out_date',
                'number_of_rooms',
                'adults',
                'children',
                'room_type',
            ]);
        });
    }
};
