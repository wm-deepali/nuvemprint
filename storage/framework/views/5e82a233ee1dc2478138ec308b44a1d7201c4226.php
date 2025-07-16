

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
                  <li class="breadcrumb-item active">Manage FAQs</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <button class="btn-icon btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#addFaqModal">Add New FAQ</button>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">FAQ Listing</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="faq-table">
                    <thead>
                      <tr>
                        <th>Date & Time</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2025-07-10 14:30</td>
                        <td>What is the return policy for comic books?</td>
                        <td>You can return comic books within 30 days if they are in original condition.</td>
                        <td>Published</td>
                        <td>
                          <a href="" class="btn btn-sm btn-info mr-1">Edit</a>
                          <button class="btn btn-sm btn-danger" >Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>2025-07-09 10:15</td>
                        <td>How long does shipping take?</td>
                        <td>Shipping typically takes 3-5 business days within the USA.</td>
                        <td>Draft</td>
                        <td>
                          <a href="" class="btn btn-sm btn-info mr-1">Edit</a>
                          <button class="btn btn-sm btn-danger" >Delete</button>
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

    <!-- Add New FAQ Modal -->
    <div class="modal fade" id="addFaqModal" tabindex="-1" role="dialog" aria-labelledby="addFaqModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addFaqModalLabel">Add New FAQ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter FAQ question" required>
              </div>
              <div class="form-group">
                <label for="answer">Answer</label>
                <textarea class="form-control" id="answer" name="answer" rows="6" placeholder="Enter FAQ answer" required></textarea>
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                  <option value="Published">Published</option>
                  <option value="Draft">Draft</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Save FAQ</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function confirmDelete(url) {
      if (confirm('Are you sure you want to delete this FAQ?')) {
        window.location.href = url;
      }
    }
  </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/admin/content/faq.blade.php ENDPATH**/ ?>