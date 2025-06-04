<div class="modal-dialog modal-lg" role="document">
    <form id="form-create-ruang" action="{{ url('/ruang/store_ajax') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Tambah Ruang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="ruang_kode">Kode Ruang</label>
                    <input type="text" class="form-control" id="ruang_kode" name="ruang_kode" placeholder="Masukkan kode ruang" required>
                </div>

                <div class="form-group">
                    <label for="ruang_nama">Nama Ruang</label>
                    <input type="text" class="form-control" id="ruang_nama" name="ruang_nama" placeholder="Masukkan nama ruang" required>
                </div>

                <div class="form-group">
                    <label for="ruang_tipe">Tipe Ruang</label>
                    <select name="ruang_tipe" id="ruang_tipe" class="form-control" required>
                        <option value="" disabled selected>Pilih tipe ruang</option>
                        <option value="Lab">Lab</option>
                        <option value="Kelas">Kelas</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Toilet">Toilet</option>
                        <option value="Mushola">Mushola</option>
                        <!-- Tambahkan opsi tipe lain sesuai kebutuhan -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="lantai_id">Lantai</label>
                    <select name="lantai_id" id="lantai_id" class="form-control" required>
                        <option value="" disabled selected>Pilih lantai</option>
                        @foreach ($lantai as $l)
                            <option value="{{ $l->lantai_id }}">{{ $l->lantai_nama }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

<script>
    $('#form-create-ruang').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let data = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                if(response.success) {
                    $('#myModal').modal('hide');
                    dataRuang.ajax.reload(null, false); // Reload DataTables tanpa reset paging
                    alert('Data ruang berhasil disimpan.');
                } else {
                    alert('Gagal menyimpan data: ' + (response.message || 'Terjadi kesalahan.'));
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let msg = 'Terjadi kesalahan pada input:\n';
                if(errors) {
                    Object.values(errors).forEach(arr => {
                        arr.forEach(e => { msg += '- ' + e + '\n'; });
                    });
                } else {
                    msg += xhr.responseText;
                }
                alert(msg);
            }
        });
    });
</script>
