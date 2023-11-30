<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard',[
            'jumlah_anggota' => User::where('roles', 'ANGGOTA')->count(),
            'jumlah_buku' => Buku::count(),
            'jumlah_peminjaman' => Peminjaman::where('status', 'Dipinjam')->count(),
            'jumlah_pengembalian' => Peminjaman::where('status', 'Dikembalikan')->count(),
        ]);
    }
}
