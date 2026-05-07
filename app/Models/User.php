<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;



class User extends Authenticatable implements FilamentUser, HasName, HasAvatar


{
    use Notifiable;

    protected $fillable = [
        'nama_lengkap', 'email', 'role',
        'nomor_hp', 'password', 'foto',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Filament: allow all users with role admin to access panel
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'editor']);
    }

    // Filament: use nama_lengkap as the display name
    public function getFilamentName(): string
    {
        return $this->nama_lengkap;
    }

    // Filament: use foto as the avatar
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }



    // Relationships — this user created these records
    public function kategoriStatistik(): HasMany
    {
        return $this->hasMany(KategoriStatistik::class);
    }

    public function kategoriSpasial(): HasMany
    {
        return $this->hasMany(KategoriSpasial::class);
    }

    public function tabelStatistik(): HasMany
    {
        return $this->hasMany(TabelStatistik::class);
    }

    public function inputDataSpasial(): HasMany
    {
        return $this->hasMany(InputDataSpasial::class);
    }

    public function inputInfografis(): HasMany
    {
        return $this->hasMany(InputInfografis::class);
    }

    public function inputPublikasi(): HasMany
    {
        return $this->hasMany(InputPublikasi::class);
    }

    // Helper: full avatar URL
    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}
