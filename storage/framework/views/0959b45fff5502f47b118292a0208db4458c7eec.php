

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
                  <li class="breadcrumb-item active">Customer Listing</li>
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
                <h4 class="card-title">Customer Listing</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="customer-table">
                    <thead>
                      <tr>
                        <th>Date & Time</th>
                        <th>Customer Info</th>
                        <th>Total Quotes</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2025-07-10 14:30</td>
                        <td>John Doe<br>john.doe@example.com<br>+1-555-123-4567</td>
                        <td>5</td>
                        <td>
                          <a href="<?php echo e(route('admin.customers.detail')); ?>" class="btn btn-sm btn-info mr-1">View Customer Detail</a>
                          <a href="" class="btn btn-sm btn-primary mr-1">View All Quotes</a>
                          <button class="btn btn-sm btn-danger">Delete Customer</button>
                        </td>
                      </tr>
                      <tr>
                        <td>2025-07-09 10:15</td>
                        <td>Jane Smith<br>jane.smith@example.com<br>+1-555-987-6543</td>
                        <td>3</td>
                        <td>
                          <a href="<?php echo e(route('admin.customers.detail')); ?>" class="btn btn-sm btn-info mr-1">View Customer Detail</a>
                          <a href="" class="btn btn-sm btn-primary mr-1">View All Quotes</a>
                          <button class="btn btn-sm btn-danger">Delete Customer</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/admin/customer_estimates/customers.blade.php ENDPATH**/ ?>