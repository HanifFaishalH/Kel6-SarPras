<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Detail User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="user_id"><strong>No</strong></label>
                  <input type="text" class="form-control" id="user" value="{{ $user->user_id ?? '-' }}" readonly>
              </div>
              <div class="form-group">
                  <label for="username"><strong>Username</strong></label>
                  <input type="text" class="form-control" id="username" value="{{ $user->username ?? '-' }}" readonly>
              </div>
              <div class="form-group">
                  <label for="no_induk"><strong>No Induk</strong></label>
                  <input type="text" class="form-control" id="no_induk" value="{{ $user->no_induk ?? '-' }}" readonly>
              </div>
              <div class="form-group">
                  <label for="nama"><strong>Nama</strong></label>
                  <input type="text" class="form-control" id="nama" value="{{ $user->nama ?? '-' }}" readonly>
              </div>
              <div class="form-group">
                  <label for="level_id"><strong>Level</strong></label>
                  <input type="text" class="form-control" id="level_id" value="{{ $user->level->level_nama?? '-' }}" readonly>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>