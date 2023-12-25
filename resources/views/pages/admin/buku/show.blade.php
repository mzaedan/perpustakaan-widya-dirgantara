@extends('layouts.admin')

@section('header-name')
  Detail Buku
@endsection

@section('content')

<div class="section">
    <div class="container-fluid">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 180px">Nama Buku</th>
                                    <td>{{ $item->nama }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Kode Buku</th>
                                    <td>{{ $item->kode_buku  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">ISBN</th>
                                    <td>{{ $item->isbn  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Rak</th>
                                    <td>{{ $item->rak->nama  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Penerbit</th>
                                    <td>{{ $item->penerbit  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Pengarang</th>
                                    <td>{{ $item->pengarang  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Kategori</th>
                                    <td>{{ $item->kategori->nama  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Tahun Buku</th>
                                    <td>{{ $item->tahun_buku  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Tanggal Masuk</th>
                                    <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Sampul</th>
                                    <td>
                                        <a href="{{ asset('storage/'.$item->sampul) }}" download target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Lampiran</th>
                                    <td>
                                        <a href="{{ asset('storage/'.$item->lampiran) }}" download target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Jumlah</th>
                                    <td>{{ $item->jumlah  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Keterangan</th>
                                    <td>{!! $item->keterangan  !!}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col text-right">
                                    <a href="{{ route('buku.index') }}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection