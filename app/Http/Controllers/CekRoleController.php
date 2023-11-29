<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekRoleController extends Controller
{
    public function __invoke(Request $request)
    {
        $role = auth()->user()->roles;

        if ($role == 'ADMIN') {
            return redirect('/admin');
        } elseif ($role == 'ANGGOTA') {
            return redirect('/peminjaman/index-peminjaman');
        } else {
            return redirect('/');
        }
    }
}