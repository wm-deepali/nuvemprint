@extends('layouts.new-master')

@section('title')
    Nuvem Prints - All Products
@endsection

@section('content')
    <div class="page-wrapper py-5">
        <div class="container text-center">
            <!-- Page Heading -->
            <h1 class="fw-bold mb-2" style="font-size: 2.2rem;">All Products</h1>
            <p class="text-muted mb-5" style="max-width: 600px; margin: 0 auto;">
                Explore our complete range of products tailored for your business and personal needs.
            </p>

            <!-- Product Grid -->
            <div class="row g-4">
                @if(isset($subcategories) && count($subcategories) > 0)
                    @foreach($subcategories as $subcat)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('subcategory-details', ['slug' => $subcat->slug]) }}" class="text-decoration-none">
                                <div class="card h-100 shadow-sm border-0">
                                    <!-- Fixed height image -->
                                    <div style="height: 200px; overflow: hidden;">
                                        <img src="{{ $subcat->thumbnail
                        ? asset('storage/' . $subcat->thumbnail)
                        : 'https://via.placeholder.com/300x200' }}"
                                            class="card-img-top w-100 h-100" style="object-fit: cover;" alt="{{ $subcat->name }}">
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="card-text fw-semibold text-dark mb-0">
                                            {{ $subcat->name }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>No products available.</p>
                @endif
            </div>
        </div>
    </div>
@endsection