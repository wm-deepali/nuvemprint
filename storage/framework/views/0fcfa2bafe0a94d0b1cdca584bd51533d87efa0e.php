

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
	Nuvem Prints ->My Orders
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
	<div class="page-wrapper">
		<div class="page-content">
			<!--start breadcrumb-->
			<section class="py-3 border-bottom d-none d-md-flex">
				<div class="container">
					<div class="page-breadcrumb d-flex align-items-center">
						<h3 class="breadcrumb-title pe-3">My Orders</h3>
						<div class="ms-auto">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i>
											Home</a>
									</li>
									<li class="breadcrumb-item"><a href="javascript:;">Account</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">My Orders</li>
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
								<?php echo $__env->make('layouts.includes.user-sidebar', ['activeMenu' => 'orders'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<div class="col-lg-8">
									<div class="card shadow-lg mb-0">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table">
													<thead class="table-light">
														<tr>
															<th>Date & Time</th>
															<th>quote ID</th>
															<th>Order ID</th>
															<th>Product</th>
															<th>Billed Amount</th>
															<th>Payment Status</th>
															<th>Order Status</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<tr>
																<td><?php echo e($quote->created_at->format('Y-m-d H:i')); ?></td>
																<td><?php echo e($quote->quote_number ?? '-'); ?></td>
																<td><?php echo e($quote->order_number ?? '-'); ?></td>
																<td>
																	<?php echo e(optional($quote->items->first()->subcategory->categories->first())->name ?? '-'); ?>

																	>
																	<?php echo e(optional($quote->items->first()->subcategory)->name ?? '-'); ?>

																</td>

																<td>£<?php echo e(number_format($quote->grand_total, 2)); ?></td>

																<td> <?php if($quote->payments->isEmpty()): ?>
																	<!-- No payment exists, show Pay Now -->
																	<span class="badge bg-danger">UnPaid</span>
																<?php else: ?>
																		<!-- Payment exists, show Paid badge -->
																		<span class="badge bg-success">Paid</span>
																	<?php endif; ?>
																</td>

																<td>
																	<div class="badge rounded-pill bg-light w-100">
																		<?php echo e(ucfirst($quote->status)); ?>

																	</div>
																</td>

																<td>
																	<div class="d-flex gap-2">
																		<a href="<?php echo e(route('order-details', $quote->id)); ?>" class="btn btn-light btn-sm rounded-0">View
																			Order Detail</a>

																		<?php if($quote->payments->isEmpty()): ?>
																			<a href="#" class="btn btn-sm btn-success rounded-0" >
																				Pay Now
																			</a>
																		<?php else: ?>
																			<a href="<?php echo e(route('view-invoice', $quote->id)); ?>"
																				class="btn btn-sm btn-dark rounded-0">View
																				Invoice</a>
																		<?php endif; ?>
																	</div>
																</td>
															</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

														<?php if($quotes->isEmpty()): ?>
															<tr>
																<td colspan="8" class="text-center">No orders found.</td>
															</tr>
														<?php endif; ?>
													</tbody>

												</table>
											</div>
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
	<!--end page wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/account-orders.blade.php ENDPATH**/ ?>