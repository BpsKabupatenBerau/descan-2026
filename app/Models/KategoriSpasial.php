<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSpasial extends Model
{
    use HasFactory;

    protected $table = "kategori_spasials";

    protected $fillable = ["judul", "logo", "status"];

    protected $casts = [
        "status" => "boolean",
    ];
}
