

<?php $__env->startSection('content'); ?>
    <style>
        .remove-modifier,
        .add-modifier {
            margin-top: 10px;
            margin-right: 10px;
        }

        .per-page-row input {
            margin-bottom: 5px;
        }

        .form-check {
            padding-top: 0.65rem;
            padding-left: 1.25rem;
        }

        label {
            font-weight: 500;
            font-size: 0.875rem;
        }
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-2">
                <div class="col-md-6">
                    <h4 class="mb-0">Edit Pricing Rule</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?php echo e(route('admin.pricing-rules.index')); ?>" class="btn btn-secondary btn-sm">← Back to List</a>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('admin.pricing-rules.update', $pricingRule->id)); ?>"
                            id="pricing-rule-form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Category</label>
                                    <div class="form-control-plaintext"><?php echo e($pricingRule->category->name); ?></div>
                                    <input type="hidden" name="category_id" value="<?php echo e($pricingRule->category_id); ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Subcategory</label>
                                    <div class="form-control-plaintext"><?php echo e($pricingRule->subcategory->name); ?></div>
                                    <input type="hidden" name="subcategory_id" value="<?php echo e($pricingRule->subcategory_id); ?>">
                                </div>
                            </div>

                            <hr>

                            
                            <h6>Attribute Modifiers</h6>
                            <div id="attribute-modifier-container">
                                <?php $__currentLoopData = $pricingRule->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-row attribute-row border rounded p-2 mb-2 position-relative">
                                        
                                        <input type="hidden" name="rows[<?php echo e($index); ?>][id]" value="<?php echo e($mod->id); ?>">
                                        <div class="form-group col-md-2">
                                            <label>Attribute</label>
                                            <select class="form-control" name="rows[<?php echo e($index); ?>][attribute_id]">
                                                <?php $__currentLoopData = $subcategoryAttributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($attr->id); ?>" <?php echo e($attr->id == $mod->attribute_id ? 'selected' : ''); ?>> <?php echo e($attr->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Value</label>
                                            <?php
                                                $selectedAttr = $subcategoryAttributes->firstWhere('id', $mod->attribute_id);
                                            ?>
                                            <select class="form-control" name="rows[<?php echo e($index); ?>][value_id]">
                                                <?php $__currentLoopData = $selectedAttr->values ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($val->id); ?>" <?php echo e($val->id == $mod->value_id ? 'selected' : ''); ?>>
                                                        <?php echo e($val->value); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3 dependency-group" style="display: none;">
                                            <label>Depends On Value</label>
                                            <select class="form-control dependency-value-select"
                                                name="rows[<?php echo e($index); ?>][dependency_value_id]">
                                                <option value="">-- Select --</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2 modifier-type-group" style="display: none;">
                                            <label>Modifier Type</label>
                                            <select class="form-control" name="rows[<?php echo e($index); ?>][modifier_type]">
                                                <option value="add" <?php echo e($mod->price_modifier_type == 'add' ? 'selected' : ''); ?>>Add
                                                </option>
                                                <option value="multiply" <?php echo e($mod->price_modifier_type == 'multiply' ? 'selected' : ''); ?>>Multiply</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2 base-charges-group" style="display: none;">
                                            <label>Base charges</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    name="rows[<?php echo e($index); ?>][modifier_value]"
                                                    value="<?php echo e($mod->price_modifier_value); ?>">
                                                <select class="form-control col-auto"
                                                    name="rows[<?php echo e($index); ?>][base_charges_type]" style="max-width: 100px;">
                                                    <option value="">Select Type</option>
                                                    <option value="amount" <?php echo e($mod->base_charges_type === 'amount' ? 'selected' : ''); ?>>Amount</option>
                                                    <option value="percentage" <?php echo e($mod->base_charges_type === 'percentage' ? 'selected' : ''); ?>>%</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2 extra-copy-group" style="display: none;">
                                            <label>Extra Copy Charge</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    name="rows[<?php echo e($index); ?>][extra_copy_charge]"
                                                    value="<?php echo e($mod->extra_copy_charge); ?>">
                                                <select class="form-control col-auto"
                                                    name="rows[<?php echo e($index); ?>][extra_copy_charge_type]" style="max-width: 100px;">
                                                    <option value="">Select Type</option>
                                                    <option value="amount" <?php echo e($mod->extra_copy_charge_type === 'amount' ? 'selected' : ''); ?>>Amount</option>
                                                    <option value="percentage" <?php echo e($mod->extra_copy_charge_type === 'percentage' ? 'selected' : ''); ?>>%</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-1 d-flex align-items-center justify-content-center mt-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="default_<?php echo e($index); ?>"
                                                    name="rows[<?php echo e($index); ?>][is_default]" value="1" <?php echo e($mod->is_default ? 'checked' : ''); ?>>
                                                <label class="custom-control-label" for="default_<?php echo e($index); ?>"
                                                    title="Mark this value as default">
                                                    Default
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-1 d-flex align-items-end modifier-buttons"></div>

                                        <div class="col-md-12 per-page-container mt-2">
                                            <label class="font-weight-bold">Pricing</label>
                                            <div class="per-page-wrapper">
                                                <?php $__currentLoopData = $mod->quantityRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qIndex => $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-row per-page-row">
                                                        <input type="hidden" name="rows[<?php echo e($index); ?>][per_page_pricing][<?php echo e($qIndex); ?>][id]"
                                                            value="<?php echo e($range->id); ?>">
                                                        <div class="form-group col-md-3">
                                                            <input type="number" class="form-control"
                                                                name="rows[<?php echo e($index); ?>][per_page_pricing][<?php echo e($qIndex); ?>][quantity_from]"
                                                                placeholder="From" value="<?php echo e($range->quantity_from); ?>">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <input type="number" class="form-control"
                                                                name="rows[<?php echo e($index); ?>][per_page_pricing][<?php echo e($qIndex); ?>][quantity_to]"
                                                                placeholder="To" value="<?php echo e($range->quantity_to); ?>">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="rows[<?php echo e($index); ?>][per_page_pricing][<?php echo e($qIndex); ?>][price]"
                                                                placeholder="Price" value="<?php echo e($range->price); ?>">
                                                        </div>
                                                        <div class="form-group col-md-3 d-flex align-items-center">
                                                            <?php if($qIndex === 0): ?>
                                                                <button type="button" class="btn btn-sm btn-primary add-per-page">+
                                                                    Add</button>
                                                            <?php else: ?>
                                                                <button type="button" class="btn btn-sm btn-danger remove-per-page">−
                                                                    Remove</button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>



                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <button type="button" class="btn btn-success mt-2" id="save-pricing-rule-btn">Update Pricing
                                Rule</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let subcategoryAttributes = <?php echo json_encode($subcategoryAttributes, 15, 512) ?>;

        function createAttributeRow(index) {
            const attrOptions = subcategoryAttributes.map(attr => `<option value="${attr.id}">${attr.name}</option>`).join('');
            const defaultValues = subcategoryAttributes[0]?.values || [];
            const valueOptions = defaultValues.map(val => `<option value="${val.id}">${val.value}</option>`).join('');

            const row = document.createElement('div');
            row.className = 'form-row attribute-row border rounded p-2 mb-2 position-relative';
            row.dataset.index = index;

            row.innerHTML = `
                                                                                                                                                                        <div class="form-group col-md-2">
                                                                                                                                                                            <label>Attribute</label>
                                                                                                                                                                            <select class="form-control" name="rows[${index}][attribute_id]">
                                                                                                                                                                            <option value="">-- Select --</option>
                                                                                                                                                                                ${attrOptions}
                                                                                                                                                                            </select>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="form-group col-md-2">
                                                                                                                                                                            <label>Value</label>
                                                                                                                                                                            <select class="form-control" name="rows[${index}][value_id]">
                                                                                                                                                                            <option value="">-- Select --</option>
                                                                                                                                                                                ${valueOptions}
                                                                                                                                                                            </select>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="form-group col-md-3 dependency-group" style="display: none;">
                                                <label>Depends On Value</label>
                                                <select class="form-control dependency-value-select" name="rows[${index}][dependency_value_id]">
                                                <option value="">-- Select --</option>
                                                </select>
                                                </div>

                                                                                                                                                                        <div class="form-group col-md-2 modifier-type-group" style="display: none;">
                                                                                                                                                                            <label>Modifier Type</label>
                                                                                                                                                                            <select class="form-control" name="rows[${index}][modifier_type]">
                                                                                                                                                                                <option value="add">Add</option>
                                                                                                                                                                                <option value="multiply">Multiply</option>
                                                                                                                                                                            </select>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="form-group col-md-2 base-charges-group" style="display: none;">
                                                                                                                                                                            <label>Base Charges</label>
                                                                                                                                                                            <div class="input-group">
                                                                                                                                                                                <input type="text" class="form-control" name="rows[${index}][modifier_value]">
                                                                                                                                                                                <select class="form-control col-auto" name="rows[${index}][base_charges_type]" style="max-width: 100px;">
                                                                                                                                                                                    <option value="">Select Type</option>
                                                                                                                                                                                    <option value="amount">Amount</option>
                                                                                                                                                                                    <option value="percentage">%</option>
                                                                                                                                                                                </select>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="form-group col-md-2 extra-copy-group" style="display: none;">
                                                                                                                                                                            <label>Extra Copy Charge</label>
                                                                                                                                                                            <div class="input-group">
                                                                                                                                                                                <input type="text" class="form-control" name="rows[${index}][extra_copy_charge]">
                                                                                                                                                                                <select class="form-control col-auto" name="rows[${index}][extra_copy_charge_type]" style="max-width: 100px;">
                                                                                                                                                                                    <option value="">Select Type</option>
                                                                                                                                                                                    <option value="amount">Amount</option>
                                                                                                                                                                                    <option value="percentage">%</option>
                                                                                                                                                                                </select>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="form-group col-md-1 d-flex align-items-center justify-content-center mt-2">
                                                                                                                                                                            <div class="custom-control custom-checkbox">
                                                                                                                                                                                <input type="checkbox" class="custom-control-input" id="default_${index}" name="rows[${index}][is_default]" value="1">
                                                                                                                                                                                <label class="custom-control-label" for="default_${index}" title="Mark this value as default">Default</label>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="form-group col-md-1 d-flex align-items-end modifier-buttons"></div>

                                                                                                                                                                        <div class="col-md-12 per-page-container mt-2" style="display: none;">
                                                                                                      <label class="font-weight-bold">Pricing</label>
                                                                                                      <div class="per-page-wrapper">
                                                                                                      <div class="form-row per-page-row">
                                                                                                      <div class="form-group col-md-3">
                                                                                                      <input type="number" class="form-control" name="rows[${index}][per_page_pricing][0][quantity_from]" placeholder="From">
                                                                                                      </div>
                                                                                                      <div class="form-group col-md-3">
                                                                                                      <input type="number" class="form-control" name="rows[${index}][per_page_pricing][0][quantity_to]" placeholder="To">
                                                                                                      </div>
                                                                                                      <div class="form-group col-md-3">
                                                                                                      <input type="text" class="form-control" name="rows[${index}][per_page_pricing][0][price]" placeholder="Price">
                                                                                                      </div>
                                                                                                      <div class="form-group col-md-3 d-flex align-items-center">
                                                                                                      <button type="button" class="btn btn-sm btn-primary add-per-page">+ Add</button>
                                                                                                      </div>
                                                                                                      </div>
                                                                                                      </div>
                                                                                                      </div>
                                                                                                                                                                    `;

            return row;
        }

        function updateButtons(containerSelector, rowClass, addClass, removeClass, buttonGroupSelector) {
            const rows = document.querySelectorAll(`.${rowClass}`);
            rows.forEach((row, index) => {
                const btnGroup = row.querySelector(buttonGroupSelector);
                btnGroup.innerHTML = '';

                if (index !== 0) {
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = `btn btn-sm btn-danger ${removeClass}`;
                    removeBtn.textContent = '- Remove';
                    btnGroup.appendChild(removeBtn);
                }

                if (index === rows.length - 1) {
                    const addBtn = document.createElement('button');
                    addBtn.type = 'button';
                    addBtn.className = `btn btn-sm btn-primary ${addClass}`;
                    addBtn.textContent = '+ Add';
                    btnGroup.appendChild(addBtn);
                }
            });
        }

        function handleAttributeChange(row) {
            const attributeSelect = row.querySelector('select[name*="[attribute_id]"]');
            const attrId = attributeSelect?.value;
            const selectedAttr = subcategoryAttributes.find(attr => attr.id == attrId);

            const dependencyGroup = row.querySelector('.dependency-group');
            const dependencySelect = row.querySelector('.dependency-value-select');
            dependencyGroup.style.display = 'none';
            dependencySelect.innerHTML = '<option value="">-- Select --</option>';

            const valueSelect = row.querySelector('select[name*="[value_id]"]');
            valueSelect.innerHTML = selectedAttr?.values
                .filter(v => !v.is_composite_value)
                .map(v => `<option value="${v.id}">${v.value}</option>`)
                .join('') || '';

            if (selectedAttr?.dependency_parent) {
                const parentAttr = subcategoryAttributes.find(attr => attr.id == selectedAttr.dependency_parent);
                const values = parentAttr?.values?.filter(v => !v.is_composite_value) || [];

                dependencySelect.innerHTML = values
                    .map(v => `<option value="${v.id}">${v.value}</option>`)
                    .join('');
                dependencyGroup.style.display = 'block';
            }

            // Per Page Pricing
            const perPageSection = row.querySelector('.per-page-container');
            if (['per_page', 'per_product'].includes(selectedAttr?.pricing_basis)) {
                perPageSection.style.display = 'block';
                const pricingLabel = perPageSection.querySelector('label.font-weight-bold');
                if (pricingLabel) {
                    pricingLabel.textContent = selectedAttr?.pricing_basis === 'per_product'
                        ? 'Per Product Pricing'
                        : 'Per Page Pricing';
                }
            } else {
                perPageSection.style.display = 'none';
            }

            const extraCopySection = row.querySelector('.extra-copy-group');
            const modifierGroup = row.querySelector('.modifier-type-group');
            const baseChargesGroup = row.querySelector('.base-charges-group');
            const showSetupFields = selectedAttr?.has_setup_charge === true;

            extraCopySection.style.display = selectedAttr?.pricing_basis === 'per_extra_copy' ? 'block' : 'none';
            modifierGroup.style.display = showSetupFields ? 'block' : 'none';
            baseChargesGroup.style.display = showSetupFields ? 'block' : 'none';
        }

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-modifier')) {
                e.preventDefault();
                const container = document.getElementById('attribute-modifier-container');
                const nextIndex = container.querySelectorAll('.attribute-row').length;
                const row = createAttributeRow(nextIndex);
                container.appendChild(row);
                updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
            }
            if (e.target.classList.contains('remove-modifier')) {
                e.preventDefault();
                const container = document.getElementById('attribute-modifier-container');
                const rowToRemove = e.target.closest('.attribute-row');
                rowToRemove.remove();

                // Re-index remaining inputs
                container.querySelectorAll('.attribute-row').forEach((row, index) => {
                    row.dataset.index = index;

                    row.querySelectorAll('input, select, label').forEach((el) => {
                        if (el.name) {
                            el.name = el.name.replace(/rows\[\d+\]/, `rows[${index}]`);
                        }
                        if (el.id) {
                            el.id = el.id.replace(/default_\d+/, `default_${index}`);
                        }
                        if (el.tagName.toLowerCase() === 'label' && el.htmlFor) {
                            el.htmlFor = el.htmlFor.replace(/default_\d+/, `default_${index}`);
                        }
                    });
                });

                updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
            }
            if (e.target.classList.contains('add-per-page')) {
                e.preventDefault();
                const wrapper = e.target.closest('.per-page-wrapper');
                const rows = wrapper.querySelectorAll('.per-page-row');
                const lastIndex = rows.length;
                const newRow = rows[0].cloneNode(true);
                newRow.querySelectorAll('input').forEach(input => input.value = '');
                newRow.querySelector('.add-per-page').outerHTML = '<button type="button" class="btn btn-sm btn-danger remove-per-page">- Remove</button>';


                const parentAttrIndex = wrapper.closest('.attribute-row')
                    .querySelector('select[name*="[attribute_id]"]')
                    .name.match(/rows\[(\d+)\]/)[1]; // get parent row index

                newRow.querySelectorAll('input').forEach(input => {
                    const name = input.name;
                    const updated = name.replace(
                        /rows\[\d+\]\[per_page_pricing\]\[\d+\]/,
                        `rows[${parentAttrIndex}][per_page_pricing][${lastIndex}]`
                    );
                    input.name = updated;
                });


                wrapper.appendChild(newRow);
            }

            if (e.target.classList.contains('remove-per-page')) {
                e.preventDefault();
                e.target.closest('.per-page-row').remove();
            }
        });


        document.addEventListener('change', function (e) {
            if (e.target.name?.includes('[attribute_id]')) {
                const row = e.target.closest('.attribute-row');
                handleAttributeChange(row);
            }
            if (e.target.name.includes('[is_default]')) {
                const changedRow = e.target.closest('.attribute-row');
                const attributeSelect = changedRow.querySelector('select[name*="[attribute_id]"]');
                const currentAttrId = attributeSelect.value;

                // Find all rows with same attribute_id and uncheck other checkboxes
                document.querySelectorAll('.attribute-row').forEach(row => {
                    const attrSelect = row.querySelector('select[name*="[attribute_id]"]');
                    const attrId = attrSelect?.value;

                    if (attrId === currentAttrId && row !== changedRow) {
                        const checkbox = row.querySelector('input[name*="[is_default]"]');
                        if (checkbox) checkbox.checked = false;
                    }
                });
            }

        });


        document.addEventListener('DOMContentLoaded', function () {
            updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');

            document.querySelectorAll('.attribute-row').forEach(row => {
                handleAttributeChange(row);
            });
        });


    </script>

    <?php $__env->startPush('scripts'); ?>
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#save-pricing-rule-btn').on('click', function () {
                    const $btn = $(this);
                    const form = $('#pricing-rule-form')[0];
                    const formData = new FormData(form);

                    $btn.prop('disabled', true);
                    $('.invalid-feedback').remove();
                    $('input, select').removeClass('is-invalid');

                    $.ajax({
                        url: "<?php echo e(route('admin.pricing-rules.update', $pricingRule->id)); ?>",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('Updated!', res.message || 'Pricing rule updated successfully.', 'success');
                                setTimeout(() => {
                                    window.location.href = res.redirect;
                                }, 800);
                            } else {
                                $btn.prop('disabled', false);
                                Swal.fire('Error', res.message || 'Something went wrong', 'error');
                            }
                        },
                        error: function (xhr) {
                            $btn.prop('disabled', false);
                            const errors = xhr.responseJSON.errors || {};
                            for (const key in errors) {
                                const msg = errors[key][0];
                                const baseKey = key.replace(/\.\d+/, '[]');
                                const $input = $(`[name="${baseKey}"]`).first();
                                $input.addClass('is-invalid');
                                if ($input.next('.invalid-feedback').length === 0) {
                                    $input.after(`<div class="invalid-feedback">${msg}</div>`);
                                } else {
                                    $input.next('.invalid-feedback').text(msg);
                                }
                            }
                        }
                    });
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/pricing-rules/edit.blade.php ENDPATH**/ ?>