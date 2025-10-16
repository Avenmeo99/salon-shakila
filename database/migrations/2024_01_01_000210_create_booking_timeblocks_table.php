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
        Schema::create('booking_timeblocks', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('weekday');
            $table->time('start');
            $table->time('end');
            $table->smallInteger('interval_minutes')->default(30);
            $table->timestamps();

            $table->unique(['weekday', 'start', 'end']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_timeblocks');
    }
};
