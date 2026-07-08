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
        Schema::create("publikasis", function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->text("deskripsi")->nullable();
            $table->string("kategori");
            $table->year("tahun");
            $table->string("penulis"); // Untuk kolom "Penulis / Penyusun" atau "Diupload Oleh"
            $table->string("file_pdf");
            $table->string("ukuran_file")->nullable(); // Opsional: menyimpan info ukuran file (misal: "2,4 MB")
            $table->integer("jumlah_unduhan")->default(0); // Dimulai dari 0 unduhan
            $table->boolean("status")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("publikasis");
    }
};
