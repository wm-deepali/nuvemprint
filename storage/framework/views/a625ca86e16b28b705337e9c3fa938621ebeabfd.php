<div class="card mt-2">
  <div class="card-header">
    <h4 class="card-title"><?php echo e($department->name); ?></h4>
  </div>

  <div class="card-body">
    <?php if(isset($departmentQuotes[$department->id]) && count($departmentQuotes[$department->id])): ?>
    <div class="table-responsive">
      <table class="table">
      <thead>
        <tr>
        <th>Date & Time</th>
        <th>Quote ID</th>
        <th>Order ID</th>
        <th>Product</th>
        <th>Billed Amount</th>
        <th>Payment Status</th>
        <th>Order Status</th>
        <th>Customer Info</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $departmentQuotes[$department->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $pivot = $quote->departments->firstWhere('id', $department->id)?->pivot; ?>
      <tr>
      <td><?php echo e($quote->created_at->format('Y-m-d H:i')); ?></td>
      <td>#<?php echo e($quote->quote_number); ?></td>
      <td>#<?php echo e($quote->order_number); ?></td>

      <td>
        <?php echo e(optional($quote->items->first()->subcategory->categories->first())->name ?? '-'); ?>

        >
        <?php echo e(optional($quote->items->first()->subcategory)->name ?? '-'); ?>

      </td>

      <td>£<?php echo e(number_format($quote->grand_total, 2)); ?></td>

      <td> <?php if($quote->payments->isEmpty()): ?>
      <!-- No payment exists, show Pay Now -->
      <span class="badge badge-danger">UnPaid</span>
      <?php else: ?>
      <!-- Payment exists, show Paid badge -->
      <span class="badge badge-success">Paid</span>
      <?php endif; ?>
      </td>

      <td><?php echo e($quote->status ?? ''); ?></td>

      <td>
        <?php echo e($quote->customer->first_name ?? '-'); ?> <?php echo e($quote->customer->last_name ?? ''); ?><br>
        <?php echo e($quote->customer->email ?? '-'); ?><br>
        <?php echo e($quote->customer->mobile ?? '-'); ?>

      </td>

      <td>
        <?php if($quote->payments->isEmpty()): ?>
      <!-- No payment exists, show Pay Now -->
      <button class="btn btn-sm btn-success pay-now-btn mb-1" data-quote-id="<?php echo e($quote->id); ?>"
      data-order-value="<?php echo e($quote->grand_total); ?>">
      Pay Now
      </button>
      <?php else: ?>
      <a href="<?php echo e(route('admin.quotes.invoice', $quote->id)); ?>" class="btn btn-sm btn-dark mb-1">View
      Invoice</a>
      <?php endif; ?>
        <a href="<?php echo e(route('admin.quote.show', $quote->id)); ?>" class="btn btn-sm btn-info mb-1">View
        Order Details</a>
        <a href="<?php echo e(route('admin.customers.detail', $quote->customer->id)); ?>"
        class="btn btn-sm btn-primary mb-1">View Customer Detail</a>
        <button class="btn btn-sm btn-success process-to-dept-btn mb-1" data-toggle="modal"
        data-target="#processToDepartmentModal" data-quote-id="<?php echo e($quote->id); ?>"
        data-used-departments="<?php echo e($quote->departments->pluck('id')->implode(',')); ?>">
        Process to Department
        </button>
        <button class="btn btn-sm btn-secondary mb-1 view-notes-btn" data-toggle="modal"
        data-target="#viewNotesModal" data-quote-id="<?php echo e($quote->id); ?>">
        View All Notes
        </button>

        <button class="btn btn-sm btn-danger mb-1 cancel-order-btn" data-quote-id="<?php echo e($quote->id); ?>">
        Cancel Order
        </button>

      </td>

      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="text-muted">No quotes assigned to <?php echo e($department->name); ?> yet.</div>
  <?php endif; ?>
  </div>
</div><?php /**PATH D:\web-mingo-project\new\resources\views/admin/quotes/tabs/department.blade.php ENDPATH**/ ?>