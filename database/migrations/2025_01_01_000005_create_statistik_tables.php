<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tabel_statistik', function (Blueprint $table) {
            $table->id();
            $table->string('judul_tabel');
            $table->string('slug')->unique();
            // URL-friendly identifier — was missing in original design
            // e.g. 'tingkat-pendidikan', 'jumlah-kk'
            $table->foreignId('kategori_id')
                  ->constrained('kategori_statistik')
                  ->restrictOnDelete();
            $table->integer('baris_tabel_ke')->default(0);
            // Display order within category (lower = shown first)
            $table->string('tipe_chart', 50)->default('bar');
            // bar | line | pie | doughnut | radar | polarArea | number | table
            $table->text('sumber_data')->nullable();
            // e.g. 'Disdukcapil 2024', 'BPS Kabupaten Berau'
            $table->foreignId('satuan_id')
                  ->constrained('satuan_statistik')
                  ->restrictOnDelete();
            $table->string('periode_data', 50)->nullable();
            // Tahunan | Bulanan | Triwulan | Semesteran
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });

        Schema::create('input_data_tabel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tabel_statistik_id')
                  ->constrained('tabel_statistik')
                  ->cascadeOnDelete();
            // Cascade: deleting the chart definition removes all its data rows
            $table->foreignId('kategori_id')
                  ->constrained('kategori_statistik')
                  ->restrictOnDelete();
            $table->foreignId('tahun_id')
                  ->constrained('tahun')
                  ->restrictOnDelete();
            $table->foreignId('bulan_id')
                  ->nullable()
                  ->constrained('bulan')
                  ->nullOnDelete();
            // null = annual data, set = monthly breakdown
            $table->string('label_baris')->nullable();
            // Row label shown in chart: e.g. 'Laki-laki', 'SD', 'Dusun I'
            $table->decimal('nilai', 15, 2)->nullable();
            // The numeric value for this label + year combination
            $table->string('file_excel', 500)->nullable();
            // Path to uploaded Excel file in storage/app/public/excel/
            // NOT varbinary — we store path, not binary data
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_data_tabel');
        Schema::dropIfExists('tabel_statistik');
    }
};
