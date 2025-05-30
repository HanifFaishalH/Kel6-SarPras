<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Laporan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formDetailLaporan">
                @csrf
                <input type="hidden" name="laporan_id" value="{{ $laporan->laporan_id }}">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Gedung</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $laporan->gedung->gedung_nama ?? 'N/A' }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lantai</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $laporan->lantai->lantai_nama ?? 'N/A' }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ruang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $laporan->ruang->ruang_nama ?? 'N/A' }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sarana</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"
                            value="{{ $laporan->sarana->barang->barang_nama ?? 'Sarana #' . $laporan->sarana_id }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Judul Laporan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $laporan->laporan_judul }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Foto Laporan</label>
                    <div class="col-sm-9">
                        @if ($laporan->laporan_foto)
                            <img src="{{ asset($laporan->laporan_foto) }}" alt="Foto Laporan" class="img-fluid"
                                style="max-width: 100%; max-height: 300px;">
                        @else
                            <p>Tidak ada foto tersedia</p>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tingkat Kerusakan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ ucfirst($laporan->tingkat_kerusakan) }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tingkat Urgensi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ ucfirst($laporan->tingkat_urgensi) }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Frekuensi Penggunaan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ ucfirst($laporan->frekuensi_penggunaan) }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Operasional</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $laporan->tanggal_operasional }}"
                            readonly>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="acceptLaporan()">Terima Laporan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>

@push('js')
    <script>
        function acceptLaporan() {
            if (confirm('Apakah Anda yakin ingin menerima laporan ini?')) {
                $.ajax({
                    url: '{{ url('/laporan') }}/' + $('#formDetailLaporan input[name="laporan_id"]').val() +
                        '/accept',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            $('#myModal').modal('hide');
                            $('#table_laporan').DataTable().ajax.reload();
                        } else {
                            alert('Gagal menerima laporan: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = 'Gagal menerima laporan:\n';
                        $.each(errors, function(key, value) {
                            errorMessage += value + '\n';
                        });
                        alert(errorMessage);
                    }
                });
            }
        }
    </script>
@endpush
