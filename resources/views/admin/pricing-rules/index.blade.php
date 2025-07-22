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
              <th>Pages Dragger</th>
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
            <td>
            @if ($rule->pages_dragger_required)
          <div class="mb-1">
            <div class="small text-muted ml-1">
            Required: <strong class="text-success">Yes</strong><br>
            @php
          $depAttr = $dependencyAttrs[$rule->pages_dragger_dependency] ?? null;
          @endphp
            @if ($depAttr)
          Depends on Attribute: <strong>{{ $depAttr->name }}</strong>
          @else
          <em class="text-danger">Invalid Dependency</em>
          @endif
            </div>
          </div>
        @endif

            </td>
            <td>
            @forelse ($rule->attributes as $attr)
          <div class="mb-1">
            <div>
            <strong>{{ $attr->attribute->name ?? '-' }}</strong>:
            {{ $attr->value->value ?? '-' }}

            @if($attr->is_default)
          <span class="badge badge-pill badge-primary ml-1" title="Default value">Default</span>
          @endif
            </div>

            {{-- Price Modifier --}}
            <div class="small text-muted ml-1">
            <em>
            ({{ ucfirst($attr->price_modifier_type) }}
            {{ $attr->price_modifier_type === 'multiply' ? '×' : '' }}
            {{ rtrim(rtrim(number_format($attr->price_modifier_value, 4, '.', ''), '0'), '.') }}
            {{ $attr->base_charges_type === 'percentage' ? '%' : '' }}
            {{ $attr->extra_copy_charge ? '| Extra: ' . rtrim(rtrim(number_format($attr->extra_copy_charge, 4, '.', ''), '0'), '.') : '' }}
            {{ $attr->extra_copy_charge_type === 'percentage' ? '%' : '' }})
            </em>
            </div>

            {{-- Dependency Section --}}
            @if ($attr->dependencies && $attr->dependencies->isNotEmpty())
          <div class="small text-danger ml-1 mt-1">
          <u><strong>Depends on:</strong></u>
          <ul class="mb-0 pl-3">
          @foreach ($attr->dependencies as $dep)
          <li>
          <strong>{{ $dep->parentAttribute->name ?? 'Attribute #' . $dep->parent_attribute_id }}</strong>
          =
          <span
          class="text-dark">{{ $dep->parentValue->value ?? 'Value #' . $dep->parent_value_id }}</span>
          </li>
          @endforeach
          </ul>
          </div>
          @endif

            {{-- Quantity Ranges --}}
            @if ($attr->quantityRanges->isNotEmpty())
          <div class="ml-1 text-muted small mt-1">
          <u>
          {{ $attr->attribute->pricing_basis === 'per_product' ? 'Per Product Pricing:' : 'Per Page Pricing:' }}
          </u>
          <ul class="mb-0 pl-3">
          @foreach ($attr->quantityRanges as $range)
          <li>
          From <strong>{{ $range->quantity_from }}</strong> to
          <strong>{{ $range->quantity_to }}</strong>:
          ₹{{ rtrim(rtrim(number_format($range->price, 4, '.', ''), '0'), '.') }}
          </li>
          @endforeach
          </ul>
          </div>
          @endif
            @if ($attr->is_fixed_per_page && $attr->fixed_per_page_price)
          <div class="ml-1 text-muted small mt-1">
          <u>Fixed Per Page Price:</u>
          ₹{{ rtrim(rtrim(number_format($attr->fixed_per_page_price, 4, '.', ''), '0'), '.') }}
          </div>
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