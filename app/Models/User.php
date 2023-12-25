<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'kode_anggota',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nomor_telepon',
        'foto',
        'kelas',
        'roles',
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

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_users', 'id');
    }

    /**
     * @return string
     */
    public static function getKodeAnggota()
    {
        $latestKode = self::withTrashed()->max('kode_anggota');

        if (!$latestKode) {
            return 'AG001';
        }

        $nextKodeNumber = (int)substr($latestKode, 3) + 1;
        return 'AG' . str_pad($nextKodeNumber, 3, '0', STR_PAD_LEFT);
    }
}
