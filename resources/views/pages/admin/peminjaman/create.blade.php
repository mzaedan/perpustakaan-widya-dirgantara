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
                                            <input type="text" class="form-control" name="kode_peminjaman" value="<?= $kodePeminjaman ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Peminjaman</label>
                                            <input type="date" class="form-control" id="datepicker" name="tanggal_peminjaman" value="<?= date('Y-m-d');?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Anggota</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" required autocomplete="off" name="kode_anggota" id="anggota-search" placeholder="Contoh Kode Anggota : AG001">
                                                <div class="input-group-append">
                                                    <a data-toggle="modal" data-target="#TableAnggota" class="btn btn-primary"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Biodata</label>
                                            <div id="tunggu_anggota"><p style="color:red">* Belum Ada Hasil</p></div>
                                            <div id="result_anggota"></div>
                                            <input type="hidden" name="id_anggota" id="id_anggota">
                                        </div>
                                        <div class="form-group">
                                            <label>Lama Peminjaman</label>
                                            <input type="number" class="form-control" name="lama_peminjaman" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Cari Buku</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" autocomplete="off" name="buku-search" id="buku-search" placeholder="Contoh : Membaca Cepat, BK001">
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
                                        <div class="form-group">
                                            <label for="">Buku Yang Akan Dipinjam</label>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Title</th>
                                                        <th>Penerbit</th>
                                                        <th>Tahun</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_buku_yang_dipinjam">
                                                    
                                                </tbody>
                                            </table>
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
    $(document).on('keyup', '#anggota-search', function(){
        let kodeAnggota = $(this).val();
        let url = "<?= url('/peminjaman/anggota-list?') ?>";
        
        if (kodeAnggota !== "" && kodeAnggota !== null) {
            url = url + '&kode_anggota=' + kodeAnggota;
        }

        console.log("keyup#anggota-search.url: ", url)

        axios.get(url).then(function (response) {
            let result = $('#result_anggota').html('');
            if (response.data.status == "ok") {
                $('#id_anggota').val(response.data.id);
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
                $("#tunggu_anggota").hide();
                result = html;
                $('#result_anggota').html(result);
            } else {
                $("#tunggu_anggota").show();
            }
        })
        .catch(function (error) {
            let result = $('#result_anggota').html('');
            $("#tunggu_anggota").show();
        });
    });
</script>

<script>
    let listBuku = [];

    $(document).on('keyup', '#buku-search', function() {

        let search = $(this).val();
        let url = "<?= url('/peminjaman/buku-list?') ?>";
        
        if (search !== "" && search !== null) {
            url = url + '&search=' + search;
        }

        // console.log("keyup#buku-search.url: ", url)

        axios.get(url).then(function (response) {
            let result = $('#result_buku').html('');
            if (response.data.status == "ok") {

                listBuku = response.data.data;
                
                let html = `<table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th></th>
                        </tr>
				    </thead>
                    <tbody id="tbody_result_buku">
                        
                    </tbody>
                </table>`;
                
                $("#tunggu_buku").hide();
                result = html;
                $('#result_buku').html(result);


                let tr = '';
                listBuku.map((buku, index) => {
                    tr += `<tr>
                            <td>${index + 1}</td>
                            <td>${buku.nama}</td>
                            <td>${buku.penerbit}</td>
                            <td>${buku.tahun_buku}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs" onclick="addToBukuYangDipinjam(`+buku.id+`)">
                                    <i class="fa fa-plus"></i>
                                </button>    
                            </td>
                        </tr>`; 
                });
                $("#tbody_result_buku").append(tr);
            } else {
                $("#tunggu_buku").show();
            }
        })
        .catch(function (error) {
            let result = $('#result_buku').html('');
            $("#tunggu_buku").show();
        });
        
    });
    
    let selectedIdBuku = [];
    let i = 0;
    function addToBukuYangDipinjam(idBuku) {
        if (selectedIdBuku.includes(idBuku)) {
            return alert('Buku ini sudah ditambahkan pada daftar yang akan dipinjam, silahkan pilih buku lain');
        }

        let filterBuku = listBuku.filter((value) => value.id === idBuku);
        let buku = {};
        
        if (filterBuku.length > 0) {
            buku = filterBuku[0];
        }

        if (buku?.stok === 0) {
            return alert('Maaf, stok buku ini sudah habis');
        }
        
        selectedIdBuku.push(buku?.id);
        
        console.log("selectedIdBuku:", selectedIdBuku);

        i++;

        let tr = '';

        tr = `<tr>
                <td id="row_num">${i}</td>
                <td>${buku?.nama}</td>
                <td>${buku?.penerbit}</td>
                <td>${buku?.tahun_buku}</td>
                <td>
                    <button type="button" name="remove" class="btn btn-danger btn-xs btn_remove">
                        <i class="fa fa-times"></i>
                    </button>
                    <input type="hidden" name="id_buku[]" value="${idBuku}" />
                </td>
            </tr>`;

        $("#tbody_buku_yang_dipinjam").append(tr);
    }

    $(document).on('click', '.btn_remove', function() {
        $(this).closest("tr").remove(); //use closest here
        $('#tbody_buku_yang_dipinjam tr').each(function(index) {
            //change id of first tr
            $(this).find("td:eq(0)").attr("id", "row_num" + (index + 1))
            //change hidden input value 
            $(this).find("td:eq(0)").html((index + 1))
        });
        i--;
    });
    
</script>

<script>
if (document.getElementById('datepicker') !== undefined && document.getElementById('datepicker') !== null) {
    document.getElementById('datepicker').addEventListener('input', function() {
        var date = new Date(this.value);
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        this.value = day + '-' + month + '-' + year;
    });
}
</script>