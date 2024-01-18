<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Rak;
use Yajra\DataTables\DataTables;

class BukuAnggotaController extends Controller
{
    public function index(Request $request)
    {
        $allRak = Rak::all();

        if(request()->ajax())
        {
            $query = Buku::query();

            return DataTables::of($query)
                ->addIndexColumn()
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
                ->filter(function($instance) use ($request) {
                    if ($request->get('id_rak') !== null) {
                        $instance->where('id_rak','=',$request->get('id_rak'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('kode_buku', 'LIKE', "%$search%")
                            ->orWhere('nama', 'LIKE', "%$search%")
                            ->orWhere('penerbit', 'LIKE', "%$search%")
                            ->orWhere('tahun_buku', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action', 'no'])
                ->make();

        }
        return view('anggota-buku',[
            'allRak' => $allRak
        ]);
    }
}
