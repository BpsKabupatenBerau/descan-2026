<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;
    protected $fillable = [
        "judul",
        "deskripsi",
        "kategori",
        "tahun",
        "sumber",
        "file_gambar",
        "status",
    ];
}
