

<?php $__env->startSection('title'); ?>
    Nuvem Prints - Category Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-wrapper py-5">
        <div class="container text-center">
            <!-- Page Heading -->
            <h1 class="fw-bold mb-2" style="font-size: 2.2rem;">
                <?php if(isset($slug)): ?>
                    Products in Category: <span class="text-primary"><?php echo e(ucwords(str_replace('-', ' ', $slug))); ?></span>
                <?php else: ?>
                    All Products
                <?php endif; ?>
            </h1>
            <p class="text-muted mb-5" style="max-width: 600px; margin: 0 auto;">
                Explore our complete range of products tailored for your business and personal needs.
            </p>

            <!-- Product Grid -->
            <div class="row g-4">
                <?php if(isset($subcategories) && count($subcategories) > 0): ?>
                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="<?php echo e(route('subcategory-details', ['slug' => $subcat->slug])); ?>" class="text-decoration-none">
                                <div class="card h-100 shadow-sm border-0">
                                    <!-- Fixed height image -->
                                    <div style="height: 200px; overflow: hidden;">
                                        <img src="<?php echo e($subcat->thumbnail
                                            ? asset('storage/' . $subcat->thumbnail)
                                            : 'https://via.placeholder.com/300x200'); ?>"
                                            class="card-img-top w-100 h-100" style="object-fit: cover;" alt="<?php echo e($subcat->name); ?>">
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="card-text fw-semibold text-dark mb-0"><?php echo e($subcat->name); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p>No products available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/front/category-products.blade.php ENDPATH**/ ?>