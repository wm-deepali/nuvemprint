<!-- resources/views/admin/attributes/edit.blade.php -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="attribute-form" enctype="multipart/form-data">

      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" value="<?php echo e($attribute->name ?? ''); ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Input Type <span class="text-danger">*</span></label>
              <select name="input_type" class="form-control">
                <option value="dropdown" <?php echo e($attribute->input_type == 'dropdown' ? 'selected' : ''); ?>>Dropdown</option>
                <option value="radio" <?php echo e($attribute->input_type == 'radio' ? 'selected' : ''); ?>>Radio</option>
                <option value="checkbox" <?php echo e($attribute->input_type == 'checkbox' ? 'selected' : ''); ?>>Checkbox</option>
                <option value="text" <?php echo e($attribute->input_type == 'text' ? 'selected' : ''); ?>>Text</option>
                <option value="number" <?php echo e($attribute->input_type == 'number' ? 'selected' : ''); ?>>Number</option>
                <option value="range" <?php echo e($attribute->input_type == 'range' ? 'selected' : ''); ?>>Range</option>
                <option value="select_image" <?php echo e($attribute->input_type == 'select_image' ? 'selected' : ''); ?>>Select Image
                </option>
                <option value="select_icon" <?php echo e($attribute->input_type == 'select_icon' ? 'selected' : ''); ?>>Select Icon
                </option>
                <option value="toggle" <?php echo e($attribute->input_type == 'toggle' ? 'selected' : ''); ?>>Toggle</option>
                <option value="textarea" <?php echo e($attribute->input_type == 'textarea' ? 'selected' : ''); ?>>Textarea</option>
                <option value="grouped_select" <?php echo e($attribute->input_type == 'grouped_select' ? 'selected' : ''); ?>>Grouped
                  Select</option>
              </select>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Custom Input Type</label>
              <select name="custom_input_type" class="form-control">
                <option value="">-- Select --</option>
                <option value="number" <?php echo e($attribute->custom_input_type == 'number' ? 'selected' : ''); ?>>Number</option>
                <option value="text" <?php echo e($attribute->custom_input_type == 'text' ? 'selected' : ''); ?>>Text</option>
                <option value="file" <?php echo e($attribute->custom_input_type == 'file' ? 'selected' : ''); ?>>File</option>
                <option value="none" <?php echo e($attribute->custom_input_type == 'none' ? 'selected' : ''); ?>>None</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Pricing Basis</label>
              <select name="pricing_basis" class="form-control">
                <option value="">-- Select --</option>
                <option value="per_page" <?php echo e($attribute->pricing_basis == 'per_page' ? 'selected' : ''); ?>>Per Page</option>
                <option value="per_product" <?php echo e($attribute->pricing_basis == 'per_product' ? 'selected' : ''); ?>>Per Product
                </option>
                <option value="per_extra_copy" <?php echo e($attribute->pricing_basis == 'per_extra_copy' ? 'selected' : ''); ?>>Per
                  Extra Copy</option>
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Detail</label>
              <textarea name="detail" class="form-control" rows="3"><?php echo e($attribute->detail ?? ''); ?></textarea>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="edit-setup">Setup Charges</label>
              <select name="has_setup_charge" id="edit-setup" class="form-control">
                <option value="">-- Select --</option>
                <option value="1" <?php echo e($attribute->has_setup_charge ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->has_setup_charge ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="edit-quantity">Allow Quantity</label>
              <select name="allow_quantity" class="form-control" id="edit-quantity">
                <option value="1" <?php echo e($attribute->allow_quantity ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->allow_quantity ? 'selected' : ''); ?>>No</option>
              </select>
              <input type="hidden" name="allow_quantity_hidden" id="allow_quantity_hidden" value="<?php echo e($attribute->allow_quantity); ?>">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="edit-composite">Is Composite</label>
              <select name="is_composite" class="form-control" id="edit-composite">
                <option value="1" <?php echo e($attribute->is_composite ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->is_composite ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="edit-image">Supports Images</label>
              <select name="has_image" class="form-control" id="edit-image">
                <option value="1" <?php echo e($attribute->has_image ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->has_image ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="edit-icon">Supports Icons</label>
              <select name="has_icon" class="form-control" id="edit-icon">
                <option value="1" <?php echo e($attribute->has_icon ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->has_icon ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="edit-dependency">Has Dependency</label>
              <select name="has_dependency" class="form-control" id="edit-dependency">
                <option value="1" <?php echo e($attribute->has_dependency ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->has_dependency ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div>

          <div class="col-md-3 dependency-parent-block"
            style="<?php echo e(!$attribute->has_dependency ? 'display: none;' : ''); ?>">
            <div class="form-group">
              <label for="edit-dependency-parent">Dependency Parent</label>
              <select name="dependency_parent" class="form-control" id="edit-dependency-parent">
                <option value="">-- Select Parent Attribute --</option>
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($parent->id); ?>" <?php echo e($attribute->dependency_parent == $parent->id ? 'selected' : ''); ?>>
            <?php echo e($parent->name); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="update-attribute-btn"
            data-id="<?php echo e($attribute->id); ?>">Update</button>
        </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    const excludedTypes = ['select_image', 'select_icon', 'grouped_select', 'range', 'toggle', 'number'];

    // Pricing Basis - Allow Quantity auto set
    function autoSetAllowQuantity(pricingBasis) {
  if (pricingBasis === 'per_page') {
    $('#edit-quantity').val('1').prop('disabled', true); // set to Yes and disable
    $('#allow_quantity_hidden').val('1'); // mirror to hidden
  } else {
    $('#edit-quantity').prop('disabled', false);
    $('#allow_quantity_hidden').val($('#edit-quantity').val()); // mirror current value
  }
}




    function toggleEditSupportFields(selectedType) {
      if (excludedTypes.includes(selectedType)) {
        $('#edit-image').closest('.form-group').hide();
        $('#edit-icon').closest('.form-group').hide();
      } else {
        $('#edit-image').closest('.form-group').show();
        $('#edit-icon').closest('.form-group').show();
      }
    }

    // Dependency Parent Show/Hide
    function toggleDependencyParentField(value) {
      if (value === '1') {
        $('.dependency-parent-block').show();
      } else {
        $('.dependency-parent-block').hide();
        $('#edit-dependency-parent').val('');
      }
    }

    // On load
    toggleEditSupportFields($('select[name="input_type"]').val());
    toggleDependencyParentField($('#edit-dependency').val());

    // On change
    $('select[name="input_type"]').on('change', function () {
      toggleEditSupportFields($(this).val());
    });

    $('#edit-dependency').on('change', function () {
      toggleDependencyParentField($(this).val());
    });

    autoSetAllowQuantity($('select[name="pricing_basis"]').val()); // call on page load

    $('select[name="pricing_basis"]').on('change', function () {
      autoSetAllowQuantity($(this).val());
    });


  });

</script><?php /**PATH D:\web-mingo-project\new\resources\views/admin/attributes/edit.blade.php ENDPATH**/ ?>