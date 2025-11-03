<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
<<<<<<< HEAD
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
=======
    public function up(): void {
        Schema::table('services', function (Blueprint $t) {
            if (!Schema::hasColumn('services', 'slug')) $t->string('slug')->unique()->after('name');
            if (!Schema::hasColumn('services', 'description')) $t->text('description')->nullable()->after('slug');
            if (!Schema::hasColumn('services', 'duration_minutes')) $t->unsignedSmallInteger('duration_minutes')->default(60)->after('price');
            if (!Schema::hasColumn('services', 'is_active')) $t->boolean('is_active')->default(true)->after('duration_minutes');
            if (!Schema::hasColumn('services', 'type')) $t->enum('type', ['single','package'])->default('single')->after('is_active');
        });
    }
    public function down(): void {
        Schema::table('services', function (Blueprint $t) {
            $t->dropColumn(['slug','description','duration_minutes','is_active','type']);
>>>>>>> 198812f (First commit - upload salon_shakila project)
        });
    }
};
