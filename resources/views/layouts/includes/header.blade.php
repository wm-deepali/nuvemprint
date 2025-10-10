<!-- Top Bar -->
<div class="desktop-header">
	<div class="top-bar">
		<div class="container d-flex justify-content-between align-items-center" style="width:1180px;">
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
			<div class="d-flex align-items-center gap-2">
				<span><img
						src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/v2/trustpilot-star-ratings-4-5.svg"
						style="width: 130px;"> 4.6</span>
				<div class="vertical-line"></div>
				<a href="{{ Route('contact-us') }}">Contact Us</a>
				<div class="vertical-line"></div>
				<a href="/all-products">Print Samples</a>
				<div class="vertical-line"></div>
				<a href="{{route('faq')}}">FAQ</a>
				<div class="vertical-line"></div>
			@php
					use App\Models\DeliveryCharge;
					$deliveryCharges = DeliveryCharge::all();
					$uniqueDeliveryCharges = $deliveryCharges->unique('title')->values();
				@endphp

			<div class="custom-select1" id="countrySelect">
					<span>
						@if($uniqueDeliveryCharges->count() > 0)
							<img
								src="{{ $uniqueDeliveryCharges->first()->image ? asset('storage/' . $uniqueDeliveryCharges->first()->image) : URL::asset('assets/images/united-kingdom.png') }}">
							{{ $uniqueDeliveryCharges->first()->title }}
						@else
							<img src="{{ URL::asset('assets/images/united-kingdom.png') }}">
							United Kingdom
						@endif
						<i class="fa-solid fa-chevron-down" style="font-size:12px"></i>
					</span>
					<div class="options">
						@foreach($uniqueDeliveryCharges as $charge)
							<div class="option" data-id="{{ $charge->id }}" data-title="{{ $charge->title }}"
								data-image="{{ $charge->image ? asset('storage/' . $charge->image) : URL::asset('assets/images/default.png') }}">
								<img src="{{ $charge->image ? asset('storage/' . $charge->image) : URL::asset('assets/images/default.png') }}"
									alt="{{ $charge->title }}">
								{{ $charge->title }}
							</div>

						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Main Header -->
	<header class="border-bottom pt-3">
		<div class="container d-flex justify-content-between align-items-center" style="width:1180px;">
			<a href="{{ route('home') }}" class="logo"><img src="{{ asset('assets') }}/images/NuvemPrint.png"></a>
			<a href="{{ route('all-products')}}">
				<button class="btn btn-products">All Products</button>
			</a>
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
							<li><a class="dropdown-item" href="{{route('account-dashboard')}}"
									style="color:gray;">Dashboard</a>
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
		    <div class=" " style="width:1180px;display:flex; margin:auto;margin-top:0px;">

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
			</div>
		</div> <!-- ðŸ”¹ properly closed mega-dropdown -->

	</header>
</div>
<!-- Mobile Header -->
<div class="mobile-header d-flex justify-content-between align-items-center ">
	<div class="d-flex gap-3">
		<button class="menu-toggle" id="openMenu" style="border:none;background:#fff;">
			<i class="fa-solid fa-bars" style="font-size:22px;"></i>
		</button>
		<!-- Logo -->
		<a href="/" class="mobile-logo">
			<img src="{{ asset('assets/images/NuvemPrint.png') }}" alt="Logo" style="height:30px;">
		</a>
	</div>
	<!-- Menu Icon -->
	<div class="header-icons d-flex align-items-center">
		<a href="#"><i class="fa-regular fa-circle-question"></i></a>
		<a href="{{ route('cart.show') }}"><i class="fa-solid fa-cart-shopping"></i></a>
		@if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->id != "")

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle dropdown-toggle-nocaret cart-link" href="#" data-bs-toggle="dropdown">
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

<!-- Sidebar Menu -->
<div class="mobile-sidebar" id="mobileSidebar">
	<div class="sidebar-header d-flex justify-content-between align-items-center p-4">
		<img src="{{ asset('assets/images/NuvemPrint.png') }}" alt="Logo" style="height:27px;">
		<button class="close-btn" id="closeMenu" style="border:none;background:#fff; color:red;"><i
				class="fa-solid fa-xmark"></i></button>
	</div>
	<hr style="margin-top:0px;">

	<div class="sidebar-body">
		<!-- Main Menus -->
		<ul class="mobile-menu">
			@foreach($menucats as $menucat)
				<li class="menu-item">
					<div class="menu-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
						data-bs-target="#submenu-{{ $menucat->id }}">
						<span>{{ $menucat->name }}</span>
						<i class="fa-solid fa-chevron-down"></i>
					</div>

					<!-- Submenu -->
					<div class="collapse submenu" id="submenu-{{ $menucat->id }}">
						@if(isset($menucat->subcategories) && count($menucat->subcategories) > 0)
							@foreach($menucat->subcategories as $subcat)
								<a href="{{ route('subcategory-details', ['slug' => $subcat->slug]) }}"
									class="submenu-item d-flex align-items-center">
									<img src="{{ $subcat->thumbnail ? asset('storage/' . $subcat->thumbnail) : 'https://via.placeholder.com/60x50' }}"
										alt="{{ $subcat->name }}">
									<span>{{ $subcat->name }}</span>
								</a>
							@endforeach
						@endif
					</div>
				</li>
			@endforeach
		</ul>

		<!-- Other Menus -->
		<!--<div class="extra-links mt-3">-->
		<!--    <a href="{{ Route('contact-us') }}">Contact Us</a>-->
		<!--    <a href="#">Print Samples</a>-->
		<!--    <a href="#">Rewards</a>-->
		<!--</div>-->

		<!-- Contact + Socials -->
		<div class="contact-info mt-4">
			@if($headerContact)
				<p><i class="fa-solid fa-phone"></i> {{ $headerContact->contact_number }}</p>
				<p><i class="fa-solid fa-envelope"></i> {{ $headerContact->email ?? 'info@nuvemprints.com' }}</p>
				<p><i class="fa-solid fa-location-dot"></i> {{ $headerContact->address ?? '123 Main Street, London' }}</p>
			@endif
		</div>

		<div class="social-icons mt-3">
			<i class="fa-brands fa-facebook"></i>
			<i class="fa-brands fa-x-twitter"></i>
			<i class="fa-brands fa-instagram"></i>
			<i class="fa-brands fa-youtube"></i>
			<i class="fa-brands fa-tiktok"></i>
			<i class="fa-brands fa-whatsapp"></i>
		</div>
	</div>
</div>
<div class="promo-strip">
    <a href="{{ route('authentication-signup') }}" class="promo-link" style="text-decoration:none;"><span>Sign up</span></a> 
    for an account and earn <span>Extra</span> Discounts on your first order.
</div>

<!-- Overlay -->
<div class="overlay" id="overlay"></div>


<script>
	document.getElementById('openMenu').addEventListener('click', function () {
		document.getElementById('mobileSidebar').classList.add('active');
		document.getElementById('overlay').classList.add('active');
	});

	document.getElementById('closeMenu').addEventListener('click', function () {
		document.getElementById('mobileSidebar').classList.remove('active');
		document.getElementById('overlay').classList.remove('active');
	});

	document.getElementById('overlay').addEventListener('click', function () {
		document.getElementById('mobileSidebar').classList.remove('active');
		document.getElementById('overlay').classList.remove('active');
	});

</script>

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


	
	document.addEventListener("DOMContentLoaded", function () {
    const options = document.querySelectorAll('#countrySelect .option');
    const dropdownSpan = document.querySelector('#countrySelect > span');
    const localStorageKey = 'selectedDeliveryCharge';

    // Load any existing saved selection
    let savedSelection = JSON.parse(localStorage.getItem(localStorageKey));

    // If nothing saved yet, auto-save the first option as default
    if (!savedSelection && options.length > 0) {
        const firstOption = options[0];
        savedSelection = {
            id: firstOption.getAttribute('data-id'),
            title: firstOption.getAttribute('data-title'),
            image: firstOption.getAttribute('data-image')
        };
        localStorage.setItem(localStorageKey, JSON.stringify(savedSelection));
    }

    // Update dropdown display from saved selection
    if (savedSelection) {
        updateDropdownDisplay(savedSelection);
    }

    // Handle option clicks
    options.forEach(option => {
        option.addEventListener('click', function () {
            const selectedData = {
                id: this.getAttribute('data-id'),
                title: this.getAttribute('data-title'),
                image: this.getAttribute('data-image')
            };

            const isDifferent = !savedSelection || savedSelection.id !== selectedData.id;

            // Save new selection
            localStorage.setItem(localStorageKey, JSON.stringify(selectedData));

            // Update dropdown UI
            updateDropdownDisplay(selectedData);

            // Reload page only if different
            if (isDifferent) {
                window.location.reload();
            }
        });
    });

    // Helper function to show selected country in top bar
    function updateDropdownDisplay(selection) {
        dropdownSpan.innerHTML = `
            <img src="${selection.image}" alt="${selection.title}">
            ${selection.title}
            <i class="fa-solid fa-chevron-down" style="font-size:12px"></i>
        `;
    }
});


</script>