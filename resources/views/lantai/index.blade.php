@extends('layout.template')

@section('content')
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
    <!-- Konten modal detail akan dimuat di sini -->
</div>

<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ $page->title ?? 'Data Lantai' }}</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <button onclick="modalAction('{{ url('/lantai/create_ajax') }}')" class="btn btn-info mb-3">Tambah Lantai</button>

                    <div class="data-tables">
                        <table class="table table-bordered table-striped table-hover table-sm" id="lantai-table">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lantai</th>
                                    <th>Gedung</th>
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

    var dataLantai;
    $(document).ready(function() {
        dataLantai = $('#lantai-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('lantai/list') }}",
                dataType: "json",
                type: "GET",
                error: function(xhr) {
                    console.error('DataTable AJAX error:', xhr.responseText);
                    alert('Gagal memuat data tabel. Silakan coba lagi.');
                }
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                { data: "lantai_nama", name: "lantai_nama" },
                { data: "gedung", name: "gedung", orderable: false, searchable: false },
                {
                    data: "aksi",
                    name: "aksi",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    function showDetail(id) {
        let url = `{{ url('/lantai/show_ajax/') }}/${id}`;
        modalAction(url);
    }
</script>
@endpush
