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
                <li class="breadcrumb-item active">Quantity Ranges & Prices</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="modal" data-target="#add-page-type">Add Quantity Range</a>
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
              <h4 class="card-title">Quantity Ranges & Prices</h4>
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
                      <th>Page Range</th>
                      <th>Quantity From</th>
                      <th>Quantity To</th>
                      <th>Price</th>
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
                          <td>{{ $type->getPageRange ? $type->getPageRange->name : 'N/A' }}</td>
                          <td>{{ $type->quantity_start }}</td>
                          <td>{{ $type->quantity_end }}</td>
                          <td>{{ $type->price }}</td>
                          <td>
                            <a href="javascript:void()" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light" data-toggle="modal" data-target="#update-page-type{{$t}}"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void()" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" onclick="deleteRange('{{ $type->id }}')"><i class="fas fa-trash-alt"></i></a>
                            <!-- The Modal -->
                            <div class="modal" id="update-page-type{{$t}}">
                              <div class="modal-dialog">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Update Quantity Ranges & Prices</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <div class="container-fluid">
                                      <form method="POST" action="{{ url('admin/trade-binding/quantity-range') }}/{{ $type->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                          <label>Page Type</label>
                                          <select class="form-control" id="up_page_type" name="page_type" required="">
                                            <option value="">Select Page Type</option>
                                            @foreach($page_types as $page)
                                              <option value="{{ $page->id }}" @if($type->page_type_id == $page->id) selected @endif>{{ $page->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group row">
                                          <label>Book Type</label>
                                          <select class="form-control" id="up_book_type" name="book_type" onchange="renderPageRanges('up_page_type', 'up_book_type')" required="">
                                            <option value="">Select Book Type</option>
                                            @foreach($book_types as $book)
                                              <option value="{{ $book->id }}" @if($type->book_type_id == $book->id) selected @endif>{{ $book->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group row">
                                          <label>Page Range</label>
                                          <select class="form-control" id="up_page_range" name="page_range" required="">
                                            @if(count($type->getRelatedPageRanges($type->page_type_id, $type->book_type_id)))
                                            @php
                                              $page_ranges = $type->getRelatedPageRanges($type->page_type_id, $type->book_type_id);
                                            @endphp
                                              @foreach($page_ranges as $range)
                                                <option value="{{ $range->id }}" @if($type->page_range_id == $range->id) selected @endif>{{ $range->name }}</option>
                                              @endforeach
                                            @endif
                                          </select>
                                        </div>
                                        <div class="form-group row">
                                          <label>Quantity Start</label>
                                          <input type="number" name="start" class="form-control" placeholder="Enter quantity start range." value="{{ $type->quantity_start }}" required="">
                                        </div>
                                        <div class="form-group row">
                                          <label>Quantity End</label>
                                          <input type="number" name="end" class="form-control" value="{{ $type->quantity_end }}" placeholder="Enter quantity end range." required="">
                                        </div>
                                        <div class="form-group row">
                                          <label>Price</label>
                                          <input type="text" name="price" class="form-control" value="{{ $type->price }}" placeholder="Enter price" required="">
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
        <h4 class="modal-title">Add Quantity Ranges & Prices</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="{{ url('admin/trade-binding/quantity-range') }}">
            @csrf
            <div class="form-group row">
              <label>Page Type</label>
              <select class="form-control" id="page_type" name="page_type" required="">
                <option value="">Select Page Type</option>
                @foreach($page_types as $page)
                  <option value="{{ $page->id }}">{{ $page->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group row">
              <label>Book Type</label>
              <select class="form-control" id="book_type" name="book_type" onchange="renderPageRanges('page_type', 'book_type')" required="">
                <option value="">Select Book Type</option>
                @foreach($book_types as $book)
                  <option value="{{ $book->id }}">{{ $book->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group row">
              <label>Page Range</label>
              <select class="form-control" id="page_range" name="page_range" required="">
                <option value="">Select Page Range</option>
              </select>
            </div>
            <div class="form-group row">
              <label>Quantity Start</label>
              <input type="number" name="start" class="form-control" placeholder="Enter quantity start range." required="">
            </div>
            <div class="form-group row">
              <label>Quantity End</label>
              <input type="number" name="end" class="form-control" placeholder="Enter quantity end range." required="">
            </div>
            <div class="form-group row">
              <label>Price</label>
              <input type="text" name="price" class="form-control" placeholder="Enter price" required="">
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

  function deleteRange(id) {
    swal({
        title: "Are you sure?",
        text: "Chaneg Status This Quantity Range.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          
          $.ajax({
            url: '{{ url('admin/trade-binding/quantity-range') }}/'+id,
            method: "DELETE",
            data:{
              _token: '{{csrf_token()}}',
            },
            beforeSend:function() {
              
            },
            success: function(response) {
              swal('', response, 'success');
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