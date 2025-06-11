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
                    <label for="ruang_id">Ruang</label>
                    <select name="ruang_id" id="ruang_id" class="form-control" required>
                        <option value="" disabled selected>Pilih ruang</option>
                        @foreach ($ruang_list as $r)
                            <option value="{{ $r->ruang_id }}">{{ $r->ruang_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        @foreach ($kategori_list as $k)
                            <option value="{{ $k->kategori_id }}">{{ $k->kategori_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="barang_id">Barang</label>
                    <select name="barang_id" id="barang_id" class="form-control" required>
                        <option value="" disabled selected>Pilih barang</option>
                        @foreach ($barang_list as $b)
                            <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
                        @endforeach
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
    $('#form-create-sarana').on('submit', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation(); // Mencegah multiple submission

        let form = $(this);
        let url = form.attr('action');
        let data = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    $('#myModal').modal('hide'); // Pastikan id modalnya sesuai
                    $('#sarana-table').DataTable().ajax.reload(null, false); // Reload tabel
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message || 'Data sarana berhasil ditambahkan!',
                        timer: 3000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message || 'Gagal menambahkan sarana.',
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = '';
                    $.each(errors, function(key, value) {
                        errorMsg += value[0] + '<br>';
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        html: errorMsg
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan pada server.'
                    });
                }
            }
        });
        return false; // Mencegah form submit biasa
    });
</script>
