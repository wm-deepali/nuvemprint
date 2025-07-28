
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php $__env->startSection('title'); ?>
    Nuvem Prints
<?php $__env->stopSection(); ?>
<link href="assets/css/app.css" rel="stylesheet">
<?php $__env->startPush('after-styles'); ?>
    <style>
        .dropdown-menu {
            -webkit-box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
            border: 0 solid #e9ecef !important;
            font-size: 14px !important;
            margin: 8px 0 0 !important;
            border-radius: 0px !important;
            background-color: rgb(30 30 30 / 90%) !important;
        }

        .dropdown-toggle::after {
            display: none !important;
        }

        .primary-menu .navbar .dropdown-large-menu ul li {
            background: black;
        }

        .list-group-item.active {
            background-color: #656565 !important;
            border-color: #656565 !important;
        }

        .nav-item a {
            color: gray !important;
        }

        .page-wrapper {
            height: auto;
        }

        .cart-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .quote-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .section-title {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .img-thumb {
            width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .upgrade-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
        }

        .btn-custom {
            background-color: #00aaa5;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #008f89;
        }

        .total-row {
            font-weight: bold;
            font-size: 18px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .btn-info {
            border: none;
            padding: 4px 7px;
            border-radius: 3px;
            background-color: rgba(128, 128, 128, 0.158);
        }

        .continue-class {
            width: 100%;
            border: none;
            height: 35px;
            border-radius: 3px;
            background-color: #f42b5b !important;
            color: #fff;
            margin-bottom: 20px;
        }

        .start-new {
            width: 100%;
            border: none;
            height: 35px;
            border-radius: 3px;
            background-color: #e9e7e8 !important;
            color: #525252;
        }

        .custom-stepper-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 40px 0;
            gap: 40px;
        }

        .custom-stepper-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-size: 14px;
            color: #666;
            text-decoration: none;
            position: relative;
        }

        .custom-stepper-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            color: white;
            font-weight: bold;
        }

        .custom-stepper-step.active .custom-stepper-circle {
            background: #00aaa5;
        }

        .custom-stepper-step.completed .custom-stepper-circle {
            background: #00aaa5;
        }

        .custom-stepper-step.completed .custom-stepper-circle::before {
            content: "✓";
        }

        .custom-stepper-step.completed .custom-stepper-circle span,
        .custom-stepper-step.active .custom-stepper-circle span {
            display: none;
        }

        .custom-stepper-step.active,
        .custom-stepper-step.completed {
            color: #00aaa5;
        }

        .custom-stepper-step:not(:last-child)::after {
            content: "";
            position: absolute;
            width: 40px;
            height: 2px;
            background: #ccc;
            top: 14px;
            left: calc(100% + 5px);
            z-index: -1;
        }

        .custom-stepper-step.completed::after,
        .custom-stepper-step.active::after {
            background: #00aaa5;
        }
    </style>
    <style>
        .custom-op {
            border: 2px solid #6bd3cc !important;
            color: black !important;
            border-radius: .375rem !important;
        }

        input::placeholder {
            color: #000 !important;
            opacity: 1 !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container">
                <div class="custom-stepper-wrapper" id="customStepper">

                    <!-- STEP TEMPLATE -->
                    <a href="shop-cart.html" class="custom-stepper-step" data-path="shop-cart.html">
                        <div class="custom-stepper-circle"><span>1</span></div>
                        <div>Cart</div>
                    </a>

                    <a href="/checkout" class="custom-stepper-step" data-path="/checkout">
                        <div class="custom-stepper-circle"><span>2</span></div>
                        <div>Checkout</div>
                    </a>

                    <a href="/payment" class="custom-stepper-step" data-path="/payment">
                        <div class="custom-stepper-circle"><span>3</span></div>
                        <div>Payment</div>
                    </a>

                    <a href="/confirm" class="custom-stepper-step" data-path="/confirm">
                        <div class="custom-stepper-circle"><span>4</span></div>
                        <div>Confirm</div>
                    </a>

                    <a href="/printing" class="custom-stepper-step" data-path="/printing">
                        <div class="custom-stepper-circle"><span>5</span></div>
                        <div>Printing</div>
                    </a>

                    <a href="/shipped" class="custom-stepper-step" data-path="/shipped">
                        <div class="custom-stepper-circle"><span>6</span></div>
                        <div>Shipped</div>
                    </a>

                </div>
            </div>

            <!--start breadcrumb-->
            <section class="py-3 border-bottom d-none d-md-flex" style="background: #f1f2f7;
          padding: 40px 0;">
                <!--end shop cart-->
                <div class="container" style="max-width: 900px;">
                    <div class="row g-4">
                        <!-- Left Section -->
                        <div class="col-md-7">
                            <div class="cart-box">
                                <!-- <div class="section-title">Shopping Cart</div> -->
                                <div class="d-flex justify-content-between mb-3">
                                    <p><strong>Shipping:</strong> Monday, 21st July 2025</p>
                                    <h5><strong>Subtotal:</strong> £15.00 </h5>
                                </div>

                                <div class="d-flex align-items-start mb-3">
                                    <img src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/price-calculator/boundSubstrateTypeId/thumbnails/3.png"
                                        class="img-thumb me-3 " alt="Product Image">
                                    <div class="col-9">
                                        <p class="mb-1"><strong>500 Art Prints</strong></p>
                                        <p class="mb-1">Size: A5 (148 mm x 210 mm)</p>
                                        <p class="mb-1">Full-colour printing (outside), 130gsm Silk</p>
                                        <a href="#">Want Multiple Delivery Addresses?</a>
                                        <div class="d-flex justify-content-between mb-3 mt-3 ">
                                            <!-- <span>Subtotal:</span>
              <span>£15.00 <br><span>VAT: £3.00</span></span> -->


                                        </div>
                                    </div>

                                </div>


                                <hr />
                                <div class="d-flex gap-2 mb-4" style=" flex-direction: row-reverse;">

                                    <button class="btn-info trash "><i class="fa-solid fa-trash"></i></button>
                                    <button class="btn-info "><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                    <!--<button class="btn-info "><i class="fa-solid fa-copy"></i> Duplicate</button>-->
                                </div>

                                <div class="upgrade-box mb-3">
                                    <p class="mb-2">Upgrade to 1,000 copies for just £13.00 extra and save £0.00 on each
                                        copy</p>
                                    <button class="btn btn-custom btn-sm">Get Deal</button>
                                </div>

                                <!--<p>Enter your Postcode to get delivery rates</p>-->
                                <p><strong>Delivery Weight:</strong> 2.00 kg</p>
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="col-md-5">
                            <div class="quote-box">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Quote Number:<strong> #4545666</strong></h5>

                                </div>

                                <!--<p class="mb-1"><small>Quote Reference: 1667893</small></p>-->

                                <div class="d-flex justify-content-between">
                                    <span><strong>Art Prints x 500 Copies</strong></span>
                                    <span>£15.00</span>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Delivery Cost</span>
                                    <span>£0.00</span>
                                </div>

                                <hr>

                                <p><strong>Total Weight:</strong> 2.00 kg</p>

                                <div class="mb42">
                                    <label class="form-label" style="font-size:16px; font-weight:600;">Calculate Shipping &
                                        Delivery:</label>
                                    <select class="form-select custom-op">
                                        <option>United Kingdom</option>
                                    </select>
                                </div>

                                <div class="input-group mb-2 " style="margin-top:30px;">
                                    <input type="text" class="form-control" placeholder="Enter Postcode">
                                    <button class="btn btn-custom">Apply</button>
                                </div>


                                <!--<div class="form-check form-switch mb-3">-->
                                <!--  <input class="form-check-input" type="checkbox" id="plainPackage">-->
                                <!--  <label class="form-check-label" for="plainPackage">Use Plain Packaging</label>-->
                                <!--</div>-->

                                <!--<div class="input-group mb-3">-->
                                <!--  <input type="text" class="form-control" placeholder="Enter discount code if you have one">-->
                                <!--  <button class="btn btn-custom">Apply</button>-->
                                <!--</div>-->
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Subtotal:</span>
                                    <span>£15.00</span>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Total Delivery Cost:</span>
                                    <span>£0.00</span>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>VAT:</span>
                                    <span>£3.00</span>
                                </div>

                                <div class="d-flex justify-content-between  mt-2">
                                    <span><strong>Grand Total</strong></span>
                                    <span><strong>£18.00</strong></span>
                                </div>
                                <hr>
                                <button class="continue-class">Continue</button>
                                <button class="start-new">Start New Qoute</button>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<script>
    document.querySelector('.continue-class')?.addEventListener('click', function () {
        const route = this.dataset.route;
        if (route) {
            window.location.href = route;
        }
    });

    const currentPath = window.location.pathname;
    const steps = document.querySelectorAll('.custom-stepper-step');

    let activeIndex = -1;

    steps.forEach((step, index) => {
        if (step.dataset.path === currentPath) {
            activeIndex = index;
        }
    });

    steps.forEach((step, index) => {
        if (index < activeIndex) {
            step.classList.add('completed');
        } else if (index === activeIndex) {
            step.classList.add('active');
        }
    });
</script>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/shop-cart.blade.php ENDPATH**/ ?>