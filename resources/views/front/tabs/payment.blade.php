<h4 class="mb-3">💳 Payment Section</h4>

<div class="card shadow-sm border-0 mb-4" style="border-radius: 10px;">
    <div class="card-body" style="background: #fffaf5; border-radius: 10px;">
        <h5 class="mb-3 text-primary"><i class="fa-solid fa-file-contract me-2"></i>Terms & Conditions</h5>

        <ul class="mb-3" style="list-style-type: disc; padding-left: 20px; color: #555; line-height: 1.6;">
            <li>All payments are processed securely through Stripe.</li>
            <li>Once payment is completed, you will receive an email confirmation with your order details.</li>
            <li>Orders marked as <strong>Pay Later</strong> must be paid within 7 business days to avoid cancellation.</li>
            <li>All uploaded files remain confidential and will be used solely for print production.</li>
            <li>By proceeding, you agree to our <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a>.</li>
        </ul>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="agreeTerms">
            <label class="form-check-label" for="agreeTerms">
                I have read and agree to the Terms & Conditions.
            </label>
        </div>
    </div>
</div>

<div class="text-end">
    <!-- Pay Now button -->
    <a href="#" class="btn btn-success btn-lg me-2" id="payNowBtn" style="border-radius: 8px; padding: 10px 25px;">
        <i class="fa-solid fa-credit-card me-1"></i> Pay Now
    </a>

    <!-- Pay Later button -->
    <button id="payLaterBtn" class="btn btn-outline-secondary btn-lg" style="border-radius: 8px; padding: 10px 25px;">
        <i class="fa-regular fa-clock me-1"></i> Pay Later
    </button>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    $(document).ready(function () {
        // ✅ Check terms agreement
        function isAgreed() {
            if (!$('#agreeTerms').is(':checked')) {
                Swal.fire('Please Confirm', 'You must agree to the Terms & Conditions before proceeding.', 'warning');
                return false;
            }
            return true;
        }

        // ✅ Pay Later
        $('#payLaterBtn').on('click', function (e) {
            e.preventDefault();

            if (!isAgreed()) return;

            $.ajax({
                url: '/cart/pay-later',
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                beforeSend: function () {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Saving your Pay Later request.',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function (response) {
                    Swal.close();
                    window.location.href = '/thank-you?quote_id=' + response.quote_id;
                },
                error: function (xhr) {
                    Swal.fire('Error', xhr.responseJSON?.error ?? 'Something went wrong', 'error');
                }
            });
        });

        // 💳 Pay Now using Stripe Checkout
        $('#payNowBtn').on('click', function (e) {
            e.preventDefault();

            if (!isAgreed()) return;

            $.ajax({
                url: '/cart/pay-now',
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                beforeSend: function () {
                    Swal.fire({
                        title: 'Redirecting to Stripe...',
                        text: 'Please wait while we start your secure payment.',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function (response) {
                    Swal.close();
                    if (response.url) {
                        window.location.href = response.url; // Redirect to Stripe
                    } else {
                        Swal.fire('Error', 'Invalid Stripe URL returned.', 'error');
                    }
                },
                error: function (xhr) {
                    Swal.close();
                    Swal.fire('Error', xhr.responseJSON?.error ?? 'Payment initialization failed.', 'error');
                }
            });
        });
    });
</script>
