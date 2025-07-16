

<?php $__env->startSection('title'); ?>
Nuvem Prints -Login In
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="page-wrapper">
	<div class="page-content">
		<!--start breadcrumb-->
		<section class="py-3 border-bottom d-none d-md-flex">
			<div class="container">
				<div class="page-breadcrumb d-flex align-items-center">
					<h3 class="breadcrumb-title pe-3">Sign in</h3>
					<div class="ms-auto">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href=""<?php echo e(route('home')); ?>"><i class="bx bx-home-alt"></i> Home</a>
								</li>
							<li class="breadcrumb-item active" aria-current="page">Sign In</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>
		<!--end breadcrumb-->
		<!--start shop cart-->
			<?php if(session('success')): ?>
                  <h5 class="alert alert-success text-center"><?php echo e(Session::get('success')); ?></h5><br>
                  <?php Session::forget('success');?>
                <?php endif; ?>
                <?php if(session('error')): ?>
                  <h5 class="alert alert-danger text-center"><?php echo e(Session::get('error')); ?></h5><br>
                  <?php Session::forget('error');?>
                <?php endif; ?>
		<section class="">
			<div class="container">
				<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
					<div class="row row-cols-1 row-cols-xl-2">
						<div class="col mx-auto">
							<div class="card">
								<div class="card-body" style="background:#ffffff;">
									<div class="border p-4 rounded">
										<div class="text-center">
											<h3 class="">Sign in</h3>
											<p>Don't have an account yet? <a href="<?php echo e(route('authentication-signup')); ?>">Sign up here</a>
											</p>
										</div>
										<div class="d-grid">
											<a class="btn my-4 shadow-sm btn-light" href="<?php echo e(route('google.redirect')); ?>"> <span class="d-flex justify-content-center align-items-center">
												<img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
												<span>Sign in with Google</span>
												</span></a>
											
										</div>
										<div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
											<hr/>
										</div>
										<div class="form-body">
											<form id="loginForm" method="post" action="<?php echo e(route('customer.authenticate')); ?>" enctype="multipart/form-data" class="row g-3">
                    <?php echo csrf_field(); ?>
												<div class="col-12">
													<label for="inputEmailAddress" class="form-label">Email Address</label>
													<input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="Email Address" required>
												</div>
												<div class="col-12">
													<label for="inputChoosePassword" class="form-label">Enter Password</label>
													<div class="input-group" id="show_hide_password">
														<input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-check form-switch">
														<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
														<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
													</div>
												</div>
												<div class="col-md-6 text-end">	<a href="<?php echo e(route('authentication-forgot-password.get')); ?>">Forgot Password ?</a>
												</div>
												<div class="col-12">
													<div class="d-grid">
														<button type="submit" class="btn btn-light"><i class="bx bxs-lock-open"></i>Sign in</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</section>
		<!--end shop cart-->
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tpmhelpinghand/public_html/nuvem.tpmhelpinghand.com/resources/views/front/authentication-signin.blade.php ENDPATH**/ ?>