<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeminjamanBuku extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'peminjaman_buku';

    protected $fillable = [
        'id_peminjaman',
        'id_buku'
    ];

    public function buku()
    {
        return $this->hasOne(Buku::class, 'id', 'id_buku');
    }
}
