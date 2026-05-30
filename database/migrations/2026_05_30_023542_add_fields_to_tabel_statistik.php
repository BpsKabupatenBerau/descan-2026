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
        Schema::table('tabel_statistik', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('judul_tabel');
            $table->json('nama_baris')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabel_statistik', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'nama_baris']);
        });
    }
};
