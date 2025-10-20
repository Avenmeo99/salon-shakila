<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->text('description')->nullable()->after('slug');
            $table->unsignedInteger('duration_minutes')->default(60)->after('price');
            $table->boolean('is_active')->default(true)->after('duration_minutes');
            $table->enum('type', ['single', 'package'])->default('single')->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['slug', 'description', 'duration_minutes', 'is_active', 'type']);
        });
    }
};
