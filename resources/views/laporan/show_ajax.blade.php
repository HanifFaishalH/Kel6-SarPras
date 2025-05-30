<div class="modal fade" id="modalDetailLaporan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Detail Laporan #{{ $laporan->laporan_kode ?? '-' }}</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <strong>Judul:</strong>
            <p>{{ $laporan->laporan_judul }}</p>

            <strong>Gedung:</strong>
            <p>{{ $laporan->gedung->gedung_nama ?? '-' }}</p>

            <strong>Lantai:</strong>
            <p>{{ $laporan->lantai->lantai_nama ?? '-' }}</p>

            <strong>Ruang:</strong>
            <p>{{ $laporan->ruang->ruang_nama ?? '-' }}</p>

            <strong>Sarana:</strong>
            <p>{{ $laporan->sarana->sarana_kode ?? '-' }}</p>

            <strong>Pelapor:</strong>
            <p>{{ $laporan->user->username ?? '-' }}</p>

            <strong>Teknisi:</strong>
            <p>{{ $laporan->teknisi->user->username ?? '-' }}</p>
          </div>
          <div class="col-md-6">
            <strong>Status:</strong>
            <p>{{ ucfirst($laporan->status) }}</p>

            <strong>Tingkat Kerusakan:</strong>
            <p>{{ ucfirst($laporan->tingkat_kerusakan) }}</p>

            <strong>Tingkat Urgensi:</strong>
            <p>{{ ucfirst($laporan->tingkat_urgensi) }}</p>

            <strong>Frekuensi Penggunaan:</strong>
            <p>{{ ucfirst($laporan->frekuensi_penggunaan) }}</p>

            <strong>Tanggal Operasional:</strong>
            <p>{{ $laporan->tanggal_operasional }}</p>

            <strong>Tanggal Laporan:</strong>
            <p>{{ $laporan->created_at->format('d-m-Y H:i') }}</p>
          </div>
        </div>

        @if($laporan->laporan_foto)
          <hr>
          <strong>Foto Laporan:</strong><br>
          <img src="{{ asset($laporan->laporan_foto) }}" class="img-fluid mt-2" style="max-width: 300px;" alt="Foto Laporan">
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
