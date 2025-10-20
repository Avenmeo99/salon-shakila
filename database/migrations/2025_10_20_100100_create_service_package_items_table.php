<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_package_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('services')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('services')->cascadeOnDelete();
            $table->unsignedSmallInteger('qty')->default(1);
            $table->timestamps();

            $table->unique(['package_id', 'item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_package_items');
    }
};
