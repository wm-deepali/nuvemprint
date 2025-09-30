@extends('layouts.new-master')

@section('title')
	Nuvem Prints
@endsection


@section('content')

	<!-- Black Strip Banner -->
	<div class="promo-strip">
		<span>Sign up</span> for an account and earn <span>2×</span> points on your first order.
	</div>

	<!-- Hero Section -->
	<div class="hero-section">
		<h1>The Smarter Way to Print</h1>
		<p>Get fast quotes, expert advice, and easily find the perfect options for your project. Tell me what you need, like
			"Quote for 100 flyers" or "Best paper for a colouring book".</p>
		<div class="hero-input">
			<input type="text" placeholder="Type a project idea and I'll help you bring it to life...">
			<button><i class="fa fa-arrow-right"></i></button>
		</div>
		<div class="banner-part-button">
			<button>I want to order...</button>
			<button>I want to Publish...</button>
			<button>I need help with...</button>
		</div>
	</div>
	<div class="section-container">
		<div class="container">
			<h1 class="main-title">Everything You Need - All in One Place</h1>
			<p class="subtitle">See how Mixam simplifies every step of your creative journey with powerful tools, premium
				printing, and seamless workflows.</p>

			<div class="tab-buttons">
				<button class="tab-button active" data-tab="create">
					<i class="fas fa-edit me-1"></i> Create
				</button>
				<button class="tab-button" data-tab="print">
					<i class="fas fa-print me-1"></i> Print
				</button>
				<button class="tab-button" data-tab="share">
					<i class="fas fa-share me-1"></i> Share
				</button>
			</div>

			<!-- Create Tab Content -->
			<div id="create-content" class="content-wrapper active">
				<div class="text-content">
					<h3>Design without Limits. Create Beautiful, Print-Ready files in Minutes.</h3>
					<p>Whether you're starting from scratch or need to make final edits to your existing artwork file,
						Mixam's
						free design tools make it effortless to create professional, print-ready files-no experience needed.
					</p>

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
					<h3>Premium Printing. High-Quality Results Every Time.</h3>
					<p>Get professional printing services with a wide range of options. From business cards to large format
						prints, we handle it all with precision and speed.</p>
					<p>Choose from premium paper stocks, finishes, and binding to make your project stand out.</p>
					<ul>
						<li>Multiple paper options</li>
						<li>Fast turnaround times</li>
						<li>Quality assurance</li>
					</ul>
				</div>
				<div class="image-content">
					<div class="floating-ui">
						<ul>
							<li>Paper selection</li>
							<li>Finishing options</li>
							<li>Proofing tools</li>
						</ul>
					</div>
					<div class="image-stack">
						<div class="image-item">
							<img src="https://via.placeholder.com/200x150/FFEAA7/000000?text=Print+Preview"
								alt="Print Image 1">
						</div>
						<div class="image-item">
							<img src="https://via.placeholder.com/200x150/DDA0DD/000000?text=Paper+Stock"
								alt="Print Image 2">
						</div>
						<div class="image-item">
							<img src="https://via.placeholder.com/200x150/98D8C8/000000?text=Finished+Product"
								alt="Print Image 3">
						</div>
					</div>
				</div>
			</div>

			<!-- Share Tab Content -->
			<div id="share-content" class="content-wrapper">
				<div class="text-content">
					<h3>Share & Sell. Reach Your Global Audience.</h3>
					<p>Easily share your designs and sell your printed products through our integrated platform. Connect
						with
						customers worldwide effortlessly.</p>
					<p>From social sharing to e-commerce integration, everything is designed for seamless distribution.</p>
					<ul>
						<li>Social media integration</li>
						<li>Online storefront</li>
						<li>Analytics dashboard</li>
					</ul>
				</div>
				<div class="image-content">
					<div class="floating-ui">
						<ul>
							<li>Share links</li>
							<li>Sell directly</li>
							<li>Track sales</li>
						</ul>
					</div>
					<div class="image-stack">
						<div class="image-item">
							<img src="https://via.placeholder.com/200x150/FD79A8/FFFFFF?text=Share+Icon"
								alt="Share Image 1">
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ideas-to-print-section">
		<h1 class="ideas-to-print-title">From Ideas to Print - See what's Possible</h1>
		<div class="ideas-to-print-grid">
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/hardcover.webp"
					alt="Hardcover">
				<h4>Hardcover</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="	https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/paperback.webp"
					alt="Paperback">
				<h4>Paperback</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/booklets.webp"
					alt="Booklets">
				<h4>Booklets</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/catalogs.webp"
					alt="Catalogs">
				<h4>Catalogs</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/hardcover.webp"
					alt="Hardcover">
				<h4>Hardcover</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="	https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/paperback.webp"
					alt="Paperback">
				<h4>Paperback</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/booklets.webp"
					alt="Booklets">
				<h4>Booklets</h4>
			</div>
			<div class="ideas-to-print-card">
				<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/products/us/catalogs.webp"
					alt="Catalogs">
				<h4>Catalogs</h4>
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
							alt="Nonprofits">
						<div class="slide-content">
							<h4>Nonprofits & Community Organizations</h4>
							<p>Amplify your cause with affordable, high-quality printing.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/entrepreneursAndSmallBusinesses.webp"
							alt="Creators">
						<div class="slide-content">
							<h4>Creators, Artists & Self-Publishers</h4>
							<p>Print, sell, and profit—bring your creative vision to life with professional quality
								printing.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/creatorsArtistsAndSelfPublishers.webp"
							alt="Businesses">
						<div class="slide-content">
							<h4>Large Businesses & Enterprises</h4>
							<p>Scale your business with high-volume printing services customized for your needs.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/passionProjectsAndPersonalPrinting.webp"
							alt="Nonprofits">
						<div class="slide-content">
							<h4>Nonprofits & Community Organizations</h4>
							<p>Amplify your cause with affordable, high-quality printing.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/entrepreneursAndSmallBusinesses.webp"
							alt="Creators">
						<div class="slide-content">
							<h4>Creators, Artists & Self-Publishers</h4>
							<p>Print, sell, and profit—bring your creative vision to life with professional quality
								printing.</p>
						</div>
					</div>
				</div>
				<div class="slide">
					<div class="slide-card">
						<img src="https://d1e8vjamx1ssze.cloudfront.net/public/images/homepage/v2/people/creatorsArtistsAndSelfPublishers.webp"
							alt="Businesses">
						<div class="slide-content">
							<h4>Large Businesses & Enterprises</h4>
							<p>Scale your business with high-volume printing services customized for your needs.</p>
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
				<div class="faq-item">Can I see a sample of my print before placing a large order? <span>+</span></div>
				<div class="faq-item">How long does production and shipping take? <span>+</span></div>
				<div class="faq-item">What is your returns and refund policy? <span>+</span></div>
				<div class="faq-item">How does Mixam's PrintLink work? <span>+</span></div>
				<div class="faq-item">What's the difference between PrintLink and bulk printing? <span>+</span></div>
			</div>
		</div>
	</section>

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
@endsection