<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add Book Types</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <form id="book-type-form">
        <div id="book-type-wrapper">
          <div class="book-type-row form-row mb-2">
            <div class="col-md-5">
              <input type="text" name="name[]" class="form-control" placeholder="Enter book type name">
              <span class="text-danger validation-err name-err"></span>
            </div>
            <div class="col-md-5">
              <input type="file" name="image[]" class="form-control">
              <span class="text-danger validation-err image-err"></span>
            </div>
            <div class="col-md-2 text-right">
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
      <button type="button" class="btn btn-primary" id="add-book-type-btn">Save</button>
    </div>
  </div>
</div>