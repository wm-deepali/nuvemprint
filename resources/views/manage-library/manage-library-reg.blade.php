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
                <li class="breadcrumb-item active">Manage Library Content</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Banner Content</h4>
            </div>
            @include('errors.flash_message')
            <div class="card-body">
              <form action="{{ route('manage-library.store') }}" method="post" enctype="multipart/form-data">
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
                              <img id='upload-img' class="img-upload-block" src="{{asset('/images/library/'. $banner->image) }}" style="width: 200px;" />
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Page Heading</label>
                      <input type="text" class="form-control" name="heading" value="{{ $banner->heading }}" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Page Sub Heading</label>
                      <input type="text" class="form-control" name="subheading" value="{{ $banner->subheading }}" />
                    </div>
                  </div>

                  <div class="col-md-12">
                    <input type="hidden" value="{{ $banner->image}}" name="old_image"> 
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
              <h4 class="card-title">Block Content</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('manage-library.update',1) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Upload Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" id="imgLogo" name="image">
                              <img id='upload-logo' class="img-upload-block" src="{{asset('/images/library/'. $content->image) }}"/>
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Content</label>
                      <textarea class="form-control" name="content" rows="2"/>{{ $content->content }}</textarea>
                    </div>
                  </div>

                  <!-- <div class="col-md-6">
                    <div class="form-group">
                      <label>Meta Title</label>
                      <input type="text" class="form-control" name="meta_title" value="{{ $content->meta_title }}" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Meta Keywords</label>
                      <input type="text" class="form-control" name="meta_keywords" value="{{ $content->meta_keywords }}" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Meta Description</label>
                      <textarea class="form-control" name="meta_description">{{ $content->meta_description }}</textarea>
                    </div>
                  </div> -->

                  <div class="col-md-12">
                    <input type="hidden" value="{{ $content->image}}" name="old_image">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Save</button>
                  </div>
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
  CKEDITOR.replace('content');
</script>
@endpush