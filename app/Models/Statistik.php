<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;

    // Tambahkan baris ini
    protected $fillable = [
        "judul",
        "kategori",
        "tipe_chart",
        "tahun_terkini",
        "status",
    ];
}
