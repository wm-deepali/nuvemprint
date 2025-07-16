

<?php $__env->startSection('content'); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row mb-2">
      <div class="col-md-6">
        <h4 class="mb-0">Order Details</h4>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
        <div class="card-body">

          
          <div class="text-center mb-3">
            <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="Company Logo" style="max-width: 200px;">
          </div>

          
          <div class="row mb-4">
            <div class="col-md-6">
              <h5><strong>Order ID:</strong> #234555</h5>
              <h5>
                <strong>Payment Status:</strong>
                <span class="badge badge-success">Paid</span>
              </h5>
            </div>

            <div class="col-md-6 ">
              <label><strong>Update Status:</strong></label>
              <select class="form-control" id="statusSelect" onchange="handleStatusChange(this)">
                <option value="">Select Status</option>
                <option value="approved">Approve Order</option>
                <option value="cancelled">Cancel Order</option>
                <option value="process">Process to Department</option>
              </select>

              <div id="departmentDropdown" class="mt-2 d-none">
                <label><strong>Select Department:</strong></label>
                <select class="form-control" onchange="showNoteModal(this)">
                  <option value="">Select Department</option>
                  <option value="department1">Department 1</option>
                  <option value="department2">Department 2</option>
                  <option value="department3">Department 3</option>
                </select>
              </div>
            </div>
          </div>

          
          <div class="row border p-3 mb-4">
            <div class="col-md-6">
              <h5><strong>Customer Info</strong></h5>
              <p><strong>Name:</strong> Julia Roberts Company</p>
              <p><strong>Contact:</strong> 1 (802) 608-1234</p>
              <p><strong>Email:</strong> julia@robertscompany.com</p>
              <p><strong>Expected Delivery:</strong> 20 July 2025</p>
              <p><strong>Date & Time:</strong> 10 July 2025, 06:42 PM IST</p>
              <p><strong>Delivery Address:</strong> ROBERTS STREET, NY 1001-234</p>
            </div>
            <div class="col-md-6 text-right">
              <h5><strong>Company Info</strong></h5>
              <p><strong>Name:</strong> My Company Name</p>
              <p><strong>Contact:</strong> 0-00-000-000</p>
              <p><strong>Email:</strong> yourcompany@gmail.com</p>
              <p><strong>Address:</strong> Company Street, NY 1001-234</p>
              <p><strong>Website:</strong> www.company.com</p>
            </div>
          </div>

          
          <h5 class="mb-2">Quote Items</h5>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th style="width: 60%;">Detail</th>
                  <th style="width: 20%;">Quantity</th>
                  <th style="width: 20%;">Price (£)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Product A</strong><br>Standard Product A<br>Category: Electronics</td>
                  <td>10</td>
                  <td>500</td>
                </tr>
                <tr>
                  <td><strong>Product B</strong><br>Premium Product B<br>Category: Accessories</td>
                  <td>5</td>
                  <td>300</td>
                </tr>
              </tbody>
            </table>
          </div>

          
          <div class="row justify-content-end mt-4">
            <div class="col-md-5">
              <table class="table table-borderless">
                <tr><th>Subtotal:</th><td class="text-right">£800</td></tr>
                <tr><th>Tax 10%:</th><td class="text-right">£80</td></tr>
                <tr class="border-top">
                  <th><strong>Grand Total:</strong></th>
                  <td class="text-right"><strong>£880</strong></td>
                </tr>
              </table>
            </div>
          </div>

          
          <hr>

          
          <h5>Customer Documents</h5>
          <div class="table-responsive">
            <table class="table table-bordered mt-2">
              <thead>
                <tr>
                  <th>Remarks / Title</th>
                  <th>Thumbnail</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Final Proof</td>
                  <td><img src="<?php echo e(asset('admin_assets/images/sample-thumb.jpg')); ?>" width="80" /></td>
                  <td><a href="#" class="btn btn-sm btn-info">View</a></td>
                </tr>
              </tbody>
            </table>
          </div>

          
          <div class="row justify-content-center mt-4">
            <div class="col-md-2">
              <button class="btn btn-primary btn-block">Download PDF</button>
            </div>
            <div class="col-md-2">
              <button class="btn btn-success btn-block">Send Email</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notes Modal -->
<div class="modal fade" id="noteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Department Note</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label><strong>Department Name:</strong></label>
          <input type="text" class="form-control mb-2" readonly value="Auto-filled on select">

          <label><strong>Note:</strong></label>
          <textarea class="form-control" rows="4" placeholder="Enter note for department..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Note</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script>
  function handleStatusChange(select) {
    const deptDropdown = document.getElementById('departmentDropdown');
    if (select.value === 'process') {
      deptDropdown.classList.remove('d-none');
    } else {
      deptDropdown.classList.add('d-none');
    }
  }

  function showNoteModal(select) {
    if (select.value) {
      const modal = new bootstrap.Modal(document.getElementById('noteModal'));
      document.querySelector('#noteModal input').value = select.value;
      modal.show();
    }
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/admin/quotes/index.blade.php ENDPATH**/ ?>