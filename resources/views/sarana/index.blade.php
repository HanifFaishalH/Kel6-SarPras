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
                        <h4 class="header-title">{{ $page->title ?? 'Data Sarana' }}</h4>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        {{-- filter kategori --}}
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
                        </div>

                        {{-- filter lantai --}}
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Filter Lantai:</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="lantai_id" name="lantai_id">
                                    <option value="">- Pilih lantai -</option>
                                    @foreach ($lantai as $item)
                                        <option value="{{ $item->lantai_id }}">{{ $item->lantai_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Lantai Sarana</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-primary"
                                    onclick="modalAction('{{ url('sarana/create_ajax') }}')">
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
                                        <th>Nomor Urut</th>
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
                if (status === "error") {
                    $('#myModal').html(
                        '<div class="modal-dialog"><div class="modal-content"><div class="modal-body"><div class="alert alert-danger">Gagal memuat konten. Silakan coba lagi.</div></div></div></div>'
                    );
                }
                $('#myModal').modal('show');

                // Handle form create sarana
                $('#form-create-sarana').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#myModal').modal('hide');
                                alert(response.message);
                                dataSarana.ajax.reload(null, false); // Reload tabel
                            }
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON?.errors;
                            if (errors) {
                                let errorMsg = 'Gagal tambah sarana:\n';
                                $.each(errors, function(key, value) {
                                    errorMsg += `- ${value}\n`;
                                });
                                alert(errorMsg);
                            } else {
                                alert('Gagal tambah sarana. Silakan coba lagi.');
                            }
                        }
                    });
                });

                // Handle form update sarana
                $('#form-update-sarana').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'PUT',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#myModal').modal('hide');
                                alert(response.message);
                                dataSarana.ajax.reload(null, false); // Reload tabel
                            }
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON?.errors;
                            if (errors) {
                                let errorMsg = 'Gagal update sarana:\n';
                                $.each(errors, function(key, value) {
                                    errorMsg += `- ${value}\n`;
                                });
                                alert(errorMsg);
                            } else {
                                alert('Gagal update sarana. Silakan coba lagi.');
                            }
                        }
                    });
                });

                // Handle form delete sarana
                $('#form-delete-sarana').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'DELETE',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#myModal').modal('hide');
                                alert(response.message);
                                dataSarana.ajax.reload(null, false); // Reload tabel
                            }
                        },
                        error: function(xhr) {
                            alert('Gagal menghapus sarana. Silakan coba lagi.');
                        }
                    });
                });
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
                    dataType: "json",
                    data: function(d) {
                        d.kategori_id = $('#kategori_id').val();
                        d.lantai_id = $('#lantai_id').val();
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
                        data: "lantai_nama",
                        name: "lantai_nama",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "ruang_nama",
                        name: "ruang_nama",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "sarana_kode",
                        name: "sarana_kode"
                    },
                    {
                        data: "barang_nama",
                        name: "barang_nama",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "kategori_nama",
                        name: "kategori_nama",
                        orderable: false,
                        searchable: false
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
                dataSarana.ajax.reload(null, false);
            });
            $('#lantai_id').on('change', function() {
                dataSarana.ajax.reload(null, false);
            });
        });
    </script>
@endpush
