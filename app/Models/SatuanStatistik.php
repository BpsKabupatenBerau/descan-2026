<?php
// app/Models/SatuanStatistik.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SatuanStatistik extends Model
{
    protected $table   = 'satuan_statistik';
    protected $fillable = ['judul_satuan', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tabelStatistik(): HasMany
    {
        return $this->hasMany(TabelStatistik::class, 'satuan_id');
    }
}
