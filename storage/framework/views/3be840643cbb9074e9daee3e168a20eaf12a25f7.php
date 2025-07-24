

<?php $__env->startSection('content'); ?>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
          <li class="breadcrumb-item active">Pricing Rules Listing</li>
          </ol>
        </div>
        </div>
      </div>
      </div>

      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="<?php echo e(route('admin.pricing-rules.create')); ?>" class="btn-icon btn btn-primary btn-round btn-sm">Add
        Pricing Rule</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pricing Rules Listing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="quote-table">
            <thead>
            <tr>
              <th>ID</th>
              <th>Subcategory</th>
              <th>Pages Dragger</th>
              <th>Default Qty</th>
              <th>Attributes</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>

            <td><?php echo e($rule->id); ?></td>

            <td>
            <?php echo e($rule->subcategory->name ?? '-'); ?><br>
            <small>Cat: <?php echo e($rule->category->name ?? '-'); ?></small>
            </td>

            <td>
            <?php if($rule->pages_dragger_required): ?>
          <div class="mb-1">
            <div class="small text-muted ml-1">
            Required: <strong class="text-success">Yes</strong><br>

            <?php
          $depAttr = $dependencyAttrs[$rule->pages_dragger_dependency] ?? null;
          ?>

            <?php if($depAttr): ?>
          Depends on Attribute: <strong><?php echo e($depAttr->name); ?></strong><br>
          <?php else: ?>
          <em class="text-danger">Invalid Dependency</em><br>
          <?php endif; ?>

            Default Pages: <strong><?php echo e($rule->default_pages ?? '-'); ?></strong>
            </div>
          </div>
        <?php else: ?>
          <span class="text-muted">No</span>
        <?php endif; ?>
            </td>

            <td><?php echo e($rule->default_quantity ?? '-'); ?></td>

            <td>
            <?php $__empty_2 = true; $__currentLoopData = $rule->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
          <div class="mb-1">
            <div>
            <strong><?php echo e($attr->attribute->name ?? '-'); ?></strong>:
            <?php echo e($attr->value->value ?? '-'); ?>

            <?php if($attr->is_default): ?>
          <span class="badge badge-pill badge-primary ml-1" title="Default value">Default</span>
          <?php endif; ?>
            </div>
            
            <div class="small text-muted ml-1">
            <em>
            (<?php echo e(ucfirst($attr->price_modifier_type)); ?>

            <?php echo e($attr->price_modifier_type === 'multiply' ? '×' : ''); ?>

            <?php echo e(rtrim(rtrim(number_format($attr->price_modifier_value, 4, '.', ''), '0'), '.')); ?>

            <?php echo e($attr->base_charges_type === 'percentage' ? '%' : ''); ?>

            <?php echo e($attr->extra_copy_charge ? '| Extra: ' . rtrim(rtrim(number_format($attr->extra_copy_charge, 4, '.', ''), '0'), '.') : ''); ?>

            <?php echo e($attr->extra_copy_charge_type === 'percentage' ? '%' : ''); ?>)
            </em>
            </div>

            
            <?php if($attr->dependencies && $attr->dependencies->isNotEmpty()): ?>
          <div class="small text-danger ml-1 mt-1">
          <u><strong>Depends on:</strong></u>
          <ul class="mb-0 pl-3">
          <?php $__currentLoopData = $attr->dependencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
          <strong><?php echo e($dep->parentAttribute->name ?? 'Attribute #' . $dep->parent_attribute_id); ?></strong>
          =
          <span
          class="text-dark"><?php echo e($dep->parentValue->value ?? 'Value #' . $dep->parent_value_id); ?></span>
          </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          </div>
          <?php endif; ?>

            
            <?php if($attr->quantityRanges->isNotEmpty()): ?>
          <div class="ml-1 text-muted small mt-1">
          <u>
          <?php echo e($attr->attribute->pricing_basis === 'per_product' ? 'Per Product Pricing:' : 'Per Page Pricing:'); ?>

          </u>
          <ul class="mb-0 pl-3">
          <?php $__currentLoopData = $attr->quantityRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
          From <strong><?php echo e($range->quantity_from); ?></strong> to
          <strong><?php echo e($range->quantity_to); ?></strong>:
          ₹<?php echo e(rtrim(rtrim(number_format($range->price, 4, '.', ''), '0'), '.')); ?>

          </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          </div>
          <?php endif; ?>
            <?php if($attr->is_fixed_per_page && $attr->fixed_per_page_price): ?>
          <div class="ml-1 text-muted small mt-1">
          <u>Fixed Per Page Price:</u>
          ₹<?php echo e(rtrim(rtrim(number_format($attr->fixed_per_page_price, 4, '.', ''), '0'), '.')); ?>

          </div>
          <?php endif; ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
          <span class="text-muted">No Modifiers</span>
        <?php endif; ?>
            </td>

            <td>
            <a href="<?php echo e(route('admin.pricing-rules.edit', $rule->id)); ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i> Edit
            </a>
            <button class="btn btn-sm btn-danger" onclick="deletePricingRule(<?php echo e($rule->id); ?>)">
            <i class="fas fa-trash"></i> Delete
            </button>
            </td>


          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="6" class="text-center">No pricing rules found.</td>
        </tr>
        <?php endif; ?>
            </tbody>
          </table>

          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>

    <!-- Add Pricing Rule Modal -->

  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    // delete pricing rule
    function deletePricingRule(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "This will delete the pricing rule.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `<?php echo e(url('admin/pricing-rules')); ?>/${id}`,
        type: 'POST',
        data: { _method: 'DELETE', _token: '<?php echo e(csrf_token()); ?>' },
        success: function () {
        Swal.fire('Deleted!', '', 'success');
        setTimeout(() => location.reload(), 500);
        }
      });
      }
    });
    }

  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/pricing-rules/index.blade.php ENDPATH**/ ?>