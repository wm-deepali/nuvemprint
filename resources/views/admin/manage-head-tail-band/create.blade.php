<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title mb-0">Add Head Tail Band</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.4rem;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <form id="head-tail-band-form" enctype="multipart/form-data">
        <div id="head-tail-band-wrapper">
          <div class="form-row mb-2 head-tail-band-row align-items-center">
            <div class="col-md-5">
              <input type="text" name="name[]" class="form-control" placeholder="e.g. Red & White">
              <span class="text-danger name-err"></span>
            </div>
            <div class="col-md-5">
              <input type="file" name="image[]" class="form-control">
              <span class="text-danger image-err"></span>
            </div>
            <div class="col-md-2 text-center">
              <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none;">×</button>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-more-head-tail-band">
          <i class="fa fa-plus mr-1"></i> Add More
        </button>
      </form>
    </div>

    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fa fa-times mr-1"></i> Close
      </button>
      <button type="button" class="btn btn-primary" id="add-head-tail-band-btn">
        <i class="fa fa-save mr-1"></i> Create
      </button>
    </div>
  </div>
</div>
