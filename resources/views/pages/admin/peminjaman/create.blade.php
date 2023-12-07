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
                                            <div class="input-group">
                                                <input type="text" class="form-control" required autocomplete="off" name="id_anggota" id="search-box" placeholder="Contoh ID Anggota : AG001">
                                                <div class="input-group-append">
                                                    <a data-toggle="modal" data-target="#TableAnggota" class="btn btn-primary"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Biodata</label>
                                            <div id="result_tunggu"><p style="color:red">* Belum Ada Hasil</p></div>
                                            <div id="result">koala</div>
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

<div class="modal fade" id="TableAnggota">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Anggota</h4>
                </div>
                <div id="modal_body" class="modal-body fileSelection1">
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
	// $(".fileSelection1 #Select_File1").click(function (event) {
    //     // Set the input value
    //     document.getElementsByName('id')[0].value = $(this).attr("data-id");

    //     // Hide the modal
    //     $('#TableAnggota').modal('hide');

    //     // Send AJAX request
    //     $.ajax({
    //         type: "POST",
    //         url: '/peminjaman/result/'+
    //         data: {
    //             id: $(this).attr(""), // Send data as object for cleaner code
    //         },
    //         beforeSend: function () {
    //             $("#result").html(""); // Clear result before loading
    //             $("#result_tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>'); // Show loading indicator
    //         },
    //         success: function (html) {
    //             $("#result").html(html); // Update result with response
    //             $("#result_tunggu").html(''); // Hide loading indicator
    //     },
    // });
    $(document).on('keyup', '#search-box',function(){
        let id = $(this).val();
        $.ajax({
            type: "GET",
            url: '/peminjaman/result/'+id,
            data:'id='+$(this).val(),
            success: function(data){
                let result = $('#result').html('');
                if (data.status == "ok") {
                    let html = `<table id="example3" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>email</th>
                                <td>${data.email}</td>
                            </tr>
                        </tbody>
                    </table>`;
                    $("#result_tunggu").hide();
                    result = html;
                    $('#result').html(result);
                } else {
                    $("#result_tunggu").show();
                }
            },
            error: function (request, status, error) {
                let result = $('#result').html('');
                $("#result_tunggu").show();
            }
        });
    });
</script>
