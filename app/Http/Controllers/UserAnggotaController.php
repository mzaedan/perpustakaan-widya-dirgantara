<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Admin\UserRequest;
use Barryvdh\DomPDF\PDF;

class UserAnggotaController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query = User::where('id', auth()->user()->id)->get();

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
                                    <a class="dropdown-item" href="' . route('user.show', $item->id). '">
                                        Detail
                                    </a>
                                    <a class="dropdown-item" href="' . route('edit-user', $item->id). '">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('no', function($item) {
                    static $count = 1;
                    return $count++;
                })

                ->editColumn('foto', function($item){
                    return $item->foto ? '<img src="'. asset('storage/'.$item->foto) .'" style="max-height: 100px;"/>' : '';
                })
               
                ->rawColumns(['action','no', 'foto'])
                ->make();

        }
        return view('user-buku');
    }

    public function edit(string $id)
    {
        $item = User::findOrFail($id);
        if ($item->id !== auth()->user()->id) {
            abort(403);
        }
        return view('anggota-edit',[
            'item' => $item
        ]);
    }

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
        return redirect()->route('index-user');
    }
}
