

<?php $__env->startSection('title'); ?>
	Nuvem Prints
<?php $__env->stopSection(); ?>
<style>
	.faq-item span {
		font-size: 1.2em;
		transition: transform 0.3s ease;
	}

	.faq-item.active span {
		transform: rotate(45deg);
	}

	.faq-answer {
		display: none;
		/*padding: 15px 0 5px;*/
		color: #666;
		line-height: 1.6;
		background: #fff;
		padding: 10px;
	}

	.faq-item.active+.faq-answer {
		display: block;
	}

	@media (max-width: 768px) {
		.faq-container {
			flex-direction: column;
		}

		.faq-left,
		.faq-right {
			width: 100%;
		}
	}
</style>

<?php $__env->startSection('content'); ?>

	<!-- Black Strip Banner -->


	<!-- Hero Section -->
	<div class="hero-section">
		<h1>Print Smarter. Print Better.</h1>
		<p>At <strong>Nuvem Print</strong>, getting the perfect print is easier than ever. From instant quotes to tailored
			options, we help you choose the right materials, finishes, and formats for your project. Whether it’s books,
			flyers, posters, or banners, our advanced printing ensures professional quality every time.</p>
		<!--<div class="hero-input">-->
		<!--<input type="text" placeholder="Type a project idea and I'll help you bring it to life...">-->
		<!--	<button>Get Started <i class="fa fa-arrow-right"></i></button>-->
		<!--</div>-->
		<div class="banner-part-button">
			<a href="<?php echo e(route('all-products')); ?>">
				<button>Get Started <i class="fa fa-arrow-right"></i></button>
			</a>

		</div>
	</div>
	<div class="section-container">
		<div class="container">
			<h1 class="main-title">From Ideas to Print – Everything You Need Here</h1>
			<p class="subtitle">Bring your vision to life with high-quality printing solutions tailored to your needs. Fast,
				reliable, and all in one place – from concept to finished product.</p>

			<div class="tab-buttons">
				<button class="tab-button active" data-tab="create">
					<i class="fas fa-edit me-1"></i> Create Quotes
				</button>
				<button class="tab-button" data-tab="print">
					<i class="fas fa-print me-1"></i> Print
				</button>
				<button class="tab-button" data-tab="order">
					<i class="fas fa-share me-1"></i> Customise Order
				</button>
				<button class="tab-button" data-tab="contact">
					<i class="far fa-address-card me-1"></i> Contact Us
				</button>

			</div>

			<!-- Create Tab Content -->
			<div id="create-content" class="content-wrapper active">
				<div class="text-content">
					<h3>Create Quotes Instantly</h3>
					<p>Get quick and accurate quotations for all your printing and publishing needs. Whether it’s
						<strong>book publishing, brochures, magazines, </strong> or any other custom print project,<strong>
							Nuvem Print’s </strong>smart quote system lets you design, customize, and view prices in real
						time. No waiting, no hidden charges—just transparent pricing tailored to your requirements.
					</p>
					<div class="tab-part-button">
						<a href="<?php echo e(route('all-products')); ?>">
							<button><i class="fas fa-edit me-1"></i> Create</button>
						</a>
					</div>

				</div>
				<div class="video-content">
					<video autoplay loop muted playsinline style="height:19rem;">
						<source
							src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/printShareDesign/Create_teal.mp4"
							type="video/mp4">
						Your browser does not support the video tag.
					</video>

				</div>
			</div>

			<!-- Print Tab Content -->
			<div id="print-content" class="content-wrapper">
				<div class="text-content">
					<h3>Print With Perfection</h3>
					<p>Bring your ideas to life with our high-quality printing services. From books and magazines to flyers,
						business cards, and marketing materials, <strong>Nuvem Print</strong> delivers sharp colors, crisp
						details, and flawless finishes. Whatever you need printed, we ensure professional results every
						time—on time.
					</p>
					<div class="tab-part-button">
						<a href="<?php echo e(route('all-products')); ?>">
							<button><i class="fas fa-print me-1"></i> Start Now</button>
						</a>
					</div>

				</div>
				<div class="video-content">
					<video autoplay loop muted playsinline style="height:19rem;">
						<source
							src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/printShareDesign/Create_teal.mp4"
							type="video/mp4">
						Your browser does not support the video tag.
					</video>

				</div>
			</div>

			<!-- Share Tab Content -->
			<div id="order-content" class="content-wrapper">
				<div class="text-content">
					<h3>Custom Orders Made Simple</h3>
					<p>Have a unique project in mind? <strong>Nuvem Prints</strong> offers fully customizable printing and
						publishing solutions tailored to your exact requirements. From special sizes and finishes to
						personalized designs, our team helps you bring your vision to reality. Share your details, and we’ll
						craft a solution that’s as unique as your project.
					</p>
					<div class="tab-part-button">
						<a href="<?php echo e(route('all-products')); ?>">
							<button><i class="fas fa-share me-1"></i> Customise Now</button>
						</a>
					</div>

				</div>
				<div class="video-content">
					<video autoplay loop muted playsinline style="height:19rem;">
						<source
							src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/printShareDesign/Create_teal.mp4"
							type="video/mp4">
						Your browser does not support the video tag.
					</video>

				</div>
			</div>
			<div id="contact-content" class="content-wrapper">
				<div class="text-content">
					<h3>Get in Touch</h3>
					<p>Have questions or ready to start your <strong>printing project? </strong>Reach out to Nuvem Print’s
						friendly team today. Whether you need a quote, guidance on your design, or support with a custom
						order, we’re here to help—fast, easy, and hassle-free.
					</p>
					<div class="tab-part-button">
						<a href="<?php echo e(route('contact-us')); ?>">
							<button><i class="far fa-address-card me-1"></i> Get in Touch</button>
						</a>
					</div>

				</div>
				<div class="video-content">
					<video autoplay loop muted playsinline style="height:19rem;">
						<source
							src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/printShareDesign/Create_teal.mp4"
							type="video/mp4">
						Your browser does not support the video tag.
					</video>

				</div>
			</div>
		</div>
	</div>
	<div class="ideas-to-print-section">
		<h1 class="ideas-to-print-title">From Ideas to Print – Everything You Need Here</h1>
		<div class="ideas-to-print-grid">
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/hardcover.webp"
					alt="Hardcover">
				<h4>Hardback</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="	https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/paperback.webp"
					alt="Paperback">
				<h4>Softback</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/booklets.webp"
					alt="Booklets">
				<h4>Booklets</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/catalogs.webp"
					alt="Catalogs">
				<h4>Catalogue</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/hardcover.webp"
					alt="Hardcover">
				<h4>Brochures</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="	https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/paperback.webp"
					alt="Paperback">
				<h4>Posters</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/booklets.webp"
					alt="Booklets">
				<h4>Banners</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/catalogs.webp"
					alt="Catalogs">
				<h4>Autobiography</h4>
			</div>
		</div>
	</div>

	<div class="printing-made-easy-section">
		<h1 class="printing-made-easy-title">Printing Made Easy - Flexible, Accessible, and Made for You</h1>
		<div class="slider-container">
			<div class="slider">
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/passionProjectsAndPersonalPrinting.webp"
							alt="Authors & Writers">
						<div class="slide-content">
							<h4>Authors & Writers</h4>
							<p>Turn your manuscript into a beautifully printed book with ease—professional quality, ready to
								share with the world.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/entrepreneursAndSmallBusinesses.webp"
							alt="Designers & Illustrators">
						<div class="slide-content">
							<h4>Designers & Illustrators</h4>
							<p>Bring your artwork to life on high-quality prints—perfect colors, crisp details, and stunning
								finishes every time.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/creatorsArtistsAndSelfPublishers.webp"
							alt="Entrepreneurs & Small Businesses">
						<div class="slide-content">
							<h4>Entrepreneurs & Small Businesses</h4>
							<p>From brochures to business cards, print marketing materials that make your brand stand out
								and leave a lasting impression.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/passionProjectsAndPersonalPrinting.webp"
							alt="Students & Educators">
						<div class="slide-content">
							<h4>Students & Educators</h4>
							<p>Create educational materials, notebooks, and projects with professional-quality printing
								that’s easy and affordable.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/entrepreneursAndSmallBusinesses.webp"
							alt="Self-Publishers & Hobbyists">
						<div class="slide-content">
							<h4>Self-Publishers & Hobbyists</h4>
							<p>Print, sell, and showcase your creations—Nuvem Print helps you turn passion projects into
								tangible products.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-nav">
				<button class="prev">&lt;</button>
				<button class="next">&gt;</button>
			</div>
		</div>
	</div>
	<section class="faq-section">
		<div class="faq-container">
			<div class="faq-left">
				<h2>Have Questions?<br>We Got Answers!</h2>
				<p>Everything you need to know about the product and billing. Can’t find the answer you’re looking for?
					Check
					out FAQ Page.</p>
			</div>
			<div class="faq-right">
				<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="faq-item"> <?php echo e(Str::limit($faq->question, 60)); ?> <span>+</span></div>
					<div class="faq-answer"><?php echo $faq->answer; ?></div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</section>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const faqItems = document.querySelectorAll('.faq-item');
			faqItems.forEach(item => {
				item.addEventListener('click', () => {
					// Close all other items
					faqItems.forEach(otherItem => {
						if (otherItem !== item) {
							otherItem.classList.remove('active');
							const otherAnswer = otherItem.nextElementSibling;
							if (otherAnswer && otherAnswer.classList.contains('faq-answer')) {
								otherAnswer.style.display = 'none';
							}
						}
					});

					// Toggle the clicked item
					item.classList.toggle('active');
					const answer = item.nextElementSibling;
					if (answer && answer.classList.contains('faq-answer')) {
						answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
					}
				});
			});
		});
	</script>

	<script>
		const slider = document.querySelector('.slider');
		const slides = document.querySelectorAll('.slide');
		const prevBtn = document.querySelector('.prev');
		const nextBtn = document.querySelector('.next');
		let currentIndex = 0;
		const totalSlides = slides.length / 2; // Original slides count

		function updateSlider() {
			const offset = -currentIndex * 33.33;
			slider.style.transform = `translateX(${offset}%)`;
			// Reset to cloned slides when reaching the end
			if (currentIndex >= totalSlides) {
				setTimeout(() => {
					slider.style.transition = 'none';
					currentIndex = 0;
					slider.style.transform = `translateX(0)`;
					setTimeout(() => {
						slider.style.transition = 'transform 0.5s ease';
					}, 50);
				}, 500);
			}
			// Reset to original slides when going backward from start
			if (currentIndex < 0) {
				setTimeout(() => {
					slider.style.transition = 'none';
					currentIndex = totalSlides - 1;
					slider.style.transform = `translateX(${-(currentIndex * 33.33)}%)`;
					setTimeout(() => {
						slider.style.transition = 'transform 0.5s ease';
					}, 50);
				}, 500);
			}
		}

		nextBtn.addEventListener('click', () => {
			currentIndex++;
			updateSlider();
		});

		prevBtn.addEventListener('click', () => {
			currentIndex--;
			updateSlider();
		});

		// Auto slide every 5 seconds
		let autoSlide = setInterval(() => {
			currentIndex++;
			updateSlider();
		}, 5000);
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\nuvem_prints\resources\views/front/index.blade.php ENDPATH**/ ?>