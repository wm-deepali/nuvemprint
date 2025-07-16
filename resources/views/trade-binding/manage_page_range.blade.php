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
                <li class="breadcrumb-item active">Page Ranges </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="modal" data-target="#add-page-type">Add Range</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row container-fluid">
        @if(session()->has('message'))
            <div class="alert alert-{{session('alert') ?? 'alert-info'}}">
                {{ session('message') }}
            </div>
        @endif
        @if(count($errors) > 0 )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Page Range</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pagetype-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Page Type</th>
                      <th>Book Type</th>
                      <th>Range From</th>
                      <th>Range To</th>
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
                          <td>{{ $type->getPageType ? $type->getPageType->name : 'N/A' }}</td>
                          <td>{{ $type->getBookType ? $type->getBookType->name : 'N/A' }}</td>
                          <td>{{ $type->range_start }}</td>
                          <td>{{ $type->range_end }}</td>
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
                                      <form method="POST" action="{{ url('admin/trade-binding/page-range') }}/{{ $type->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                          <label>Page Type</label>
                                          <select class="form-control" name="page_type" required="">
                                            <option value="">Select Page Type</option>
                                            @foreach($page_types as $page)
                                              <option value="{{ $page->id }}" @if($type->page_type_id == $page->id) selected @endif>{{ $page->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group row">
                                          <label>Book Type</label>
                                          <select class="form-control" name="book_type" required="">
                                            <option value="">Select Book Type</option>
                                            @foreach($book_types as $book)
                                              <option value="{{ $book->id }}" @if($type->book_type_id == $book->id) selected @endif>{{ $book->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group row">
                                          <label>Name</label>
                                          <input type="text" name="name" class="form-control" placeholder="Enter page range name" value="{{ $type->name }}" required="">
                                        </div>
                                        <div class="form-group row">
                                          <label>Range Start</label>
                                          <input type="number" name="start" class="form-control" placeholder="Enter value for start range." value="{{ $type->range_start }}" required="">
                                        </div>
                                        <div class="form-group row">
                                          <label>Range End</label>
                                          <input type="number" name="end" class="form-control" placeholder="Enter value for start range." value="{{ $type->range_end }}" required="">
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
        <h4 class="modal-title">Add Page Range</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="{{ url('admin/trade-binding/page-range') }}">
            @csrf
            <div class="form-group row">
              <label>Page Type</label>
              <select class="form-control" name="page_type" required="">
                <option value="">Select Page Type</option>
                @foreach($page_types as $page)
                  <option value="{{ $page->id }}">{{ $page->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group row">
              <label>Book Type</label>
              <select class="form-control" name="book_type" required="">
                <option value="">Select Book Type</option>
                @foreach($book_types as $book)
                  <option value="{{ $book->id }}">{{ $book->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group row">
              <label>Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter page range name" required="">
            </div>
            <div class="form-group row">
              <label>Range Start</label>
              <input type="number" name="start" class="form-control" placeholder="Enter value for start range." required="">
            </div>
            <div class="form-group row">
              <label>Range End</label>
              <input type="number" name="end" class="form-control" placeholder="Enter value for start range." required="">
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
            url: '{{ url('admin/trade-binding/page-range') }}/'+id,
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