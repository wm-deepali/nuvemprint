<?php
    $inputType = $attribute['input_type'] ?? 'radio';
    $values = $attribute['values'] ?? [];
    $supportImage = $attribute['has_image'] ?? false;
?>


<?php if($inputType === 'radio' && $supportImage): ?>
    <div class="attribute-wrapper col-md-12 mb-3" data-attribute-id="<?php echo e($attribute['id']); ?>"
        data-is-required="<?php echo e($attribute['is_required']); ?>">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            <?php echo e($attribute['name']); ?>

            <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="row attribute-values">
            <div class="col-md-6">
                <div class="paper-type-section">
                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button"
                            class="btn btn-light radio-button text-start <?php echo e($value['is_default'] ? 'active' : ''); ?>"
                            data-attribute-id="<?php echo e($attribute['id']); ?>" data-value-id="<?php echo e($value['id']); ?>"
                            data-image="<?php echo e(asset('storage/' . ($value['image_path'] ?? 'default-preview.png'))); ?>" <?php echo e($value['is_default'] ? 'data-selected=true' : ''); ?>>
                            <?php echo e($value['value']); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="border rounded overflow-hidden" style="width: 100%; height: 200px; padding: 3px;">
                    <img id="preview-image-<?php echo e($attribute['id']); ?>"
                        src="<?php echo e(asset('storage/' . ($attribute['values'][0]['image_path'] ?? 'default-preview.png'))); ?>"
                        class="img-fluid h-100 w-100 object-fit-cover" alt="Preview">
                    <div class="zoom-section">
                        <div class="zoomicon" data-bs-toggle="modal" data-bs-target="#imageZoomModal"
                            style="cursor: pointer;">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<?php elseif($inputType === 'radio'): ?>
    <div class="<?php echo e(in_array($attribute['name'], ['Paper Weight', 'Cover Paper Weight']) ? 'col-md-12 attribute-wrapper' : 'col-md-6 attribute-wrapper'); ?> mb-3"
        data-attribute-id="<?php echo e($attribute['id']); ?>" data-is-required="<?php echo e($attribute['is_required']); ?>">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            <?php echo e($attribute['name']); ?>

            <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="attribute-values <?php echo e(count($values) <= 4 ? 'color-print' : 'color-print1'); ?>">
            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="print-color <?php echo e($value['is_default'] ? 'active' : ''); ?>" data-attribute-id="<?php echo e($attribute['id']); ?>"
                    data-value-id="<?php echo e($value['id']); ?>" data-value="<?php echo e($value['value']); ?>">
                    <p><?php echo e($value['value']); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
<?php elseif($inputType === 'select_image'): ?>
    <div class="attribute-wrapper col-md-12 mb-3" data-attribute-id="<?php echo e($attribute['id']); ?>"
        data-is-required="<?php echo e($attribute['is_required']); ?>">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            <?php echo e($attribute['name']); ?>

            <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="attribute-value color-print1">
            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="choose-binding <?php echo e($value['is_default'] ? 'active' : ''); ?>" data-value="<?php echo e($value['value']); ?>"
                    data-attribute-id="<?php echo e($attribute['id']); ?>" data-value-id="<?php echo e($value['id']); ?>">
                    <div>
                        <img src="<?php echo e(asset('storage/' . ($value['image_path'] ?? 'default.png'))); ?>"
                            alt="<?php echo e($value['value']); ?>" />
                        <div class="zoom-section1">
                            <div class="zoomicon">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </div>
                        </div>
                        <p class="text-center"><?php echo e($value['value']); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
<?php elseif($inputType === 'dropdown'): ?>
    <div class="attribute-wrapper col-md-6 mb-3" data-attribute-id="<?php echo e($attribute['id']); ?>"
        data-is-required="<?php echo e($attribute['is_required']); ?>">
        <div class="d-flex justify-content-between size-btn">
            <label class="form-label d-flex align-items-center" style="gap: 5px;">
                <?php echo e($attribute['name']); ?>

                <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                    data-target="#helpModal">?</span>
            </label>
            <button type="button" class="btn btn-link p-0">Custom Size</button>
        </div>
        <div class="attribute-values">
            <select class="custom-select" id="dropdown_<?php echo e($attribute['id']); ?>" name="attributes[<?php echo e($attribute['id']); ?>]">
                <option value="">-- Select --</option>
                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value['value']); ?>" data-attribute-id="<?php echo e($attribute['id']); ?>"
                        data-value-id="<?php echo e($value['id']); ?>" <?php echo e($value['is_default'] ? 'selected' : ''); ?>>
                        <?php echo e($value['value']); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        </div>
    </div>
<?php endif; ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/attribute-block.blade.php ENDPATH**/ ?>