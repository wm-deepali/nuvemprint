@extends('layouts.master')

@section('content')

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
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Customer Listing</a></li>
          <li class="breadcrumb-item active">Customer Detail</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Customer Detail</h4>
        </div>
        <div class="card-body">
          <div class="row">
          <div class="col-md-2 text-center">
            <img
            src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=2832"
            class="profile-img mb-3" alt="Customer Profile" style="width:110px;">
          </div>
          <div class="col-md-8" style="margin-left:-30px;">
            <h5>{{ $customer->first_name }} {{ $customer->last_name }}</h5>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Contact Number:</strong> {{ $customer->mobile }}</p>
            <p><strong>Full Address:</strong> {{ $customer->address }}</p>
          </div>
          </div>
          <hr>
          <h5 class="mt-3">Enquiries</h5>
          <div class="table-responsive">
          <table class="table" id="enquiries-table">
            <thead>
            <tr>
              <th>Date & Time</th>
              <th>Quote Number</th>
              <th>Product</th>
              <th>Estimated Cost</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($customer->quotes as $quote)
          <tr>
            <td>{{ $quote->created_at->format('Y-m-d H:i') }}</td>
            <td>#{{ $quote->quote_number }}</td>
            @php
          $subcategory = optional($quote->items->first())->subcategory;
          $category = $subcategory?->categories->first();
        @endphp
            <td>
            {{ $category?->name ?? '-' }} >
            {{ $subcategory?->name ?? '-' }}
            </td>
            <td>£{{ number_format($quote->grand_total, 2) }}</td>
            <td>
            <a href="{{ route('admin.quote.show', $quote->id) }}" class="btn btn-sm btn-info">View Quotation</a>
            </td>
          </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center">No quotes found.</td>
        </tr>
        @endforelse
            </tbody>

          </table>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection