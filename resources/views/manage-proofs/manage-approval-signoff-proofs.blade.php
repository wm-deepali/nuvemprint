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
                <li class="breadcrumb-item active">Sign Off Approvals</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            {{-- <a href="{{ route('uploaded-proofs.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Proof</a> --}}
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Sign off Approval Proofs List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="uploaded-proofs-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th width="170px">Date & Time</th>
                      <th width="160px">Estimate/Job/Invoice Number</th>
                      <th width="60px">Approval Status</th>
                      <th>Address</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($proofs as $proof)
                    <tr>
                      <td>#{{ $loop->iteration }}</td>
                      <td>{{ $proof->created_at }}</td>
                      <td>{{ $proof->number }}</td>
                      <td>{{ $proof->approval_status }}</td>
                      <td>{{ $proof->address }}</td>
                      <td>
                        {{-- <a href="{{ route('uploaded-proofs.edit', $proof) }}" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a> --}}
                        <form action="{{ route('proof-approval-sign-off.destroy', $proof) }}" method="POST" style="display: inline-block">
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
        $('#uploaded-proofs-table').DataTable();
    });
</script>
@endpush