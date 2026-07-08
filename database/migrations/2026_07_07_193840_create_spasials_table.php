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
        Schema::create("spasials", function (Blueprint $table) {
            $table->id();
            $table->string("kategori");
            $table->string("nama_lokasi");
            $table->text("deskripsi")->nullable();
            $table->string("alamat_lengkap");
            $table->string("telepon")->nullable();
            $table->string("website")->nullable();
            $table->decimal("latitude", 10, 8);
            $table->decimal("longitude", 11, 8);
            $table->json("data_tambahan")->nullable(); // Untuk menyimpan Jam Operasional & Fasilitas dinamis
            $table->boolean("status")->default(true); // 1 = Aktif, 0 = Nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("spasials");
    }
};
