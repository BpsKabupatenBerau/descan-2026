<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spasial extends Model
{
    use HasFactory;

    protected $fillable = [
        "kategori",
        "nama_lokasi",
        "deskripsi",
        "alamat_lengkap",
        "telepon",
        "website",
        "latitude",
        "longitude",
        "data_tambahan",
        "status",
    ];

    protected $casts = [
        "data_tambahan" => "array",
        "status" => "boolean",
    ];
}
