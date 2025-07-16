<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add Cover Foiling</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="cover-foiling-form" enctype="multipart/form-data">
        <div id="cover-foiling-wrapper">
          <div class="form-row mb-2 cover-foiling-row">
            <div class="col-md-5">
              <input type="text" name="name[]" class="form-control" placeholder="e.g. Gold, Silver, Copper">
              <span class="text-danger validation-err name-err"></span>
            </div>
            <div class="col-md-5">
              <input type="file" name="image[]" class="form-control">
              <span class="text-danger validation-err image-err"></span>
            </div>
            <div class="col-md-1 text-right">
              <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none;">×</button>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-more-cover-foiling">Add More</button>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="add-cover-foiling-btn">Create</button>
    </div>
  </div>
</div>