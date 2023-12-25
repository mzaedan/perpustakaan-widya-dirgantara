<?php

use App\Http\Controllers\Admin\BukuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\RakController;
use App\Http\Controllers\Admin\UserController;
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
    //Cek Role
    Route::get('/cek-role', CekRoleController::class);

    //Buku
    Route::get('/buku/index', [BukuAnggotaController::class, 'index'])->name('index-buku');

    //Peminjaman dan Pengembalian ADMIN
    Route::get('/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('pengembalian');

    //Peminjaman dan Pengembalian Anggota
    Route::get('/peminjaman/peminjaman', [DashboardPeminjamanController::class, 'peminjaman'])->name('index-peminjaman-anggota');
    Route::get('/peminjaman/pengembalian', [DashboardPeminjamanController::class, 'pengembalian'])->name('index-pengembalian-anggota');
    Route::get('/peminjaman/result/{id}', [PeminjamanController::class, 'result'])->name('result');
    Route::get('/peminjaman/buku-list', [PeminjamanController::class, 'Bukulist'])->name('buku-list');
    
    Route::get('/user/index', [UserAnggotaController::class, 'index'])->name('index-user');
    Route::get('/user/edit/{id}', [UserAnggotaController::class, 'edit'])->name('edit-user');
    Route::get('/user/update', [UserAnggotaController::class, 'update'])->name('update-user');
    
    Route::get('user/cetak-kartu/{id}', [App\Http\Controllers\Admin\UserController::class, 'cetak_pdf'])->name('cetak-kartu');
});

Route::group(['middleware' => ['auth','admin']], function(){
   Route::post('/peminjaman/kembali/{id}', [PeminjamanController::class, 'kembalikan'])->name('kembalikan');
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

