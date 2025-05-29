@extends('layout.template')

@section('content')
<h2>Laporan Kerusakan per Tahun</h2>
<table id="tabelPerTahun" class="display responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Tahun</th>
            <th>Jumlah Laporan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $item)
        <tr>
            <td>{{ $item->tahun }}</td>
            <td>{{ $item->jumlah_laporan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#tabelPerTahun').DataTable();
    });
</script>
@endpush
