<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use SoftDeletes;

    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_peminjaman', 'id_users', 'tanggal_peminjaman', 'lama_peminjaman', 'tanggal_harus_dikembalikan', 'tanggal,kembali','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }
}
