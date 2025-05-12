@extends('layout.template')

@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
        <!-- Konten modal akan dimuat di sini -->
    </div>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ $page->title }}</h4>

                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <button onclick="modalAction('{{ url('level/create_ajax') }}')" class="btn btn-sm btn-primary">Tambah Ajax</button>
                                <a href="{{ url('level/create') }}" class="btn btn-sm btn-success">Tambah</a>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Filter Level:</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="level_id" name="level_id">
                                    <option value="">- Pilih Level -</option>
                                    @foreach($level as $item)
                                        <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Level Pengguna</small>
                            </div>
                        </div>

                        <div class="data-tables">
                            <table class="table table-bordered table-striped table-hover table-sm" id="table_level">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Level</th>
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
    <!-- DataTables CSS (dapat juga dipindahkan ke layout jika digunakan global) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <!-- DataTables & jQuery (jQuery sudah ada di layout.template) -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function(response, status, xhr) {
                if (status == "error") {
                    $('#myModal').html('<div class="alert alert-danger">Gagal memuat konten. Silakan coba lagi.</div>');
                }
                $('#myModal').modal('show');
            });
        }

        var dataLevel;
        $(document).ready(function() {
            dataLevel = $('#table_level').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('level/list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function (d) {
                        d.level_id = $('#level_id').val();
                    }
                },
                columns: [
                    { data: "DT_RowIndex", name: "level_id" },
                    { data: "level_nama", name: "level_nama" },
                    { data: "aksi", name: "aksi", orderable: false, searchable: false }
                ],
                order: [[0, 'asc']]
            });

            $('#level_id').on('change', function() {
                dataLevel.ajax.reload();
            });
        });
    </script>
@endpush
