<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $kode_peminjaman
 * @property int $id_anggota
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
        'id_anggota', 
        'id_buku',
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

    public function anggota()
    {
        return $this->belongsTo(User::class, 'id_anggota', 'id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }

    /**
     * @return string
     */
    public static function getKodePeminjaman()
    {
        $latestKode = self::withTrashed()->max('kode_peminjaman');

        if (!$latestKode) {
            return 'PJ001';
        }

        $nextKodeNumber = (int)substr($latestKode, 3) + 1;
        return 'PJ' . str_pad($nextKodeNumber, 3, '0', STR_PAD_LEFT);
    }

    public function updateStokBuku($peminjamanDihapus = false)
    {
        $buku = $this->buku;

        if ($buku === null) {
            return false;
        }

        $jumlahBuku = $buku->jumlah;

        if ($jumlahBuku === 0) {
            return false;
        }

        if ($this->status === "Dipinjam") {
            $jumlahBuku--;
        }

        if ($this->status === "Dikembalikan") {
            $jumlahBuku++;
        }

        if ($peminjamanDihapus) {
            $jumlahBuku++;
        }

        $buku->jumlah = $jumlahBuku;
        $buku->save();
    }

    public function updateTanggalDikembalikan()
    {
        if ($this->lama_peminjaman == null) {
            return false;
        }

        $lamaPeminjaman = $this->lama_peminjaman;
        $tanggalDikembalikan = date('Y-m-d', strtotime('+'.$lamaPeminjaman.' day'));

        $this->tanggal_harus_dikembalikan = $tanggalDikembalikan;
        $this->save();
    }
}
