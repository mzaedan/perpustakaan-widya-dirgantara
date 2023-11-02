<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama' , 'id_kategori', 'id_rak', 'sampul', 'isbn', 'lampiran', 'penerbit', 'pengarang', 'tahun_buku', 'isi', 'jumlah'
    ];
}
