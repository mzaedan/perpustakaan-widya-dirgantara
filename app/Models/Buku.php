<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use SoftDeletes;

    protected $table = 'buku';

    protected $fillable = [
        'nama' , 'id_kategori', 'id_rak', 'sampul', 'isbn', 'lampiran', 'penerbit', 'pengarang', 'tahun_buku', 'isi', 'jumlah', 'kode_buku', 'keterangan'
    ];

    public function kategori()
    {
        return $this->hasOne(User::class, 'id', 'id_kategori');
    }

    public function rak()
    {

    }
}
