<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekRoleController extends Controller
{
    public function __invoke(Request $request)
    {
        $role = auth()->user()->roles;
        if ($role == 'ADMIN') {
            return redirect()->route('admin-dashboard');
        } elseif ($role == 'ANGGOTA') {
            return redirect()->route('index-peminjaman-anggota');
        } else {
            return redirect()->route('home');
        }
    }
}