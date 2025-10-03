

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Attribute Groups</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm"
                            id="add-attribute-groups">Add</a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attribute Groups</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Group Name</th>
                                            <th>Attached Attributes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $attributeGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($group->name); ?></td>
                                                <td>
                                                    <?php echo e($group->attributes->pluck('name')->join(', ') ?: 'No attributes attached'); ?>

                                                </td>
                                                <td>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-sm btn-primary edit-attribute-group"
                                                                data-id="<?php echo e($group->id); ?>">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)"
                                                                onclick="deleteConfirmation(<?php echo e($group->id); ?>)">
                                                                <i class="fa fa-trash text-danger"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="3" class="text-center">No Attribute Groups Found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="modal fade" id="attribute-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            // Add Attribute
            $(document).on('click', '#add-attribute-groups', function () {
                $.get("<?php echo e(route('admin.attribute-groups.create')); ?>", function (result) {
                    if (result.success) {
                        $('#attribute-modal').html(result.html).modal('show');
                    }
                });
            });

            // Edit Attribute
            $(document).on('click', '.edit-attribute-group', function () {
                const id = $(this).data('id');
                $.get(`<?php echo e(url('admin/attribute-groups')); ?>/${id}/edit`, function (result) {
                    if (result.success) {
                        $('#attribute-modal').html(result.html).modal('show');
                    }
                });
            });

            // Save attribute group
            $(document).on('click', '#save-group-btn', function () {
                const form = $('#attribute-group-form')[0];
                const formData = new FormData(form);

                $('#save-group-btn').attr('disabled', true);
                $('.validation-err').html('');

                $.ajax({
                    url: "<?php echo e(route('admin.attribute-groups.store')); ?>", // Update this route if needed
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        if (result.success) {
                            Swal.fire('Success!', result.message || '', 'success');
                            $('#attribute-modal').modal('hide');
                            setTimeout(() => location.reload(), 500);
                        } else {
                            $('#save-group-btn').attr('disabled', false);
                            if (result.code === 422) {
                                for (const key in result.errors) {
                                    const errId = key.replace(/\./g, '_') + '-err';
                                    $('#' + errId).html(result.errors[key][0]);
                                }
                            } else {
                                Swal.fire(result.msgText || 'Something went wrong');
                            }
                        }
                    }
                });
            });
        });

        // Update Attribute
        $(document).on('click', '#update-attribute-btn', function () {
            $(this).prop('disabled', true);
            $('.validation-err').text('');

            let id = $(this).data('id');
            let formData = new FormData(document.getElementById('attribute-form'));
            formData.append('_method', 'PUT');

            $.ajax({
                url: `/admin/attribute-groups/${id}`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Updated!', '', 'success');
                        $('#attribute-modal').modal('hide');
                        setTimeout(() => location.reload(), 300);
                    } else {
                        $('#update-attribute-btn').prop('disabled', false);
                        if (response.errors) {
                            $.each(response.errors, function (key, messages) {
                                const $input = $(`[name="${key}"]`);
                                const $errorSpan = $input.siblings('.' + key.replace(/\./g, '_') + '-err');
                                if ($errorSpan.length) {
                                    $errorSpan.html(messages[0]);
                                }
                            });
                        } else {
                            Swal.fire('Error', response.msgText ?? 'Something went wrong', 'error');
                        }
                    }
                }
            });
        });
        // Delete Attribute
        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/attribute-groups/${id}`,
                        type: "DELETE",
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Deleted!', '', 'success');
                                setTimeout(() => location.reload(), 300);
                            } else {
                                Swal.fire('Error', response.msgText, 'error');
                            }
                        }
                    });
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/admin/attribute-groups/index.blade.php ENDPATH**/ ?>