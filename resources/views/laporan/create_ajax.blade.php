<form action="{{ url('/laporan/store_ajax') }}" method="POST" id="form-create-laporan" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Laporan Kerusakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Gedung</label>
                    <input type="hidden" name="gedung_id" value="{{ $gedung->gedung_id }}">
                    <input type="text" class="form-control" value="{{ $gedung->gedung_nama }}" readonly>
                    <small id="error-gedung_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Lantai</label>
                    <select name="lantai_id" id="lantai_id" class="form-control" required>
                        <option value="">- Pilih Lantai -</option>
                        @foreach ($lantai as $l)
                            <option value="{{ $l->lantai_id }}">{{ $l->lantai_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-lantai_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Ruang</label>
                    <select name="ruang_id" id="ruang_id" class="form-control" required>
                        <option value="">- Pilih Ruang -</option>
                        @foreach ($ruang as $r)
                            <option value="{{ $r->ruang_id }}">{{ $r->ruang_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-ruang_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Sarana</label>
                    <select name="sarana_id" id="sarana_id" class="form-control" required>
                        <option value="">- Pilih Sarana -</option>
                        @foreach ($sarana as $s)
                            <option value="{{ $s->sarana_id }}">{{ $s->sarana_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-sarana_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Judul Laporan</label>
                    <input type="text" name="laporan_judul" class="form-control" maxlength="100" required>
                    <small id="error-laporan_judul" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Foto Kerusakan</label>
                    <input type="file" name="laporan_foto" accept=".jpg,.jpeg,.png" class="form-control">
                    <small id="error-laporan_foto" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Tingkat Kerusakan</label>
                    <select name="tingkat_kerusakan" class="form-control" required>
                        <option value="">- Pilih Tingkat Kerusakan -</option>
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="kritis">Kritis</option>
                    </select>
                    <small id="error-tingkat_kerusakan" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Tingkat Urgensi</label>
                    <select name="tingkat_urgensi" class="form-control" required>
                        <option value="">- Pilih Tingkat Urgensi -</option>
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="kritis">Kritis</option>
                    </select>
                    <small id="error-tingkat_urgensi" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Frekuensi Penggunaan</label>
                    <select name="frekuensi_penggunaan" class="form-control" required>
                        <option value="">- Pilih Frekuensi -</option>
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                    <small id="error-frekuensi_penggunaan" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Tanggal Operasional</label>
                    <input type="date" name="tanggal_operasional" class="form-control" required>
                    <small id="error-tanggal_operasional" class="error-text form-text text-danger"></small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Laporan</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    // Get floors based on building selection
    const gedungID = $('input[name="gedung_id"]').val();
    if (gedungID) {
        $.ajax({
            url: "{{ url('laporan/ajax/lantai') }}/" + gedungID,
            type: "GET",
            dataType: "json",
            success: function(data) {
                var lantaiSelect = $('select[name="lantai_id"]');
                lantaiSelect.empty().append('<option value="">- Pilih Lantai -</option>');
                $.each(data, function(key, value) {
                    lantaiSelect.append(
                        '<option value="'+ value.lantai_id +'">'+ value.lantai_nama +'</option>'
                    );
                });
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    }

    // Get rooms and facilities based on floor selection
    $('select[name="lantai_id"]').on('change', function() {
        var lantaiID = $(this).val();
        if (lantaiID) {
            $.ajax({
                url: "{{ url('laporan/ajax/ruang-sarana') }}/" + lantaiID,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Handle rooms
                    var ruangSelect = $('select[name="ruang_id"]');
                    ruangSelect.empty().append('<option value="">- Pilih Ruang -</option>');
                    
                    if(data.ruang && data.ruang.length > 0) {
                        $.each(data.ruang, function(key, value) {
                            ruangSelect.append(
                                '<option value="'+ value.ruang_id +'">'+ value.ruang_nama +'</option>'
                            );
                        });
                    }

                    // Handle facilities
                    var saranaSelect = $('select[name="sarana_id"]');
                    saranaSelect.empty().append('<option value="">- Pilih Sarana -</option>');
                    
                    if(data.sarana && data.sarana.length > 0) {
                        $.each(data.sarana, function(key, value) {
                            
                            saranaSelect.append(
                                '<option value="'+ value.sarana_id +'">'+ 
                                value.sarana_kode + ' - ' + value.sarana_nama + 
                                '</option>'
                            );
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        } else {
            // Clear dependent selects if no floor selected
            $('select[name="ruang_id"]').empty().append('<option value="">- Pilih Ruang -</option>');
            $('select[name="sarana_id"]').empty().append('<option value="">- Pilih Sarana -</option>');
        }
    });
    // Handle form submission
    $('#form-create-laporan').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 'success') {
                    // Close modal and refresh table
                    $('#modal-create-laporan').modal('hide');
                    $('#laporan-table').DataTable().ajax.reload();
                    alert(response.message);
                } else {
                    // Handle validation errors
                    $.each(response.errors, function(key, value) {
                        $('#error-' + key).text(value[0]);
                    });
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
});
</script>
