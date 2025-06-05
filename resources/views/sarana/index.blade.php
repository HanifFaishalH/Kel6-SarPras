@extends('layout.template')

@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true">
    </div>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ $page->title }}</h4>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Filter Kategori:</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="kategori_id" name="kategori_id">
                                    <option value="">- Pilih Kategori -</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Kategori Sarana</small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-primary"
                                    onclick="modalAction('{{ url('sarana/create') }}')">
                                    <i class="fa fa-plus"></i> Tambah Sarana
                                </button>
                            </div>
                        </div>

                        <div class="data-tables">
                            <table class="table table-bordered table-striped table-hover table-sm" id="table_sarana">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>No</th>
                                        <th>Lantai</th>
                                        <th>Ruang</th>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Nomor Urut
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function(response, status, xhr) {
                if (status == "error") {
                    $('#myModal').html('<div class="alert alert-danger">Belum buat</div>');
                }
                $('#myModal').modal('show');
            });
        }

        let dataSarana;
        $(document).ready(function() {
            dataSarana = $('#table_sarana').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('sarana/list') }}",
                    type: "GET",
                    data: function(d) {
                        d.kategori_id = $('#kategori_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "sarana_id"
                    },
                    {
                        data: "lantai_nama",
                        name: "lantai_nama"
                    },
                    {
                        data: "ruang_nama",
                        name: "ruang_nama"
                    },
                    {
                        data: "sarana_kode",
                        name: "sarana_kode"
                    },
                    {
                        data: "barang_nama",
                        name: "barang_nama"
                    },
                    {
                        data: "kategori_nama",
                        name: "kategori_nama"
                    },
                    {
                        data: "nomor_urut",
                        name: "nomor_urut"
                    },
                    {
                        data: "aksi",
                        name: "aksi",
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ]
            });

            $('#kategori_id').on('change', function() {
                dataSarana.ajax.reload();
            });
        });
    </script>
@endpush
