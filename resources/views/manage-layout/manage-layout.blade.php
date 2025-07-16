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
                <li class="breadcrumb-item active">Manage Layout</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
           <!-- <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="modal" data-target="#add-layout">Add Layout</a>|-->
            <a href="{{ route('layout/content') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Add Content</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Manage Layout</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="layout-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th width="120px">Date</th>
                      <th>Heading</th>
                      <th>Content</th>
                      <th>Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="add-layout">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Layout</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="{{ route('manage-layout.store') }}">
            @csrf
            <div class="form-group row">
              <label>Heading</label>
              <input type="text" name="heading" class="form-control" placeholder="Enter Heading" value="{{ old('heading') }}" required="">
            </div>
            <div class="form-group row">
              <label>Content</label>
              <textarea name="content" class="form-control content required">{{ old('content') }}</textarea>
            </div>

            <div class="form-group row">
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready( function () {
        $('#layout-table').DataTable();
    });

    $(".change-status").on('change', function(){
      const layout_id = $(this).data('layout_id');
      const status = $(this).prop('checked') == true ? 'active' : 'block'; 
      $.ajax({
          'url':'{{ route('change-status-layout') }}',
          'type':'GET',
          'data':{'layout_id':layout_id, 'status':status},
          success:function(){
            location.reload();
          }
      });

  });

</script>
@endpush