<div id="loginPrompt" style="display: none; max-width: 100%; margin: 15px auto; padding: 12px 16px; text-align: center; background: #f1f1f1; border: 1px solid #ccc; border-radius: 6px; font-family: 'Segoe UI', sans-serif;">
    <p style="margin: 0; font-size: 14px; color: #444;">
        Please <a href="<?php echo e(route('authentication-signin')); ?>" style="color: #007bff; font-weight: 500; text-decoration: none;">sign in</a>
        or <a href="<?php echo e(route('authentication-signup')); ?>" style="color: #007bff; font-weight: 500; text-decoration: none;">create an account</a> to continue.
    </p>
</div>


<div class="tabone-section">
    <div>
        <div class="custom-art-tab-section-left">
         <div class="custom-art-tab-cont">
            <h6><?php echo e($subcategory_name ?? ''); ?></h6>
            <button class="custom-art-edit-btn">✎ Edit</button>
         </div>
         <div class="custom-art-card">
            <div class="custom-art-item-label">Item 1</div>
            <div class="custom-art-field">
               <label>Copies</label>
               <input
                  type="number"
                  value="<?php echo e($items['quantity'] ?? ''); ?>"
                  class="custom-art-input-box"
               />
            </div>
            <!-- <?php $paperSizeValue = collect($attributes_resolved)->firstWhere('attribute_name', 'Paper Size')['value_name'] ?? '';
                                 ?> -->
            <div class="custom-art-field">
               <label>Size</label>
               <input
                  type="text"
                  value="<?php echo e($paperSizeValue); ?>"
                  class="custom-art-input-box"
                  readonly
               />
            </div>
            <?php 
            $paperWeightValue = collect($attributes_resolved)->firstWhere('attribute_name', 'Paper Weight')['value_name'] ?? ''; 
            $paperTypeValue = collect($attributes_resolved)->firstWhere('attribute_name', 'Paper Type')['value_name'] ?? ''; ?>
            <div class="custom-art-field custom-art-gsm-options">
               <label><?php echo e($paperWeightValue); ?><span class="custom-art-subtext">paper - <?php echo e($paperTypeValue); ?></span></label>
               <div class="custom-art-side-options">
                  <button class="custom-art-side active">Front</button>
                  <button class="custom-art-side">Back</button>
               </div>
            </div>
            <button class="custom-art-change-options">🔧 Change Options</button>
            <div class="custom-art-vat-row">
               <input type="checkbox" checked />
               <label>Add VAT (if applicable)</label>
               <button class="custom-art-info-btn">Info</button>
            </div>
            <a href="#" class="custom-art-view-quote">📄 View this quote</a>
         </div>
      </div>
    </div>
    <div class="tab-section-right">
        <div class="custom-address-container">
            <div class="custom-address-title">Billing Address</div>
            <form id="detailsForm" enctype="multipart/form-data">

                <div class="custom-address-field">
                    <label>Email *</label>
                    <input name="billing_email" type="text" placeholder="Email" id="email">
                </div>
                <div class="custom-address-field">
                    <label>Name *</label>
                    <div class="d-flex justify-content-between">
                        <input type="text" name="billing_first_name" placeholder="Firstname" class="first_name"
                            style="width: 48%; display: inline-block; margin-right: 4%;">
                        <input type="text" name="billing_last_name" placeholder="Surname" class="last_name"
                            style="width: 48%; display: inline-block;">
                    </div>
                </div>
                <div class="custom-address-field">
                    <label>Phone *</label>
                    <input name="billing_mobile" type="text" placeholder="Phone" class="mobile">
                </div>

                <div class="custom-address-field">
                    <label>Country</label>
                    <select class="form-select" name="billing_country" id="inputSelectCountry"
                        aria-label="Default select example" required>
                        <option value="">Select Country</option>
                        <?php $countries = countrylist(); ?>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>


                </div>
                <div class="custom-address-field">
                    <label>Address</label>
                    <input type="text" name="billing_address" placeholder="Start typing address">
                </div>
                <div class="custom-address-title">Delivery Address</div>
                <!-- Delivery Instructions -->
                <div class="custom-address-field">
                    <label>Delivery Instructions</label>
                    <input type="text" name="delivery_instructions" placeholder="Enter instructions">
                </div>

                <!-- Plain Packaging Checkbox -->
                <div class="custom-address-field custom-checkbox d-flex">
                    <input type="checkbox" name="plain_packaging" id="plainPackaging" value="1" style="width: 18px;">
                    <label for="plainPackaging" style="margin-top: 6px;">Use plain
                        packaging</label>
                </div>

                <!-- Same as Billing Address Checkbox -->
                <div class="custom-address-field custom-checkbox d-flex">
                    <input type="checkbox" name="same_as_billing" id="sameBilling" value="1" style="width: 18px;">
                    <label for="sameBilling" style="margin-top: 6px;">Same as billing
                        address</label>
                </div>

                <div class="custom-address-field">
                    <label>Name *</label>
                    <div class="d-flex justify-content-between">
                        <input name="delivery_first_name" type="text" placeholder="Firstname" class="first_name"
                            style="width: 48%; display: inline-block; margin-right: 4%;">
                        <input type="text" name="delivery_last_name" placeholder="Surname" class="last_name"
                            style="width: 48%; display: inline-block;">
                    </div>
                </div>
                <div class="custom-address-field">
                    <label>Phone *</label>
                    <input type="text" name="delivery_mobile" placeholder="Phone" class="mobile">
                </div>
                <div class="custom-address-field">
                    <label>Country</label>
                    <select class="form-select" name="delivery_country" id="inputSelectCountry"
                        aria-label="Default select example" required>
                        <option value="">Select Country</option>
                        <?php $countries = countrylist(); ?>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($country->id); ?>" <?php echo e((isset($delivery['title']) && $delivery['title'] == $country->name) ? 'selected' : ''); ?>>
                                <?php echo e($country->name); ?>

                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="custom-address-field">
                    <label>Address</label>
                    <input type="text" name="delivery_address" placeholder="Start typing address">
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-primary" id="nextToPaymentBtn">
                        Next <i class="fa fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('/cart/get-session')
        .then(res => res.json())
        .then(cart => {
            const billing = cart.billing || {};
            const delivery = cart.delivery_address || {};

            let sessionDataFound = false;

            // Fill billing from session
            if (billing.first_name) {
                $('#email').val(billing.email);
                $('input[name="billing_first_name"]').val(billing.first_name);
                $('input[name="billing_last_name"]').val(billing.last_name);
                $('input[name="billing_mobile"]').val(billing.mobile);
                $('select[name="billing_country"]').val(billing.country);
                $('input[name="billing_address"]').val(billing.address);
                sessionDataFound = true;
            }

            // Fill delivery from session
            if (delivery.first_name) {
                $('input[name="delivery_first_name"]').val(delivery.first_name);
                $('input[name="delivery_last_name"]').val(delivery.last_name);
                $('input[name="delivery_mobile"]').val(delivery.mobile);
                $('select[name="delivery_country"]').val(delivery.country);
                $('input[name="delivery_address"]').val(delivery.address);
                $('input[name="delivery_instructions"]').val(delivery.delivery_instructions);

                if (delivery.plain_packaging === '1') {
                    $('#plainPackaging').prop('checked', true);
                }

                if (delivery.same_as_billing === '1') {
                    $('#sameBilling').prop('checked', true).trigger('change');
                }

                sessionDataFound = true;
            }

            // If session data not found, try fetching customer data
            if (!sessionDataFound) {
                fetch('/customer-data')
                    .then(res => res.json())
                    .then(data => {
                        const user = data.user || {};
                        if (user && user.first_name) {
                            $('#email').val(user.email);
                            $('input[name="billing_first_name"]').val(user.first_name);
                            $('input[name="billing_last_name"]').val(user.last_name);
                            $('input[name="billing_mobile"]').val(user.mobile);
                            $('select[name="billing_country"]').val(user.country);

                            $('#addressFormWrapper').show();
                        } else {
                            // Show login/signup if no user data
                            $('#loginPrompt').show();
                        }
                    })
                    .catch(() => {
                        $('#loginPrompt').show();
                    });
            } else {
                $('#addressFormWrapper').show();
            }
        })
        .catch(() => {
            // If session fetch fails, fallback to login prompt
            $('#loginPrompt').show();
        });
});

    // Autofill delivery when "Same as Billing" is checked
    $(document).on('change', '#sameBilling', function () {
        if ($(this).is(':checked')) {
            $('input[name="delivery_first_name"]').val($('input[name="billing_first_name"]').val());
            $('input[name="delivery_last_name"]').val($('input[name="billing_last_name"]').val());
            $('input[name="delivery_mobile"]').val($('input[name="billing_mobile"]').val());
            $('select[name="delivery_country"]').val($('select[name="billing_country"]').val());
            $('input[name="delivery_address"]').val($('input[name="billing_address"]').val());
        } else {
            // Optional: clear delivery fields if unchecked
            $('input[name="delivery_first_name"]').val('');
            $('input[name="delivery_last_name"]').val('');
            $('input[name="delivery_mobile"]').val('');
            $('select[name="delivery_country"]').val('');
            $('input[name="delivery_address"]').val('');
        }
    });

    $(document).ready(function () {
        $('#nextToPaymentBtn').on('click', function () {
            const formData = new FormData($('#detailsForm')[0]);

            $.ajax({
                url: "<?php echo e(route('cart.address-details')); ?>", // Replace with your actual route
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                success: function (response) {
                    // Move to Payment tab
                    // Switch to Payment tab programmatically

                    const paymentTab = document.querySelector('.custom-tab[data-tab="payment"]');
                    paymentTab.classList.remove('disabled');
                    paymentTab.style.pointerEvents = 'auto';
                    paymentTab.style.opacity = '1';
                    document.querySelectorAll('.custom-tab').forEach(tab => tab.classList.remove('active'));
                    document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

                    // Activate the "Payment" tab
                    document.querySelector('.custom-tab[data-tab="payment"]').classList.add('active');
                    document.getElementById('payment').classList.add('active');

                },
                error: function (xhr) {
                    alert('Error saving details. Please try again.');
                }
            });
        });
    });


</script><?php /**PATH D:\web-mingo-project\new\resources\views/front/tabs/details.blade.php ENDPATH**/ ?>