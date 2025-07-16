<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add Bindings</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="binding-form" enctype="multipart/form-data">
        <div id="binding-wrapper">
          <div class="binding-row form-row mb-2 align-items-end">
            <div class="col-md-5">
              <label>Name</label>
              <input type="text" name="name[]" class="form-control" placeholder="e.g. Staple, Wiro">
              <span class="text-danger validation-err name-err small"></span>
            </div>
            <div class="col-md-5">
              <label>Image</label>
              <input type="file" name="image[]" class="form-control">
              <span class="text-danger validation-err image-err small"></span>
            </div>
            <div class="col-md-1 text-right">
              <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none;">×</button>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-more-binding">
          <i class="fas fa-plus"></i> Add More
        </button>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="add-binding-btn">Create</button>
    </div>
  </div>
</div>