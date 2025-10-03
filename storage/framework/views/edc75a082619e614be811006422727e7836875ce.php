

<?php $__env->startSection('content'); ?>
    <style>
        .sra3-input {
            margin-bottom: 10px;
        }
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-2">
                <div class="col-md-6">
                    <h4 class="mb-0">Edit Cover Paper Weight Rates</h4>
                    <small class="text-muted d-block mt-1">
                        <i class="fas fa-info-circle"></i> Pricing is based on the SRA3 sheet.</strong>
                    </small>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?php echo e(route('admin.centralized-paper-pricing.index')); ?>" class="btn btn-secondary btn-sm">← Back to List</a>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <form id="edit-paper-weight-form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="attribute_id" value="<?php echo e($attribute->id); ?>">
                            <div id="dependency-section"></div>

                            <button type="submit" class="btn btn-success mt-2">Update Pricing</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php
    $filteredValuesByParent = [];

    foreach ($attribute->parents as $parent) {
        if (strtolower(trim($parent->name)) === 'paper size') {
            continue;
        }

        $filteredValuesByParent[$parent->id] = [
            'name' => $parent->name,
            'values' => $parent->values->where('is_composite_value', false)->map(function ($val) {
                return [
                    'id' => $val->id,
                    'value' => $val->value,
                ];
            })->values()
        ];
    }

    $filteredValuesByParent[$attribute->id] = [
        'name' => $attribute->name . ' (Self)',
        'values' => $attribute->values->where('is_composite_value', false)->map(function ($val) {
            return [
                'id' => $val->id,
                'value' => $val->value,
            ];
        })->values()
    ];
?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function () {
        const parentValues = <?php echo json_encode($filteredValuesByParent, 15, 512) ?>;
        const existingRules = <?php echo json_encode($pricingRules, 15, 512) ?>;
        let ruleIndex = 0;

      function getDependencyRowHtml(index, rule = null) {
    let html = `<div class="card mb-3 dependency-row border rounded" data-index="${index}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Dependency Row ${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-dependency">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                        <div class="row">`;

    Object.entries(parentValues).forEach(([parentId, parentData]) => {
        const selectedValue = rule?.dependencies?.find(dep => dep.attribute_id == parentId)?.value_id 
            ?? (parentId == "<?php echo e($attribute->id); ?>" ? rule?.value_id : '');

        html += `<div class="col-md-3">
                    <label>${parentData.name}</label>
                    <select name="rows[${index}][dependency_values][${parentId}]" class="form-control" required>
                        <option value="">-- Select --</option>`;

        parentData.values.forEach(val => {
            const selected = selectedValue == val.id ? 'selected' : '';
            html += `<option value="${val.id}" ${selected}>${val.value}</option>`;
        });

        html += `</select></div>`;
    });

    const price = rule?.price ?? '';

    html += `
        <div class="col-md-4">
            <label>Price</label>
            <div class="d-flex align-items-center">
                <input type="number" name="rows[${index}][price]" class="form-control price-input"
                    step="0.01" min="0" placeholder="Price of SRA3 sheet"
                    value="${price}" data-index="${index}" required>
            </div>
            <small class="text-muted">SRA3 sheet price</small>
        </div>
    `;

    html += `</div></div></div>`;
    return html;
}

        function addDependencyRow(rule = null) {
            $('#dependency-section').append(getDependencyRowHtml(ruleIndex, rule));
            ruleIndex++;
        }

        existingRules.forEach(rule => {
            addDependencyRow(rule);
        });

        if (existingRules.length === 0) {
            addDependencyRow();
        }

        $('#dependency-section').after('<button type="button" class="btn btn-primary mt-2" id="add-dependency">+ Add Dependency</button>');

        $(document).on('click', '#add-dependency', function () {
            addDependencyRow();
        });

        $(document).on('click', '.remove-dependency', function () {
            $(this).closest('.dependency-row').remove();
        });

        $(document).on('input', '.price-input', function () {
            const index = $(this).data('index');
            const value = parseFloat($(this).val());
            if (!isNaN(value)) {
                const perSheet = (value / 1000).toFixed(4);
                $(`#per-sheet-${index}`).text(perSheet);
            } else {
                $(`#per-sheet-${index}`).text('0.00');
            }
        });

        $('#edit-paper-weight-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo e(route('admin.paper-weight-rates.update', $attribute->id)); ?>",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.message ?? 'Data updated successfully.'
                    }).then(() => {
                        window.location.href = "<?php echo e(route('admin.centralized-paper-pricing.index')); ?>";
                    });
                },
                error: function (xhr) {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/admin/centralized-paper-pricing/cover-paper-weight-rates/edit.blade.php ENDPATH**/ ?>