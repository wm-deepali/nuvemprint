<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Subcategory</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="subcategory-form" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                
                <div class="form-group">
                    <label>Select Categories</label>
                    <div class="form-control" style="height:150px; overflow-y:scroll;">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check">
                                <input type="checkbox" name="category_ids[]" value="<?php echo e($category->id); ?>" class="form-check-input">
                                <label class="form-check-label"><?php echo e($category->name); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="text-danger validation-err" id="category_ids-err"></div>
                </div>

                
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <div class="text-danger validation-err" id="name-err"></div>
                </div>

                
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                </div>

                
                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control">
                </div>

                
                <div class="form-group">
                    <label>Gallery (multiple)</label>
                    <input type="file" id="gallery-input" class="form-control" multiple>
                    <div id="gallery-preview-list" class="row mt-2"></div>
                </div>

                
                <ul class="nav nav-tabs" id="tabContent">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#info">Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sizes">Available Sizes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#binding">Binding Options</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paper">Paper Types</a>
                    </li>
                </ul>

                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active" id="info">
                        <textarea name="information" id="information" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="tab-pane fade" id="sizes">
                        <textarea name="available_sizes" id="available_sizes" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="tab-pane fade" id="binding">
                        <textarea name="binding_options" id="binding_options" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="tab-pane fade" id="paper">
                        <textarea name="paper_types" id="paper_types" class="form-control" rows="4"></textarea>
                    </div>
                </div>

                
                <div class="form-group pt-1">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button type="button" class="btn btn-primary" id="add-subcategory-btn">Save</button>
            </form>
        </div>
    </div>
</div>
<?php /**PATH D:\web-mingo-project\new\resources\views/admin/subcategories/ajax/add-subcategory.blade.php ENDPATH**/ ?>