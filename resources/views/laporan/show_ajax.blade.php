<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Laporan Kerusakan</h5>
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
                            <p><strong>Sarana:</strong> {{ $laporan->sarana->sarana_kode }} - {{ $laporan->sarana->kategori->kategori_nama ?? '-' }}</p>
                            <p><strong>Pelapor:</strong> {{ $laporan->user->username }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($laporan->status) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tingkat Kerusakan:</strong> {{ ucfirst($laporan->tingkat_kerusakan) }}</p>
                            <p><strong>Tingkat Urgensi:</strong> {{ ucfirst($laporan->tingkat_urgensi) }}</p>
                            <p><strong>Frekuensi Penggunaan:</strong> {{ ucfirst($laporan->frekuensi_penggunaan) }}</p>
                            <p><strong>Tanggal Operasional:</strong> {{ \Carbon\Carbon::parse($laporan->tanggal_operasional)->format('d-m-Y') }}</p>
                            <p><strong>Tanggal Laporan:</strong> {{ $laporan->created_at->format('d-m-Y H:i') }}</p>
                            @if($laporan->teknisi)
                                <p><strong>Teknisi:</strong> {{ $laporan->teknisi->user->username ?? '-' }}</p>
                                <p><strong>Diterima Teknisi:</strong> {{ $laporan->tanggal_diterima_teknisi ? \Carbon\Carbon::parse($laporan->tanggal_diterima_teknisi)->format('d-m-Y') : '-' }}</p>
                                <p><strong>Tanggal Selesai Diperbaiki:</strong> {{ $laporan->tanggal_selesai_diperbaiki ? \Carbon\Carbon::parse($laporan->tanggal_selesai_diperbaiki)->format('d-m-Y') : '-' }}</p>
                            @endif
                        </div>
                    </div>

                    @if($laporan->catatan_teknisi)
                        <hr>
                        <p><strong>Catatan Teknisi:</strong></p>
                        <div class="alert alert-info">
                            {{ $laporan->catatan_teknisi }}
                        </div>
                    @endif

                    @if($laporan->laporan_foto)
                        <hr>
                        <p><strong>Foto Laporan:</strong></p>
                        <img src="{{ asset($laporan->laporan_foto) }}" alt="Foto Laporan" class="img-fluid rounded" style="max-width: 300px;">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
</script>