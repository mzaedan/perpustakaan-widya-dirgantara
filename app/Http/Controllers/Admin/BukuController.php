<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BukuRequest;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Buku::query();

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('buku.show', $item->id). '">
                                        Detail
                                    </a>
                                    <a class="dropdown-item" href="' . route('buku.edit', $item->id). '">
                                        Sunting
                                    </a>
                                    <form action="'. route('buku.destroy', $item->id) .'" method="POST" onsubmit="return confirm(\'Apakah Anda Ingin Menghapus Data Ini?\')">
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
               
                ->rawColumns(['action', 'no'])
                ->make();

        }
        return view('pages.admin.buku.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allKategori = Kategori::all();
        $allRak = Rak::all();

        return view('pages.admin.buku.create', [
            'allKategori' => $allKategori,
            'allRak' => $allRak,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BukuRequest $request)
    {
        $data = $request->all();

        $data['kode_buku'] = 'BK' . str_pad(Buku::count() + 1, 3, '0', STR_PAD_LEFT);

        $data['sampul'] = $request->file('sampul')->store('assets/sampul', 'public');
        $data['lampiran'] = $request->file('lampiran')->store('assets/lampiran', 'public');

        Buku::create($data);

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Buku::findOrFail($id);

        return view('pages.admin.buku.show',[
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Buku::findOrFail($id);

        return view('pages.admin.buku.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BukuRequest $request, string $id)
    {
        $data = $request->all();

        $data['kode_buku'] =  'BK001';

        $data['sampul'] = $request->file('sampul')->store('assets/sampul', 'public');
        $data['lampiran'] = $request->file('lampiran')->store('assets/lampiran', 'public');

        $item = Buku::findOrFail($id);

        $item->update($data);

        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Buku::findOrFail($id);
        $item->delete();

        return redirect()->route('buku.index');
    }
}
