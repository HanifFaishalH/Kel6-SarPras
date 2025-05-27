<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card card-outline card-primary w-100" style="max-width: 800px;">
        <div class="card card-outline card-primary p-3">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">
                    <i class="bi bi-building me-2"></i>Detail Gedung #{{ $gedung->gedung_kode ?? 'N/A' }}
                </h4>
                <a href="{{ url('gedung') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>

            <!-- Gedung Info -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div>
                            <p class="mb-2"><strong><i class="bi bi-building me-2"></i>Nama Gedung:</strong>
                                {{ $gedung->gedung_nama ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="mb-2"><strong><i class="bi bi-key me-2"></i>Kode Gedung:</strong>
                                {{ $gedung->gedung_kode ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="mb-2"><strong><i class="bi bi-calendar me-2"></i>Tanggal Dibuat:</strong>
                                {{ $gedung->created_at ? $gedung->created_at->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="mb-2"><strong><i class="bi bi-calendar-check me-2"></i>Tanggal
                                    Diperbarui:</strong>
                                {{ $gedung->updated_at ? $gedung->updated_at->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gedung Table -->
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
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
</div>
