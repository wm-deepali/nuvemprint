

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
                  <li class="breadcrumb-item active">Contact Messages</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Contact Messages</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="contact-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <!-- <th>Phone</th> -->
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td><?php echo e($contact->name); ?></td>
                          <td><?php echo e($contact->email); ?></td>
                          <!-- <td><?php echo e($contact->phone ?? '—'); ?></td> -->
                          <td><?php echo e($contact->subject ?? '—'); ?></td>
                          <td><?php echo e(Str::limit($contact->message, 50)); ?></td>
                          <td><?php echo e($contact->created_at->format('d M Y, h:i A')); ?></td>
                          <td>
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" class="btn btn-sm btn-info view-contact"
                                  data-id="<?php echo e($contact->id); ?>">
                                  <i class="fas fa-eye"></i>
                                </a>
                              </li>
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" onclick="deleteConfirmation(<?php echo e($contact->id); ?>)">
                                  <i class="fa fa-trash text-danger"></i>
                                </a>
                              </li>
                            </ul>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
  <script>
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // View Contact Message
    $(document).on('click', '.view-contact', function () {
      const id = $(this).data('id');
      $.get(`/admin/contact-submissions/${id}`, function (result) {
        if (result.success) {
          $('#contact-modal').html(result.html).modal('show');
        } else {
          Swal.fire('Error', 'Unable to fetch message details', 'error');
        }
      });
    });

    // Delete Contact Message
    function deleteConfirmation(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the message!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/admin/contact-submissions/${id}`,
            type: "DELETE",
            success: function (response) {
              if (response.success) {
                Swal.fire('Deleted!', '', 'success');
                setTimeout(() => location.reload(), 300);
              } else {
                Swal.fire('Error', response.msgText || 'Something went wrong', 'error');
              }
            }
          });
        }
      });
    }
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/admin/contact_submissions/index.blade.php ENDPATH**/ ?>