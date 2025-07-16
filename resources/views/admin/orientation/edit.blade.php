<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit Orientation</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <form id="orientation-form">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" value="{{ $orientation->name }}" class="form-control">
          <span class="text-danger validation-err" id="name-err"></span>
        </div>
      </form>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="update-orientation-btn" data-id="{{ $orientation->id }}">Update</button>
    </div>
  </div>
</div>
