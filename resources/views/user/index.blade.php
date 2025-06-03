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

@endpush

@push('js')

    <script>
        function modalAction(url) {
            $.get(url, function (response) {
                // Jika response adalah HTML langsung (bukan JSON), inject langsung ke modal
                $('#myModal').remove(); // Hapus modal lama jika ada
                $('body').append(response); // Tambahkan modal ke body
                $('#myModal').modal('show'); // Tampilkan modal
            }).fail(function () {
                alert("Terjadi kesalahan: Tidak dapat memuat data.");
            });
        }


        var dataUser;
        $(document).ready(function () {
            dataUser = $('#table_user').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('user/list') }}",
                    dataType: "json",
                    type: "GET",
                    data: function (d) {
                        d.level_id = $('#level_id').val();
                    }
                },
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex" },
                    { data: "username", name: "username" },
                    { data: "no_induk", name: "no_induk" },
                    { data: "nama", name: "nama" },
                    { data: "level_nama", name: "level_nama" },
                    { data: "aksi", name: "aksi", orderable: false, searchable: false }
                ],
                order: [[0, 'asc']]
            });

            $('#level_id').on('change', function () {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush