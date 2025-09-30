

<?php $__env->startSection('title'); ?>
  Nuvem Prints
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-styles'); ?>
  <style>
    .details-faq-container {
      /* max-width: 800px; */
      margin: 50px auto;
      padding: 0 0px;
    }

    .details-faq-heading {
      font-size: 28px;
      text-align: center;
      margin-bottom: 30px;
    }

    .details-faq-item {
      border-bottom: 1px solid #ddd;
    }

    .details-faq-question {
      width: 100%;
      padding: 15px 20px;
      text-align: left;
      font-size: 18px;
      font-weight: 500;
      border: none;
      background: #f9f9f9;
      cursor: pointer;
      outline: none;
      transition: background 0.3s;
      position: relative;
    }

    .details-faq-question::after {
      content: '+';
      position: absolute;
      right: 20px;
      font-size: 24px;
      transition: transform 0.3s;
    }

    .details-faq-question.active::after {
      transform: rotate(45deg);
    }

    .details-faq-question:hover {
      background: #f1f1f1;
    }

    .details-faq-answer {
      display: none;
      padding: 0 20px 15px 20px;
      background: #fff;
      font-size: 16px;
      color: #555;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    th {
      background: #f9f9f9;
    }

    .checkmark {
      color: green;
      text-align: right;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <div class="details-tab">
    <div class="details-tab-left">
      <h2 class="details-heading"><?php echo e($subcategory->name); ?></h2>

      <!-- Tabs -->
      <div class="details-tabs">
        <button class="details-tab-btn active" data-tab="details-tab1">Info</button>
        <button class="details-tab-btn" data-tab="details-tab2">FAQ</button>
      </div>

      <!-- Tab content -->
      <div class="details-tab-content">
        <div id="details-tab1" class="details-content active">
          <p><?php echo e($subcategory->description); ?></p>
        </div>
        <div id="details-tab2" class="details-content">
          <div class="details-faq-container">


            <div class="details-faq-item">
              <button class="details-faq-question">What is your return policy?</button>
              <div class="details-faq-answer">
                <p>Our return policy allows returns within 30 days of purchase with a valid receipt.</p>
              </div>
            </div>

            <div class="details-faq-item">
              <button class="details-faq-question">How long does shipping take?</button>
              <div class="details-faq-answer">
                <p>Shipping typically takes 5-7 business days for standard delivery.</p>
              </div>
            </div>

            <div class="details-faq-item">
              <button class="details-faq-question">Do you offer international shipping?</button>
              <div class="details-faq-answer">
                <p>Yes, we ship to most countries worldwide. Shipping fees may vary.</p>
              </div>
            </div>

            <div class="details-faq-item">
              <button class="details-faq-question">Can I track my order?</button>
              <div class="details-faq-answer">
                <p>Yes, you will receive a tracking number via email once your order is shipped.</p>
              </div>
            </div>

            <div class="details-faq-item">
              <button class="details-faq-question">How can I contact customer support?</button>
              <div class="details-faq-answer">
                <p>You can contact us via email or phone. Our support team is available 9 AM - 6 PM.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="details-tab-right">
      <!-- Main slider -->
      <?php $galleries = $subcategory->gallery; ?>
      <?php if(isset($galleries) && count($galleries) > 0): ?>
        <div class="details-main-slider">
          <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y => $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img src="<?php echo e(asset('storage/' . $gallery)); ?>" class="details-slide <?php echo e($y == 0 ? 'active' : ''); ?>" alt="">
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <!-- <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/booklet3-1.webp" class="details-slide active">
                          <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/booklet4-1.webp" class="details-slide"> -->
        </div>
      <?php endif; ?>


      <?php if(isset($galleries) && count($galleries) > 0): ?>
        <div class="details-thumbnails">
          <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y => $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img src="<?php echo e(asset('storage/' . $gallery)); ?>" data-slide="<?php echo e($y); ?>"
              class="details-thumb <?php echo e($y == 0 ? 'active' : ''); ?>">
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
      <!-- Thumbnails -->
      <!-- <div class="details-thumbnails">
              <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/booklet3-1.webp" data-slide="0"
                class="details-thumb active">
              <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/booklet4-1.webp" data-slide="1"
                class="details-thumb">
            </div> -->
    </div>
  </div>

  <div class="container py-5">
    <?php if($subcategory->calculator_required): ?>
      <?php echo $__env->make('front.calculator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
  </div>

  <div class="details-page-tab-container">
    <!-- Tabs -->
    <div class="details-page-tab-buttons">
      <button class="details-page-tab-btn active" data-tab="info">Information</button>
      <button class="details-page-tab-btn" data-tab="sizes">Available Sizes</button>
      <button class="details-page-tab-btn" data-tab="binding">Binding Options</button>
      <button class="details-page-tab-btn" data-tab="paper">Paper Types</button>
    </div>

    <!-- Tab Content -->
    <div class="details-page-tab-content">
      <div id="info" class="details-page-tab-content-item active">
        <p><?php echo $subcategory->details->information; ?></p>
      </div>
      <div id="sizes" class="details-page-tab-content-item">
        <p><?php echo $subcategory->details->available_sizes; ?></p>
      </div>
      <div id="binding" class="details-page-tab-content-item">
        <p><?php echo $subcategory->details->binding_options; ?></p>
      </div>
      <div id="paper" class="details-page-tab-content-item">
        <p><?php echo $subcategory->details->paper_types; ?></p>
      </div>
    </div>
  </div>

  <div class="details-related-container">
    <!-- Header + Arrows -->
    <div class="details-related-header">
      <h2 class="details-related-heading">Related Products</h2>
      <div class="details-related-arrows">
        <button class="details-related-prev">&#10094;</button>
        <button class="details-related-next">&#10095;</button>
      </div>
    </div>

    <!-- Slider -->
    <div class="details-related-slider-wrapper">
      <div class="details-related-slider">
        <!-- Slide 1 -->
        <div class="details-related-slide">
          <div class="details-related-card">
            <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/wall-calendar-11.webp" alt="">
            <h3>Product 1</h3>
          </div>
          <div class="details-related-card">
            <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/wire-booklet-11.webp" alt="">
            <h3>Product 2</h3>
          </div>
          <div class="details-related-card">
            <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/zine1-1.webp" alt="">
            <h3>Product 3</h3>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="details-related-slide">
          <div class="details-related-card">
            <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/stapled-booklet-1-1.webp" alt="">
            <h3>Product 4</h3>
          </div>
          <div class="details-related-card">
            <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/image-26-07-2025-at-2104.webp" alt="">
            <h3>Product 5</h3>
          </div>
          <div class="details-related-card">
            <img src="https://d1e8vjamx1ssze.cloudfront.net/product-images/stapledprogrammeopenconference.webp" alt="">
            <h3>Product 6</h3>
          </div>
        </div>
        <!-- Add more slides as needed -->
      </div>
    </div>
  </div>

  <script>
    const slider = document.querySelector('.details-related-slider');
    const slides = document.querySelectorAll('.details-related-slide');
    const nextBtn = document.querySelector('.details-related-next');
    const prevBtn = document.querySelector('.details-related-prev');

    let currentIndex = 0;

    function showSlide(index) {
      slider.style.transform = `translateX(-${index * 100}%)`;
    }

    // Next slide
    nextBtn.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % slides.length; // infinite loop
      showSlide(currentIndex);
    });

    // Previous slide
    prevBtn.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + slides.length) % slides.length; // infinite loop
      showSlide(currentIndex);
    });
  </script>
  <script>
    // Tabs logic
    const pageTabBtns = document.querySelectorAll('.details-page-tab-btn');
    const pageTabContents = document.querySelectorAll('.details-page-tab-content-item');

    pageTabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        // Remove active from all buttons and contents
        pageTabBtns.forEach(b => b.classList.remove('active'));
        pageTabContents.forEach(c => c.classList.remove('active'));

        // Activate current
        btn.classList.add('active');
        document.getElementById(btn.dataset.tab).classList.add('active');
      });
    });
  </script>
  <script>
    // Accordion logic
    const detailsFaqQuestions = document.querySelectorAll('.details-faq-question');

    detailsFaqQuestions.forEach(q => {
      q.addEventListener('click', () => {
        const active = q.classList.contains('active');

        // Close all
        detailsFaqQuestions.forEach(item => {
          item.classList.remove('active');
          item.nextElementSibling.style.display = 'none';
        });

        // Toggle current
        if (!active) {
          q.classList.add('active');
          q.nextElementSibling.style.display = 'block';
        }
      });
    });
  </script>
  <script>
    // Tabs logic
    const detailsTabBtns = document.querySelectorAll('.details-tab-btn');
    const detailsTabContents = document.querySelectorAll('.details-tab-content .details-content');

    detailsTabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        detailsTabBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const target = btn.dataset.tab;
        detailsTabContents.forEach(c => c.classList.remove('active'));
        document.getElementById(target).classList.add('active');
      });
    });

    // Slider logic
    const detailsSlides = document.querySelectorAll('.details-main-slider .details-slide');
    const detailsThumbs = document.querySelectorAll('.details-thumbnails .details-thumb');

    detailsThumbs.forEach((thumb, i) => {
      thumb.addEventListener('click', () => {
        detailsSlides.forEach(s => s.classList.remove('active'));
        detailsSlides[i].classList.add('active');

        detailsThumbs.forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
      });
    });
  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/front/subcategory-detail.blade.php ENDPATH**/ ?>