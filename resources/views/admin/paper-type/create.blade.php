<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add Paper Types</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <form id="paper-type-form">
        <div id="paper-type-wrapper">
          <div class="paper-type-row form-row mb-2">
            <div class="col-md-11">
              <input type="text" name="name[]" class="form-control" placeholder="Enter paper type name">
              <span class="text-danger validation-err name-err"></span>
            </div>
            <div class="col-md-1 text-right">
              <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
            </div>
          </div>
        </div>

        <button type="button" class="btn btn-sm btn-outline-primary mt-1" id="add-more">
          <i class="fas fa-plus"></i> Add More
        </button>
      </form>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="add-paper-type-btn">Save</button>
    </div>
  </div>
</div>