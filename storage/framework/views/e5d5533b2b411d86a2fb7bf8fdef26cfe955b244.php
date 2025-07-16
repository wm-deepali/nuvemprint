

<?php $__env->startSection('content'); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <!-- Header + Add Department Button -->
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h4>Departments</h4>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDepartmentModal">Add Department</button>
          </div>

          <!-- Department Table -->
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Department Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Static Example Row -->
                  <tr>
                    <td>1</td>
                    <td>Print Department</td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>
                      <button class="btn btn-sm btn-warning">Edit</button>
                      <button class="btn btn-sm btn-danger">Delete</button>
                      <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#viewNotesModal">View All Notes</button>
                    </td>
                  </tr>
                  <!-- Add more rows here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Department</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label>Department Name</label>
          <input type="text" class="form-control mb-2" placeholder="Enter Department Name">

          <label>Status</label>
          <select class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- View All Notes Modal -->
<div class="modal fade" id="viewNotesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Department Notes</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Sample Note Card 1 -->
          <div class="col-md-6">
            <div class="card border mb-3">
              <div class="card-body">
                <p><strong>Date & Time:</strong> 2025-07-15 15:00</p>
                <p><strong>Order ID:</strong> #342134</p>
                <p><strong>Customer:</strong> John Doe<br>Email: john@example.com<br>+1-555-1234</p>
                <p><strong>Note:</strong> Order reviewed and forwarded to the print team.</p>
              </div>
            </div>
          </div>

          <!-- Sample Note Card 2 -->
          <div class="col-md-6">
            <div class="card border mb-3">
              <div class="card-body">
                <p><strong>Date & Time:</strong> 2025-07-14 11:45</p>
                <p><strong>Order ID:</strong> #342135</p>
                <p><strong>Customer:</strong> Jane Smith<br>Email: jane@example.com<br>+1-555-4321</p>
                <p><strong>Note:</strong> Final file uploaded for print approval.</p>
              </div>
            </div>
          </div>

          <!-- Add more note cards here if needed -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Required Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/admin/customer_estimates/manage-department.blade.php ENDPATH**/ ?>