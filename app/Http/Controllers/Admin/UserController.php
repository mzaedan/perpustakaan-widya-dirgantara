<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Admin\UserRequest;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = User::query();

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('cetak-kartu', $item->id). '" target="_blank">
                                        Cetak Kartu
                                    </a>
                                    <a class="dropdown-item" href="' . route('user.edit', $item->id). '">
                                        Edit
                                    </a>
                                    <a class="dropdown-item" href="' . route('user.show', $item->id). '">
                                        Detail
                                    </a>
                                    <form action="'. route('user.destroy', $item->id) .'" method="POST" onsubmit="return confirm(\'Apakah Anda Ingin Menghapus Data Ini?\')">
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

                // ->editColumn('foto', function($item){
                //     return $item->foto ? '<img src="'. asset('storage/'.$item->foto) .'" style="max-height: 100px;"/>' : '';
                // })

                ->editColumn('foto', function($item){
                    return $item->foto ? '<img src="'. Storage::url($item->foto) .'" style="max-height: 100px;"/>' : '';
                })
                            
                ->rawColumns(['action','no', 'foto'])
                ->make();

        }
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        if ($data['roles'] === 'ANGGOTA') {
            $data['kode_anggota'] = User::getKodeAnggota();
        }

        $data['password'] = bcrypt($request->password);
        $data['foto'] = $request->file('foto')->store('assets/foto', 'public');

        User::create($data);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = User::findOrFail($id);

        return view('pages.admin.user.show',[
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = User::findOrFail($id);

        return view('pages.admin.user.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->all();
        $item = User::findOrFail($id);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/foto', 'public');
        }

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item->update($data);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
    
    public function cetak_pdf(PDF $pdf, string $id)
    {
        $item = User::findOrFail($id);
    
        $pdf = $pdf->loadview('pages.admin.user.cetak_kartu',['item'=>$item]);

        return $pdf->stream('laporan-cetak-pdf');
    }
}
