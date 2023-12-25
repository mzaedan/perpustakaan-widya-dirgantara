@extends('layouts.admin')

@section('header-name')
  User
@endsection

@section('content')

<div class="section">
    <div class="container-fluid">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
                                + Tambah User
                            </a>
                            <div class="table-resposive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th style="text-align: center">Kode Anggota</th>
                                            <th style="text-align: center">Foto</th>
                                            <th style="text-align: center">Nama</th>
                                            <th style="text-align: center">Email</th>
                                             <th style="text-align: center">Level</th>
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
                { data : 'no', name: 'no', className: 'text-center', width: '15%' },
                { data : 'id', name: 'id', className: 'text-center' },
                { data : 'foto', name: 'foto', className: 'text-center' },
                { data : 'name', name: 'name', className: 'text-center' },
                { data : 'email', name: 'email', className: 'text-center' },
                { data : 'roles', name: 'roles', className: 'text-center' },
                {
                    data : 'action',
                    name : 'action',
                    orderable : false,
                    searcable : false,
                    className: 'text-center',
                    width: '15%'
                },
            ]
        })
    </script>
@endpush