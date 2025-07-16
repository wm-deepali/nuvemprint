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
                <li class="breadcrumb-item active">Add Proof</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('uploaded-proofs.index') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Back</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Upload Proof</h4>
            </div>
            <div class="card-body">
              @include('errors.flash_message')
              <form action="{{ route('uploaded-proofs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Enter Name</label>
                      <input required="" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name"/>
                    </div>
                    <div class="form-group">
                      <label>Enter Email Id</label>
                      <input required="" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email Id"/>
                    </div>                    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Inner Page Pdf</label>
                      <input required="" type="file" class="form-control" name="inner_pdf"/>
                    </div>
                    <div class="form-group">
                      <label>Cover Page Pdf</label>
                      <input required="" type="file" class="form-control" name="cover_pdf"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Comments</label>
                      <textarea required="" class="form-control" name="comments" rows="3" placeholder="Enter comments">{{ old('comments') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Job Number</label>
                      <input required="" type="text" class="form-control" placeholder="Enter Job Number" value="{{ old('job_number') }}" name="job_number"/>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Add Proof</button>
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