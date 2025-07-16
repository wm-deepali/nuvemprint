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
                <li class="breadcrumb-item active">Orders</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          {{-- <div class="dropdown">
            <a href="{{ route('teams.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Team</a>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="content-body">
      @include('errors.flash_message')
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Orders List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="team-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th width="170px">Date & Time</th>
                      <th width="160px">Name & Email</th>
                      <th width="160px">Estimate Or Invoice Number</th>
                      <th width="60px">Job Cost</th>
                      <th width="60px">Delivery Address</th>
                      <th width="60px">Inner Pdf</th>
                      <th width="60px">Cover Pdf</th>
                      <th width="60px">Other File</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($orders as $order)
                    <tr>
                      <td>#{{ $loop->iteration }}</td>
                      <td>{{ $order->created_at }}</td>
                      <td>{{ $order->name }} <br> {{ $order->email }}</td>
                      <td>{{ $order->estimate_or_invoice }}</td>
                      <td>{{ $order->job_cost }}</td>
                      <td>{{ $order->delivery_address }}</td>
                      <td>
                        @if(isset($order->inner_pdf))
                          <a href="{{ asset('storage/'.$order->inner_pdf) }}" target="_blank" />view
                          @else
                          -
                          @endif
                      </td>
                      <td>
                        @if(isset($order->cover_pdf))
                          <a href="{{ asset('storage/'.$order->cover_pdf) }}" target="_blank" />view
                        @else
                        -
                        @endif
                      </td>
                      <td>
                          @if(isset($order->other_file))
                          <a href="{{ asset('storage/'.$order->other_file) }}" target="_blank" />view
                          @else
                          -
                          @endif                        
                      </td>
                      
                      <td>
                        {{-- <a href="{{ route('teams.edit', $team) }}" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a> --}}
                        <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr>
                    @empty
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

@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready( function () {
        $('#team-table').DataTable();
    });
</script>
@endpush