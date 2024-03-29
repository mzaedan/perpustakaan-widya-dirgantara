@extends('layouts.admin')

@section('header-name')
  Halaman Edit Buku
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
                                                <option value="{{ $item->id_kategori }}" selected>{{ $item->kategori->nama }}</option>
                                                @foreach ($allKategori as $kategori)
                                                    <option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Rak/Lokasi</label>
                                            <select class="form-control select2" required="required"  name="id_rak">
                                                <option value="{{ $item->id_rak }}" selected>{{ $item->rak->nama }}</option>
                                                @foreach ($allRak as $rak)
                                                    <option value="{{ $rak->id }}">
                                                        {{ $rak->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pengarang</label>
                                            <input type="text" class="form-control" name="pengarang" placeholder="Nama Pengarang" value="{{ $item->pengarang }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Penerbit</label>
                                            <input type="text" class="form-control" name="penerbit" placeholder="Nama Pengarang" value="{{ $item->penerbit }}">
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
                                            <label>Sampul <small style="color:green">* opsional</small></label> <br/>
                                            <div class="mb-3">
                                                @if ($item->sampul === null)
                                                    <span class="text-danger"><i class="fa fa-times"></i> <i>Tidak ada file yang diupload</i></span>
                                                @else
                                                    <img class="img-fluid" width="200" src="{{ asset('storage/'.$item->sampul)}}" alt="sampul.jpg" />
                                                @endif
                                            </div>
                                            <input type="file" accept="image/*" name="sampul" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Lampiran Buku <small style="color:green">(pdf) * opsional</small></label> <br/>
                                            <div class="mb-3">
                                                @if ($item->lampiran === null)
                                                    <span class="text-danger"><i class="fa fa-times"></i> <i>Tidak ada file yang diupload</i></span>
                                                @else
                                                <a href="{{ url('storage/'.$item->lampiran) }}">
                                                    <i class="fa fa-download"></i> &nbsp;Download Lampiran
                                                </a>
                                                @endif
                                            </div>
                                            <input type="file" accept="application/pdf" name="lampiran" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan Lainnya</label>
                                            <textarea class="form-control" name="keterangan" id="summernotehal" style="height:120px" value="{{ $item->keterangan }}">{{ $item->keterangan  }}</textarea>
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