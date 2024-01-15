<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DendaRequest;
use App\Models\Denda;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Denda::query();

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('denda.edit', $item->id). '">
                                        Sunting
                                    </a>
                                    <form action="'. route('denda.destroy', $item->id) .'" method="POST" onsubmit="return confirm(\'Apakah Anda Ingin Menghapus Data Ini?\')">
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
        return view('pages.admin.denda.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.denda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DendaRequest $request)
    {
        $data = $request->all();

        $checkDendaAktif = Denda::where('status','=',Denda::STATUS_AKTIF)->first();

        if ($checkDendaAktif === null) {
            $data['status'] =  'Aktif';
        } else {
            $data['status'] = 'Tidak Aktif';
        }

        $data['tanggal_tetap'] =  date('Y-m-d');

        Denda::create($data);

        return redirect()->route('denda.index')->with('toast_success','Denda berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Denda::findOrFail($id);

        return view('pages.admin.denda.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DendaRequest $request, string $id)
    {
        $data = $request->all();

        $item = Denda::findOrFail($id);

        $item->update($data);

        return redirect()->route('denda.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Denda::findOrFail($id);
        $item->delete();

        return redirect()->route('denda.index');
    }
}
