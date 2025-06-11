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
                        <button onclick="modalAction('{{ url('/user/create_ajax') }}')" class="btn btn-info">Tambah
                            User</button>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Filter Level:</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="level_id" name="level_id">
                                    <option value="">- Pilih Level -</option>
                                    @foreach ($level as $item)
                                        <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Level Pengguna</small>
                            </div>
                        </div>

                        <div class="data-tables">
                            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>No Induk</th>
                                        <th>Nama</th>
                                        <th>Level</th>
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
                if (status === "error") {
                    $('#myModal').html(
                        '<div class="modal-dialog"><div class="modal-content"><div class="modal-body"><div class="alert alert-danger">Gagal memuat konten. Silakan coba lagi.</div></div></div></div>'
                    );
                }
                $('#myModal').modal('show');

                // Handle form update user
                $('#form-update-user').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'PUT',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#myModal').modal('hide');
                                dataUser.ajax.reload(null, false); // Reload tabel
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message ||
                                        'Data user berhasil diperbarui!',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Gagal update user: ' + (response.message ||
                                        'Coba lagi.'),
                                });
                            }
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON?.errors;
                            if (errors) {
                                let errorMsg = '';
                                $.each(errors, function(key, value) {
                                    errorMsg += `- ${value}<br>`;
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi Gagal',
                                    html: errorMsg
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Gagal update user. Silakan coba lagi.'
                                });
                            }
                        }
                    });
                });

                // Handle form create user
                $('#form-create-user').on('submit', function(e) {
                    e.preventDefault();
                    let formData = new FormData(this); // Untuk mendukung file upload (foto)
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#myModal').modal('hide');
                                dataUser.ajax.reload(null, false); // Reload tabel
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message ||
                                        'Data user berhasil ditambahkan!',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Gagal tambah user: ' + (response.message ||
                                        'Coba lagi.'),
                                });
                            }
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON?.errors;
                            if (errors) {
                                let errorMsg = '';
                                $.each(errors, function(key, value) {
                                    errorMsg += `- ${value}<br>`;
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi Gagal',
                                    html: errorMsg
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Gagal tambah user. Silakan coba lagi.'
                                });
                            }
                        }
                    });
                });

                // Handle form delete user
                $('#form-delete-user').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'DELETE',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#myModal').modal('hide');
                                dataUser.ajax.reload(null, false); // Reload tabel
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message ||
                                        'Data user berhasil dihapus!',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Gagal menghapus user: ' + (response
                                        .message || 'Coba lagi.'),
                                });
                            }
                        },
                        error: function(xhr) {
                            let message = 'Gagal menghapus user. Silakan coba lagi.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            } else if (xhr.status === 404) {
                                message = 'Data user tidak ditemukan.';
                            } else if (xhr.status === 500) {
                                message = 'Kesalahan server internal.';
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            });
                        }
                    });
                });
            });
        }

        var dataUser;
        $(document).ready(function() {
            dataUser = $('#table_user').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('user/list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(d) {
                        d.level_id = $('#level_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex"
                    },
                    {
                        data: "username",
                        name: "username"
                    },
                    {
                        data: "no_induk",
                        name: "no_induk"
                    },
                    {
                        data: "nama",
                        name: "nama"
                    },
                    {
                        data: "level_nama",
                        name: "level_nama"
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

            $('#level_id').on('change', function() {
                dataUser.ajax.reload();
            });

            $(document).on('click', '.btn-detail', function() {
                var id = $(this).data('id');
                modalAction('/user/show/' + id); // Load detail user
            });

            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                modalAction('/user/edit/' + id); // Load form edit user
            });

            $(document).on('click', '.btn-hapus', function() {
                var id = $(this).data('id');
                modalAction('/user/delete_ajax/' + id); // Load form hapus user
            });
        });
    </script>
@endpush
