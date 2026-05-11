<?php
// app/Models/Bulan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    public $timestamps = false;
    protected $table   = 'bulan';
    protected $fillable = ['bulan', 'nama'];

    public function inputDataTabel()
    {
        return $this->hasMany(InputDataTabel::class);
    }
}
