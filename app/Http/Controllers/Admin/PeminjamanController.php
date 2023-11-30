<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PeminjamanRequest;
use Yajra\DataTables\DataTables;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Peminjaman::query()->where('status', 'Dipinjam');;

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
            $query = Peminjaman::query()->where('status', 'Dikembalikan');

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
        return view('pages.admin.peminjaman.create');
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
        $item = Peminjaman::findOrFail($id);

        return view('pages.admin.peminjaman.show',[
            'item' => $item
        ]);
    }

    // public function pengembalian(string $id)
    // {
    //     $item = Peminjaman::findOrFail($id);

    //     return view('pages.admin.peminjaman.pengembalian',[
    //         'item' => $item
    //     ]);
    // }

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
}
