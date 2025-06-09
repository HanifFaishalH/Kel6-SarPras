@extends('layout.template')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Riwayat Perbaikan</h4>

                        <div class="data-tables">
                            <table class="table table-bordered table-striped table-hover table-sm" id="table_riwayat"
                                style="width: 100%">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>No</th>
                                        <th>Laporan ID</th>
                                        <th>Teknisi</th>
                                        <th>Tindakan</th>
                                        <th>Bahan</th>
                                        <th>Biaya</th>
                                        <th>Status</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
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
        $(document).ready(function () {
            $('#table_riwayat').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('laporan/riwayat_data') }}",
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'laporan_id', name: 'laporan_id' },
                    { data: 'teknisi', name: 'teknisi' },
                    { data: 'tindakan', name: 'tindakan' },
                    { data: 'bahan', name: 'bahan' },
                    { data: 'biaya', name: 'biaya' },
                    { data: 'status', name: 'status' },
                    { data: 'waktu_mulai', name: 'waktu_mulai' },
                    { data: 'waktu_selesai', name: 'waktu_selesai' },
                ],
                order: [[0, 'desc']]
            });
        });
    </script>
@endpush