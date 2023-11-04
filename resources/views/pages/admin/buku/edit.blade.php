@extends('layouts.admin')

@section('header-name')
  Halaman Tambah Buku
@endsection

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

@section('content')

<div class="section">
    <div class="container-fluid">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('buku.update',  $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Buku</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Contoh : Cara Cepat Belajar Pemrograman Web" value="{{ $item->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input type="text" class="form-control" name="isbn" placeholder="Contoh ISBN : 978-602-8123-35-8" value="{{ $item->isbn }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select class="form-control select2" required="required"  name="id_kategori">
                                                <option disabled selected value> -- Pilih Kategori -- </option>
                                                <option value="1"> TEST </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Rak/Lokasi</label>
                                            <select class="form-control select2" required="required"  name="id_rak">
                                                <option disabled selected value> -- Pilih Rak -- </option>
                                                <option value="1"> TEST </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pengarang</label>
                                            <input type="text" class="form-control" name="pengarang" placeholder="Nama Pengarang" value="{{ $item->pengarang }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Penerbit</label>
                                            <input type="text" class="form-control" name="pengarang" placeholder="Nama Pengarang" value="{{ $item->penerbit }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Buku</label>
                                            <input type="number" class="form-control" name="tahun_buku" placeholder="Tahun Buku : 2019" value="{{ $item->tahun_buku }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Jumlah Buku</label>
                                            <input type="number" class="form-control" name="jumlah" placeholder="Jumlah buku : 12" value="{{ $item->jumlah }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Sampul</label>
                                            <input type="file" accept="image/*" name="sampul" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Lampiran Buku <small style="color:green">(pdf) * opsional</small></label>
                                            <input type="file" accept="application/pdf" name="lampiran" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan Lainnya</label>
                                            <textarea class="form-control" name="keterangan" id="summernotehal" style="height:120px" value="{{ $item->keterangan }}"></textarea>
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