<div class="modal-dialog" role="document">
    <form id="form-delete-ruang" action="{{ url('/ruang/destroy_ajax/'.$ruang->ruang_id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus ruang <strong>{{ $ruang->ruang_nama }}</strong> ({{ $ruang->ruang_kode }})?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </form>
</div>

<script>
    $('#form-delete-ruang').on('submit', function(e) {
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
                    alert('Data ruang berhasil dihapus.');
                } else {
                    alert('Gagal menghapus data.');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
    });
</script>
