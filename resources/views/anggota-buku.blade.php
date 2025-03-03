@extends('layouts.anggota')

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
                            <div class="form-group col-md-2">
                                <label for="id_rak" class="form-label">Rak</label>
                                <select name="id_rak" id="id_rak" class="form-control">
                                    <option value="">-- Pilih Rak --</option>
                                    @foreach ($allRak as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
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
                                            <th>Tanggal Masuk</th>
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
        $(function() {
            var datatable = $('#crudTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                    data: function(d) {
                        d.id_rak = $("#id_rak").val();
                        d.search = $('input[type="search"]').val();
                    }
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
                        data : 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            var date = new Date(data);
                            var day = date.getDate();
                            var month = date.toLocaleString('default', { month: 'long' });
                            var year = date.getFullYear();
                            return day + ' ' + month + ' ' + year;
                        }
                    },
                ]
            })

            $("#id_rak").change(function() {
                datatable.draw();
            });
        })
    </script>
@endpush