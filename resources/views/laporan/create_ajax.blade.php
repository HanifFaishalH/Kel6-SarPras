<form action="{{ url('/laporan/store_ajax') }}" method="POST" id="form-tambah-laporan">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Laporan Kerusakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group">
                    <label>Gedung</label>
                    <select name="gedung_id" class="form-control" required>
                        <option value="">- Pilih Gedung -</option>
                        @foreach($gedung as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_gedung }}</option>
                        @endforeach
                    </select>
                    <small id="error-gedung_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Lantai</label>
                    <select name="lantai_id" class="form-control" required>
                        <option value="">- Pilih Lantai -</option>
                        @foreach($lantai as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_lantai }}</option>
                        @endforeach
                    </select>
                    <small id="error-lantai_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Ruang</label>
                    <select name="ruang_id" class="form-control" required>
                        <option value="">- Pilih Ruang -</option>
                        @foreach($ruang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_ruang }}</option>
                        @endforeach
                    </select>
                    <small id="error-ruang_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Sarana</label>
                    <select name="sarana_id" class="form-control" required>
                        <option value="">- Pilih Sarana -</option>
                        @foreach($sarana as $item)
                            <option value="{{ $item->id }}">{{ $item->sarana_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-sarana_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Judul Laporan</label>
                    <input type="text" name="laporan_judul" class="form-control" required>
                    <small id="error-laporan_judul" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="laporan_deskripsi" class="form-control" rows="4" required></textarea>
                    <small id="error-laporan_deskripsi" class="error-text form-text text-danger"></small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#form-tambah-laporan").validate({
            rules: {
                gedung_id: { required: true },
                lantai_id: { required: true },
                ruang_id: { required: true },
                sarana_id: { required: true },
                laporan_judul: { required: true, minlength: 5 },
                laporan_deskripsi: { required: true, minlength: 10 }
            },
            messages: {
                gedung_id: { required: "Gedung harus dipilih." },
                lantai_id: { required: "Lantai harus dipilih." },
                ruang_id: { required: "Ruang harus dipilih." },
                sarana_id: { required: "Sarana harus dipilih." },
                laporan_judul: {
                    required: "Judul laporan wajib diisi.",
                    minlength: "Judul minimal 5 karakter."
                },
                laporan_deskripsi: {
                    required: "Deskripsi wajib diisi.",
                    minlength: "Deskripsi minimal 10 karakter."
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.success) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataLaporan.ajax.reload(); // reload DataTable
                            form.reset();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Silakan coba lagi.'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
