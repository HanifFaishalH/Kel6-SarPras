<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Laporan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="gedung"><strong>Gedung</strong></label>
                <input type="text" class="form-control" id="gedung" value="{{ optional($laporan->gedung)->gedung_nama ?? '-' }}" readonly>
            </div>
            <div class="form-group">
                <label for="lantai"><strong>Lantai</strong></label>
                <input type="text" class="form-control" id="lantai" value="{{ optional($laporan->lantai)->lantai_nama ?? '-' }}" readonly>
            </div>
            <div class="form-group">
                <label for="ruang"><strong>Ruang</strong></label>
                <input type="text" class="form-control" id="ruang" value="{{ optional($laporan->ruang)->ruang_nama ?? '-' }}" readonly>
            </div>
            <div class="form-group">
                <label for="sarana"><strong>Sarana</strong></label>
                <input type="text" class="form-control" id="sarana" value="{{ optional($laporan->sarana)->sarana_kode ?? '-' }}" readonly>
            </div>
            <div class="form-group">
                <label for="teknisi"><strong>Teknisi</strong></label>
                <input type="text" class="form-control" id="teknisi" value="{{ optional(optional($laporan->teknisi)->user)->name ?? '-' }}" readonly>
            </div>
            <div class="form-group">
                <label for="laporan_judul"><strong>Judul Laporan</strong></label>
                <input type="text" class="form-control" id="laporan_judul" value="{{ $laporan->laporan_judul ?? '-' }}" readonly>
            </div>
            <div class="form-group">
                <label for="laporan_foto"><strong>Foto Laporan</strong></label>
                @if($laporan->laporan_foto)
                    <!-- Debug info (can remove after testing) -->
                    <div class="alert alert-info small mb-2">
                        Path: {{ $laporan->getRawOriginal('laporan_foto') }}<br>
                        Exists: {{ $laporan->file_exists ? 'Yes' : 'No' }}<br>
                        URL: {{ $laporan->laporan_foto }}
                    </div>
                    
                    <img src="{{ $laporan->laporan_foto }}" 
                        onerror="this.onerror=null;this.src='{{ asset('images/default-image.jpg') }}';"
                        alt="Foto Laporan" class="img-fluid" style="max-width: 100%; height: auto;">
                    <div class="mt-2">
                        <a href="{{ $laporan->laporan_foto }}" target="_blank" class="btn btn-sm btn-primary">
                            View Full Image
                        </a>
                    </div>
                @else
                    <div class="alert alert-warning">
                        Tidak ada foto tersedia
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="tingkat_kerusakan"><strong>Tingkat Kerusakan</strong></label>
                <input type="text" class="form-control" id="tingkat_kerusakan" value="{{ ucfirst($laporan->tingkat_kerusakan ?? '-') }}" readonly>
            </div>
            <div class="form-group">
                <label for="tingkat_urgensi"><strong>Tingkat Urgensi</strong></label>
                <input type="text" class="form-control" id="tingkat_urgensi" value="{{ ucfirst($laporan->tingkat_urgensi ?? '-') }}" readonly>
            </div>
            <div class="form-group">
                <label for="frekuensi_penggunaan"><strong>Frekuensi Penggunaan</strong></label>
                <input type="text" class="form-control" id="frekuensi_penggunaan" value="{{ ucfirst($laporan->frekuensi_penggunaan ?? '-') }}" readonly>
            </div>
            <div class="form-group">
                <label for="tanggal_operasional"><strong>Tanggal Operasional</strong></label>
                <input type="text" class="form-control" id="tanggal_operasional" value="{{ $laporan->tanggal_operasional ?? '-' }}" readonly>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>

