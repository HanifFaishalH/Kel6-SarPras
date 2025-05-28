<div class="container py-4">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow w-100" style="max-width: 800px;">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Gedung #{{ $gedung->gedung_kode ?? 'N/A' }}
                </h5>
                <button type="button" class="btn btn-sm btn-light" onclick="$('#myModal').modal('hide')">
                    <i class="bi bi-x"></i> Tutup
                </button>
            </div>

            <div class="card-body">
                <form id="editGedungForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="gedung_id" value="{{ $gedung->gedung_id }}"> <!-- Hidden input -->

                    <div class="mb-3">
                        <label for="gedung_nama" class="form-label">Nama Gedung</label>
                        <input type="text" name="gedung_nama"
                            class="form-control @error('gedung_nama') is-invalid @enderror"
                            value="{{ old('gedung_nama', $gedung->gedung_nama) }}" required>
                        @error('gedung_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gedung_kode" class="form-label">Kode Gedung</label>
                        <input type="text" name="gedung_kode"
                            class="form-control @error('gedung_kode') is-invalid @enderror"
                            value="{{ old('gedung_kode', $gedung->gedung_kode) }}" required>
                        @error('gedung_kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary"
                            onclick="$('#myModal').modal('hide')">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
