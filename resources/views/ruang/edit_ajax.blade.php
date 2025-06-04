<div class="modal-dialog modal-lg" role="document">
    <form id="form-update-ruang" action="{{ url('/ruang/update_ajax/'.$ruang->ruang_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Ruang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="ruang_kode">Kode Ruang</label>
                    <input type="text" class="form-control" id="ruang_kode" name="ruang_kode" value="{{ $ruang->ruang_kode }}" required>
                </div>

                <div class="form-group">
                    <label for="ruang_nama">Nama Ruang</label>
                    <input type="text" class="form-control" id="ruang_nama" name="ruang_nama" value="{{ $ruang->ruang_nama }}" required>
                </div>

                <div class="form-group">
                    <label for="ruang_tipe">Tipe Ruang</label>
                    <select name="ruang_tipe" id="ruang_tipe" class="form-control" required>
                        <option value="" disabled>Pilih tipe ruang</option>
                        @foreach (['Lab', 'Kelas', 'Kantor', 'Toilet', 'Mushola'] as $tipe)
                            <option value="{{ $tipe }}" {{ $ruang->ruang_tipe == $tipe ? 'selected' : '' }}>{{ $tipe }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="lantai_id">Lantai</label>
                    <select name="lantai_id" id="lantai_id" class="form-control" required>
                        <option value="" disabled>Pilih lantai</option>
                        @foreach ($lantai as $l)
                            <option value="{{ $l->lantai_id }}" {{ $ruang->lantai_id == $l->lantai_id ? 'selected' : '' }}>{{ $l->lantai_nama }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
</div>

<script>
    $('#form-update-ruang').on('submit', function(e) {
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
                    dataRuang.ajax.reload(null, false);
                    alert('Data ruang berhasil diperbarui.');
                } else {
                    alert('Gagal memperbarui data: ' + (response.message || 'Terjadi kesalahan.'));
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
