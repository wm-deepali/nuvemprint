<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add Paper Sizes</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
      <form id="paper-size-form">
        <div id="paper-size-wrapper">
          <div class="paper-size-row form-row align-items-end mb-2">
            <div class="col-md-5">
              <label>Paper Size Name</label>
              <input type="text" name="name[]" class="form-control" placeholder="e.g. A4">
              <span class="text-danger validation-err name-err small"></span>
            </div>
            <div class="col-md-5">
              <label>Dimensions</label>
              <input type="text" name="dimensions[]" class="form-control" placeholder="e.g. 210 x 297 mm">
              <span class="text-danger validation-err dimensions-err small"></span>
            </div>
            <div class="col-md-1 text-right">
              <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none;">×</button>
            </div>
          </div>
        </div>

        <button type="button" class="btn btn-sm btn-outline-primary" id="add-more-paper-size">
          <i class="fas fa-plus"></i> Add More
        </button>
      </form>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="save-paper-size-btn">Save</button>
    </div>
  </div>
</div>
