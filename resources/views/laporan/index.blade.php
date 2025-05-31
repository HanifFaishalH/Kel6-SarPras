@extends('layout.template')

@section('title', 'Daftar Laporan')

@section('content')
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
    </div>
@endsection

@push('js')
    <script>
        // Ensure modalAction is defined
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
                ajax: '{{ url("/laporan/list") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'laporan_judul', name: 'laporan_judul' },
                    { data: 'sarana', name: 'sarana' },
                    { data: 'teknisi', name: 'teknisi' },
                    { data: 'status_laporan', name: 'status_laporan' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush