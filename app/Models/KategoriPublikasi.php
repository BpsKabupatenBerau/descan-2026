<?php
// app/Models/KategoriPublikasi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPublikasi extends Model
{
    public $timestamps = false;
    protected $table   = 'kategori_publikasi';
    protected $fillable = ['kategori'];

    public function publikasi(): HasMany
    {
        return $this->hasMany(InputPublikasi::class);
    }
}
