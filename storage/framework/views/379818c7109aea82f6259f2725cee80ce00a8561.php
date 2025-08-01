

<?php $__env->startSection('title'); ?>
	Nuvem Prints -Sign Up
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="page-wrapper">
		<div class="page-content">
			<!--start breadcrumb-->
			<section class="py-3 border-bottom d-none d-md-flex">
				<div class="container">
					<div class="page-breadcrumb d-flex align-items-center">
						<h3 class="breadcrumb-title pe-3">Sign Up</h3>
						<div class="ms-auto">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="" <?php echo e(route('home')); ?>"><i class="bx bx-home-alt"></i>
											Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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

			<section class="py-0 py-lg-5">
				<div class="container">
					<div
						class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
						<div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
							<div class="col mx-auto">
								<div class="card mb-0">
									<div class="card-body">
										<div class="border p-4 rounded">
											<div class="text-center">
												<h3 class="">Sign Up</h3>
												<p>Already have an account? <a
														href="<?php echo e(route('authentication-signin')); ?>">Sign in here</<>
												</p>
											</div>
											<div class="d-grid">
												<a class="btn my-4 shadow-sm btn-light"
													href="<?php echo e(route('google.redirect')); ?>"> <span
														class="d-flex justify-content-center align-items-center">
														<img class="me-2" src="assets/images/icons/search.svg" width="16"
															alt="Image Description">
														<span>Sign Up with Google</span>
													</span>
												</a>
											</div>
											<div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH
													EMAIL</span>
												<hr />
											</div>
											<div class="form-body">
												<form class="row g-3" id="registerForm" method="post"
													action="<?php echo e(route('customer-register')); ?>" enctype="multipart/form-data">
													<?php echo csrf_field(); ?>

													<div class="col-sm-6">
														<label for="inputFirstName" class="form-label">First Name</label>
														<input type="text" name="first_name" class="form-control"
															id="inputFirstName" placeholder="Jhon" required>
													</div>
													<div class="col-sm-6">
														<label for="inputLastName" class="form-label">Last Name</label>
														<input type="text" name="last_name" class="form-control"
															id="inputLastName" placeholder="Deo" required>
													</div>
													<div class="col-12">
														<label for="inputEmailAddress" class="form-label">Email
															Address</label>
														<input type="email" name="email" class="form-control"
															id="inputEmailAddress" placeholder="example@user.com" required>
														<span id="email_feedback" style="display:none; color:red;">Email
															already exists</span>
													</div>
													<div class="col-12">
														<label for="inputMobile" class="form-label">Mobile</label>
														<input type="tel" onkeypress="return isNumber(event)"
															autocomplete="off" class="form-control" name="mobile"
															minlength="10" maxlength="10" placeholder="Moblie number"
															id="inputMobile" required>
													</div>
													<div class="col-12">
														<label for="inputChoosePassword" class="form-label">Password</label>
														<div class="input-group" id="show_hide_password">
															<input type="password" name="password"
																class="form-control border-end-0" id="inputChoosePassword"
																placeholder="Enter Password" required> <a
																href="javascript:;"
																class="input-group-text bg-transparent"><i
																	class='bx bx-hide'></i></a>
														</div>
													</div>
													<div class="col-12">
														<label for="inputSelectCountry" class="form-label">Country</label>
														<select class="form-select" name="country" id="inputSelectCountry"
															aria-label="Default select example" required>
															<option>Select Country</option>
															<?php $countries = countrylist(); ?>
															<?php if(isset($countries) && count($countries) > 0): ?>
																<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

																	<option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															<?php endif; ?>
														</select>
													</div>
													<div class="col-12">
														<div class="form-check form-switch">
															<input class="form-check-input" type="checkbox"
																id="flexSwitchCheckChecked" required>
															<label class="form-check-label" for="flexSwitchCheckChecked">I
																read and agree to Terms & Conditions</label>
														</div>
													</div>
													<div class="col-12">
														<div class="d-grid">
															<button type="submit" class="btn btn-light"><i
																	class='bx bx-user'></i>Sign up</button>
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
<?php $__env->startPush('after-scripts'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="
		https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
		"></script>
	<link href="
		https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css
		" rel="stylesheet">

	<script>
		function getUrlParameter(name) {
			name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
			var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
			var results = regex.exec(location.search);
			return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
		}
		$(document).ready(function () {
			$('#inputEmailAddress').on('input change', function () {
				checkEmailExists();
			});

		});
		function checkEmailExists() {
			var email = $('#inputEmailAddress').val();
			var emailFeedback = $('#email_feedback');

			// Simple email validation regex
			var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

			if (emailPattern.test(email)) {
				$.ajax({
					url: '<?php echo e(route("check-email")); ?>',
					method: 'POST',
					data: {
						email: email,
						_token: '<?php echo e(csrf_token()); ?>'
					},
					success: function (data) {
						if (data.exists) {
							emailFeedback.text('Email already exists').show();
							$('#inputEmailAddress').removeClass('is-valid').addClass('is-invalid');
						} else {
							emailFeedback.hide();
							$('#inputEmailAddress').removeClass('is-invalid').addClass('is-valid');
						}
					}
				});
			} else {
				emailFeedback.text('Invalid email address').show();
				$('#inputEmailAddress').removeClass('is-valid').addClass('is-invalid');
			}
		}


		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}

	</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/authentication-signup.blade.php ENDPATH**/ ?>