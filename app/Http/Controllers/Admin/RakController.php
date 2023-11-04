<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rak;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Admin\RakRequest;
use App\Models\Kategori;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Rak::query();

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('rak.edit', $item->id). '">
                                        Sunting
                                    </a>
                                    <form action="'. route('rak.destroy', $item->id) .'" method="POST" onsubmit="return confirm(\'Apakah Anda Ingin Menghapus Data Ini?\')">
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
                // ->editColumn('photo', function($item){
                //     return $item->photo ? '<img src="'. asset('storage/'.$item->photo) .'" style="max-height: 40px;"/>' : '';
                // })

                ->addColumn('no', function($item) {
                    static $count = 1;
                    return $count++;
                })
               
                ->rawColumns(['action','no'])
                ->make();

        }
        return view('pages.admin.rak.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.rak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RakRequest $request)
    {
        $data = $request->all();

        Rak::create($data);

        return redirect()->route('rak.index');
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
        $item = Rak::findOrFail($id);

        return view('pages.admin.rak.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RakRequest $request, string $id)
    {
        $data = $request->all();

        $item = Rak::findOrFail($id);

        $item->update($data);

        return redirect()->route('rak.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Rak::findOrFail($id);
        $item->delete();

        return redirect()->route('rak.index');
    }
}
