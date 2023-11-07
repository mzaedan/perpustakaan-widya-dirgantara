@extends('layouts.admin')

@section('header-name')
  Halaman Tambah Peminjaman
@endsection


@section('content')

<div class="section">
    <div class="container-fluid">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                   @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kode Peminjaman</label>
                                            <input type="text" class="form-control" name="kode_peminjaman">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Peminjaman</label>
                                            <input type="date" class="form-control" name="tanggal_peminjaman">
                                        </div>
                                        <div class="form-group">
                                            <label>ID Anggota</label>
                                            <input type="text" class="form-control" name="id_anggota" value="AG001">
                                        </div>
                                        <div class="form-group">
                                            <label>Biodata</label>
                                            <div id="result_tunggu"> <p style="color:red">* Belum Ada Hasil</p></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lama Peminjaman</label>
                                            <input type="number" class="form-control" name="lama_peminjaman" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kode Buku</label>
                                            <input type="text" class="form-control" name="kode_buku" value="BK001">
                                        </div>
                                        <div class="form-group">
                                            <label>Data Buku</label>
                                            <div id="result_tunggu"> <p style="color:red">* Belum Ada Hasil</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary px-5">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection