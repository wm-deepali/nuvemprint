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
                  <li class="breadcrumb-item active">Manage Blogs</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="{{ route('admin.content.blogs.create') }}" class="btn-icon btn btn-primary btn-round btn-sm">Add New Blog</a>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Blog Listing</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="blog-table">
                    <thead>
                      <tr>
                        <th>Date & Time</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2025-07-10 14:30</td>
                        <td>Exploring Comic Book Trends</td>
                        <td>Published</td>
                        <td>
                          <a href="{{ route('admin.content.blogs.create') }}" class="btn btn-sm btn-info mr-1">Edit</a>
                          <button class="btn btn-sm btn-danger" >Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>2025-07-09 10:15</td>
                        <td>Graphic Novels in 2025</td>
                        <td>Draft</td>
                        <td>
                          <a href="{{ route('admin.content.blogs.create') }}" class="btn btn-sm btn-info mr-1">Edit</a>
                          <button class="btn btn-sm btn-danger" >Delete</button>
                        </td>
                      </tr>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function confirmDelete(url) {
      if (confirm('Are you sure you want to delete this blog?')) {
        window.location.href = url;
      }
    }
  </script>


@endsection