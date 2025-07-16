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
                <li class="breadcrumb-item active">All Approval/Pending Proofs</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('uploaded-proofs.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Proof</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Approval/Pending Proofs List</h4>
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
                      <th width="60px">Comments</th>
                      <th>Inner Pdf</th>
                      <th>Cover Pdf</th>
                      <th width="60px">Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($proofs as $proof)
                    <tr>
                      <td>#{{ $loop->iteration }}</td>
                      <td>{{ $proof->created_at }}</td>
                      <td>{{ $proof->name }}<br>{{ $proof->email }}</td>
                      <td>{{ $proof->job_number }}</td>
                      <td>{{ $proof->comments }}</td>
                      <td>
                        <a href="{{ asset('storage/'.$proof->inner_pdf) }}" target="_tab"><img src="https://via.placeholder.com/50"></a>
                      </td>
                      <td>
                        <a href="{{ asset('storage/'.$proof->cover_pdf) }}" target="_tab"><img src="https://via.placeholder.com/50"></a>
                      <td class="text-center">
                        <span
                        @if ($proof->status)
                        class="badge badge-primary"
                        @else
                        class="badge badge-danger"
                        @endif
                        >
							@php
							$data = \DB::table('proof_feedback')->where('proof_id', $proof->id)->latest()->first();
							@endphp
							@if($data)
                            {{ $data->status }}
							@else
							<span class="badge badge-primary">Sent for approval</span>
							@endif
                        </span>
                      </td>
						
                      <td>
                        {{-- <a href="{{ route('uploaded-proofs.edit', $proof) }}" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a> --}}
                        @if(count($proof->getFeedbacks) > 0)
                          <a href="{{ route('proof.feedbacks', $proof->id) }}" title="View Related Feedbacks"><button class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        @endif
                        <form action="{{ route('uploaded-proofs.destroy', $proof) }}" method="POST" style="display: inline-block">
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