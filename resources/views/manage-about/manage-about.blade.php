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
                <li class="breadcrumb-item active">Manage About</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            {{-- <a href="feedback.php" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a> --}}
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Banner Section</h4>
            </div>
            @include('errors.flash_message')
            <div class="card-body">
              <form action="{{ route('about.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Upload Banner Image</label>
                      <div class="custom-img-uploader">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <span class="btn-file">
                              <input type="file" id="imgSec" name="banner_image">
                              @if($data->banner_image)
                              <img id='upload-img' class="img-upload-block" src="{{ asset('storage/'.$data->banner_image) }}"/>
                              @else
                              <img id='upload-img' class="img-upload-block" src="{{ asset('admin_assets') }}/images/plus-upload.jpg"/>
                              @endif
                            </span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Banner Heading</label>
                      <input type="text" name="banner_heading" class="form-control" value="{{ $data->banner_heading ?? '' }}" />
                    </div>
                    <div class="form-group">
                      <label>Banner Sub Heading</label>
                      <input type="text" name="banner_subheading" class="form-control" value="{{ $data->banner_subheading ?? '' }}"/>
                    </div>
                    <div class="form-group">
                      <label>Banner Text</label>
                      <input type="text" name="banner_text" value="{{ $data->banner_text ?? '' }}" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Button2 Link</label>
                      <input type="text" name="btn2_link" class="form-control" value="{{ $data->btn2_link ?? '' }}"/>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Banner Button1 Name</label>
                      <input type="text" name="btn1_name" class="form-control" value="{{ $data->btn1_name ?? '' }}"/>
                    </div>
                    <div class="form-group">
                      <label>Button1 Link</label>
                      <input type="text" name="btn1_link" class="form-control" value="{{ $data->btn1_link ?? '' }}"/>
                    </div>
                    <div class="form-group">
                      <label>Banner Button2 Name</label>
                      <input type="text" name="btn2_name" class="form-control" value="{{ $data->btn2_name }}"/>
                    </div>
                  </div>
                  <div class="card-title">
                    <h4>Content Section</h4>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Upload Content Image</label>
                        <div class="custom-img-uploader">
                          <div class="input-group">
                            <span class="input-group-btn">
                              <span class="btn-file">
                                <input type="file" id="imgSec" name="content_image">
                                @if($data->content_image)
                                <img id='upload-img' class="img-upload-block" src="{{ asset('storage/'.$data->content_image ) }}"/>
                                @else
                                <img id='upload-img' class="img-upload-block" src="{{ asset('admin_assets') }}/images/plus-upload.jpg"/>
                                @endif
                              </span>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="heading" class="form-control" value="{{ $data->heading }}"/>
                      </div>
                      <div class="form-group">
                        <label>Sub Heading</label>
                        <input type="text" name="sub_heading" class="form-control" value="{{ $data->sub_heading }}"/>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label> Button Name</label>
                        <input type="text" name="content_btn_name" class="form-control" value="{{ $data->content_btn_name }}"/>
                      </div>
                      <div class="form-group">
                        <label>Button Link</label>
                        <input type="text" name="content_btn_link" class="form-control" value="{{ $data->content_btn_link }}"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Content</label>
                      <textarea name="content" class="text-control" rows="4" cols="8" required="">{{ $data->content }}</textarea>
                  </div>
                  </div>
                  <div class="card-title">
                    <h4>Mid Section</h4>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Upload Image</label>
                        <div class="custom-img-uploader">
                          <div class="input-group">
                            <span class="input-group-btn">
                              <span class="btn-file">
                                <input type="file" id="imgSec" name="section2_image">
                                @if($data->section2_image)
                                <img id='upload-img' class="img-upload-block" src="{{ asset('storage/'.$data->section2_image) }}"/>
                                @else
                                <img id='upload-img' class="img-upload-block" src="{{ asset('admin_assets') }}/images/plus-upload.jpg"/>
                                @endif
                              </span>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="section2_heading" class="form-control" value="{{ $data->section2_heading }}"/>
                      </div>
                      <div class="form-group">
                        <label>Sub Heading</label>
                        <input type="text" name="section2_subheading" class="form-control" value="{{ $data->section2_subheading }}"/>
                      </div>
                      <div class="form-group">
                        <label>Checks</label>
                        <input type="text" name="section2_checks_name" class="form-control" value="{{ $data->section2_checks_name }}"/>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                      <label>Meta Title</label>
                      <input required="" type="text" class="form-control" name="meta_title" value="{{ $data->meta_title }}" />
                    </div>
                    <div class="form-group">
                      <label>Meta Keyword</label>
                      <input required="" type="text" class="form-control" name="meta_keyword" value="{{ $data->meta_keyword }}" />
                    </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Meta Description</label>
                      <textarea required="" class="form-control" name="meta_desc" rows="3" >{{ $data->meta_desc }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
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
<script>
CKEDITOR.replace('content');

</script>


@endpush