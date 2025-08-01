

<?php $__env->startSection('title'); ?>
    Nuvem Prints ->My Downloads
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
		<div class="page-wrapper">
			<div class="page-content">
				<!--start breadcrumb-->
				<section class="py-3 border-bottom d-none d-md-flex">
					<div class="container">
						<div class="page-breadcrumb d-flex align-items-center">
							<h3 class="breadcrumb-title pe-3">My Downloads</h3>
							<div class="ms-auto">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb mb-0 p-0">
										<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:;">Account</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">My Downloads</li>
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
									<?php echo $__env->make('layouts.includes.user-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<div class="col-lg-8">
										<div class="card shadow-none mb-0">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table">
														<thead class="table-light">
															<tr>
																<th>Product</th>
																<th>Downloads Remaining</th>
																<th>Expires</th>
																<th>Download</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>Stock Moview Clip</td>
																<td>12</td>
																<td>Novermber 15, 2021</td>
																<td>
																	<div class="d-flex gap-2">	<a href="javascript:;" class="btn btn-light btn-sm rounded-0">Movie Clip 1</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>Stock Moview Clip</td>
																<td>08</td>
																<td>Novermber 12, 2021</td>
																<td>
																	<div class="d-flex gap-2"> <a href="javascript:;" class="btn btn-light btn-sm rounded-0">Movie Clip 2</a>
																	</div>
																</td>
															</tr>
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
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/account-downloads.blade.php ENDPATH**/ ?>