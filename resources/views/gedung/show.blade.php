<div class="container py-4">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow w-100" style="max-width: 800px;">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-building me-2"></i>Detail Gedung #{{ $gedung->gedung_kode ?? 'N/A' }}
                </h5>
                <button type="button" class="btn btn-sm btn-light" onclick="$('#myModal').modal('hide')">
                    <i class="bi bi-x"></i> Tutup
                </button>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Informasi Gedung</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-building me-2"></i>
                            <strong>Nama Gedung:</strong> {{ $gedung->gedung_nama ?? '-' }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-key me-2"></i>
                            <strong>Kode Gedung:</strong> {{ $gedung->gedung_kode ?? '-' }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-calendar me-2"></i>
                            <strong>Tanggal Dibuat:</strong>
                            {{ $gedung->created_at ? $gedung->created_at->format('d-m-Y H:i') : '-' }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-calendar-check me-2"></i>
                            <strong>Tanggal Diperbarui:</strong>
                            {{ $gedung->updated_at ? $gedung->updated_at->format('d-m-Y H:i') : '-' }}
                        </li>
                    </ul>
                </div>

                <h6 class="fw-bold mb-3">Ringkasan Data Tabel</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>ID Gedung</th>
                                <th>Nama Gedung</th>
                                <th>Kode Gedung</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diperbarui</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $gedung->gedung_id ?? '-' }}</td>
                                <td>{{ $gedung->gedung_nama ?? '-' }}</td>
                                <td>{{ $gedung->gedung_kode ?? '-' }}</td>
                                <td>{{ $gedung->created_at ? $gedung->created_at->format('d-m-Y H:i') : '-' }}</td>
                                <td>{{ $gedung->updated_at ? $gedung->updated_at->format('d-m-Y H:i') : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
