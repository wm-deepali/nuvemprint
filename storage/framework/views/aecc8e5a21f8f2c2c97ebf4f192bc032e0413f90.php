<!-- Add Attribute Group Modal -->
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-group-form">
      <div class="modal-header">
        <h5 class="modal-title">Add Attribute Group</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label>Group Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" placeholder="Enter group name">
          <small class="text-danger validation-err" id="name-err"></small>
        </div>

        <div class="form-group">
          <label>Select Attributes <span class="text-danger">*</span></label>
          <div class="border p-2" style="max-height: 300px; overflow-y: auto;">
            <?php $__empty_1 = true; $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <div class="form-check">
                <input type="checkbox" name="attribute_ids[]" value="<?php echo e($attribute->id); ?>" class="form-check-input" id="attr-<?php echo e($attribute->id); ?>">
                <label class="form-check-label" for="attr-<?php echo e($attribute->id); ?>">
                  <?php echo e($attribute->name); ?> (<?php echo e(ucfirst(str_replace('_', ' ', $attribute->input_type))); ?>)
                </label>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <p class="text-muted">No attributes available.</p>
            <?php endif; ?>
          </div>
          <small class="text-danger validation-err" id="attribute_ids-err"></small>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="save-group-btn">Save</button>
      </div>
    </form>
  </div>
</div>
<?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/admin/attribute-groups/create.blade.php ENDPATH**/ ?>