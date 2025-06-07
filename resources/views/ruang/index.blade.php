@extends('layout.template')

@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-hidden="true">
        <!-- Konten modal akan dimuat di sini -->
    </div>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ $page->title ?? 'Data Ruang' }}</h4>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Filter Lantai:</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="lantai_id" name="lantai_id">
                                    <option value="">- Pilih Lantai -</option>
                                    @foreach ($lantai as $l)
                                        <option value="{{ $l->lantai_id }}">{{ $l->lantai_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Lantai Ruangan</small>
                            </div>
                        </div>

                        <button onclick="modalAction('{{ url('/ruang/create_ajax') }}')" class="btn btn-info mb-3">Tambah
                            Ruang</button>

                        <div class="data-tables">
                            <table class="table table-bordered table-striped table-hover table-sm" id="ruang-table">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Ruang</th>
                                        <th>Nama Ruang</th>
                                        <th>Tipe Ruang</th>
                                        <th>Lantai</th>
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
    <!-- Add any additional CSS if needed -->
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

                // Handle form submissions for create, edit, and delete
                const forms = ['#form-create-ruang', '#form-update-ruang', '#form-delete-ruang'];
                forms.forEach(formId => {
                    $(formId).on('submit', function(e) {
                        e.preventDefault();
                        const form = $(this);
                        const method = formId === '#form-delete-ruang' ? 'DELETE' : form.find(
                            'input[name="_method"]').val() || 'POST';
                        $.ajax({
                            url: form.attr('action'),
                            type: method,
                            data: form.serialize(),
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    $('#myModal').modal('hide');
                                    alert(response.message);
                                    dataRuang.ajax.reload(null, false); // Reload tabel
                                }
                            },
                            error: function(xhr) {
                                let errors = xhr.responseJSON?.errors;
                                if (errors) {
                                    let errorMsg =
                                        `Gagal ${formId.includes('create') ? 'menambah' : formId.includes('update') ? 'update' : 'menghapus'} ruang:\n`;
                                    $.each(errors, function(key, value) {
                                        errorMsg += `- ${value}\n`;
                                    });
                                    alert(errorMsg);
                                } else {
                                    alert(
                                        `Gagal ${formId.includes('create') ? 'menambah' : formId.includes('update') ? 'update' : 'menghapus'} ruang. Silakan coba lagi.`);
                                }
                            }
                        });
                    });
                });
            });
        }

        var dataRuang;
        $(document).ready(function() {
            dataRuang = $('#ruang-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('ruang/list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(d) {
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
                        data: "ruang_kode",
                        name: "ruang_kode"
                    },
                    {
                        data: "ruang_nama",
                        name: "ruang_nama"
                    },
                    {
                        data: "ruang_tipe",
                        name: "ruang_tipe"
                    },
                    {
                        data: "lantai",
                        name: "lantai.lantai_nama",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        name: "aksi",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Reload data when floor filter changes
            $('#lantai_id').change(function() {
                dataRuang.ajax.reload(null, false);
            });
        });

        // Delete function using modal
        function deleteRuang(id) {
            modalAction('{{ url('/ruang/delete_ajax') }}/' + id);
        }
    </script>
@endpush
