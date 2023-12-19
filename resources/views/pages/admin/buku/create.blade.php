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
                            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Buku</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Contoh : Cara Cepat Belajar Pemrograman Web">
                                        </div>
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input type="text" class="form-control" name="isbn" placeholder="Contoh ISBN : 978-602-8123-35-8">
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select class="form-control select2" required="required"  name="id_kategori">
                                                <option disabled selected value> -- Pilih Kategori -- </option>
                                                @foreach ($allKategori as $kategori)
                                                    <option value="{{ $kategori->id }}">
                                                        {{ $kategori->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Rak/Lokasi</label>
                                            <select class="form-control select2" required="required"  name="id_rak">
                                                <option disabled selected value> -- Pilih Rak -- </option>
                                                @foreach ($allRak as $rak)
                                                    <option value="{{ $rak->id }}">
                                                        {{ $rak->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pengarang</label>
                                            <input type="text" class="form-control" name="pengarang" placeholder="Nama Pengarang">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Penerbit</label>
                                            <input type="text" class="form-control" name="penerbit" placeholder="Nama Penerbit">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Anggaran/Pembelian</label>
                                            <input type="number" class="form-control" name="tahun_buku" placeholder="Contoh : 2020, 2021">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Jumlah Buku</label>
                                            <input type="number" class="form-control" name="jumlah" placeholder="Jumlah buku : 12">
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
                                            <textarea class="form-control" name="keterangan" id="summernotehal" style="height:120px"></textarea>
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