<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
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
                                    <a class="dropdown-item" href="' . route('user.edit', $item->id). '">
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
}
