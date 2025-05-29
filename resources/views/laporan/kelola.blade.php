@extends('layout.template')

@section('content')
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
    //
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
                        <label class="col-form-label col-sm-2">Filter Status:</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="status" name="status">
                                <option value="">- Semua Status -</option>
                                <option value="pending">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            <small class="form-text text-muted">Status Laporan</small>
                        </div>
                    </div>

                    <div class="data-tables">
                        <table class="table table-bordered table-striped table-hover table-sm" id="table_laporan">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Lantai</th>
                                    <th>Ruang</th>
                                    <th>Sarana</th>
                                    <th>Status</th>
                                    <th>Tanggal Laporan</th>
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
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function(response, status, xhr) {
            if (status == "error") {
                $('#myModal').html('<div class="alert alert-danger">Gagal memuat konten. Silakan coba lagi.</div>');
            }
            $('#myModal').modal('show');
        });
    }

    var dataLaporan;
    $(document).ready(function() {
        dataLaporan = $('#table_laporan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('laporan/list_kelola') }}", // Ganti sesuai route
                dataType: "json",
                type: "GET",
                data: function (d) {
                    d.status = $('#status').val();
                }
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                { data: "laporan_judul", name: "laporan_judul" },
                { data: "lantai", name: "lantai" },
                { data: "ruang", name: "ruang" },
                { data: "sarana", name: "sarana" },
                { data: "status", name: "status" },
                { data: "created_at", name: "created_at" },
                { data: "aksi", name: "aksi", orderable: false, searchable: false }
            ],
            // order: [[7, 'desc']]
        });

        $('#status').on('change', function() {
            dataLaporan.ajax.reload();
        });
    });
</script>
@endpush
