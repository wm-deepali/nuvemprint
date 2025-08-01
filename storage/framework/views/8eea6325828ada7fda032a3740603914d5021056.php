

<?php $__env->startSection('content'); ?>
    <div class="app-content content mb-3">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card p-4 shadow-sm" style="max-width: 900px; margin: auto; background: #fff;">

                    
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="mb-0" style="font-weight:700;">INVOICE</h2>
                            <small class="text-muted"
                                style="font-weight:600;">#<?php echo e($invoice->invoice_number ?? 'N/A'); ?></small>
                        </div>
                        <div>
                            <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="Logo" style="height: 30px;">
                        </div>
                    </div>

                    
                    <div class="row border-top border-bottom   mb-4" style="font-size: 14px;">
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">Info</strong>
                            <hr>
                            <p class="" style="margin-bottom:6px;"><strong>Invoice Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y')); ?></p>
                            <p style="margin-bottom:6px;"> <strong>Order Id: </strong>
                                #<?php echo e($quote->order_number); ?></p>
                            <p style="margin-bottom:6px;"> <strong>Payment Status: </strong>
                                <?php echo e($payments->sum('amount_received') >= $quote->grand_total ? 'Paid' : 'Unpaid'); ?></p>
                            <p style="margin-bottom:6px;"> <strong>Payment Method: </strong>
                                <?php echo e($payments->last()->payment_method ?? 'N/A'); ?></p>
                            <p style="margin-bottom:6px;"> <strong>Payment Date:
                                </strong><?php echo e(\Carbon\Carbon::parse($payments->last()->payment_date)->format('d M, Y') ?? 'N/A'); ?>

                            </p>

                        </div>
                        <div class="col-md-4 border-left border-right p-2">
                            <strong class="mb-1">Billed to</strong>
                            <hr>
                            <p class="" style="margin-bottom:6px;font-weight:600;">
                                <?php echo e($customer->first_name ?? '-'); ?>

                                <?php echo e($customer->last_name ?? ''); ?>

                            </p>
                            <p class="" style="margin-bottom:6px;"><?php echo e($quote->billingAddress->address); ?></p>

                            <p style="margin-bottom:4px; "><?php echo e($customer->mobile ?? ''); ?></p>
                            <p class="text-blue" style="margin-bottom:6px; color:blue;"><?php echo e($customer->email ?? ''); ?></p>
                        </div>
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">From</strong>
                            <hr>

                            <p class="" style="margin-bottom:6px;font-weight:600;">Nuvem Print</p>
                            <p class="" style="margin-bottom:6px; ">Unit 7 Lotherton Way Garforth Leeds LS252JY</p>

                            <!--<p class="mb-1">www.company.com</p>-->
                            <p style="margin-bottom:4px; "> 01132 874724</p>
                            <p class=" text-blue" style="color:blue;">andy@nuvemprint.com</p>
                        </div>
                    </div>

                    
                    <h5 class="mb-2">Item Summary</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 14px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Rate (£)</th>
                                    <th>Total (£)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $quote->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                           <?php echo e($item->subcategory->name ?? 'N/A'); ?> (<?php echo e(optional($item->subcategory->categories->first())->name ?? 'N/A'); ?>)
                                            <br>
                                            <!-- <small class="text-muted"><?php echo e($item->note ?? ''); ?></small> -->
                                        </td>
                                        <td><?php echo e($item->quantity); ?></td>
                                        <td> <?php echo e($item->quantity > 0 ? number_format($item->sub_total / $item->quantity, 2) : '0.00'); ?></td>
                                        <td><?php echo e(number_format($item->sub_total, 2)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->items->sum('sub_total') + ($quote->proof_price ?? 0), 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->delivery_price, 2)); ?></td>
                                </tr>
                                 <tr>
                                    <th>Proof Reading:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->proof_price, 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>VAT (<?php echo e($quote->vat_percentage); ?>)%:</th>
                                    <td class="text-right">£<?php echo e(number_format($quote->vat_amount, 2)); ?></td>
                                </tr>
                                <tr class="border-top">
                                    <th><strong>Total:</strong></th>
                                    <td class="text-right"><strong>£<?php echo e(number_format($quote->grand_total, 2)); ?></strong></td>
                                </tr>
                                <?php
                                $amountDue = $quote->grand_total - $payments->sum('amount_received');
                                ?>
                                <tr class="font-weight-bold "
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th><strong>Amount due:</strong></th>
                                    <td class="text-right"><strong>£<?php echo e(number_format($amountDue, 2)); ?></strong></td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="<?php echo e(route('admin.invoices.download', $quote->id)); ?>" class="btn btn-outline-primary btn-block">
                                Download Invoice
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success btn-block">Send via Email</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/quotes/view-invoice.blade.php ENDPATH**/ ?>