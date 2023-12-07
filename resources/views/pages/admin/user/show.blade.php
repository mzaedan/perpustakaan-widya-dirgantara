@extends('layouts.admin')

@section('header-name')
  Detail User
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
                                    <th style="width: 180px">Nama Anggota</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Email</th>
                                    <td>{{ $item->email  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Tempat Lahir</th>
                                    <td>{{ $item->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Tanggal Lahir</th>
                                    <td>{{ $item->tanggal_lahir  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Jenis Kelamin</th>
                                    <td>{{ $item->jenis_kelamin  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Alamat</th>
                                    <td>{{ $item->alamat  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Nomor Telepon</th>
                                    <td>{{ $item->nomor_telepon  }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Foto</th>
                                    <td>
                                        <a href="{{ asset('storage/'.$item->foto) }}" download target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 180px">Kelas</th>
                                    <td>{{ $item->kelas  }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col text-right">
                                    <a href="{{ route('user.index') }}" class="btn btn-primary">Kembali</a>
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