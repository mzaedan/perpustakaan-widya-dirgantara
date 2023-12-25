<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode_peminjaman
 * @property int $id_users
 * @property string $tanggal_peminjaman
 * @property int $lama_peminjaman
 * @property string $tanggal_harus_dikembalikan
 * @property string $tanggal_kembali
 * @property string $status
 */
class Peminjaman extends Model
{
    use SoftDeletes;

    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_peminjaman', 
        'id_users', 
        'tanggal_peminjaman', 
        'lama_peminjaman', 
        'tanggal_harus_dikembalikan', 
        'tanggal_kembali',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    /**
     * @return string
     */
    public static function getKodePeminjaman()
    {
        $latestKode = self::withTrashed()->max('kode_peminjaman');

        if (!$latestKode) {
            return 'BK001';
        }

        $nextKodeNumber = (int)substr($latestKode, 3) + 1;
        return 'PJ' . str_pad($nextKodeNumber, 3, '0', STR_PAD_LEFT);
    }
}
