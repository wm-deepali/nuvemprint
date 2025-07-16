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
                <li class="breadcrumb-item active">Manage Layout Content</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('manage-layout.index') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Page Heading</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('layout/content') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Upload Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" id="imgSec" name="image">
                              <img id='upload-img' class="img-upload-block" src="{{asset('/images/layout/'. $content->image) }}" style="width: 200px;" />
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Page Heading</label>
                      <input type="text" class="form-control" name="heading" value="{{ $content->heading }}" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Page Sub Heading</label>
                      <input type="text" class="form-control" name="subheading" value="{{ $content->subheading }}" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Page Heading Content</label>
                      <textarea class="form-control" name="content" rows="2"/>{{ $content->content }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <input type="hidden" value="{{ $content->image}}" name="old_image"> 
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Layout Block Content</h4>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('save/block') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Upload Image</label>
                    <div class="custom-img-uploader">
                      <div class="input-group">
                        <span class="input-group-btn">
                          <span class="btn-file">
                            <input type="file" id="imgSec" name="image">
                            <img id='upload-img' class="img-upload-block" src="{{asset('/images/layout/'. $block->image) }}" style="width: 200px;" />
                          </span>
                        </span>
                      </div>
                    </div>
                  </div>


                </div>
              </div>

              <div class="form-group row">
                <label>Heading</label>
                <input type="text" name="heading" class="form-control" placeholder="Enter Heading" value="{{ $block->heading }}" required="">
              </div>
              <div class="form-group row">
                <label>Content</label>
                <textarea name="content" class="form-control content required">{{ $block->content }}</textarea>
              </div>
              <div class="form-group row">
                <input type="hidden" name="old_image" value="{{ $block->image }}">
                <button type="submit" class="btn btn-info">Submit</button>
              </div>
            </form>
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
        $('#book-table').DataTable();
    });

    $(".change-status").on('change', function(){
      const book_id = $(this).data('book_id');
      const status = $(this).prop('checked') == true ? 'active' : 'block'; 
      $.ajax({
          'url':'{{ route('change-status-book') }}',
          'type':'GET',
          'data':{'book_id':book_id, 'status':status},
          success:function(){
            location.reload();
          }
      });

  });

</script>
@endpush