@extends('layouts.admin')

@section('header-name')
  Peminjaman
@endsection

@section('content')

<div class="section">
    <div class="container-fluid">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">
                                + Tambah Peminjaman
                            </a>
                            <div class="table-resposive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th style="text-align: center">Kode Pinjam</th>
                                            <th style="text-align: center">ID Anggota</th>
                                            <th style="text-align: center">Nama</th>
                                            <th style="text-align: center">Tanggal Peminjaman</th>
                                            <th style="text-align: center">Tanggal Harus Dikembalikan</th>
                                            <th style="text-align: center">Status</th>
                                            <th style="text-align: center">Denda</th>
                                            <th style="text-align: center">Aksi</th>
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
                { data : 'kode_peminjaman', name: 'kode_peminjaman' },
                { data : 'id_anggota', name: 'id_anggota' },
                { data : 'id_anggota', name: 'id_anggota' },
                { data : 'tanggal_peminjaman', name: 'tanggal_peminjaman' },
                { data : 'tanggal_harus_dikembalikan', name: 'tanggal_harus_dikembalikan' },
                { data : 'no', name: 'no' },
                { data : 'no', name: 'no' },
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