<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.update', $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama User</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="{{ old('nama', $user->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_induk" class="form-label">No Induk</label>
                        <input type="text" name="no_induk" id="no_induk" class="form-control"
                            value="{{ old('no_induk', $user->no_induk) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username', $user->username) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" id="password" class="form-control"
                            value="{{ old('password') }}">
                    </div>
                    <div class="mb-3">
                        <label for="level_id" class="form-label">Level</label>
                        <select name="level_id" id="level_id" class="form-control">
                            @foreach ($level as $l)
                                <option value="{{ $l->level_id }}" {{ old('level_id', $user->level_id) == $l->level_id ? 'selected' : '' }}>{{ $l->level_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>