<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tahun', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('tahun')->unique();
            // Note: smallInteger replaces MySQL-only year() type
            // PostgreSQL 13 compatible
        });

        Schema::create('bulan', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('bulan')->unsigned();
            // 1–12. tinyInteger replaces non-existent 'month' type
            $table->string('nama', 20);
            // e.g. Januari, Februari, ...
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulan');
        Schema::dropIfExists('tahun');
    }
};
