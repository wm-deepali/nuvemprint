

<?php $__env->startSection('title'); ?>
    Nuvem Prints -Sign Up
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        /* .container {
          max-width: 1200px;
          margin: auto;
        } */

        .main-content {
            display: flex;
            gap: 1.5rem;
        }

        .left,
        .right {
            background-color: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .left {
            flex: 2;
        }

        .right {
            flex: 1;
        }

        h3 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .input-row {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .option-buttons button {
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            background-color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        .option-buttons button.active {
            border: 2px solid #f42b5b;
        }

        .image-preview {
            background-color: #f0f0f0;
            height: 100px;
            width: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #666;
        }

        .thumbnail-list {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .thumbnail-list img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 2px solid transparent;
        }

        .thumbnail-list img.selected {
            border-color: #f42b5b;
        }

        .slider-container {
            margin-top: 1rem;
        }

        input[type=range] {
            width: 100%;
        }

        .slider-values {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .delivery-box {
            border: 2px solid #f42b5b;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #2e3c4d;
            color: white;
        }

        .delivery-box .best-value {
            color: gold;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }

        .design-options {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
        }

        .design-box {
            border: 1px solid #ccc;
            padding: 0.5rem;
            text-align: center;
            border-radius: 6px;
            flex: 1;
        }

        .btn-yellow {
            background-color: #ffcf00;
            border: none;
            padding: 0.75rem 1rem;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
            border-radius: 6px;
            margin: 1rem 0;
        }

        .additional-links {
            font-size: 0.9rem;
            color: #555;
        }

        .additional-links a {
            color: #333;
            text-decoration: none;
        }

        .tab-container {
            margin-top: 1.5rem;
            background-color: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .tab-buttons {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .tab-buttons button {
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            background-color: #f5f7fa;
            cursor: pointer;
            border-radius: 4px;
            font-weight: 500;
        }

        .tab-buttons button.active {
            background-color: #f42b5b;
            color: white;
            border-color: #f42b5b;
        }

        .tab-content {
            display: none;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .tab-content.active {
            display: block;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!--start page wrapper -->
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
                                <div class="col-lg-4">
                                    <div class="card shadow-none mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="list-group list-group-flush"> <a href=""
                                                    class="list-group-item active d-flex justify-content-between align-items-center">Dashboard
                                                    <i class='bx bx-tachometer fs-5'></i></a>
                                                <a href="account-orders.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Orders
                                                    <i class='bx bx-cart-alt fs-5'></i></a>
                                                <a href="account-downloads.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Downloads
                                                    <i class='bx bx-download fs-5'></i></a>
                                                <a href="account-addresses.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Addresses
                                                    <i class='bx bx-home-smile fs-5'></i></a>
                                                <a href="account-payment-methods.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Payment
                                                    Methods <i class='bx bx-credit-card fs-5'></i></a>
                                                <a href="account-user-details.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Account
                                                    Details <i class='bx bx-user-circle fs-5'></i></a>
                                                <a href="<?php echo e(route('account-logout')); ?>"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                                    Logout
                                                    <i class='bx bx-log-out fs-5'></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card shadow-none mb-0">
                                        <div class="card-body">
                                            <p>Hello <strong>Madison Ruiz</strong> (not <strong>Madison Ruiz?</strong> <a
                                                    href="javascript:;">Logout</a>)</p>
                                            <p>From your account dashboard you can view your Recent Orders, manage your
                                                shipping and billing addesses and edit your password and account details</p>
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
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/dashboard.blade.php ENDPATH**/ ?>