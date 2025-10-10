<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="delivery-charge-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Delivery Charge</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div>
          <div class="row">

            <div class="form-group col-md-6">
              <label>No Of Days <span class="text-danger">*</span></label>
              <input type="number" value="<?php echo e($DeliveryCharge->no_of_days); ?>" name="no_of_days" class="form-control"
                step="1" placeholder="Enter No Of Days">
              <span class="validation-err no_of_days-err text-danger"></span>
            </div>
            <div class="form-group col-md-6">
              <label>Price <span class="text-danger">*</span></label>
              <input type="text" name="price" class="form-control" value="<?php echo e($DeliveryCharge->price); ?>">
              <span class="validation-err price-err text-danger"></span>
            </div>
          
            <div class="form-group col-md-6">
              <label>Delivery Country<span class="text-danger">*</span></label>
              <select name="title" class="form-control" required>
                <option value="">-- Select Country --</option>
                <option value="United Kingdom" <?php echo e($DeliveryCharge->title == 'United Kingdom' ? 'selected' : ''); ?>>
                  United Kingdom</option>
                <option value="Ireland" <?php echo e($DeliveryCharge->title == 'Ireland' ? 'selected' : ''); ?>>Ireland
                </option>
                <option value="Europe" <?php echo e($DeliveryCharge->title == 'Europe' ? 'selected' : ''); ?>>Europe</option>
              </select>

              <span class="validation-err country-err text-danger"></span>
            </div>
            <div class="form-group col-md-6">
              <label>Image</label>
              <input type="file" name="image" class="form-control" accept="image/*">
              <span class="validation-err image-err text-danger"></span>

              <?php if($DeliveryCharge->image): ?>
                <div class="mt-2">
                  <img src="<?php echo e(asset('storage/' . $DeliveryCharge->image)); ?>" alt="Current Image"
                    style="max-height: 100px;">
                </div>
              <?php endif; ?>
            </div>

          </div>



          <div class="form-group" id="delivery -input-wrapper-0">
            <label>Details </label>
            <textarea name="details" id="details" class="form-control"
              rows="4"><?php echo e($DeliveryCharge->details ?? ''); ?></textarea>
            <span class="validation-err details-err text-danger"></span>
          </div>

          <div class="form-check mb-2">
            <input type="checkbox" name="is_default" value="1" class="form-check-input" id="is_default" <?php echo e($DeliveryCharge->is_default ? 'checked' : ''); ?>>
            <label class="form-check-label" for="is_default">Set as Default</label>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
          <button type="button" id="update-delivery-charge-btn" class="btn btn-primary"
            data-id="<?php echo e($DeliveryCharge->id); ?>">Update</button>
        </div>

    </form>
  </div>
</div><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/admin/delivery-charge/edit.blade.php ENDPATH**/ ?>