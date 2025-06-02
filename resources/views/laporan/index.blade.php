@extends('layout.template')

@section('content')
<<<<<<< HEAD
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
=======
    <div class="table-responsive">
        <table id="laporanTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Sarana</th>
                    <th>Teknisi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
>>>>>>> parent of 7d31f35 (fix :)
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
<<<<<<< HEAD
        function modalAction(url = '') {
            $('#myModal').load(url, function(response, status, xhr) {
                if (status == "error") {
                    $('#myModal').html(
                        '<div class="alert alert-danger">Gagal memuat konten. Silakan coba lagi.</div>');
                }
                $('#myModal').modal('show');
            });
        }

        var dataLaporan;
        $(document).ready(function() {
            dataLaporan = $('#laporan-table').DataTable({
=======
        // Ensure modalAction is defined
>>>>>>> parent of 7d31f35 (fix :)
        function modalAction(url) {
            console.log('Making AJAX request to:', url); // Debug
            $('.modal').modal('hide'); // Close any open modals
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response); // Debug
                    if (response.status === 'success' && response.html) {
                        // Remove existing modal to prevent duplicates
                        $('#showModal').remove();
                        // Append HTML to body, ensuring no script evaluation
                        $('body').append(response.html.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, ''));
                        // Show modal
                        $('#showModal').modal('show');
                    } else {
                        console.error('Error response:', response.message);
                        alert(response.message || 'Gagal memuat detail laporan.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error, xhr.responseText); // Debug
                    alert('Terjadi kesalahan: ' + (xhr.responseJSON?.message || 'Tidak dapat memuat data.'));
                }
            });
        }

        $(document).ready(function() {
            $('#laporanTable').DataTable({
                processing: true,
                serverSide: true,
<<<<<<< HEAD
                ajax: {
                    url: "{{ url('laporan/list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(d) {
                        d.status = $('#status').val();
                    },
                    error: function(xhr) {
                        console.error('DataTable AJAX error:', xhr.responseText);
                        alert('Gagal memuat data tabel. Silakan coba lagi.');
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "laporan_judul",
                        name: "laporan_judul"
                    },
                    {
                        data: "sarana",
                        name: "sarana"
                    },
                    {
                        data: "status_laporan",
                        name: "status_laporan"
                    },
                    {
                        data: "created_at",
                        name: "created_at"
                    },
                    {
                        data: "aksi",
                        name: "aksi",
                        orderable: false,
                        searchable: false
                    }
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
=======
                ajax: '{{ url("/laporan/list") }}',
>>>>>>> parent of 7d31f35 (fix :)
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'laporan_judul', name: 'laporan_judul' },
                    { data: 'sarana', name: 'sarana' },
                    { data: 'teknisi', name: 'teknisi' },
                    { data: 'status_laporan', name: 'status_laporan' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });
<<<<<<< HEAD

            $('#status').on('change', function() {
                console.log('Status filter changed to:', $(this).val());
                dataLaporan.ajax.reload();
            });

            $('#status').on('change', function () {
                console.log('Status filter changed to:', $(this).val());
                dataLaporan.ajax.reload();
            });
=======
>>>>>>> parent of 7d31f35 (fix :)
        });
    </script>
@endpush
