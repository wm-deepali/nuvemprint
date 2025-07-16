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
          <li class="breadcrumb-item active">Pricing Rules Listing</li>
          </ol>
        </div>
        </div>
      </div>
      </div>

      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="{{ route('admin.pricing-rules.create') }}" class="btn-icon btn btn-primary btn-round btn-sm">Add
        Pricing Rule</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pricing Rules Listing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="quote-table">
            <thead>
            <tr>
              <th>ID</th>
              <th>Subcategory</th>
              <th colspan="3">Quantity Range & Base Price</th>
              <th>Attributes</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($rules as $rule)
          <tr>
            <td>{{ $rule->id }}</td>
            <td>
            {{ $rule->subcategory->name ?? '-' }}<br>
            <small>Cat: {{ $rule->category->name ?? '-' }}</small>
            </td>
            <td colspan="3">
            @foreach ($rule->quantities as $qty)
          From <strong>{{ $qty->quantity_from }}</strong> to <strong>{{ $qty->quantity_to }}</strong>:
          ₹{{ number_format($qty->base_price, 2) }}<br>
        @endforeach
            </td>
            <td>
            @forelse ($rule->attributes as $attr)
          <div class="mb-1">
            <strong>{{ $attr->attribute->name ?? '-' }}</strong>:
            {{ $attr->value->value ?? '-' }}
            <span class="text-muted">
            ({{ ucfirst($attr->price_modifier_type) }}
            {{ $attr->price_modifier_type === 'multiply' ? '×' : '₹' }}{{ $attr->price_modifier_value }})
            </span>

            @if($attr->is_default)
          <span class="badge badge-pill badge-primary ml-1" title="Default value">Default</span>
          @endif
          </div>
        @empty
          <span class="text-muted">No Modifiers</span>
        @endforelse

            </td>
            <td>
            <a href="{{ route('admin.pricing-rules.edit', $rule->id) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i> Edit
            </a>
            <button class="btn btn-sm btn-danger" onclick="deletePricingRule({{ $rule->id }})">
            <i class="fas fa-trash"></i> Delete
            </button>
            </td>

          </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">No pricing rules found.</td>
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

    <!-- Add Pricing Rule Modal -->

  </div>
@endsection
@push('scripts')
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    // delete pricing rule
    function deletePricingRule(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "This will delete the pricing rule.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `{{ url('admin/pricing-rules') }}/${id}`,
        type: 'POST',
        data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
        success: function () {
        Swal.fire('Deleted!', '', 'success');
        setTimeout(() => location.reload(), 500);
        }
      });
      }
    });
    }

  </script>
@endpush