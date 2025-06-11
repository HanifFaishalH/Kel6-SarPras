<div class="modal-dialog modal-lg" role="document">
    <form id="form-create-ruang" action="{{ url('/ruang/store_ajax') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Tambah Ruang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
<script>
    $('#form-create-ruang').on('submit', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation(); // Tambahkan ini untuk mencegah multiple submission

    let form = $(this);
    let url = form.attr('action');
    let data = form.serialize();

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        beforeSend: function() {
            // Tampilkan loading indicator jika perlu
            $('.modal-footer button').prop('disabled', true);
        },
        complete: function() {
            $('.modal-footer button').prop('disabled', false);
        },
        success: function(response) {
            $('#myModal').modal('hide');
            $('#ruang-table').DataTable().ajax.reload(null, false);
            
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.message || 'Data berhasil disimpan!',
                timer: 3000,
                showConfirmButton: false
            });
            
            form.trigger("reset");
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessage = '';
                
                $.each(errors, function(key, value) {
                    errorMessage += value[0] + '<br>';
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: errorMessage,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: xhr.responseJSON?.message || 'Terjadi kesalahan pada server.',
                });
            }
        }
    });
    return false; // Mencegah form submit biasa
});
</script>