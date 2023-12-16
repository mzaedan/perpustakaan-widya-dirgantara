<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PeminjamanRequest;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use app\Models\User;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Peminjaman::with(['user'])->where('status', 'Dipinjam')->get();

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <form action="'. route('kembalikan', $item->id) .'" method="POST" onsubmit="return confirm(\'Apakah Anda Ingin Mengembalikan Buku Ini?\')">
                                        '. method_field('POST') . csrf_field() . '
                                        <button type="submit" class="dropdown-item">
                                            Kembalikan
                                        </button>
                                    </form>
                                    <a class="dropdown-item" href="' . route('peminjaman.show', $item->id). '">
                                        Detail
                                    </a>
                                    <form action="'. route('peminjaman.destroy', $item->id) .'" method="POST" onsubmit="return confirm(\'Apakah Anda Ingin Menghapus Data Ini?\')">
                                        '. method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('no', function($item) {
                    static $count = 1;
                    return $count++;
                })
               
                ->rawColumns(['action','no'])
                ->make();

        }
        return view('pages.admin.peminjaman.index');
    }

    public function pengembalian()
    {
        if(request()->ajax())
        {
            $query = Peminjaman::with(['user'])->where('status', 'Dikembalikan');

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('peminjaman.show', $item->id). '">
                                        Detail
                                    </a>
                                    <form action="'. route('peminjaman.destroy', $item->id) .'" method="POST" onsubmit="return confirm(\'Apakah Anda Ingin Menghapus Data Ini?\')">
                                        '. method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('no', function($item) {
                    static $count = 1;
                    return $count++;
                })
               
                ->rawColumns(['action','no'])
                ->make();

        }
        
        return view('pages.admin.peminjaman.index-pengembalian');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('id', 'kode_anggota')->get();

        return view('pages.admin.peminjaman.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeminjamanRequest $request)
    {
        $data = $request->all();

        $data['status'] = 'Dipinjam';

        Peminjaman::create($data);

        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Peminjaman::with(['user'])->findOrFail($id);
        
        return view('pages.admin.peminjaman.show',[
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Peminjaman::findOrFail($id);
        $item->delete();

        return redirect()->route('peminjaman.index');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'Dikembalikan';
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dikembalikan');
    }

    public function result($id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            return response()->json([
                'status' => "ok",
                'name' => $user->name,
                'nomor_telepon' => $user->nomor_telepon,
                'email' => $user->email,
                'alamat' => $user->alamat,
                'kelas' => $user->kelas,
            ], 200);
        } else {
            return response()->json([
                'status' => "error",
                'message' => 'Anggota Tidak Ditemukan!',
            ], 200);
        }
    }

    public function Bukulist($id)
    {
        $buku = Buku::where('id', $id)->first();

        if ($buku) {
            return response()->json([
                'status' => "ok",
                'nama' => $buku->nama,
                'penerbit' => $buku->penerbit,
                'tahun_buku' => $buku->tahun_buku,
            ], 200);
        } else {
            return response()->json([
                'status' => "error",
                'message' => 'Buku Tidak Ditemukan!',
            ], 200);
        }
    }
}
