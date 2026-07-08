<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("kategori_spasials", function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->string("logo")->nullable(); // Untuk menyimpan path gambar logo
            $table->boolean("status")->default(true); // 1: Aktif, 0: Nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("kategori_spasials");
    }
};
