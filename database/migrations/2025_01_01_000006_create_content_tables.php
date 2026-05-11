<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('input_data_spasial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                  ->constrained('kategori_spasial')
                  ->restrictOnDelete();
            $table->string('nama_lokasi');
            $table->text('deskripsi')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('telepon', 20)->nullable();
            // varchar — phone numbers can start with 0 or contain +62
            // Original used integer which would lose leading zeros
            $table->text('website')->nullable();
            // text replaces MySQL-only tinytext
            $table->decimal('latitude', 10, 7);
            // e.g. -1.2379000
            $table->decimal('longitude', 10, 7);
            // e.g. 116.8529000
            $table->jsonb('extra_data')->nullable();
            // PostgreSQL JSONB for flexible fields: jam_operasional, fasilitas, kapasitas, dll
            // jsonb = indexed JSON, faster queries than json type
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });

        Schema::create('input_infografis', function (Blueprint $table) {
            $table->id();
            $table->string('judul_infografis');
            $table->string('slug')->unique();
            // Added — needed for public URL routing
            $table->text('deskripsi_infografis')->nullable();
            $table->foreignId('kategori_id')
                  ->constrained('kategori_statistik')
                  ->restrictOnDelete();
            $table->foreignId('tahun_id')
                  ->constrained('tahun')
                  ->restrictOnDelete();
            // Renamed from tahun_infografis integer to tahun_id FK — consistent with other tables
            $table->string('sumber')->nullable();
            $table->string('file_infografis', 500);
            // Path to image file in storage/app/public/infografis/
            // NOT varbinary — store path, not binary
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });

        Schema::create('input_publikasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_publikasi');
            $table->string('slug')->unique();
            // Added — needed for public URL routing
            $table->text('deskripsi_publikasi')->nullable();
            $table->foreignId('kategori_publikasi_id')
                  ->constrained('kategori_publikasi')
                  ->restrictOnDelete();
            $table->foreignId('tahun_id')
                  ->constrained('tahun')
                  ->restrictOnDelete();
            $table->string('penulis')->nullable();
            $table->string('file_publikasi', 500);
            // Path to PDF in storage/app/public/publikasi/
            // NOT varbinary — store path, not binary
            $table->string('nama_file_unduhan')->nullable();
            // Custom filename shown to user when downloading
            $table->bigInteger('ukuran_file')->nullable();
            // File size in bytes — for display purposes
            $table->unsignedInteger('download_count')->default(0);
            // Added — tracked in PublikasiController::download()
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_publikasi');
        Schema::dropIfExists('input_infografis');
        Schema::dropIfExists('input_data_spasial');
    }
};
