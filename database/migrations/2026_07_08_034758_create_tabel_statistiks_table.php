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
        Schema::create("tabel_statistiks", function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->text("deskripsi")->nullable();
            $table
                ->foreignId("kategori_id")
                ->constrained("kategori_statistiks")
                ->cascadeOnDelete();
            $table->json("nama_baris")->nullable(); // Untuk menyimpan array baris
            $table->string("tipe_chart")->nullable();
            $table->boolean("status")->default(true);
            $table->string("sumber_data")->nullable();
            $table->string("satuan")->nullable();
            $table->string("periode")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tabel_statistiks");
    }
};
