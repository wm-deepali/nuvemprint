
<style>
    .card{
        background:#fff !important;
        margin-top:16px !important;
    }
    .list-group-item.active {
    z-index: 2;
    color: #000 !important;
    background-color: #80808029 !important;
    border-color: rgb(255 255 255 / 20%);
    }
    .list-group-flush>.list-group-item {
    border: 1px solid #80808017 !important;
    border-width: 0 0 1px;
}
.list-group-flush{
    /*border: 1px solid #8080804a !important;*/
}
</style>

<?php $__env->startSection('title'); ?>
    Nuvem Prints -Address Book
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
		<div class="page-wrapper">
			<div class="page-content">
				<!--start breadcrumb-->
				<section class="py-3 border-bottom d-none d-md-flex">
					<div class="container">
						<div class="page-breadcrumb d-flex align-items-center">
							<h3 class="breadcrumb-title pe-3">Address Book</h3>
							<div class="ms-auto">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb mb-0 p-0">
										<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:;">Account</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Address Book</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</section>
				<!--end breadcrumb-->
				<!--start shop cart-->
				<section class="py-4">
					<div class="container">
						<h3 class="d-none">Account</h3>
						<div class="card">
							<div class="card-body">
								<div class="row">
									<?php echo $__env->make('layouts.includes.user-sidebar',['activeMenu' => 'addresses'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					            	<div class="col-lg-8">
					            	    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addressModal">
                                            Add New Address
                                        </button>
										<div class="card shadow-lg mb-0">
											<div class="card-body">
												<h6 class="mb-4">The following addresses will be used on the checkuot page by default.</h6>
												<div class="row">
													<div class="table-responsive">
													<table class="table ">
														<thead class="table-light">
															<tr>
																<th>Tag</th>
																<th>TYpe</th>
																<th>Address</th>
																<th>Default</th>
																<!--th>Actions</th-->
															</tr>
														</thead>
														<tbody>
														    <?php if(isset($addresses) && count($addresses)>0): ?>
														    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<tr>
																<td><?php echo e($address->address_tag ?? ""); ?></td>
																<td><?php echo e(ucfirst($address->type) ?? ""); ?></td>
																<td>
																	<?php echo e($address->address_line1 ?? ""); ?><br/>
																	<?php echo e($address->address_line2 ?? ""); ?><br/>
																	<?php echo e($address->postal_code ?? ""); ?><br/>
																	<?php echo e($address->cityname->name ?? ""); ?> <?php echo e($address->statename->name ?? ""); ?><br/>
																	<?php echo e($address->countryname->name ?? ""); ?><br/>
																</td>
																<td><?php echo e($address->is_default == 1 ? "Yes" : "No"); ?></td>
																<!--td>
																	<div class="d-flex gap-2">	<a href="javascript:;" class="btn btn-pencil btn-sm rounded-0">Edit</a>
																	</div>
																		<div class="d-flex gap-2">	<a href="javascript:;" class="btn btn-trash btn-sm rounded-0">Delete</a>
																	</div>
																</td-->
															</tr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															<?php endif; ?>
														</tbody>
													</table>
												</div>
												</div>
												<!--end row-->
											</div>
										</div>
									</div>
								</div>
								<!--end row-->
							</div>
						</div>
					</div>
				</section>
				<!--end shop cart-->
			</div>
		</div>
<!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="addressForm">
      <?php echo csrf_field(); ?>
      <div class="modal-content border-0 shadow">
               	<div class="modal-header  text-white" style="background:#fff;border-bottom:1px solid gray;">
          <h5 class="modal-title">Add Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" style="background:#fff;">
          <div class="mb-2">
              <label>Type</label>
              <select name="type" class="form-select" required>
                  <option value="billing">Billing</option>
                  <option value="shipping">Shipping</option>
              </select>
          </div>
          <div class="mb-2">
              <label>Address Tag</label>
              <select name="address_tag" class="form-select" required>
                  <option value="Home">Home</option>
                  <option value="Office">Office</option>
                  <option value="Others">Others</option>
              </select>
          </div>
          <div class="mb-2">
              <label>Address Line 1</label>
              <input name="address_line1" class="form-control mb-2" placeholder="Address Line 1" required>
          </div>
          
          <div class="mb-2">
              <label>Address Line 2</label>
              <input name="address_line2" class="form-control mb-2" placeholder="Address Line 2">
          </div>
          
          <div class="mb-2">
              <label>Country</label>
              <select name="country" class="form-select" id="cntry" required>
                 <option>Select Country</option>
				<?php $countries = countrylist(); ?>
				<?php if(isset($countries) && count($countries)>0): ?>
				<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					
					<option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</select>
          </div>
          
          <div class="mb-2">
              <label>State</label>
              <select name="state" class="form-select" id="state" required>
                 <option>Select State</option>
			
			</select>
          </div>
          
          <div class="mb-2">
              <label>City</label>
              <select name="city" class="form-select" id="city" required>
                 <option>Select City</option>
			
			</select>
          </div>
          
          
          
          <div class="mb-2">
              <label>Postal Code</label>
              <input name="postal_code" class="form-control mb-2" placeholder="Postal Code" required>
          </div>
          <div class="form-check">
              <input name="is_default" class="form-check-input" type="checkbox" value="1">
              <label class="form-check-label">Set as default</label>
          </div>
          
        
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Address</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('after-scripts'); ?>
<script>
$('#cntry').on("change", function() {
    $("#city").html("");
    $("#state").html("");
   let country_id = $(this).val();  
   $.ajax({
       url: `<?php echo e(URL::to('states-by-country')); ?>`,
       type: "post",
       dataType: "json",
       data:{"country_id":country_id, "_token": "<?php echo e(csrf_token()); ?>",},
       success: function(result) {
           console.log(result);
           $("#state").html(result);
          
       }
   });
});
$('#state').on("change", function() {
    $("#city").html("");
    
   let state_id = $(this).val();  
   $.ajax({
       url: `<?php echo e(URL::to('cities-by-state')); ?>`,
       type: "post",
       dataType: "json",
       data:{"state_id":state_id, "_token": "<?php echo e(csrf_token()); ?>",},
       success: function(result) {
           console.log(result);
           $("#city").html(result);
          
       }
   });
});

$('#addressForm').submit(function(e) {
    e.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
        url: "<?php echo e(route('addresses.store')); ?>",
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                $('#addressModal').modal('hide');
                $('#addressForm')[0].reset();

                // Refresh the address list
                location.reload(); // or use AJAX to re-render
            }
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseJSON.message);
        }
    });
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/account-addresses.blade.php ENDPATH**/ ?>