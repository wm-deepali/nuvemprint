<!-- Top Bar -->
<div class="top-bar">
	<div class="container d-flex justify-content-between align-items-center">
		<div class="d-flex gap-2">
			@php
				use App\Models\ContactInfo;
				$headerContact = ContactInfo::where('show_on_header', 1)->first();
			@endphp

			@if($headerContact)
				<span style="border-right: 1px solid #44444448;padding-right: 10px;"><i class="fa-solid fa-phone"
						style="font-size: 16px;"></i> {{ $headerContact->contact_number ?? '+01132 874724'}}</span>
			@endif
			<i class="fa-brands fa-facebook"></i>
			<i class="fa-brands fa-x-twitter"></i>
			<i class="fa-brands fa-instagram"></i>
			<i class="fa-brands fa-youtube"></i>
			<i class="fa-brands fa-tiktok"></i>
			<i class="fa-brands fa-whatsapp"></i>
		</div>
		<div class="d-flex align-items-center gap-3">
			<span><img src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/v2/trustpilot-star-ratings-4-5.svg"
					style="width: 130px;"> 4.6</span>

			<a href="{{ Route('contact-us') }}">Contact Us</a>
			<a href="#">Print Samples</a>
			<a href="#">Rewards</a>
			<div class="custom-select" id="countrySelect">
				<span><img src="{{ URL::asset('assets/images/united-kingdom.png') }}"> United Kingdom</span>
				<div class="options">
					<div class="option"><img src="{{ URL::asset('assets/images/united-kingdom.png') }}"> United Kingdom
					</div>
					<div class="option"><img src="{{ URL::asset('assets/images/united-states.png') }}"> USA</div>
					<div class="option"><img src="{{ URL::asset('assets/images/european-union.png') }}"> Europe</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Main Header -->
<header class="border-bottom pt-3">
	<div class="container d-flex justify-content-between align-items-center">
		<a href="#" class="logo"><img src="{{ asset('assets') }}/images/NuvemPrint.png"></a>
		<button class="btn btn-products">All Products</button>
		<div class="search-container">
			<input type="text" class="form-control" placeholder="Search...">
			<button><i class="fa fa-search"></i></button>
		</div>
		<div class="header-icons d-flex align-items-center">
			<a href="#"><i class="fa-regular fa-circle-question"></i></a>
			<a href="{{ route('cart.show') }}"><i class="fa-solid fa-cart-shopping"></i></a>
			@if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->id != "")

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret cart-link" href="#"
						data-bs-toggle="dropdown">
						<i class='bx bx-user'></i> <i class='bx bx-chevron-down'></i>
					</a>
					<ul class="dropdown-menu" style="background:#000;">
						<li><a class="dropdown-item" href="{{route('account-dashboard')}}" style="color:gray;">Dashboard</a>
						</li>
						<li><a class="dropdown-item" href="{{route('account-logout')}}" style="color:gray;">Logout</a>
						</li>
					</ul>
				</li>
			@else
				<a href="{{route('authentication-signin')}}"><i class="fa-regular fa-user"></i></a>
			@endif
		</div>
	</div>
	<nav class="main-nav mt-3">
		<?php $menucats = menuCategories(); ?>
		@if(isset($menucats) && count($menucats) > 0)
			<ul class="nav justify-content-center">
				@foreach($menucats as $index => $menucat)
					<li class="nav-item"><a href="#" class="nav-link" data-cat-id="cat-{{ $menucat->id }}"
							data-cat-id="cat-{{ $menucat->id }}">
							{{ $menucat->name }}</a>
					</li>
				@endforeach
			</ul>
		@endif
	</nav>

	<!-- Mega Menu -->
	<div class="mega-dropdown">

		<div class="dropdown-left">
			<ul>
				<li class="active" data-cat-id="all">All Products</li>
				@foreach($menucats as $menucat)
					<li data-cat-id="cat-{{ $menucat->id }}">
						{{ $menucat->name }}
					</li>
				@endforeach
			</ul>
		</div>

		<div class="dropdown-right">
			<!-- Default Content -->
			<div class="content" id="all">
				<h4>All Products</h4>
				<div class="dropdown-items">
					@if(isset($menucats) && count($menucats) > 0)
						@foreach($menucats as $menucat)
							@if(isset($menucat->subcategories) && count($menucat->subcategories) > 0)
								@foreach($menucat->subcategories as $subcat)
									<div class="item" data-url="{{ route('subcategory-details', ['slug' => $subcat->slug]) }}">
										<img src="{{ $subcat->thumbnail
									? asset('storage/' . $subcat->thumbnail)
									: 'https://via.placeholder.com/120x100' }}" alt="{{ $subcat->name }}">
										<p>{{ $subcat->name }}</p>
									</div>
								@endforeach
							@endif
						@endforeach
					@else
						<p>No subcategories available</p>
					@endif
				</div>
			</div>


			@if(isset($menucats) && count($menucats) > 0)
				@foreach($menucats as $menucat)
					<div class="content" id="cat-{{ $menucat->id }}" style="display:none;">
						<h4>{{ $menucat->name }}</h4>
						<div class="dropdown-items">


							@if(isset($menucat->subcategories) && count($menucat->subcategories) > 0)
								@foreach($menucat->subcategories as $subcat)
									<div class="item" data-url="{{ route('subcategory-details', ['slug' => $subcat->slug]) }}">
										<img src="{{ $subcat->thumbnail
									? asset('storage/' . $subcat->thumbnail)
									: 'https://via.placeholder.com/120x100' }}" alt="{{ $subcat->name }}">
										<p>{{ $subcat->name }}</p>
									</div>

								@endforeach
							@else
								<p>No subcategories available</p>
							@endif
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div> <!-- 🔹 properly closed mega-dropdown -->

</header>

<script>
	document.addEventListener("DOMContentLoaded", function () {
		const megaDropdown = document.querySelector(".mega-dropdown");
		megaDropdown.style.display = "none";

		const navLinks = document.querySelectorAll(".main-nav .nav-link");
		const menuItems = document.querySelectorAll(".mega-dropdown .dropdown-left li");
		const productBtn = document.querySelector(".btn-products");
		const contents = document.querySelectorAll(".mega-dropdown .content");

		// Show default All Products
		const allContent = document.getElementById("all");
		if (allContent) allContent.style.display = "block";

		// Show selected category/content
		function showCategory(target) {
			contents.forEach(c => c.style.display = "none");
			menuItems.forEach(m => m.classList.remove("active"));
			const targetItem = document.querySelector(`.dropdown-left li[data-cat-id="${target}"]`);
			if (targetItem) targetItem.classList.add("active");

			const targetContent = document.getElementById(target);
			if (targetContent) targetContent.style.display = "block";
		}

		// Toggle mega menu for top nav
		navLinks.forEach(link => {
			link.addEventListener("click", e => {
				e.preventDefault();
				const target = link.getAttribute("data-cat-id");
				const targetContent = document.getElementById(target);

				if (
					megaDropdown.style.display === "flex" &&
					targetContent && targetContent.style.display === "block"
				) {
					megaDropdown.style.display = "none";
					menuItems.forEach(m => m.classList.remove("active"));
				} else {
					megaDropdown.style.display = "flex";
					showCategory(target);
				}
			});
		});

		// Toggle All Products button
		if (productBtn) {
			productBtn.addEventListener("click", () => {
				if (megaDropdown.style.display === "flex") {
					megaDropdown.style.display = "none";
					menuItems.forEach(m => m.classList.remove("active"));
				} else {
					megaDropdown.style.display = "flex";
					showCategory("all");
				}
			});
		}

		// Left category click
		menuItems.forEach(item => {
			item.addEventListener("click", () => {
				const target = item.getAttribute("data-cat-id");
				megaDropdown.style.display = "flex";
				showCategory(target);
			});
		});

		// Subcategory item click
		document.querySelectorAll(".dropdown-items .item").forEach(item => {
			item.addEventListener("click", function (e) {
				e.stopPropagation();
				const url = this.getAttribute("data-url");
				document.querySelectorAll(".dropdown-items .item").forEach(i => i.classList.remove("active"));
				this.classList.add("active");
				if (url) setTimeout(() => window.location.href = url, 150);
			});
			item.style.cursor = "pointer";
		});
	});

</script>