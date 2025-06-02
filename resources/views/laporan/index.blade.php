@extends('layout.template')

@section('title', 'Daftar Laporan')

@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal-content">
                <!-- Konten modal akan dimuat di sini -->
            </div>
        </div>
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
                        <!-- Tombol Tambah Laporan -->
                        <button onclick="modalAction('{{ url('/laporan/create_ajax') }}')" class="btn btn-info">Buat
                            Laporan</button>

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
                            <table class="table table-bordered table-striped table-hover table-sm" id="laporan-table">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Sarana</th>
                                        <th>Status Laporan</th>
                                        <th>Persetujuan Admin</th>
                                        <th>Status Sarpras</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function modalAction(url) {
            $('#myModal').modal('hide'); // Close any open modals
            $('#modal-content').html('<div class="text-center p-4"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');
            $('#myModal').modal('show');

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success' && response.html) {
                        $('#modal-content').html(response.html);
                    } else {
                        $('#modal-content').html('<div class="alert alert-danger">Gagal memuat konten.</div>');
                    }
                },
                error: function (xhr) {
                    let errorMsg = 'Gagal memuat konten. Silakan coba lagi.';
                    if (xhr.status === 403) {
                        errorMsg = 'Anda tidak memiliki akses untuk tindakan ini.';
                    } else if (xhr.status === 404) {
                        errorMsg = 'Konten tidak ditemukan.';
                    }
                    $('#modal-content').html('<div class="alert alert-danger">' + errorMsg + '</div>');
                }
            });
        }

        var dataLaporan;
        $(document).ready(function () {
            dataLaporan = $('#laporan-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('laporan/list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function (d) {
                        d.status = $('#status').val();
                    },
                    error: function (xhr) {
                        console.error('DataTable AJAX error:', xhr.responseText);
                        alert('Gagal memuat data tabel. Silakan coba lagi.');
                    }
                },
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "laporan_judul", name: "laporan_judul" },
                    { data: "sarana", name: "sarana" },
                    { data: "status_laporan", name: "status_laporan" },
                    { data: "status_admin", name: "status_admin" },
                    { data: "status_sarpras", name: "status_sarpras" },
                    { data: "created_at", name: "created_at" },
                    {
                        data: "laporan_id",
                        name: "aksi",
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return '<button class="btn btn-sm btn-primary" onclick="modalAction(\'{{ url("laporan/show_ajax") }}/' + data + '\')">Detail</button>';
                        }
                    }
                ]
            });

            $('#status').on('change', function () {
                console.log('Status filter changed to:', $(this).val());
                dataLaporan.ajax.reload();
            });
        });
    </script>
@endpush