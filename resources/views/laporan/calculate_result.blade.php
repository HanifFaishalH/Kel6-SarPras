<div class="modal-body">
    <h5>Hasil Kalkulasi Prioritas</h5>
    <p><strong>Judul Laporan:</strong> {{ $laporan->laporan_judul }}</p>
    <p><strong>Total Bobot:</strong> {{ $bobot }}</p>
    
    <h6>Faktor Penilaian:</h6>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Faktor</th>
                <th>Nilai</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factors as $name => $factor)
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ ucfirst($factor['value']) }}</td>
                    <td>{{ $factor['score'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>