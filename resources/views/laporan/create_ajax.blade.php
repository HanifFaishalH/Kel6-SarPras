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
                <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">

                <div class="form-group">
                    <label>Gedung</label>
                    <select name="gedung_id" id="gedung_id" class="form-control" required>
                        <option value="">- Pilih Gedung -</option>
                        @foreach($gedung as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_gedung }}</option>
                        @endforeach
                    </select>
                    <small id="error-gedung_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Lantai</label>
                    <select name="lantai_id" id="lantai_id" class="form-control" required disabled>
                        <option value="">- Pilih Lantai -</option>
                    </select>
                    <small id="error-lantai_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Ruang</label>
                    <select name="ruang_id" id="ruang_id" class="form-control" required disabled>
                        <option value="">- Pilih Ruang -</option>
                    </select>
                    <small id="error-ruang_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Sarana</label>
                    <select name="sarana_id" id="sarana_id" class="form-control" required disabled>
                        <option value="">- Pilih Sarana -</option>
                    </select>
                    <small id="error-sarana_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Judul Laporan</label>
                    <input type="text" name="laporan_judul" class="form-control" required>
                    <small id="error-laporan_judul" class="error-text form-text text-danger"></small>
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
    $('#gedung_id').change(function () {
        var gedungId = $(this).val();
        $('#lantai_id').html('<option value="">- Pilih Lantai -</option>').prop('disabled', true);
        $('#ruang_id').html('<option value="">- Pilih Ruang -</option>').prop('disabled', true);
        $('#sarana_id').html('<option value="">- Pilih Sarana -</option>').prop('disabled', true);

        if (gedungId) {
            $.ajax({
                url: '/get-lantai/' + gedungId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log('Data lantai:', data); // debugging
                    $('#lantai_id').prop('disabled', false);
                    $.each(data, function (key, value) {
                        $('#lantai_id').append('<option value="' + value.lantai_id + '">' + value.nama_lantai + '</option>');
                    });
                },
                error: function () {
                    alert('Gagal mengambil data lantai');
                }
            });
        }
    });

    $('#lantai_id').change(function () {
        var lantaiId = $(this).val();
        $('#ruang_id').html('<option value="">- Pilih Ruang -</option>').prop('disabled', true);
        $('#sarana_id').html('<option value="">- Pilih Sarana -</option>').prop('disabled', true);

        if (lantaiId) {
            $.ajax({
                url: '/get-ruang/' + lantaiId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log('Data ruang:', data); // debugging
                    $('#ruang_id').prop('disabled', false);
                    $.each(data, function (key, value) {
                        $('#ruang_id').append('<option value="' + value.ruang_id + '">' + value.nama_ruang + '</option>');
                    });
                },
                error: function () {
                    alert('Gagal mengambil data ruang');
                }
            });
        }
    });

    $('#ruang_id').change(function () {
        var ruangId = $(this).val();
        $('#sarana_id').html('<option value="">- Pilih Sarana -</option>').prop('disabled', true);

        if (ruangId) {
            $.ajax({
                url: '/get-sarana/' + ruangId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log('Data sarana:', data); // debugging
                    $('#sarana_id').prop('disabled', false);
                    $.each(data, function (key, value) {
                        $('#sarana_id').append('<option value="' + value.sarana_id + '">' + value.sarana_nama + '</option>');
                    });
                },
                error: function () {
                    alert('Gagal mengambil data sarana');
                }
            });
        }
    });
});
</script>
