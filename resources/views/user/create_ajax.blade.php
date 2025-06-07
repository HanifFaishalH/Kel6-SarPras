<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Tambah User</button>

<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="formTambahUser" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Level</label>
                    <select name="level_id" class="form-control" required>
                        <option value="">- Pilih Level -</option>
                        @foreach($level as $l)
                            <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                        @endforeach
                    </select>

                    <label class="mt-2">Username</label>
                    <input type="text" name="username" class="form-control" required>

                    <label class="mt-2">Password</label>
                    <input type="password" name="password" class="form-control" required>

                    <label class="mt-2">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>

                    <label class="mt-2">No Induk (opsional)</label>
                    <input type="text" name="no_induk" class="form-control">

                    <label class="mt-2">Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#formTambahUser').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: '{{ url('/user/store') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                $('#modalTambahUser').modal('hide');
                $('#formTambahUser')[0].reset();
                toastr.success('User berhasil ditambahkan');
                $('#datatable-user').DataTable().ajax.reload();
            },
            error: function (err) {
                toastr.error('Gagal menambahkan user');
            }
        });
    });
</script>