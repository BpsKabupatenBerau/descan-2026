<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        "judul",
        "deskripsi",
        "kategori",
        "tahun",
        "penulis",
        "file_pdf",
        "ukuran_file",
        "jumlah_unduhan",
        "status",
    ];

    protected $casts = [
        "status" => "boolean",
    ];
}
