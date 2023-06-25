<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function totalKeuanganMasuk()
    {
        return $this->keuangan()
            ->where('kategori', 'pemasukan')
            ->sum('jumlah');
    }

    public function totalKeuanganKeluar()
    {
        return $this->keuangan()
            ->where('kategori', 'pengeluaran')
            ->sum('jumlah');
    }

    public function saldoKeuangan()
    {
        $totalMasuk = $this->totalKeuanganMasuk();
        $totalKeluar = $this->totalKeuanganKeluar();

        return $totalMasuk - $totalKeluar;
    }

    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'id_user');
    }
}
