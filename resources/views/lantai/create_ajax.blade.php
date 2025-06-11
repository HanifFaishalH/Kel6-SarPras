<div class="modal-dialog modal-lg" role="document">
    <form id="form-create-ruang" action="{{ url('/lantai/store_ajax') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">{{ isset($data) ? 'Edit' : 'Tambah' }} Lantai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="lantai_nama">Nama Lantai</label>
                    <input type="text" class="form-control" id="lantai_nama" name="lantai_nama"
                        value="{{ $data->lantai_nama ?? '' }}" placeholder="Masukkan nama lantai" required>
                </div>

                <div class="form-group">
                    <label for="gedung_id">Gedung</label>
                    <select name="gedung_id" id="gedung_id" class="form-control" required>
                        <option value="" disabled selected>Pilih gedung</option>
                        @foreach ($gedung as $g)
                            <option value="{{ $g->gedung_id }}" {{ (isset($data) && $data->gedung_id == $g->gedung_id) ? 'selected' : '' }}>
                                {{ $g->gedung_nama }}
                            </option>
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
                if (response.success) {
                    $('#myModal').modal('hide');
                    dataLantai.ajax.reload(null, false);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message || 'Data berhasil disimpan!',
                        timer: 3000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message || 'Data gagal disimpan!',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let msg = '';

                if (errors) {
                    Object.values(errors).forEach(arr => {
                        arr.forEach(e => { msg += e + '<br>'; });
                    });
                } else {
                    msg = 'Terjadi kesalahan saat mengirim data.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: msg
                });
            }
        });
    });

    $('#myModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset(); // Reset form saat modal ditutup
        $(this).find('.alert').remove(); // Hapus pesan error jika ada
        $(this).find('.is-invalid').removeClass('is-invalid'); // Hapus kelas is-invalid
    });
</script>
