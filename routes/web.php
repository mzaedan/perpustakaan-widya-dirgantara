<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\BukuAnggotaController;
use App\Http\Controllers\CekRoleController;
use App\Http\Controllers\DashboardPeminjamanController;
use App\Http\Controllers\UserAnggotaController;
use App\Models\Peminjaman;
use App\Models\Rak;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman-amggota');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/cek-role', CekRoleController::class);
    Route::get('/peminjaman/index-peminjaman', [DashboardPeminjamanController::class, 'index_peminjaman'])->name('index-peminjaman');
    Route::get('/peminjaman/pengembalian', [DashboardPeminjamanController::class, 'pengembalian'])->name('index-pengembalian-anggota');


    
    Route::get('/buku/index', [BukuAnggotaController::class, 'index'])->name('index-buku');
    Route::get('/user/index', [UserAnggotaController::class, 'index'])->name('index-user');
    Route::get('/peminjaman/index-pengembalian', [PeminjamanController::class, 'index_pengembalian'])->name('index-pengembalian-admin');
    Route::post('/peminjaman/kembali/{id}', [PeminjamanController::class, 'kembali'])->name('peminjaman-kembali');

    Route::get('user/cetak-kartu/{id}', [App\Http\Controllers\Admin\UserController::class, 'cetak_pdf'])->name('cetak-kartu');
});





Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('buku', BukuController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('rak', RakController::class);
        Route::resource('peminjaman', PeminjamanController::class);
        Route::get('/peminjaman/pengembalian/{id}', [PeminjamanController::class, 'pengembalian'])->name('peminjaman.pengembalian');
        Route::resource('denda', DendaController::class);
        Route::resource('user', UserController::class);
        
        
        
    });

