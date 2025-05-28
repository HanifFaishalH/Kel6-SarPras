@extends('layout.template')

@section('content')
<h2>Laporan Kerusakan per Bulan</h2>

<table id="tabelPerBulan" class="display responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Tahun</th>
            <th>Bulan</th>
            <th>Jumlah Laporan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $item)
        <tr>
            <td>{{ $item->tahun }}</td>
            <td>{{ \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F') }}</td>
            <td>{{ $item->jumlah_laporan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#tabelPerBulan').DataTable();
    });
</script>
@endpush
