<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header bg-light">
      <h5 class="modal-title">View submission Message</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="mb-2">
        <strong>Name:</strong> <?php echo e($submission->name); ?>

      </div>
      <div class="mb-2">
        <strong>Email:</strong> <?php echo e($submission->email); ?>

      </div>
      <?php if(!empty($submission->phone)): ?>
        <div class="mb-2">
          <strong>Phone:</strong> <?php echo e($submission->phone); ?>

        </div>
      <?php endif; ?>
      <div class="mb-2">
        <strong>Subject:</strong> <?php echo e($submission->subject ?? '—'); ?>

      </div>
      <hr>
      <div>
        <strong>Message:</strong>
        <p class="mt-2"><?php echo e($submission->message); ?></p>
      </div>
      <hr>
      <div class="text-muted small">
        <strong>Submitted:</strong> <?php echo e($submission->created_at->format('d M Y, h:i A')); ?>

      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/admin/contact_submissions/view.blade.php ENDPATH**/ ?>