<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="delivery-charge-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Delivery Charge</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div>
          <div class="delivery -block border p-2 mb-2">
            <div class="form-group" id="title-wrapper-0">
              <label>No Of Days <span class="text-danger">*</span></label>
              <input type="number" value="<?php echo e($DeliveryCharge->no_of_days); ?>" name="no_of_days" class="form-control"
                step="1" placeholder="Enter No Of Days">
              <span class="validation-err no_of_days-err text-danger"></span>
            </div>
            <div class="form-group" id="delivery -input-wrapper-0">
              <label>Details </label>
              <textarea name="details" id="details" class="form-control"
                rows="4"><?php echo e($DeliveryCharge->details ?? ''); ?></textarea>
              <span class="validation-err details-err text-danger"></span>
            </div>

            <div class="form-group" id="title-wrapper-0">
              <label>Price <span class="text-danger">*</span></label>
              <input type="text" name="price" class="form-control" value="<?php echo e($DeliveryCharge->price); ?>">
              <span class="validation-err price-err text-danger"></span>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
          <button type="button" id="update-delivery-charge-btn" class="btn btn-primary"
            data-id="<?php echo e($DeliveryCharge->id); ?>">Update</button>
        </div>

    </form>
  </div>
</div><?php /**PATH D:\web-mingo-project\new\resources\views/admin/delivery-charge/edit.blade.php ENDPATH**/ ?>