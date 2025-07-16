<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add Cover Weights</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="cover-weight-form">
        <div id="cover-weight-wrapper">
          <div class="form-row mb-2">
            <div class="col-md-11">
              <input type="text" name="gsm[]" class="form-control" placeholder="Enter GSM">
              <span class="text-danger validation-err gsm-err"></span>
            </div>
            <div class="col-md-1 text-right">
              <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none;">×</button>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-more">Add More</button>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="add-cover-weight-btn">Save</button>
    </div>
  </div>
</div>
