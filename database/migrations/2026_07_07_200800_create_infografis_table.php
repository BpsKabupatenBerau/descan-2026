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
        Schema::create("infografis", function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->text("deskripsi")->nullable();
            $table->string("kategori");
            $table->year("tahun");
            $table->string("sumber");
            $table->string("file_gambar")->nullable(); // Menyimpan path file gambar
            $table->boolean("status")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("infografis");
    }
};
