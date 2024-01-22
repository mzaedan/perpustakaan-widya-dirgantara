<?php

namespace App\Models;

use DateTime;
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

    public function manyPeminjamanBuku()
    {
        return $this->hasMany(PeminjamanBuku::class, 'id_peminjaman', 'id');
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

        $tanggalPeminjaman = $this->tanggal_peminjaman;
        $lamaPeminjaman = $this->lama_peminjaman;
        $tanggalHarusDikembalikan = date('Y-m-d', strtotime($tanggalPeminjaman.'+'.$lamaPeminjaman.' day'));

        $this->tanggal_harus_dikembalikan = $tanggalHarusDikembalikan;
        $this->save();
    }

    public function getJumlahTelatKembalikan()
    {
        if ($this->tanggal_harus_dikembalikan == null) {
            return 0;
        }

        if ($this->tanggal_harus_dikembalikan >= date('Y-m-d')) {
            return 0;
        }

        $tanggalKembali = new DateTime($this->tanggal_kembali);
        $tanggalHarusDikembalikan = new DateTime($this->tanggal_harus_dikembalikan);
       
        if ($tanggalKembali === false) {
            $tanggalKembali = new DateTime("now");
        }
  
        $dateDiff = $tanggalKembali->diff($tanggalHarusDikembalikan);

        $jumlahTelat = $dateDiff->days;

        return intval($jumlahTelat);
    }

    public function getDenda()
    {
        $dendaAktif = Denda::where('status','=',Denda::STATUS_AKTIF)->first();

        if ($dendaAktif === null) {
            return 0;
        }

        if (date('Y-m-d') <= $this->tanggal_harus_dikembalikan) {
            return 0;
        }

        $hargaDenda = floatval($dendaAktif->harga_denda);

        $jumlahTelatKembalikan = $this->getJumlahTelatKembalikan();

        $totalDenda = $hargaDenda * $jumlahTelatKembalikan * $this->getJumlahBuku();

        return $totalDenda;
    }

    public function getJumlahBuku()
    {
        return $this->manyPeminjamanBuku()->count();
    }

    public function createPeminjamanBuku()
    {
        if ($this->id_buku !== null) {
            $peminjamanBuku = new PeminjamanBuku();
            $peminjamanBuku->id_peminjaman = $this->id;
            $peminjamanBuku->id_buku = $this->id_buku;
            $peminjamanBuku->save();

            $this->id_buku = null;
            $this->save();
        }
    }
}
