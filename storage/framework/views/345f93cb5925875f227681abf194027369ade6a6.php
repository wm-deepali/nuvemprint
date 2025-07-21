<style>
    body {
        background-color: #f8f9fa !important;
    }

    .reset-card {
        width: 100%;
        height: 70px;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        align-items: center;
    }

    .reset-card button {
        background: none;
        border: none;
        color: red;
        border-bottom: 1px solid red;
        padding-bottom: 4px;
    }

    .calculation-card {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 30px 20px;
    }

    .color-print {
        width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .color-print1 {
        width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 10px;
    }

    .print-color {
        width: 100%;
        height: 38px;
        border-radius: 5px;
        border: 1px solid rgb(185, 185, 185);
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .print-color.active,
    .print-color:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .print-color p {
        margin: 0px;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .form-row-section {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .form-row-section1 {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .s-row {
        width: 100%;
    }

    .size-btn button {
        background: none;
        border: none;
        color: red;
    }

    .paper-type-section {
        width: 100%;
        height: 200px;
        display: flex;
        flex-direction: column;
        gap: 7px;
        border: 1px solid rgb(185, 185, 185);
        padding: 10px;
        border-radius: 7px;
        overflow: hidden;
        overflow-y: scroll;
        padding-right: 8px;
    }

    .paper-type-section button {
        text-align: left;
    }

    .paper-type-section button.active,
    .paper-type-section button:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .paper-type-options::-webkit-scrollbar {
        width: 8px;
    }

    .paper-type-options::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 5px;
    }

    .paper-type-options::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 5px;
    }

    .paper-type-options::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    .paper-type-options {
        scrollbar-color: #007bff #f0f0f0;
        scrollbar-width: thin;
    }

    .choose-binding {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .choose-binding.active {
        background-color: #fff;
        border: 1px solid #80bdff;
        border-radius: 6px;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .choose-binding img {
        width: 100%;
        border: 1px solid gray;
        border-radius: 6px;
        padding: 3px;
    }

    .help-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 1px solid #dbdbdb;
        color: #b7b8b9;
        font-weight: bold;
        font-size: 11px;
        cursor: pointer;
        margin-left: 5px;
    }

    .s-row label {
        font-size: 14px;
        font-weight: 600;
    }

    .form-label {
        font-size: 14px;
        font-weight: 600;
    }

    .page-slider {
        width: 100%;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-slider input[type="range"] {
        -webkit-appearance: none;
        width: 100%;
        height: 10px;
        background: #f0f0f0;
        border-radius: 5px;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .page-slider input[type="range"]:hover {
        opacity: 1;
    }

    .page-slider input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #17a2b8;
        border-radius: 50%;
        cursor: pointer;
    }

    .page-slider input[type="range"]::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #17a2b8;
        border-radius: 50%;
        cursor: pointer;

    }

    .page-slider input[type="range"]::-webkit-slider-runnable-track {
        background: linear-gradient(to right, #007bff 0%, #007bff var(--value, 0%), #f0f0f0 var(--value, 0%), #f0f0f0 100%);
        height: 10px;
        border-radius: 5px;

    }

    .page-slider input[type="range"]::-moz-range-track {
        background: linear-gradient(to right, #007bff 0%, #007bff var(--value, 0%), #f0f0f0 var(--value, 0%), #f0f0f0 100%);
        height: 10px;
        border-radius: 5px;

    }

    .page-slider .range-value {
        margin-top: 5px;
        text-align: center;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .page-slider button {
        background: none;
        border: none;
        color: rgb(0, 0, 0);
        /* border-bottom: 1px solid red; */
        padding-bottom: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .range-value button {
        background-color: rgb(189, 187, 187);
        padding: 5px;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right-side-section {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 20px 20px;
    }

    .estimate-card {
        width: 100%;
        min-height: 15px;
        border: 1px solid gray;
        border-radius: 14px;
        display: flex;
        align-items: center;
        padding: 15px;
        gap: 20px;

    }

    .circle-point {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid gray;
    }

    .estimate-div {
        width: 90%;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .line-y {
        width: 1px;
        height: 50px;
        background-color: gray;
    }

    .line-x {
        width: 100%;
        height: 1px;
        background-color: gray;

    }

    .est-card {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .disci i {
        color: green;
        margin-right: 5px;
    }

    .disci p {
        font-size: 13px;
    }

    .addtobtn button {
        width: 100%;
        background-color: #ffc107;
        color: black;
        font-weight: 600;
        border: none;
        border-radius: 4px;
        height: 40px;
        font-size: 18px;
    }

    .note-dis {
        width: 100%;
        display: flex;
        justify-content: space-between;

    }

    .note-dis p {
        font-size: 12px;
    }

    .extra-card {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 20px 20px;
        display: flex;
        gap: 20px;
    }

    .extra-card-details {
        display: flex;
        flex-direction: column;
        /* justify-content: space-between; */
    }

    .extra-card-details p {
        font-size: 13px;
        margin-top: 5px;
    }

    .page-slider {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Adjust slider height and remove unwanted margins */
    .page-slider input[type="range"] {
        -webkit-appearance: none;
        width: 90%;
        /* adjust as needed */
        height: 6px;
        background: #ccc;
        border-radius: 5px;
        outline: none;
        margin: 0;
        /* prevents misalignment */
        padding: 0;
        vertical-align: middle;
    }

    /* For WebKit browsers (Chrome, Safari) */
    .page-slider input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #2552a5;
        cursor: pointer;
        margin-top: -5px;
        /* Adjust to center thumb vertically */
        position: relative;
    }

    /* For Firefox */
    .page-slider input[type="range"]::-moz-range-thumb {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #000;
        cursor: pointer;
    }

    /* Button styling (optional) */
    .range-value button {
        width: 30px;
        height: 30px;
        border: none;
        background-color: #eee;
        border-radius: 4px;
        font-size: 20px;
        cursor: pointer;

    }

    .zoom-section {
        width: 30px;
        height: 30px;
        background-color: #ffffff;
        position: relative;
        bottom: 0px;
        right: 0px;
        z-index: 100;
        margin-top: -30px;
        float: inline-end;
        border-top-left-radius: 3px;

    }

    .zoom-section1 {
        width: 20px;
        height: 20px;
        background-color: #ffffff;
        position: relative;
        right: -1px;
        right: 3px;
        margin-top: -31px;
        margin-top: -22px;
        float: inline-end;
        border-top-left-radius: 3px;
    }

    .zoomicon {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgb(170, 170, 170);
    }

    .btn-light {
        background-color: #f8f9fa !important;
        color: #212529 !important;
        border-color: #f8f9fa !important;
    }

    .btn-light.active,
    .btn-light:focus,
    .btn-light:hover {
        background-color: #e2e6ea !important;
        /* Slight hover */
        color: #212529 !important;
    }

    .btn-link {
        background-color: transparent !important;
    }
</style>


<div class="row">
    <div class="col-md-7">
        <div class="reset-card">
            <h5>Create Your <?php echo e($subcategory->name ?? "Booklets"); ?></h5>
            <button>Reset</button>
        </div>
        <form>
            <?php if(!empty($attributeGroups) && count($attributeGroups)): ?>
                <?php
                    $mainGroup = collect($attributeGroups)->first(function ($group) {
                        return str_contains(strtolower($group['group_name']), 'main attributes');
                    });
                    $otherGroups = collect($attributeGroups)->reject(function ($group) {
                        return str_contains(strtolower($group['group_name']), 'main attributes');
                    });
                ?>
                <div class="calculation-card mt-3">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quantityInput" class="form-label d-flex align-items-center"
                                style="gap: 5px;">Quantity <span class="help-circle" data-label="Quantity"
                                    data-toggle="modal" data-target="#helpModal">?</span></label>
                            <input type="number" class="form-control" id="quantityInput" placeholder="100" value="100">
                        </div>

                        
                        <?php if(isset($mainGroup['attributes'])): ?>
                            <?php $__currentLoopData = $mainGroup['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('front.attribute-block', ['attribute' => $attribute], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="form-row-section1">
                        <div class="s-row mb-3">
                            <label>Pages <span class="help-circle" data-label="Pages" data-toggle="modal"
                                    data-target="#helpModal">?</span></label>
                            <div class="page-slider">
                                <input type="range" min="32" max="840" value="32" id="pageSlider">
                                <div class="range-value">
                                    <button type="button">-</button>
                                    <span id="pageValue">32</span>
                                    <button type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php $__currentLoopData = $otherGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $groupKey = \Illuminate\Support\Str::slug($group['group_name'], '_');
                        $isToggleable = $group['is_toggleable'] ?? false;
                    ?>

                    <div class="calculation-card mt-3">
                        <?php if($isToggleable): ?>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input group-toggle" type="checkbox" id="toggle_<?php echo e($groupKey); ?>"
                                    data-target="#section_<?php echo e($groupKey); ?>">
                                <label class="form-check-label" for="toggle_<?php echo e($groupKey); ?>"><?php echo e($group['group_name']); ?></label>
                            </div>
                        <?php else: ?>
                            
                            <h5 class="mb-2"><?php echo e($group['group_name']); ?></h5>
                        <?php endif; ?>
                        <div class="mt-3 <?php echo e($isToggleable ? 'd-none' : ''); ?>" id="section_<?php echo e($groupKey); ?>">
                            <div class="row">
                                <?php $__currentLoopData = $group['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('front.attribute-block', ['attribute' => $attribute], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>
        </form>
    </div>
    <div class="col-md-5">
        <div class="right-side-section">
            <h5>Choose Price & Delivery Date</h5>
            <div class="estimate-card" style="background-color: #454f5b ;     border: 3px solid #58b0aa;">
                <div class="circle-point" style=" border: 3px solid #58b0aa; background-color: #fff;"></div>
                <div class="est-card">
                    <div class="estimate-div">
                        <div class="ast-active">
                            <p class="m-0 text-white">Estimated Delivery:</p>
                            <h4 class=" text-white">Thu, 17th Jul</h4>
                        </div>
                        <div class="line-y"></div>
                        <div class="">
                            <h4 class="text-white final-price">£0.00</h4>
                        </div>
                    </div>
                    <div class="line-x"></div>
                    <div class="disci">
                        <p class=" m-0 text-white"><i class="fa-solid fa-check"></i> Printed on a Canon iX </p>
                        <p class=" m-0 text-white"><i class="fa-solid fa-check"></i> High Quality Digital
                            Printing</p>
                        <p class=" m-0 text-white"><i class="fa-solid fa-check"></i> Print-on-Demand from £5.00
                        </p>
                        <p class=" m-0 text-white"><i class="fa-solid fa-check"></i> Flexible Payment Options
                            Available</p>
                    </div>
                </div>
            </div>
            <div class="estimate-card mt-3">
                <div class="circle-point"></div>
                <div class="est-card">
                    <div class="estimate-div">
                        <div>
                            <p class="m-0">Estimated Delivery:</p>
                            <h4>Thu, 17th Jul</h4>
                        </div>
                        <div class="line-y"></div>
                        <div class="">
                            <h4 class="final-price">£0.00</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row-section1 mt-3">
                <div class="s-row mb-3">
                    <label for="binding">Design Option </label>
                    <div class="color-print1">
                        <div class="choose-binding" data-value="Staple">
                            <img
                                src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/price-calculator/binding/thumbnails/stapled.png">
                            <p class="text-center" style="font-size: 12px;">Upload Own Artwork</p>
                        </div>
                        <div class="choose-binding" data-value="Perfect (PUR)">
                            <img
                                src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/price-calculator/binding/thumbnails/stapled.png">
                            <p class="text-center" style="font-size: 12px;">Design Online</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="addtobtn">
                <button id="addToCartBtn" data-route="<?php echo e(route('shop-cart')); ?>">Add to Cart</button>
                <div class="note-dis">
                    <p>Delivery dates are estimated.</p>
                    <p>Total Order Weight: 1.60 kg</p>
                </div>
            </div>


        </div>
        <div class="extra-card mt-3">
            <img
                src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/price-calculator/tooltips_and_thumbnails/print-template-thumbnail.png" />
            <div class="extra-card-details">
                <h6 class="m-0">Print on Demand</h6>
                <p>Download the free PDF template we created for your specifications.</p>
                <a href="">Get a Qoute</a>
            </div>
        </div>
        <div class="extra-card mt-3">
            <img
                src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/price-calculator/tooltips_and_thumbnails/print-template-thumbnail.png" />
            <div class="extra-card-details">
                <h6 class="m-0">Print on Demand</h6>
                <p>Download the free PDF template we created for your specifications.</p>
                <a href="">Get a Qoute</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 4 Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">Help</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="helpModalBody">
                <!-- Dynamic content will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const quantityPricing = <?php echo json_encode($quantityPricing, 15, 512) ?>;
    const attributeConditions = <?php echo json_encode($conditionsMap, 15, 512) ?>;

    // ========== UTILS ==========
    function getBasePriceFromQuantity(quantity) {
        let matched = null, maxRange = null;

        quantityPricing.forEach((q) => {
            if (!maxRange || q.quantity_to > maxRange.quantity_to) maxRange = q;
            if (quantity >= q.quantity_from && quantity <= q.quantity_to) matched = q;
        });

        return parseFloat((matched || maxRange)?.base_price || 0);
    }


    function getModifierAmount(price, modifier, base, type = 'amount') {
        const parsedPrice = parseFloat(price || 0);
        console.log('parsedPrice', parsedPrice);

        if (type === 'percentage') {
            const percentValue = (parsedPrice / 100) * base;
            return modifier === 'multiply' ? base * percentValue : percentValue;
        }

        return modifier === 'multiply' ? base * parsedPrice : parsedPrice;
    }


    function calculateTotalPrice() {
        let quantity = parseInt($('#quantityInput').val()) || 1;
        let base = getBasePriceFromQuantity(quantity);
        let total = base;

        // Collect all adjustments first
        let adjustments = [];

        $('.attribute-wrapper .active').each(function () {
            const price = parseFloat($(this).data('price') || 0);
            const modifier = $(this).data('modifier') || 'add';
            const baseType = $(this).data('base-type') || 'amount';

            adjustments.push({ price, modifier, baseType });
        });

        $('select.custom-select').each(function () {
            const selected = $(this).find('option:selected');
            const price = parseFloat(selected.data('price') || 0);
            const modifier = selected.data('modifier') || 'add';
            const baseType = selected.data('base-type') || 'amount';

            adjustments.push({ price, modifier, baseType });
        });

        // First add all fixed amounts
        adjustments.forEach(({ price, modifier, baseType }) => {
            if (baseType === 'amount') {
                total += getModifierAmount(price, modifier, base);
            }
        });

        // Then apply percentage charges on new total
        adjustments.forEach(({ price, modifier, baseType }) => {
            if (baseType === 'percentage') {
                const percentValue = (price / 100) * total;
                total += modifier === 'multiply' ? total * percentValue : percentValue;
            }
        });

        $('.final-price').text(`£${total.toFixed(2)}`);
    }


    function handleAttributeConditions(selectedAttrId, selectedValueId) {
        $('.attribute-wrapper').removeClass('d-none');
        $('.attribute-condition-note').remove();
        $('.attribute-values').show();
        $('.attribute-values [data-value-id]').show();

        attributeConditions.forEach(condition => {
            const $affected = $(`[data-attribute-id="${condition.affected_attribute_id}"]`);
            const match = +condition.parent_attribute_id === +selectedAttrId && +condition.parent_value_id === +selectedValueId;

            if (condition.action === 'show') {
                if (match) {
                    $affected.removeClass('d-none').find('.attribute-values').show();
                } else {
                    $affected.removeClass('d-none').find('.attribute-values').hide();
                    const parentWrapper = $(`[data-attribute-id="${condition.parent_attribute_id}"]`);
                    const parentName = parentWrapper.find('label').clone().children().remove().end().text().trim();
                    const parentValueLabel = parentWrapper.find(`[data-value-id="${condition.parent_value_id}"]`).text().trim()
                        || parentWrapper.find(`option[data-value-id="${condition.parent_value_id}"]`).text().trim();
                    $affected.append(`<p class="attribute-condition-note text-danger mt-2">
                        Only available when <strong>${parentName}</strong> is set to <strong>${parentValueLabel}</strong>.
                    </p>`);
                }
            }

            if (condition.action === 'hide' && match) {
                if (condition.all_values_affected) {
                    $affected.addClass('d-none');
                } else {
                    condition.affected_value_ids.forEach(valId => {
                        $affected.find(`[data-value-id="${valId}"]`).hide();
                    });
                }
            }
        });
    }

    // ========== INIT ==========
    $(function () {
        // On quantity change
        $('#quantityInput').on('input', calculateTotalPrice);

        $(document).on('click', '.attr-select, .print-color, .choose-binding', function () {
            const $this = $(this);
            const $wrapper = $this.closest('.attribute-wrapper');

            // If no wrapper found, skip
            if (!$wrapper.length) return;

            // Deactivate all other buttons in this group
            $wrapper.find('.attr-select, .print-color, .choose-binding')
                .removeClass('active')
                .removeAttr('data-selected');

            // Activate current one
            $this.addClass('active').attr('data-selected', 'true');

            const attrId = $wrapper.data('attribute-id');
            const valueId = $this.data('value-id');

            handleAttributeConditions(attrId, valueId);
            calculateTotalPrice();
        });




        // On dropdown change
        $(document).on('change', 'select.custom-select', function () {
            const selected = $(this).find('option:selected');
            const attrId = selected.data('attribute-id');
            const valueId = selected.data('value-id');
            handleAttributeConditions(attrId, valueId);
            calculateTotalPrice();
        });

        // Group toggle visibility
        $(document).on('change', '.group-toggle', function () {
            const target = $(this).data('target');
            $(target).toggleClass('d-none', !$(this).is(':checked'));
        });

        // Help circle popups
        $('.help-circle').on('click', function () {
            const label = $(this).data('label');
            const helpContent = {
                'Quantity': 'Specify the number of booklets you want to print. Enter a value between 1 and 1000.',
                'Colour Printing': 'Choose between full-color printing (Colors) or black-and-white (Grayscale) for your booklet.',
                'Orientation': 'Select the page orientation: Portrait (vertical) or Landscape (horizontal).',
                'Size': 'Choose the booklet size from standard options or select Custom Size for specific dimensions.',
                'Paper Type': 'Choose the type of paper finish, such as Silk, Gloss, Uncoated, or Recycled Natural.',
                'Paper Weight': 'Select the paper thickness, measured in grams per square meter (gsm). Higher gsm indicates thicker paper.',
                'Binding': 'Choose the binding method: Staple, Perfect (PUR), or Wiro for securing the booklet pages.',
                'Pages': 'Adjust the number of pages for your booklet, ranging from 32 to 840 pages.'
            };

            $('#helpModalLabel').text(`${label} Help`);
            $('#helpModalBody').text(helpContent[label] || 'No help content available.');
        });

        // Page slider
        const slider = document.getElementById('pageSlider');
        const valueDisplay = document.getElementById('pageValue');
        const decrementBtn = valueDisplay.previousElementSibling;
        const incrementBtn = valueDisplay.nextElementSibling;

        function updateSliderFill() {
            const percent = ((slider.value - slider.min) / (slider.max - slider.min)) * 100;
            slider.style.setProperty('--value', `${percent}%`);
        }

        slider.addEventListener('input', () => {
            valueDisplay.textContent = slider.value;
            updateSliderFill();
        });

        decrementBtn?.addEventListener('click', () => {
            let val = +slider.value;
            if (val > 32) {
                slider.value = val - 1;
                valueDisplay.textContent = slider.value;
                updateSliderFill();
            }
        });

        incrementBtn?.addEventListener('click', () => {
            let val = +slider.value;
            if (val < 840) {
                slider.value = val + 1;
                valueDisplay.textContent = slider.value;
                updateSliderFill();
            }
        });

        updateSliderFill();

        // Add to cart button
        $('#addToCartBtn').on('click', function () {
            const route = $(this).data('route');
            if (route) window.location.href = route;
        });

        // Initial condition/price evaluation
        calculateTotalPrice();
        $('.attribute-wrapper .active').each(function () {
            const attrId = $(this).data('attribute-id');
            const valueId = $(this).data('value-id');
            handleAttributeConditions(attrId, valueId);
        });
        $('select.custom-select').each(function () {
            const selected = $(this).find('option:selected');
            const attrId = selected.data('attribute-id');
            const valueId = selected.data('value-id');
            handleAttributeConditions(attrId, valueId);
        });
    });
</script><?php /**PATH D:\web-mingo-project\new\resources\views/front/calculator.blade.php ENDPATH**/ ?>