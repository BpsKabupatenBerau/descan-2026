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
        Schema::table('kategori_statistik', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        // Generate slugs for existing records
        $categories = \DB::table('kategori_statistik')->get();
        foreach ($categories as $cat) {
            \DB::table('kategori_statistik')
                ->where('id', $cat->id)
                ->update(['slug' => \Illuminate\Support\Str::slug($cat->judul_kategori)]);
        }

        Schema::table('kategori_statistik', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('kategori_statistik', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
