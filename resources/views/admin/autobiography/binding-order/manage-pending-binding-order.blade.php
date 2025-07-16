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
                <li class="breadcrumb-item active">Binding Order</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            {{-- <a href="{{ route('teams.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Team</a> --}}
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Binding Order List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="enquiry-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th width="170px">Date & Time</th>
                      <th>Order Number</th>
                      <th>Name & Email</th>
                      <th>Phone Number</th>
                      <th>Address</th>
                      <th>Qty</th>
					<th>Paper Type</th>
                      <th>Binding Type</th>
                      <th>Book Size</th>
                      <th>Embossing</th>
                      <th>Embossing Detail</th>
                      <th>Print Type & Paper Grade</th>
                      <th>Check for Printability</th>
                      <th>Extra & accessories</th>
                      <th>Delivery Type</th>
                      <th>File</th>
						<th>Preview</th>
                      <th>Final Price</th>
                      <th>Payment Status</th>
                      <th>Order Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (isset($pending_binding_orders) && count($pending_binding_orders)>0)
                    @foreach ($pending_binding_orders as $binding_order)
                    <tr>
                      <td>#{{ $loop->iteration }}</td>
                      <td>{{ $binding_order->created_at }}</td>
                      <td>{{ $binding_order->order_number }}</td>
                      <td>{{ $binding_order->name }}<br>{{ $binding_order->email }}</td>
                      <td>{{ $binding_order->phone_number }}</td>
                      <td>{{ $binding_order->address }}</td>
                      <td>{{ $binding_order->binding_quantity }}</td>
						<td>{{ $binding_order->paper_type }}</td>
                      <td>{{ $binding_order->autobiography_binding_type->name ?? '-' }}-<span>{{ $binding_order->autobiography_colour->name ?? '-' }}</span></td>
                      <td>{{ Str::title(str_replace('_', ' ', $binding_order->book_size)) }}</td>
                      <td>
                        {{ Str::title(str_replace('_', ' ', $binding_order->embossing_type)) }}-<span>{{ Str::title(str_replace('_', ' ', $binding_order->embossing_colour)) }}</span><br>
                        @if ($binding_order->embossing_type == 'standard_embossing')
                          Spine Embossing - {{ $binding_order->has_embossed_spine }}
                        @elseif($binding_order->embossing_type == 'customised_embossing')
                          @if (isset($binding_order->customised_embossed_front_cover) && Storage::exists($binding_order->customised_embossed_front_cover))
                            <a href="{{ URL::asset('storage/'.$binding_order->customised_embossed_front_cover) }}" download="">Front Cover</a><br>
                          @endif
                          @if ($binding_order->has_embossed_spine == 'yes')
                            @if (isset($binding_order->customised_embossed_spine) && Storage::exists($binding_order->customised_embossed_spine))
                              <a href="{{ URL::asset('storage/'.$binding_order->customised_embossed_spine) }}" download="">Spine</a><br>
                            @endif
                          @endif
                        @else
                          @if (isset($binding_order->print_cover) && Storage::exists($binding_order->print_cover))
                            <a href="{{ URL::asset('storage/'.$binding_order->print_cover) }}" download="">Print Cover</a><br>
                          @endif
                          @if ($binding_order->has_embossed_spine == 'yes')
                            @if (isset($binding_order->print_spine) && Storage::exists($binding_order->print_spine))
                              <a href="{{ URL::asset('storage/'.$binding_order->print_spine) }}" download="">Spine</a><br>
                            @endif
                          @endif
                        @endif
                      </td>
                      <td>
                        @if ($binding_order->embossing_type == 'standard_embossing')
                          <a href="javascript:void(0)" class="view-embossing-detail" order_id="{{ $binding_order->id }}">view</a>
                        @else
                        -
                        @endif
                      </td>
                      <td>
                        {{ Str::title($binding_order->printing_type) }}<br>
                        {{ $binding_order->autobiography_paper_grade->name ?? '-' }} <br>
                        {{ $binding_order->number_of_page}} Page<br>
                      </td>
                      <td>{{ $binding_order->check_data_for_printability }}</td>
                      <td>
                        <a href="javascript:void(0)" class="view-extra-detail" order_id="{{ $binding_order->id }}">view</a>
                      </td>
                      <td>{{ Str::title(str_replace('_', ' ', $binding_order->delivery_type)) }}</td>
                      <td>
                        @if (isset($binding_order->pdf_upload) && Storage::exists($binding_order->pdf_upload))
                        <a href="{{ URL::asset('storage/'.$binding_order->pdf_upload) }}" download="">PDF</a>
                        @endif
                      </td>
						<td><a href="{{ route('admin.generate-bio-pdf',$binding_order->id) }}" target="_blank">Preview</a></td>
                      <td>{{ $binding_order->final_price }}</td>
                      <td>{{ $binding_order->payment_status }}</td>
                      <td>{{ $binding_order->order_status }}</td>
                      <td>
                        @if ($binding_order->order_status == 'pending')
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" onclick="completeConfirmation({{ $binding_order->id }})"><i class="fa fa-check"></i></a>
                        @endif
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" onclick="deleteConfirmation({{ $binding_order->id }})"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    @endif
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
<div class="modal" id="order-modal">
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  function completeConfirmation(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update to completed!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url:`{{ URL::to('admin/complete-bio-order-status/${id}') }}`,
          type:"post",
          dataType:"json",
          success:function(result) {
            if(result.success) {
              Swal.fire(
              'Order Completed!',
              'success'
              );
              setTimeout(function(){
                location.reload();
              },400);
            } else {
              Swal.fire(result.msgText);
            }
          }
        });
      }
    })
  };
  
  function deleteConfirmation(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url:`{{ URL::to('admin/manage-bio-order/${id}') }}`,
          type:"DELETE",
          dataType:"json",
          success:function(result) {
            if(result.success) {
              Swal.fire(
              'Deleted!',
              `college moved to trash.`,
              'success'
              );
              setTimeout(function(){
                location.reload();
              },400);
            } else {
              Swal.fire(result.msgText);
            }
          }
        });
      }
    })
  };
  
  $(document).ready( function () {
    $('#enquiry-table').DataTable();

    $(document).on('click','.view-embossing-detail',function(event) {
        let order_id = $(this).attr('order_id');
        $.ajax({
          url:`{{ URL::to('admin/fetch-bio-embossing-detail/${order_id}') }}`,
          type:"get",
          dataType:"json",
          success:function(result) {
            if(result.success) {
                $("#order-modal").html(result.html);
                $("#order-modal").modal('show');
            } else {
                console.log(result.msgText);
            }
          }
        });
    });

    $(document).on('click','.view-extra-detail',function(event) {
        let order_id = $(this).attr('order_id');
        $.ajax({
          url:`{{ URL::to('admin/fetch-bio-extra-detail/${order_id}') }}`,
          type:"get",
          dataType:"json",
          success:function(result) {
            if(result.success) {
                $("#order-modal").html(result.html);
                $("#order-modal").modal('show');
            } else {
                console.log(result.msgText);
            }
          }
        });
    });

  });
</script>
@endpush