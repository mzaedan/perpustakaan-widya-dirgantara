<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use SoftDeletes;

    protected $table = 'denda';

    protected $fillable = [
        'harga_denda', 'status', 'tanggal_tetap'
    ];
}
