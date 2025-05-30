@extends('layout.template')

@section('content')
    {{-- Modal --}}
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered"> <!-- Changed to modal-md for compact width -->
            <div class="modal-content">
                {{-- Konten akan dimuat via Ajax --}}
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

                        <div class="form-group row">
                            <label for="status" class="col-form-label col-sm-2">Filter Status:</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="status" name="status">
                                    <option value="">- Semua Status -</option>
                                    <option value="pending">Pending</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                <small class="form-text text-muted">Pilih status laporan untuk memfilter data</small>
                            </div>
                        </div>

                        <div class="data-tables">
                            <table class="table table-bordered table-striped table-hover table-sm" id="table_laporan"
                                style="width: 100%">
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
    <style>
        .modal-dialog {
            max-width: 600px;
            /* Set desired width */
            margin: 1.75rem auto;
            /* Center modal */
        }

        .modal-content {
            background-color: #fff;
            /* Solid white background */
            border-radius: 0.3rem;
            /* Bootstrap default border-radius */
        }

        .modal {
            overflow-x: hidden;
            /* Prevent horizontal scroll */
        }
    </style>
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal .modal-content').html('<div class="text-center p-4">Loading...</div>');
            $('#myModal .modal-content').load(url, function(response, status, xhr) {
                if (status == "error") {
                    $('#myModal .modal-content').html(
                        '<div class="alert alert-danger">Gagal memuat konten. Silakan coba lagi.</div>');
                }
            });
            $('#myModal').modal('show');
        }

        $(document).ready(function() {
            let dataLaporan = $('#table_laporan').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('laporan/list_kelola') }}",
                    data: function(d) {
                        d.status = $('#status').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'laporan_judul',
                        name: 'laporan_judul'
                    },
                    {
                        data: 'lantai.lantai_nama',
                        name: 'lantai.lantai_nama'
                    },
                    {
                        data: 'ruang.ruang_nama',
                        name: 'ruang.ruang_nama'
                    },
                    {
                        data: "sarana",
                        name: "sarana"
                    },
                    {
                        data: 'status_laporan', // Changed from 'status' to 'status_laporan'
                        name: 'status_laporan',
                        render: function(data, type, row) {
                            let badgeClass = {
                                pending: 'badge badge-warning',
                                proses: 'badge badge-primary',
                                selesai: 'badge badge-success'
                            };
                            return '<span class="' + (badgeClass[data] || 'badge badge-secondary') +
                                ' badge-status">' + data.charAt(0).toUpperCase() + data.slice(1) +
                                '</span>';
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#status').on('change', function() {
                dataLaporan.ajax.reload();
            });
        });
    </script>
@endpush
