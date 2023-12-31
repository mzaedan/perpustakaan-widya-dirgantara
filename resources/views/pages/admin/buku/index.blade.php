@extends('layouts.admin')

@section('header-name')
  Buku
@endsection

@section('content')

<div class="section">
    <div class="container-fluid">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">
                                + Tambah Buku
                            </a>
                            <div class="table-resposive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Buku</th>
                                            <th>Nama Buku</th>
                                            <th>Penerbit</th>
                                            <th style="text-align: center">Tahun Anggaran/Pembelian</th>
                                            <th>Stok Buku</th>
                                            <th>Rak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection



@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data : 'no', name: 'no' },
                { data : 'kode_buku', name: 'kode_buku' },
                { data : 'nama', name: 'nama' },
                { data : 'penerbit', name: 'penerbit' },
                { data : 'tahun_buku', name: 'tahun_buku', className: 'text-center' },
                
                { data : 'jumlah', name: 'jumlah' },
                { data : 'rak.nama', name: 'rak.nama'},
                {
                    data : 'action',
                    name : 'action',
                    orderable : false,
                    searcable : false,
                    width: '15%'
                },
            ]
        })
    </script>
@endpush