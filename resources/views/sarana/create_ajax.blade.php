<div class="modal-dialog modal-lg" role="document">
    <form id="form-create-sarana" action="{{ url('/sarana/store_ajax') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Tambah Sarana</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="sarana_kode">Kode Sarana</label>
                    <input type="text" class="form-control" id="sarana_kode" name="sarana_kode"
                        value="{{ $sarana_kode ?? '' }}" readonly required>
                </div>
                <div class="form-group">
                    <label for="lantai_id">Lantai</label>
                    <select name="lantai_id" id="lantai_id" class="form-control" required>
                        <option value="" disabled selected>Pilih lantai</option>
                        @foreach ($lantai_list as $l)
                            <option value="{{ $l->lantai_id }}">{{ $l->lantai_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ruang_id">Ruang</label>
                    <select name="ruang_id" id="ruang_id" class="form-control" disabled required>
                        <option value="">- Pilih Ruang -</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">- Pilih Kategori -</option>
                        @foreach ($kategori_list ?? [] as $k)
                            <option value="{{ $k->kategori_id }}">{{ $k->kategori_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="barang_id">Barang</label>
                    <select name="barang_id" id="barang_id" class="form-control" disabled required>
                        <option value="">- Pilih Barang -</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="frekuensi_penggunaan">Frekuensi Penggunaan</label>
                    <input type="text" class="form-control" id="frekuensi_penggunaan" name="frekuensi_penggunaan"
                        placeholder="Masukkan frekuensi penggunaan" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Ambil ruang berdasarkan lantai
        $('#lantai_id').on('change', function() {
            var lantaiID = $(this).val();
            var ruangSelect = $('#ruang_id');
            var kategoriSelect = $('#kategori_id'); // Tetap aktif karena sudah ada opsi
            var barangSelect = $('#barang_id');

            ruangSelect.empty().append('<option value="">- Pilih Ruang -</option>').prop('disabled',
                true);
            barangSelect.empty().append('<option value="">- Pilih Barang -</option>').prop('disabled',
                true);

            if (lantaiID) {
                $.ajax({
                    url: "{{ url('sarana/ajax/ruang-by-lantai') }}/" + lantaiID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                ruangSelect.append('<option value="' + value
                                    .ruang_id + '">' + value.ruang_nama +
                                    '</option>');
                            });
                            ruangSelect.prop('disabled', false);
                        } else {
                            Swal.fire('Info', 'Tidak ada ruang tersedia untuk lantai ini.',
                                'info');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal mengambil data ruang.', 'error');
                    }
                });
            }
        });

        // Ambil barang berdasarkan kategori (ruang tidak lagi memengaruhi kategori)
        $('#kategori_id').on('change', function() {
            var kategoriID = $(this).val();
            var barangSelect = $('#barang_id');

            barangSelect.empty().append('<option value="">- Pilih Barang -</option>').prop('disabled',
                true);

            if (kategoriID) {
                $.ajax({
                    url: "{{ url('sarana/ajax/barang-by-kategori') }}/" + kategoriID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                barangSelect.append('<option value="' + value
                                    .barang_id + '">' + value.barang_nama +
                                    '</option>');
                            });
                            barangSelect.prop('disabled', false);
                        } else {
                            Swal.fire('Info',
                                'Tidak ada barang tersedia untuk kategori ini.', 'info');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal mengambil data barang.', 'error');
                    }
                });
            }
        });
    });
</script>
