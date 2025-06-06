<div class="modal-header">
    <h5 class="modal-title">Tugaskan Teknisi</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="formTugaskanTeknisi" action="{{ url('laporan/tugaskan_teknisi/' . $laporan->laporan_id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="teknisi_id">Pilih Teknisi</label>
            <select name="teknisi_id" id="teknisi_id" class="form-control" required>
                <option value="">-- Pilih Teknisi --</option>
                @foreach ($teknisi as $t)
                    <option value="{{ $t->teknisi_id }}">{{ $t->user->username }} ({{ $t->keahlian }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tugaskan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </form>
</div>
