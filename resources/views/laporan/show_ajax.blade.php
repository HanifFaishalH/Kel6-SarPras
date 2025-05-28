<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Laporan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <h6><strong>Judul Laporan:</strong> {{ $laporan->laporan_judul }}</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Gedung:</strong> {{ $laporan->gedung->gedung_nama }}</p>
                            <p><strong>Lantai:</strong> {{ $laporan->lantai->lantai_nama }}</p>
                            <p><strong>Ruang:</strong> {{ $laporan->ruang->ruang_nama }}</p>
                            <p><strong>Sarana:</strong> {{ $laporan->sarana->sarana_kode }}</p>
                            <p><strong>Pelapor:</strong> {{ $laporan->user->username }}</p>
                            <p><strong>Teknisi:</strong> {{ $laporan->teknisi->user->username}}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> {{ ucfirst($laporan->status) }}</p>
                            <p><strong>Tingkat Kerusakan:</strong> {{ ucfirst($laporan->tingkat_kerusakan) }}</p>
                            <p><strong>Tingkat Urgensi:</strong> {{ ucfirst($laporan->tingkat_urgensi) }}</p>
                            <p><strong>Frekuensi Penggunaan:</strong> {{ ucfirst($laporan->frekuensi_penggunaan) }}</p>
                            <p><strong>Tanggal Operasional:</strong> {{ $laporan->tanggal_operasional }}</p>
                            <p><strong>Tanggal Laporan:</strong> {{ $laporan->created_at->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>
                    @if($laporan->laporan_foto)
                        <hr>
                        <p><strong>Foto Laporan:</strong></p>
                        <img src="{{ asset($laporan->laporan_foto) }}" alt="Foto Laporan" class="img-fluid" style="max-width: 300px;">
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>