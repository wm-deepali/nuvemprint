<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit Paper Size</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="paper-size-form">
        <div class="form-group">
          <label for="name">Paper Size Name</label>
          <input type="text" name="name" class="form-control" value="{{ $paperSize->name }}">
          <span class="text-danger validation-err name-err"></span>
        </div>
        <div class="form-group">
          <label for="dimensions">Dimensions</label>
          <input type="text" name="dimensions" class="form-control" value="{{ $paperSize->dimensions }}">
          <span class="text-danger validation-err dimensions-err"></span>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="update-paper-size-btn" data-id="{{ $paperSize->id }}">Update</button>
    </div>
  </div>
</div>
