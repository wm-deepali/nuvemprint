<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit Paper Weight</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="paper-weight-form">
        <input type="text" name="gsm" class="form-control" value="{{ $paperWeight->gsm }}">
        <span class="text-danger validation-err gsm-err"></span>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="update-paper-weight-btn" data-id="{{ $paperWeight->id }}">Update</button>
    </div>
  </div>
</div>
