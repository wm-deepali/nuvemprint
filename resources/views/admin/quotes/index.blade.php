@extends('layouts.master')

@section('content')
  <div class="app-content content">
    <div class="content-wrapper">
    <div class="content-header row mb-2">
      <div class="col-md-6">
      <h4 class="mb-0">Order Details</h4>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
      <div class="card-body">

        {{-- Company Logo --}}
        <div class="text-center mb-3">
        <img src="{{ asset('admin_assets/images/logo.png') }}" alt="Company Logo" style="max-width: 200px;">
        </div>

        {{-- Order ID + Status --}}
        <div class="row mb-4">
        <div class="col-md-6">
          <h5><strong>Order ID:</strong> #{{ $quote->quote_number }}</h5>
          <h5>
          <strong>Payment Status:</strong>
          <span class="badge badge-success">Paid</span>
          </h5>
        </div>

        <div class="col-md-6 ">
          <label><strong>Update Status:</strong></label>
          <select class="form-control" id="statusSelect" onchange="handleStatusChange(this)">
          <option value="">Select Status</option>
          <option {{ $quote->status == 'approved' ? 'selected' : '' }} value="approved">Approve Order</option>
          <option {{ $quote->status == 'cancelled' ? 'selected' : '' }} value="cancelled">Cancel Order</option>
          <!-- <option value="process">Process to Department</option> -->
          </select>

          <div id="departmentDropdown" class="mt-2 d-none">
          <label><strong>Select Department:</strong></label>
          <select class="form-control" onchange="showNoteModal(this)">
            <option value="">Select Department</option>
            <option value="department1">Department 1</option>
            <option value="department2">Department 2</option>
            <option value="department3">Department 3</option>
          </select>
          </div>
        </div>
        </div>

        {{-- Customer & Company Info --}}
        <div class="row border p-3 mb-4">
        <div class="col-md-6">
          <h5><strong>Customer Info</strong></h5>
          <p><strong>Name:</strong> {{ $quote->customer->first_name ?? 'N/A' }}
          {{ $quote->customer->last_name ?? '' }}
          </p>
          <p><strong>Contact:</strong> {{ $quote->customer->mobile ?? 'N/A' }}</p>
          <p><strong>Email:</strong> {{ $quote->customer->email ?? 'N/A' }}</p>
          <p><strong>Expected Delivery:</strong>
          {{ \Carbon\Carbon::parse($quote->delivery_date)->format('d F Y') ?? 'N/A' }}</p>
          <p><strong>Date & Time:</strong> {{ $quote->created_at->format('d F Y, h:i A') ?? 'N/A' }}</p>
          <p><strong>Delivery Address:</strong>
          {{ $quote->deliveryAddress->address ?? '' }},
          </p>

        </div>
        <div class="col-md-6 text-right">
          <h5><strong>Company Info</strong></h5>
          <p><strong>Name:</strong> My Company Name</p>
          <p><strong>Contact:</strong> 0-00-000-000</p>
          <p><strong>Email:</strong> yourcompany@gmail.com</p>
          <p><strong>Address:</strong> Company Street, NY 1001-234</p>
          <p><strong>Website:</strong> www.company.com</p>
        </div>
        </div>

        {{-- Quote Items --}}
        {{-- Quote Items --}}
        <h5 class="mb-2">Quote Items</h5>
        <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="thead-light">
          <tr>
            <th style="width: 60%;">Detail</th>
            <th style="width: 20%;">Quantity</th>
            <th style="width: 20%;">Price (£)</th>
          </tr>
          </thead>
          <tbody>
          @forelse($quote->items as $item)
        <tr>
        <td>
        <strong>{{ $item->subcategory->name ?? 'N/A' }}</strong><br>
        {{ $item->subcategory->description ?? 'No description available' }}<br>
        Category: {{ optional($item->subcategory->categories->first())->name ?? 'N/A' }}
        </td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->sub_total, 2) }}</td>
        </tr>
      @empty
        <tr>
        <td colspan="3" class="text-center">No quote items found.</td>
        </tr>
      @endforelse

          {{-- Proofreading price row --}}
          @if($quote->proof_type && $quote->proof_price)
        <tr>
        <td><strong>Proof Type:</strong> {{ ucfirst($quote->proof_type) }}</td>
        <td>—</td>
        <td>{{ number_format($quote->proof_price, 2) }}</td>
        </tr>
      @endif

          </tbody>
        </table>
        </div>



        {{-- Summary --}}
        <div class="row justify-content-end mt-4">
        <div class="col-md-5">
          <table class="table table-borderless">
          <tr>
            <th>Subtotal:</th>
            <td class="text-right">
            £{{ number_format($quote->items->sum('sub_total') + ($quote->proof_price ?? 0), 2) }}</td>
          </tr>
          <tr>
            <th>Delivery Charge:</th>
            <td class="text-right">£{{ number_format($quote->delivery_price, 2) }}</td>
          </tr>
          <tr>
            <th>VAT ({{ $quote->vat_percentage }})%:</th>
            <td class="text-right">£{{ number_format($quote->vat_amount, 2) }}</td>
          </tr>
          <tr class="border-top">
            <th><strong>Grand Total:</strong></th>
            <td class="text-right"><strong>£{{ number_format($quote->grand_total, 2) }}</strong></td>
          </tr>
          </table>
        </div>
        </div>


        {{-- Horizontal Line --}}
        <hr>

        {{-- Customer Documents --}}
        <h5>Customer Documents</h5>
        <div class="table-responsive">
        <table class="table table-bordered mt-2">
          <thead>
          <tr>
            <th>Remarks / Title</th>
            <th>Thumbnail</th>
            <th>View</th>
          </tr>
          </thead>
          <tbody>
          @forelse ($quote->documents as $doc)
          <tr>
          <td>{{ $doc->name ?? 'Untitled' }}</td>
          <td>
          @if(Str::endsWith($doc->path, ['.jpg', '.jpeg', '.png']))
        <img src="{{ asset('storage/' . $doc->path) }}" width="80" />
        @elseif(Str::endsWith($doc->path, '.pdf'))
        <img src="{{ asset('admin_assets/images/pdf.png')}}" width="40" alt="PDF" />
        @elseif(Str::endsWith($doc->path, ['.doc', '.docx']))
        <img src="{{ asset('admin_assets/images/google-docs.png') }}" width="40" alt="Word Doc" />
        @else
        <span class="text-muted">No Preview</span>
        @endif
          </td>
          <td>
          <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="btn btn-sm btn-info">View</a>
          </td>
          </tr>
      @empty
        <tr>
        <td colspan="3" class="text-center">No documents uploaded.</td>
        </tr>
      @endforelse
          </tbody>
        </table>
        </div>


        {{-- Action Buttons --}}
        <div class="row justify-content-center mt-4">
        <div class="col-md-2">
          <a href="{{ route('admin.quotes.download.pdf', $quote->id) }}" class="btn btn-primary btn-block"
          target="_blank">
          Download PDF
          </a>

        </div>
        <div class="col-md-2">
          <button class="btn btn-success btn-block">Send Email</button>
        </div>
        </div>

      </div>
      </div>
    </div>
    </div>
  </div>

  <!-- Notes Modal -->
  <div class="modal fade" id="noteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <form>
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Department Note</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <label><strong>Department Name:</strong></label>
        <input type="text" class="form-control mb-2" readonly value="Auto-filled on select">

        <label><strong>Note:</strong></label>
        <textarea class="form-control" rows="4" placeholder="Enter note for department..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save Note</button>
      </div>
      </div>
    </form>
    </div>
  </div>
@endsection

<!-- Scripts -->
@push('scripts')
  <script>

    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    function handleStatusChange(select) {
    const status = select.value;
    const quoteId = {{ $quote->id }};
    const deptDropdown = document.getElementById('departmentDropdown');

    // Show department dropdown only if "process"
    if (status === 'process') {
      deptDropdown.classList.remove('d-none');
      return;
    } else {
      deptDropdown.classList.add('d-none');
    }

    // Send status change immediately for 'approved' or 'cancelled'
    if (status === 'approved' || status === 'cancelled') {
      updateQuoteStatus(quoteId, status);
    }
    }

    function showNoteModal(select) {
    const department = select.value;
    if (department) {
      document.querySelector('#noteModal input').value = department;
      const modal = new bootstrap.Modal(document.getElementById('noteModal'));
      modal.show();
    }
    }

    function updateQuoteStatus(quoteId, status, department = null) {
    $.ajax({
      url: '{{ route('admin.quotes.update.status') }}',
      type: 'POST',
      data: {
      quote_id: quoteId,
      status: status,
      department: department,
      _token: '{{ csrf_token() }}'
      },
      success: function (response) {
      if (response.success) {
        Swal.fire('Success', response.message, 'success');
      } else {
        Swal.fire('Error', 'Something went wrong.', 'error');
      }
      },
      error: function (xhr) {
      Swal.fire('Error', 'Unable to update status.', 'error');
      }
    });
    }

    function showNoteModal(select) {
    if (select.value) {
      const modal = new bootstrap.Modal(document.getElementById('noteModal'));
      document.querySelector('#noteModal input').value = select.value;
      modal.show();
    }
    }
  </script>
@endpush