<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form id="edit-category-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="category_id" value="<?php echo e($category->id); ?>">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"
                            value="<?php echo e($category->name); ?>">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" <?php echo e($category->status == 'active' ? 'selected' : ''); ?>>Active</option>
                            <option value="inactive" <?php echo e($category->status == 'inactive' ? 'selected' : ''); ?>>Inactive
                            </option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control-file">
                        <div class="text-danger validation-err" id="image-err"></div>

                        <?php if($category->image): ?>
                            <div class="mt-2">
                                <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="Current Image" width="100"
                                    class="img-thumbnail">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Popular</label>
                        <select name="is_premium" id="is_premium" class="form-control">
                            <option value="no" <?php echo e($category->is_premium == 'no' ? 'selected' : ''); ?>>No</option>
                            <option value="yes" <?php echo e($category->is_premium == 'yes' ? 'selected' : ''); ?>>Yes</option>
                        </select>
                        <div class="text-danger validation-err" id="_premium-err"></div>
                    </div>

                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="update-category-btn"
                            data-category-id="<?php echo e($category->id); ?>">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/admin/categories/ajax/edit-category.blade.php ENDPATH**/ ?>