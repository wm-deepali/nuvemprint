<!-- Add Group Assignment Modal -->
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="group-assignment-form">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo e($assignment ? 'Edit' : 'Add'); ?> Group Assignment</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="assignment_id" value="<?php echo e($assignment->id ?? ''); ?>">

        <!-- Subcategory Dropdown -->
        <div class="form-group">
          <label>Subcategory <span class="text-danger">*</span></label>
          <select name="subcategory_id" class="form-control">
            <option value="">-- Select Subcategory --</option>
            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($subcat->id); ?>"
                <?php echo e(optional($assignment)->subcategory_id == $subcat->id ? 'selected' : ''); ?>>
                <?php echo e($subcat->name); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <small class="text-danger validation-err" id="subcategory_id-err"></small>
        </div>

        <!-- Attribute Group Dropdown -->
        <div class="form-group">
          <label>Attribute Group <span class="text-danger">*</span></label>
          <select name="attribute_group_id" class="form-control">
            <option value="">-- Select Group --</option>
            <?php $__currentLoopData = $attributeGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($group->id); ?>"
                <?php echo e(optional($assignment)->attribute_group_id == $group->id ? 'selected' : ''); ?>>
                <?php echo e($group->name); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <small class="text-danger validation-err" id="attribute_group_id-err"></small>
        </div>

        <!-- Sort Order -->
        <div class="form-group">
          <label>Sort Order</label>
          <input type="number" name="sort_order" class="form-control"
            value="<?php echo e(optional($assignment)->sort_order ?? 0); ?>">
          <small class="text-danger validation-err" id="sort_order-err"></small>
        </div>

        <!-- Toggleable Checkbox -->
        <div class="form-check">
          <input type="checkbox" name="is_toggleable" value="1" class="form-check-input"
            id="is_toggleable"
            <?php echo e(optional($assignment)->is_toggleable ? 'checked' : ''); ?>>
          <label class="form-check-label" for="is_toggleable">Toggleable</label>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="<?php echo e($assignment ? 'update-assignment-btn' : 'save-group-btn'); ?>"
          data-id="<?php echo e($assignment->id ?? ''); ?>">
          <?php echo e($assignment ? 'Update' : 'Save'); ?>

        </button>
      </div>
    </form>
  </div>
</div>
<?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/admin/group-assignments/create.blade.php ENDPATH**/ ?>