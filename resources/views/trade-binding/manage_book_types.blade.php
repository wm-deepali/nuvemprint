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
                <li class="breadcrumb-item active">Book Type </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="modal" data-target="#add-page-type">Add Book Type</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Book Types</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pagetype-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <!-- <th>Title</th> -->
                      <th>Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($types) > 0) 
                      @foreach($types as $t => $type)
                        <tr>
                          <td>{{ $t + 1 }}</td>
                          <td>{{ $type->name }}</td>
                         <!--  <td>{{ $type->title ? $type->title : 'N/A' }}</td> -->
                          <td>{{ $type->status == 'Yes' ? 'Active' : 'Inactive' }}</td>
                          <td>
                            <a href="javascript:void()" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light" data-toggle="modal" data-target="#update-page-type{{$t}}"><i class="fas fa-pencil-alt"></i></a>
                            @if($type->status == 'Yes')
                              <a href="javascript:void()" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" title="Approve Book Type" onclick="changeStatus('{{ $type->id }}')"><i class="far fa-times-circle"></i></a>
                            @else
                              <a href="javascript:void()" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light" title="Inactive Book Type" onclick="changeStatus('{{ $type->id }}')"><i class="fas fa-check"></i></a>
                            @endif
                            <!-- The Modal -->
                            <div class="modal" id="update-page-type{{$t}}">
                              <div class="modal-dialog">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Update Book Type</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <div class="container-fluid">
                                      <form method="POST" action="{{ url('admin/trade-binding/book-type') }}/{{ $type->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                          <label>Name</label>
                                          <input type="text" name="name" class="form-control" placeholder="Enter form type name" value="{{ $type->name }}" required="">
                                        </div>
                                        <div class="form-group row">
                                          <button type="submit" class="btn btn-info">Update</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="3">No record(s) found.</td>
                      </tr>
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

<!-- Modal For Add Book Type  -->
<!-- The Modal -->
<div class="modal" id="add-page-type">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Book Type</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="{{ url('admin/trade-binding/book-type') }}">
            @csrf
            <div class="form-group row">
              <label>Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter form type name" required="">
            </div>
           <!--  <div class="form-group row">
              <label>Title</label>
              <input type="text" name="title" class="form-control" placeholder="Enter form type Title">
            </div> -->
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
    $('#pagetype-table').DataTable();
  });

  function changeStatus(id) {
    swal({
        title: "Are you sure?",
        text: "Chaneg Status This Book Type.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '{{ url('admin/trade-binding/book-type') }}/'+id,
            method: "GET",
            beforeSend:function() {
              
            },
            success: function(response) {
              swal('', response, 'success');
              setTimeout(function() {
                location.reload();
              }, 1000);
            },
            error: function(response) {
              swal('', response, 'error');
            },
            complete: function() {
              location.reload();
            }
          })
      }
    });
  }


</script>
@endpush