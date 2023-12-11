@extends('layouts.admin')

@section('header-name')
    Detail Buku
@endsection

@section('content')

<div class="section">
    <div class="row">
        
    </div>
    <div class="container-fluid">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <table class="table table-striped">
                                        <tr style="background:yellowgreen">
                                            <td colspan="3">Data Transaksi</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Peminjaman</td>
                                            <td>:</td>
                                            <td>
                                                <?= $item->kode_peminjaman;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Peminjaman</td>
                                            <td>:</td>
                                            <td>
                                                <?= $item->tanggal_peminjaman;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Harus Dikembalikan</td>
                                            <td>:</td>
                                            <td>
                                                <?= $item->tanggal_harus_dikembalikan;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ID Anggota</td>
                                            <td>:</td>
                                            <td>
                                                <?= $item->id_users;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Biodata</td>
                                            <td>:</td>
                                            <td>
                                                <table class="table table-striped">
                                                    <tr>
                                                        <td>Nama Anggota</td>
                                                        <td>:</td>
                                                        <td><?= $item->user->name;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kelas</td>
                                                        <td>:</td>
                                                        <td><?= $item->user->kelas;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telepon</td>
                                                        <td>:</td>
                                                        <td><?= $item->user->nomor_telepon;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>E-mail</td>
                                                        <td>:</td>
                                                        <td><?= $item->user->email;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>:</td>
                                                        <td><?= $item->user->alamat;?></td>
                                                    </tr>
                                                </table>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lama Peminjaman</td>
                                            <td>:</td>
                                            <td><?= $item->lama_peminjaman;?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-7">
                                    <table class="table table-striped">
                                        <tr style="background:yellowgreen">
                                            <td colspan="3">Data Peminjaman Buku</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td>
                                                 <?= $item->status;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Kembali</td>
                                            <td>:</td>
                                            <td>
                                                Belum Dikembalikan
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Denda</td>
                                            <td>:</td>
                                            <td>
                                                <p>1 Hari</p>
                                                Rp. 2000
                                            </p><small style="color:#333;">*Untuk 1 Buku</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kode Buku</td>
                                        <td>:</td>
                                        <td>BK001</td>
                                    </tr>
                                    <tr>
                                        <td>Data Buku</td>
                                        <td>:</td>
                                        <td>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Title</th>
                                                        <th>Penerbit</th>
                                                        <th>Tahun</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Laskar Pelangi</td>
                                                        <td>Gramedia</td>
                                                        <td>2009</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div> 
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col text-right">
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-primary">Kembali</a>
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