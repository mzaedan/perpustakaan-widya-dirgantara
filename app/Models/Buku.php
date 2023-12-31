<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Buku extends Model
{
    use SoftDeletes;

    protected $table = 'buku';

    protected $fillable = [
        'nama' , 'id_kategori', 'id_rak', 'sampul', 'isbn', 'lampiran', 'penerbit', 'pengarang', 'tahun_buku', 'isi', 'jumlah', 'kode_buku', 'keterangan'
    ];

    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id', 'id_kategori');
    }

    public function rak()
    {
        return $this->hasOne(Rak::class, 'id', 'id_rak');
    }

    public static function getKodeBuku()
    {
        $latestKode = self::withTrashed()->max('kode_buku');

        if (!$latestKode) {
            return 'BK001';
        }

        $nextKodeNumber = (int)substr($latestKode, 3) + 1;
        return 'BK' . str_pad($nextKodeNumber, 3, '0', STR_PAD_LEFT);
    }
}
