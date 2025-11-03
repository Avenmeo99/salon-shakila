<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
<<<<<<< HEAD
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
=======
    public function up(): void {
        Schema::create('service_package_items', function (Blueprint $t) {
            $t->id();
            $t->foreignId('package_id')->constrained('services')->cascadeOnDelete();
            $t->foreignId('item_id')->constrained('services')->cascadeOnDelete();
            $t->unsignedSmallInteger('qty')->default(1);
            $t->timestamps();

            $t->unique(['package_id','item_id']);
        });
    }
    public function down(): void {
>>>>>>> 198812f (First commit - upload salon_shakila project)
        Schema::dropIfExists('service_package_items');
    }
};
