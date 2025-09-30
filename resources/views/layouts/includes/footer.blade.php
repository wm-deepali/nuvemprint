<div class="footer-top-strip">
	Get double points on your first order when you sign up for an account
	<button>Create an Account</button>
</div>

<footer>
	<div class="footer-container">

		<!-- Left Side Logo & Info -->
		<div class="footer-logo">
			<a href="#" class="logo"><img src="{{ asset('assets') }}/images/NuvemPrint.png"></a>
			<p>Nuvem is a leading online printing platform that creates customisable print products for a global
				audience.
				We make print easy, accessible, and affordable with competitive pricing, exceptional materials and pro
				customer service.</p>

			<div class="social-icons">
				<i class="fa-brands fa-facebook"></i>
				<i class="fa-brands fa-x-twitter"></i>
				<i class="fa-brands fa-instagram"></i>
				<i class="fa-brands fa-youtube"></i>
				<i class="fa-brands fa-tiktok"></i>
			</div>

			<p><strong>TrustScore:</strong> ⭐ 4.6 | 5946 reviews</p>
		</div>

		<!-- Customer Support -->
		<div class="footer-section">
			@php
				use App\Models\ContactInfo;
				$contactFooter = ContactInfo::first();
			@endphp
			<h4>Customer Support Hours</h4>

			<ul>
				<li>Mon - Fri: 24 Hour Service</li>
				<li>Sat - Sun: 10am to 6pm</li>
			</ul>
			<p>Email: {{ $contactFooter->email ?? 'andy@nuvemprint.com' }}<br>Phone:
				{{ $contactFooter->contact_number ?? '01132 874724' }}
			</p>
			<p>Address: {{ $contactFooter->address ?? "Unit 7 Lotherton Way Garforth Leeds LS252JY"}}</p>
		</div>

		@php
			use App\Models\Page;
			$footerPages = Page::where('status', 'published')->get();
		@endphp
		<!-- Home -->
		<div class="footer-section">
			<h4>Home</h4>
			<ul>
				<li><a href="#">Knowledge Base</a></li>
				<li><a href="{{route('blogs')}}">Blog</a></li>
				<li><a href="#">Our Paper Ranges</a></li>
				<li><a href="#">Rewards Program</a></li>
				<li><a href="#">Join Our Team</a></li>
				@foreach($footerPages as $page)
					<li class="mb-1">
						<a href="{{ route('page.show', $page->slug) }}">
							<i class='bx bx-chevron-right'></i> {{ $page->page_name }}
						</a>
					</li>
				@endforeach
			</ul>
		</div>

		<?php $fsubcates = footerSubCategories();
$fcates = footerCategories(); ?>
		<!-- Popular Items -->
		<div class="footer-section">
			<h4>Popular Items</h4>
			<ul>
				@if(isset($fsubcates) && count($fsubcates) > 0)
					@foreach($fsubcates as $fsubcate)
						<li class="mb-1"><a href="{{ route('subcategory-details', ['slug' => $fsubcate->slug]) }}"><i
									class='bx bx-chevron-right'></i>{{$fsubcate->name}}</a></li>
					@endforeach
				@endif

			</ul>
		</div>

		<!-- Categories -->
		<div class="footer-section">
			<h4>Categories</h4>
			<ul>
				@if(isset($fcates) && count($fcates) > 0)
					@foreach($fcates as $fcate)
						<li>
							<a href="{{ route('category-products', ['slug' => $fcate->slug]) }}">{{ $fcate->name }}</a>
						</li>
					@endforeach
				@endif

			</ul>
		</div>

	</div>

	<!-- Bottom Bar -->
	<div class="footer-bottom">
		<p>© 2003 - 2025, Nuvem Print. All rights reserved.</p>
		<div class="payments">
			<img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal">
			<img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Stripe_Logo%2C_revised_2016.svg" alt="Stripe">
			<img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Apple_Pay_logo.svg" alt="Apple Pay">
		</div>
	</div>
</footer>