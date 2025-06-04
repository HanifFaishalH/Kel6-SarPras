@extends('layout.template')

@section('content')
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
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

                    <button onclick="modalAction('{{ url('/ruang/create_ajax') }}')" class="btn btn-info mb-3">Tambah Ruang</button>

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
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                { data: "ruang_kode", name: "ruang_kode" },
                { data: "ruang_nama", name: "ruang_nama" },
                { data: "ruang_tipe", name: "ruang_tipe" },
                { data: "lantai", name: "lantai.lantai_nama", orderable: false, searchable: false },
                { data: "aksi", name: "aksi", orderable: false, searchable: false }
            ]
        });

        // reload data ketika filter lantai berubah
        $('#lantai_id').change(function() {
            dataRuang.ajax.reload(null, false); // Reload DataTables tanpa reset paging
        });
    });
</script>
@endpush
