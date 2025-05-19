@extends('layout.template')

@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true">
        <!-- Konten modal akan dimuat di sini -->
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
                            <label class="col-form-label col-sm-2">Filter Gedung:</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="gedung_id" name="gedung_id">
                                    <option value="">- Pilih Gedung -</option>
                                    @foreach ($gedung as $item)
                                        <option value="{{ $item->gedung_id }}">{{ $item->gedung_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Nama Gedung</small>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-primary"
                                    onclick="modalAction('{{ url('gedung/create') }}')">
                                    <i class="fa fa-plus"></i> Tambah Gedung
                                </button>
                            </div>
                        </div>

                        <div class="data-tables">
                            <table class="table table-bordered table-striped table-hover table-sm" id="table_gedung">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Gedung</th>
                                        <th>Kode Gedung</th>
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
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function(response, status, xhr) {
                if (status == "error") {
                    $('#myModal').html(
                        '<div class="alert alert-danger">Belum jadi.</div>');
                }
                $('#myModal').modal('show');
            });
        }

        var dataGedung;
        $(document).ready(function() {
            dataGedung = $('#table_gedung').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('gedung/list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(d) {
                        d.gedung_id = $('#gedung_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "gedung_id"
                    },
                    {
                        data: "gedung_nama",
                        name: "gedung_nama"
                    },
                    {
                        data: "gedung_kode",
                        name: "gedung_kode"
                    },
                    {
                        data: "aksi",
                        name: "aksi",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm btn-warning" onclick="modalAction('{{ url('gedung/edit') }}/${row.gedung_id}')">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="modalAction('{{ url('gedung/delete') }}/${row.gedung_id}')">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            `;
                        }
                    }
                ],
                order: [
                    [0, 'asc']
                ]
            });

            $('#gedung_id').on('change', function() {
                dataGedung.ajax.reload();
            });
        });
    </script>
@endpush
