<form action="{{ url('/laporan/store_ajax') }}" method="POST" id="form-create-laporan" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Laporan Kerusakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Gedung --}}
                <div class="form-group">
                    <label>Gedung</label>
                    @if ($gedung)
                        <input type="hidden" name="gedung_id" value="{{ $gedung->gedung_id }}">
                        <input type="text" class="form-control" value="{{ $gedung->gedung_nama }}" readonly>
                    @else
                        <input type="hidden" name="gedung_id" value="">
                        <input type="text" class="form-control" value="Tidak ada gedung tersedia" readonly>
                    @endif
                    <small id="error-gedung_id" class="error-text form-text text-danger"></small>
                </div>

                {{-- Lantai --}}
                <div class="form-group">
                    <label>Lantai</label>
                    <select name="lantai_id" id="lantai_id" class="form-control" required>
                        <option value="">- Pilih Lantai -</option>
                        @foreach ($lantai as $l)
                            <option value="{{ $l->lantai_id }}">{{ $l->lantai_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-lantai_id" class="error-text form-text text-danger"></small>
                </div>

                {{-- Ruang --}}
                <div class="form-group">
                    <label>Ruang</label>
                    <select name="ruang_id" id="ruang_id" class="form-control" required>
                        <option value="">- Pilih Ruang -</option>
                        {{-- Option akan diisi lewat ajax --}}
                    </select>
                    <small id="error-ruang_id" class="error-text form-text text-danger"></small>
                </div>

                {{-- Sarana --}}
                <div class="form-group">
                    <label>Sarana</label>
                    <select name="sarana_id" id="sarana_id" class="form-control" required>
                        <option value="">- Pilih Sarana -</option>
                        {{-- Option akan diisi lewat ajax --}}
                    </select>
                    <small id="error-sarana_id" class="error-text form-text text-danger"></small>
                </div>

                {{-- Judul Laporan --}}
                <div class="form-group">
                    <label>Judul Laporan</label>
                    <input type="text" name="laporan_judul" class="form-control" maxlength="100" required>
                    <small id="error-laporan_judul" class="error-text form-text text-danger"></small>
                </div>

                {{-- Foto Kerusakan --}}
                <div class="form-group">
                    <label>Foto Kerusakan</label>
                    <input type="file" name="laporan_foto" accept=".jpg,.jpeg,.png" class="form-control">
                    <small id="error-laporan_foto" class="error-text form-text text-danger"></small>
                </div>

                {{-- Tingkat Kerusakan --}}
                <div class="form-group">
                    <label>Tingkat Kerusakan</label>
                    <select name="tingkat_kerusakan" class="form-control" required>
                        <option value="">- Pilih Tingkat Kerusakan -</option>
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="kritis">Kritis</option>
                    </select>
                    <small id="error-tingkat_kerusakan" class="error-text form-text text-danger"></small>
                </div>

                {{-- Tingkat Urgensi --}}
                <div class="form-group">
                    <label>Tingkat Urgensi</label>
                    <select name="tingkat_urgensi" class="form-control" required>
                        <option value="">- Pilih Tingkat Urgensi -</option>
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="kritis">Kritis</option>
                    </select>
                    <small id="error-tingkat_urgensi" class="error-text form-text text-danger"></small>
                </div>

                {{-- Frekuensi Penggunaan --}}
                <div class="form-group">
                    <label>Frekuensi Penggunaan</label>
                    <select name="frekuensi_penggunaan" class="form-control" required>
                        <option value="">- Pilih Frekuensi -</option>
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                    <small id="error-frekuensi_penggunaan" class="error-text form-text text-danger"></small>
                </div>

                {{-- Dampak Kerusakan --}}
                <div class="form-group">
                    <label>Dampak Kerusakan</label>
                    <select name="dampak_kerusakan" class="form-control" required>
                        <option value="">- Pilih Dampak Kerusakan -</option>
                        <option value="minor">Minor</option>
                        <option value="kecil">Kecil</option>
                        <option value="sedang">Sedang</option>
                        <option value="besar">Besar</option>
                    </select>
                    <small id="error-dampak_kerusakan" class="error-text form-text text-danger"></small>
                </div>

                {{-- Tanggal Operasional --}}
                <div class="form-group">
                    <label>Tanggal Operasional</label>
                    <input type="date" name="tanggal_operasional" class="form-control" required>
                    <small id="error-tanggal_operasional" class="error-text form-text text-danger"></small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Laporan</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    // Ambil data ruang & sarana berdasarkan lantai terpilih
    $('select[name="lantai_id"]').on('change', function() {
        var lantaiID = $(this).val();
        var ruangSelect = $('select[name="ruang_id"]');
        var saranaSelect = $('select[name="sarana_id"]');

        // Kosongkan pilihan sebelumnya
        ruangSelect.empty().append('<option value="">- Pilih Ruang -</option>');
        saranaSelect.empty().append('<option value="">- Pilih Sarana -</option>');

        if (lantaiID) {
            $.ajax({
                url: "{{ url('laporan/ajax/ruang-sarana') }}/" + lantaiID,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Isi ruang
                    if (data.ruang && data.ruang.length > 0) {
                        $.each(data.ruang, function(key, value) {
                            ruangSelect.append('<option value="'+ value.ruang_id +'">'+ value.ruang_nama +'</option>');
                        });
                    }

                    // Isi sarana
                    if (data.sarana && data.sarana.length > 0) {
                        $.each(data.sarana, function(key, value) {
                            saranaSelect.append('<option value="'+ value.sarana_id +'">'+ value.sarana_kode + ' - ' + value.sarana_nama + '</option>');
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('Gagal memuat data ruang atau sarana. Silakan coba lagi.');
                }
            });
        }
    });

    // Handle submit form create laporan
    $('#form-create-laporan').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 'success') {
                    alert(response.message);
                    $('#form-create-laporan')[0].reset();
                    // Reset filter status jika ada di halaman utama
                    if ($('#status').length) {
                        $('#status').val('').trigger('change');
                    }
                    $('#myModal').modal('hide');
                    $('#laporan-table').DataTable().ajax.reload(null, false);
                } else {
                    // Tampilkan error validasi
                    $.each(response.errors, function(key, value) {
                        $('#error-' + key).text(value[0]);
                    });
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('Gagal menyimpan laporan. Silakan coba lagi.');
            }
        });
    });
});
</script>
