<?php
// app/Models/Tahun.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tahun extends Model
{
    public $timestamps = false;
    protected $table = 'tahun';
    protected $fillable = ['tahun'];

    public function inputDataTabel(): HasMany
    {
        return $this->hasMany(InputDataTabel::class);
    }

    public function inputInfografis(): HasMany
    {
        return $this->hasMany(InputInfografis::class);
    }

    public function inputPublikasi(): HasMany
    {
        return $this->hasMany(InputPublikasi::class);
    }

    // Scope: ordered descending (newest first in dropdowns)
    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('tahun');
    }
}
