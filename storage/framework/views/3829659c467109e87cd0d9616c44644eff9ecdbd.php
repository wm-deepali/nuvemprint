 

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
                  <li class="breadcrumb-item"><a href="<?php echo e(route('admin.customers')); ?>">Customer Listing</a></li>
                  <li class="breadcrumb-item active">Customer Detail</li>
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
                <h4 class="card-title">Customer Detail</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2 text-center">
                    <img src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=2832" class="profile-img mb-3" alt="Customer Profile" style="width:110px;">
                  </div>
                  <div class="col-md-8" style="margin-left:-30px;">
                    <h5>John Doe</h5>
                    <p><strong>Email:</strong> john.doe@example.com</p>
                    <p><strong>Contact Number:</strong> +1-555-123-4567</p>
                    <p><strong>Full Address:</strong> 123 Main Street, Springfield, IL 62701, USA</p>
                  </div>
                </div>
                <hr>
                <h5 class="mt-3">Enquiries</h5>
                <div class="table-responsive">
                  <table class="table" id="enquiries-table">
                    <thead>
                      <tr>
                        <th>Date & Time</th>
                        <th>Quote Number</th>
                        <th>Product</th>
                        <th>Estimated Cost</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2025-07-10 14:30</td>
                        <td>#345446</td>
                        <td>Books > Comic Books</td>
                        <td>£150.00</td>
                        <td><a href="" class="btn btn-sm btn-info">View Quotation</a></td>
                      </tr>
                      <tr>
                        <td>2025-07-08 09:45</td>
                        <td>#345447</td>
                        <td>Books > Graphic Novels</td>
                        <td>£200.00</td>
                        <td><a href="" class="btn btn-sm btn-info">View Quotation</a></td>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/admin/customer_estimates/customer_detail.blade.php ENDPATH**/ ?>