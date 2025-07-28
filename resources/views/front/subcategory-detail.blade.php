@extends('layouts.new-master')

@section('title')
	Nuvem Prints
@endsection

@push('after-styles')
	<style>
		.tab-container {
			margin-top: 1.5rem;
			background-color: #fff;
			border-radius: 8px;
			padding: 1.5rem;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
		}

		.tab-buttons {
			display: flex;
			gap: 0.5rem;
			margin-bottom: 1rem;
		}

		.tab-buttons button {
			padding: 0.5rem 1rem;
			border: 1px solid #ccc;
			background-color: #f5f7fa;
			cursor: pointer;
			border-radius: 4px;
			font-weight: 500;
		}

		.tab-buttons button.active {
			background-color: #f42b5b;
			color: white;
			border-color: #f42b5b;
		}

		.tab-content {
			display: none;
			padding: 1rem;
			background-color: #f9f9f9;
			border-radius: 4px;
		}

		.tab-content.active {
			display: block;
		}
	</style>
@endpush

@section('content')
	<div class="page-wrapper">
		<div class="page-content">
			<!--start breadcrumb-->
			<section class="py-3 border-bottom d-none d-md-flex">
				<div class="container">
					<div class="page-breadcrumb d-flex align-items-center">
						<h3 class="breadcrumb-title pe-3">{{$subcategory->name}}</h3>
						<div class="ms-auto">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i>
											Home</a>
									</li>
									<!-- <li class="breadcrumb-item"><a href="javascript:;">Shop</a>
											</li> -->
									<li class="breadcrumb-item active" aria-current="page">Product Details</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</section>

			<!--start product detail-->
			<section class="py-4">
				<div class="container">
					<div class="product-detail-card">
						<div class="product-detail-body">
							<div class="row g-0">
								<div class="col-12 col-lg-5">
									<div class="image-zoom-section">
										<?php $galleries = $subcategory->gallery; ?>
										@if(isset($galleries) && count($galleries) > 0)
											<div class="product-gallery owl-carousel owl-theme border mb-3 p-3"
												data-slider-id="1">
												@foreach($galleries as $y => $gallery)

													<div class="item">
														<img src="{{ asset('storage/' . $gallery) }}" class="img-fluid" alt="">
													</div>
												@endforeach


											</div>
										@endif
										@if(isset($galleries) && count($galleries) > 0)
											<div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
												@foreach($galleries as $y => $gallery)
													<button class="owl-thumb-item">
														<img src="{{ asset('storage/' . $gallery) }}" class="" alt="">
													</button>
												@endforeach
											</div>
										@endif
									</div>
								</div>
								<div class="col-12 col-lg-7">
									<div class="product-info-section p-3">
										<h3 class="mt-3 mt-lg-0 mb-0">{{$subcategory->name}}</h3>

										<div class="mt-3">
											<h6>Discription :</h6>
											<p class="mb-0">{{$subcategory->description}}</p>
										</div>

										<div class="row row-cols-auto align-items-center mt-3">

										</div>

									</div>
								</div>
							</div>
							<!--end row-->
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<div class="container py-5">
		@if($subcategory->calculator_required)
			@include('front.calculator')
		@endif

		<div class="tab-container">
			<div class="tab-buttons">
				<button class="active" data-tab="tab-information">Information</button>
				<button data-tab="tab-available-size">Available Sizes</button>
				<button data-tab="tab-binding-options">Binding Options</button>
				<button data-tab="tab-paper-types">Paper Types</button>
				<button data-tab="tab-faqs">FAQs</button>
			</div>
			<div class="tab-content active" id="tab-specifications">
				<h4>Information</h4>
				<p>{!! $subcategory->details->information !!}</p>
			</div>
			<div class="tab-content" id="tab-available-size">
				<h4>Available Sizes</h4>
				<p>{!! $subcategory->details->available_sizes !!}</p>
			</div>
			<div class="tab-content" id="tab-binding-options">
				<h4>Binding Options</h4>
				<p>{!! $subcategory->details->binding_options !!}</p>
			</div>
			<div class="tab-content" id="tab-paper-types">
				<h4>Paper Types</h4>
				<p>{!! $subcategory->details->paper_types !!}</p>
			</div>
			<div class="tab-content" id="tab-faqs">
				<h4>Frequently Asked Questions</h4>
				<p>Common questions about booklet printing, delivery, and customization options.</p>
			</div>

		</div>
	</div>
	<section class="py-4">
		<div class="container">
			<div class="d-flex align-items-center">
				<h5 class="text-uppercase mb-0">Related Product</h5>
				<a href="" class="btn btn-light ms-auto rounded-0">View All<i class='bx bx-chevron-right'></i></a>
			</div>
			<hr />
			<div class="product-grid">
				<div class="browse-category owl-carousel owl-theme">
					<div class="item">
						<div class="card rounded-0 product-card border" style="background-color: rgb(0 0 0 / 20%);">
							<div class="card-body c-img">
								<img src="{{ URL::asset('assets/images/booklets.png')}}" class="img-fluid" alt="...">
							</div>
							<div class="card-footer text-center">
								<h6 class="mb-1 text-uppercase text-gray">{{$subcategory->name}}</h6>
								<!-- <p class="mb-0 font-12 text-uppercase">10 Products</p> -->
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card rounded-0 product-card border">
							<div class="card-body c-img">
								<img src="{{ URL::asset('assets/images/brochure.png')}}" class="img-fluid" alt="...">
							</div>
							<div class="card-footer text-center">
								<h6 class="mb-1 text-uppercase text-gray">Brochures</h6>
								<!-- <p class="mb-0 font-12 text-uppercase">8 Products</p> -->
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card rounded-0 product-card border">
							<div class="card-body c-img">
								<img src="{{ URL::asset('assets/images/Catalog.png')}}" class="img-fluid" alt="...">
							</div>
							<div class="card-footer text-center">
								<h6 class="mb-1 text-uppercase text-gray">Catalogues</h6>
								<!-- <p class="mb-0 font-12 text-uppercase">14 Products</p> -->
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card rounded-0 product-card border">
							<div class="card-body c-img">
								<img src="{{ URL::asset('assets/images/magzin.png')}}" class="img-fluid" alt="...">
							</div>
							<div class="card-footer text-center">
								<h6 class="mb-1 text-uppercase text-gray">Magazines</h6>
								<!-- <p class="mb-0 font-12 text-uppercase">6 Products</p> -->
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card rounded-0 product-card border">
							<div class="card-body c-img">
								<img src="{{ URL::asset('assets/images/business.png')}}" class="img-fluid" alt="...">
							</div>
							<div class="card-footer text-center">
								<h6 class="mb-1 text-uppercase text-gray">Business Cards</h6>
								<!-- <p class="mb-0 font-12 text-uppercase">6 Products</p> -->
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card rounded-0 product-card border">
							<div class="card-body c-img">
								<img src="{{ URL::asset('assets/images/magzin.png')}}" class="img-fluid" alt="...">
							</div>
							<div class="card-footer text-center">
								<h6 class="mb-1 text-uppercase text-gray">Magazines</h6>
								<!-- <p class="mb-0 font-12 text-uppercase">6 Products</p> -->
							</div>
						</div>
					</div>





				</div>
			</div>
		</div>
	</section>


@endsection