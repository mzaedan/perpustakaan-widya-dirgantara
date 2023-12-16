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
                                            <input type="date" class="form-control" id="datepicker" name="tanggal_peminjaman" value="<?= date('Y-m-d');?>">
                                        </div>
                                        <div class="form-group">
                                            <label>ID Anggota</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" required autocomplete="off" name="id_users" id="search-box" placeholder="Contoh ID Anggota : AG001">
                                                <div class="input-group-append">
                                                    <a data-toggle="modal" data-target="#TableAnggota" class="btn btn-primary"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Biodata</label>
                                            <div id="result_tunggu"><p style="color:red">* Belum Ada Hasil</p></div>
                                            <div id="result"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lama Peminjaman</label>
                                            <input type="number" class="form-control" name="lama_peminjaman" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Kode Buku</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" required autocomplete="off" name="buku-search" id="buku-search" placeholder="Contoh ID Anggota : AG001">
                                                <div class="input-group-append">
                                                    <a data-toggle="modal" data-target="#TableBuku" class="btn btn-primary"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Data Buku</label>
                                            <div id="tunggu_buku"><p style="color:red">* Belum Ada Hasil</p></div>
                                            <div id="result_buku"></div>
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


<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).on('keyup', '#search-box',function(){
        let id = $(this).val();
        var self = this;
        axios.get('/peminjaman/result/'+id)
        .then(function (response) {
            let result = $('#result').html('');
            if (response.data.status == "ok") {
                let html = `<table id="example3" class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td>${response.data.name}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>${response.data.kelas}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>${response.data.nomor_telepon}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>${response.data.email}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>${response.data.alamat}</td>
                        </tr>
                    </tbody>
                </table>`;
                $("#result_tunggu").hide();
                result = html;
                $('#result').html(result);
            } else {
                $("#result_tunggu").show();
            }
        })
        .catch(function (error) {
            let result = $('#result').html('');
            $("#result_tunggu").show();
        });
    });
</script>

<script>
    $(document).on('keyup', '#buku-search',function(){
        let id = $(this).val();
        axios.get('/peminjaman/buku-list/'+id)
        .then(function (response) {
            let result = $('#result_buku').html('');
            if (response.data.status == "ok") {
                let html = `<table id="example3" class="table table-bordered table-striped">
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
                            <td>${response.data.nama}</td>
                            <td>${response.data.penerbit}</td>
                            <td>${response.data.tahun_buku}</td>
                        </tr>
                    </tbody>
                </table>`;
                $("#tunggu_buku").hide();
                result = html;
                $('#result_buku').html(result);
            } else {
                $("#tunggu_buku").show();
            }
        })
        .catch(function (error) {
            let result = $('#result_buku').html('');
            $("#tunggu_buku").show();
        });
    });
</script>

<script>
document.getElementById('datepicker').addEventListener('input', function() {
    var date = new Date(this.value);
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    this.value = day + '-' + month + '-' + year;
});
</script>