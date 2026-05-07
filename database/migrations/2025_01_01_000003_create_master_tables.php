<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_publikasi', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            // e.g. Monografi, Laporan Keuangan, Perdes, RKPD, Profil Desa
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            // e.g. site_name, contact_phone, hero_title, site_logo
            $table->text('value')->nullable();
            $table->string('group', 100)->default('general');
            // general | contact | appearance | seo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('kategori_publikasi');
    }
};
