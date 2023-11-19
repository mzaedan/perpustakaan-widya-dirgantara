<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .bg-primary {
            background-color: #3498db !important;
            color: white;
        }
        .border-primary {
            border-color: #3498db !important;
        }
        .border-bottom-primary {
            border-bottom-color: #3498db !important;
        }
        .panel-body {
            padding: 15px;
        }
        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .text-center {
            text-align: center;
        }
        .img-responsive {
            display: block;
            max-width: 100%;
            height: auto;
        }
        /* .row-no-gutters {
            margin-right: 0;
            margin-left: 0;
        }

        .text-right {
            text-align: right;
        } */
    </style>
</head>
<body>
    <div class="container">
        <br />
    </div>
    <br />
    <div id="printableArea">
        <page size="A4">
            <div class="panel panel-default">
                <div class="panel-body bg-primary">
                    <h4 class="text-center">KARTU ANGGOTA PERPUSTAKAAN</h4>
                    <br />
                    <div class="row">
                        <div class="col-sm-8">
                            <table class="table table-stripped">
                                @if (is_object($alluser))
                                    <tr>
                                        <td>ID Anggota</td>
                                        <td>:</td>
                                        <td>{{ $alluser->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{ $alluser->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>{{ $alluser->tempat_lahir }},{{ date('d-m-Y', strtotime($alluser->tanggal_lahir)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $alluser->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Bergabung</td>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y', strtotime($alluser->created_at)) }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="row-no-gutters text-right" style="margin-right: 50px; margin-bottom:100px; margin-top:-220px" >
                            <img src="{{ asset('storage/'.$alluser->foto) }}" style="width:3cm;height:4cm;" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </page>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>