

<?php $__env->startSection('title'); ?>
    Nuvem Prints - About Us
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .btn-login-page {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            letter-spacing: .5px;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: #eff7f7 !important;
            padding: .375rem .75rem;
            font-size: 1rem;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-control {
            border: 2px solid #e0e0e0 !important;
            color: black !important;
            border-radius: .375rem !important;
        }

        .custom-select {
            border: 2px solid #e0e0e0 !important;
            color: black !important;
            border-radius: .375rem !important;
        }

        .page-content {
            min-height: calc(100vh - 100px);
            padding-bottom: 80px;
            /* Prevent overlap with footer */
        }
    </style>
    <style>
        .form-check-input:checked {
            background-color: #ff4880;
            border-color: #ff4880;
        }

        .form-check-input:focus {
            border-color: #ff488026;
            outline: 0;
            box-shadow: 0 0 0 .15rem #ff488026;
        }

        .custom-switch .form-check-input {
            width: 50px;
            height: 26px;
            background-color: #ccc;
            border-radius: 50px;
            position: relative;
            border: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
            outline: none;
            box-shadow: none;
        }

        .custom-switch .form-check-input:checked {
            background-color: #28a745 !important;
            /* Green when checked */
        }

        .custom-switch .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            /* Green glow on focus */
        }

        .custom-switch .form-check-input::before {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .custom-switch .form-check-input:checked::before {
            transform: translateX(24px);
            /* Slide toggle dot */
        }

        .custom-switch .form-check-label {
            margin-left: 10px;
            vertical-align: middle;
        }

        input::placeholder,
        textarea::placeholder {
            color: #b0b0b0;
            opacity: 1;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-valid {
            border-color: #28a745 !important;
        }

        .text-danger {
            font-size: 0.875em;
        }
    </style>


    <div class="page-wrapper">
        <div class="page-content">
            <!-- Breadcrumb -->
            <section class="py-3  d-none d-md-flex" style="border-bottom:1px solid #80808045">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Sign Up</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><i class="bx bx-home-alt"></i>
                                            Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Flash Messages -->
            <?php if(session('success')): ?>
                <h5 class="alert alert-success text-center"><?php echo e(session('success')); ?></h5><br>
                <?php    Session::forget('success'); ?>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <h5 class="alert alert-danger text-center"><?php echo e(session('error')); ?></h5><br>
                <?php    Session::forget('error'); ?>
            <?php endif; ?>

            <!-- Validation Errors -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Sign-Up Section -->
            <section class="py-0 py-lg-5 " style="margin-top:80px;">
                <div class="container">
                    <div
                        class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0 mb-5">
                        <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                            <div class="col mx-auto">
                                <div class="card mb-0">
                                    <div class="card-body" style="background:#ebebeb30;">
                                        <div class="border p-4 rounded">
                                            <div class="text-center">
                                                <h3 class="">Sign Up</h3>
                                                <p>
                                                    Already have an account?
                                                    <a href="<?php echo e(route('authentication-signin', ['redirect' => request('redirect')])); ?>"
                                                        style="color:#ff4880; margin-left:6px;">
                                                        Sign in here
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="d-grid">
                                                <a class="btn-login-page my-2 " href="<?php echo e(route('google.redirect')); ?>">
                                                    <span class="d-flex justify-content-center align-items-center">
                                                        <img class="me-2" src="assets/images/icons/search.svg" width="16"
                                                            alt="Image Description">
                                                        <span>Sign Up with Google</span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class=" text-center " style="margin-bottom:25px;"> <span>OR</span>

                                            </div>
                                            <hr>
                                            <div class="form-body">
                                                <form class="row g-3" id="registerForm" method="post"
                                                    action="<?php echo e(route('customer-register')); ?>" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="redirect" value="<?php echo e(request('redirect')); ?>">

                                                    <div class="col-sm-6">
                                                        <label for="inputFirstName" class="form-label">First Name</label>
                                                        <input type="text" name="first_name"
                                                            class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            id="inputFirstName" value="<?php echo e(old('first_name')); ?>"
                                                            placeholder="John" required>
                                                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="inputLastName" class="form-label">Last Name</label>
                                                        <input type="text" name="last_name"
                                                            class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            id="inputLastName" value="<?php echo e(old('last_name')); ?>"
                                                            placeholder="Doe" required>
                                                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputEmailAddress" class="form-label">Email
                                                            Address</label>
                                                        <input type="email" name="email"
                                                            class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            id="inputEmailAddress" value="<?php echo e(old('email')); ?>"
                                                            placeholder="example@user.com" required>
                                                        <span id="email_feedback" style="display:none; color:red;">Email
                                                            already exists</span>
                                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputMobile" class="form-label">Mobile</label>
                                                        <input type="tel" onkeypress="return isNumber(event)"
                                                            autocomplete="off"
                                                            class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            name="mobile" minlength="10" maxlength="10"
                                                            placeholder="Mobile number" id="inputMobile"
                                                            value="<?php echo e(old('mobile')); ?>" required>
                                                        <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <!--<div class="col-12">-->
                                                    <!--    <label for="inputChoosePassword" class="form-label">Password</label>-->
                                                    <!--    <div class="input-group" id="show_hide_password">-->
                                                    <!--        <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password" required>-->
                                                    <!--        <a href="javascript:;" class="input-group-text "><i class="fa-solid fa-eye"></i></a>-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                    <div class="col-12">
                                                        <label for="inputChoosePassword" class="form-label">Enter
                                                            Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" name="password"
                                                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                id="inputChoosePassword" placeholder="Enter Password"
                                                                required>
                                                            <i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                                                id="togglePassword"></i>
                                                        </div>
                                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputSelectCountry" class="form-label">Country</label>
                                                        <select class="form-select <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            name="country" id="inputSelectCountry" required>
                                                            <option value="">Select Country</option>
                                                            <?php $countries = countrylist(); ?>
                                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($country->id); ?>" <?php echo e(old('country') == $country->id ? 'selected' : ''); ?>><?php echo e($country->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                                            <button type="submit" class="btn btn-products"><i
                                                                    class='bx bx-user'></i> Sign up</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div> <!-- form-body -->
                                        </div> <!-- border box -->
                                    </div> <!-- card-body -->
                                </div> <!-- card -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- section-authentication-signin -->
                </div> <!-- container -->
            </section>
            <!--end section-->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector("#togglePassword");
            const passwordInput = document.querySelector("#inputChoosePassword");

            togglePassword.addEventListener("click", function () {
                // toggle type attribute
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);

                // toggle eye / eye-slash icon
                this.classList.toggle("fa-eye");
                this.classList.toggle("fa-eye-slash");
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

    <script>
        $(document).ready(function () {
            $('#inputEmailAddress').on('input change', function () {
                checkEmailExists();
            });
        });

        function checkEmailExists() {
            var email = $('#inputEmailAddress').val();
            var emailFeedback = $('#email_feedback');
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
            return !(charCode > 31 && (charCode < 48 || charCode > 57));
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/front/authentication-signup.blade.php ENDPATH**/ ?>