<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PeminjamanRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DashboardPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function peminjaman()
    {
        if(request()->ajax())
        {
           $query = Peminjaman::with(['user', 'anggota'])
            ->where('id_anggota', Auth::user()->id)
            ->where('status', 'Dipinjam');

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('peminjaman.pengembalian', $item->id). '">
                                        Kembalikan
                                    </a>
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

                ->addColumn('denda', function($item) {
                    $output = '';
                    $output .= $item->getJumlahTelatKembalikan().' Hari <br/> <span class="text-danger">Rp '.$item->getDenda().'</span>';
                    $output .= '</p><small style="color:#333;">*Untuk 1 Buku</small>';

                    return $output;
                }) 
                ->rawColumns(['action','no', 'denda'])
                ->make();

        }
        return view('anggota-peminjaman');
    }

    public function pengembalian()
    {
        if(request()->ajax())
        {
           $query = Peminjaman::with(['user', 'anggota'])
            ->where('id_anggota', Auth::user()->id)
            ->where('status', 'Dikembalikan');

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('peminjaman.pengembalian', $item->id). '">
                                        Kembalikan
                                    </a>
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
                ->addColumn('denda', function($item) {
                    $output = '';
                    $output .= $item->getJumlahTelatKembalikan().' Hari <br/> <span class="text-danger">Rp '.$item->getDenda().'</span>';
                    $output .= '</p><small style="color:#333;">*Untuk 1 Buku</small>';

                    return $output;
                })
                ->rawColumns(['action','no', 'denda'])
                ->make();

        }
        
        return view('anggota-pengembalian');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.peminjaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeminjamanRequest $request)
    {
        $data = $request->all();

        Peminjaman::create($data);

        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Peminjaman::findOrFail($id);

        return view('pages.admin.peminjaman.show',[
            'item' => $item
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
}
