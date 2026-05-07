<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_statistik', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kategori');
            $table->string('logo_kategori', 500)->nullable();
            // Stores file path — NOT binary. e.g. 'kategori/kependudukan.png'
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->boolean('is_active')->default(true);
            // boolean replaces 'binary' type from original DBML
            $table->timestamps();
        });

        Schema::create('kategori_spasial', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kategori');
            $table->string('warna_marker', 20)->default('#3B82F6');
            // Hex color for Leaflet.js map marker — added, was missing in original
            $table->string('logo_kategori', 500)->nullable();
            // File path, not binary
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('satuan_statistik', function (Blueprint $table) {
            $table->id();
            $table->string('judul_satuan', 100);
            // e.g. Jiwa, KK, %, Rp, Unit, Ha, Ton
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('satuan_statistik');
        Schema::dropIfExists('kategori_spasial');
        Schema::dropIfExists('kategori_statistik');
    }
};
