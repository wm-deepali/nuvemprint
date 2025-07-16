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
                <li class="breadcrumb-item active">All Feedbacks</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Manage Feedbacks</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="uploaded-proofs-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th width="170px">Date & Time</th>
                      <th width="160px">Name & Email</th>
                      <th width="160px">Job Number</th>
                      <th width="60px">Approval Status</th>
                      <th>Address</th>
                      <th>Need Changes</th>
                      <th>PostCode</th>
                      <th>Receiving Date</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($feedbacks_data as $f => $feedback)
                    <tr>
                      <td>{{ $f + 1 }}</td>
                      <td>{{ date('d-m-Y h:i A', strtotime($feedback->created_at)) }}</td>
                      <td>{{ $feedback->name }}<br>{{ $feedback->telephone_number }}</td>
                      <td>{{ $feedback->getUploadProof ? $feedback->getUploadProof->job_number : 'N/A' }}</td>
                      <td>{{ $feedback->status }}</td>
                      <td>{{ $feedback->delivery_address }}</td>
                      <td>{{ $feedback->change_request }}</td>
                      <td>{{ $feedback->pincode }}</td>
                      <td>{{ date('d-m-Y', strtotime($feedback->needed_date)) }}</td>
                      <td></td>
                    </tr>
                  @endforeach
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
        $('#uploaded-proofs-table').DataTable();
    });
</script>
@endpush