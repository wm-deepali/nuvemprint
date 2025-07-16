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
          <li class="breadcrumb-item active">Cover Finishes</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <div class="dropdown">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
          id="add-cover-finish">Add</a>
        </div>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cover Finishes</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="cover-finish-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th width="70px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($coverFinishes as $coverFinish)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $coverFinish->name }}</td>
            <td>
            @if($coverFinish->image_path)
          <img src="{{ asset('storage/' . $coverFinish->image_path) }}" width="50" height="50"
          alt="cover-finish" />
        @endif
            </td>

            <td>
            <ul class="list-inline">
            <li class="list-inline-item">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm-custom edit-cover-finish"
              data-id="{{ $coverFinish->id }}">
              <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteConfirmation({{ $coverFinish->id }})">
              <i class="fa fa-trash text-danger" aria-hidden="true"></i>
            </a>
            </li>
            </ul>
            </td>
          </tr>
        @endforeach
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

  <div class="modal" id="cover-finish-modal"></div>
@endsection

@push('scripts')
  <script type="text/javascript">
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    function deleteConfirmation(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This will permanently delete the record!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonColor: '#d33'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `/admin/manage-cover-finish/${id}`,
        type: "DELETE",
        success: function (response) {
        if (response.success) {
          Swal.fire('Deleted!', '', 'success');
          setTimeout(() => location.reload(), 300);
        } else {
          Swal.fire('Error', response.msgText, 'error');
        }
        }
      });
      }
    });
    }

    $(document).ready(function () {
    $('#cover-finish-table').DataTable();

    $('#add-cover-finish').on('click', function () {
      $.get("{{ route('admin.manage-cover-finish.create') }}", function (response) {
      if (response.success) {
        $('#cover-finish-modal').html(response.html).modal('show');
      }
      });
    });

    $(document).on('click', '#add-cover-finish-btn', function () {
      $(this).prop('disabled', true);
      let formData = new FormData(document.getElementById('cover-finish-form'));
      $.ajax({
      url: "{{ route('admin.manage-cover-finish.store') }}",
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Created!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#add-cover-finish-btn').prop('disabled', false);
        if (response.errors) {
          $.each(response.errors, function (field, messages) {
          if (field.startsWith("name.") || field.startsWith("image.")) {
            const index = field.split('.')[1];
            const key = field.split('.')[0]; // name or image
            $('.' + key + '-err').eq(index).html(messages[0]);
          } else {
            $('#' + field + '-err').html(messages[0]);
          }
          });
        }

        }
      }
      });
    });

    $(document).on('click', '.edit-cover-finish', function () {
      let id = $(this).data('id');
      $.get(`/admin/manage-cover-finish/${id}/edit`, function (response) {
      if (response.success) {
        $('#cover-finish-modal').html(response.html).modal('show');
      }
      });
    });

    $(document).on('click', '#update-cover-finish-btn', function () {
      $(this).prop('disabled', true);
      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('cover-finish-form'));
      formData.append('_method', 'PUT');
      $.ajax({
      url: `/admin/manage-cover-finish/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Updated!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#update-cover-finish-btn').prop('disabled', false);
        if (response.errors) {
          $.each(response.errors, function (key, value) {
          $(`#${key}-err`).html(value[0]);
          });
        }
        }
      }
      });
    });
    });

    // Add more cover finish row
    $(document).on('click', '#add-more-cover-finish', function () {
    const row = `
    <div class="form-row mb-2 cover-finish-row align-items-center">
      <div class="col-md-5 mb-1 mb-md-0">
      <input type="text" name="name[]" class="form-control" placeholder="e.g. Gloss Lamination">
      <span class="text-danger name-err"></span>
      </div>
      <div class="col-md-5 mb-1 mb-md-0">
      <input type="file" name="image[]" class="form-control">
      <span class="text-danger image-err"></span>
      </div>
      <div class="col-md-2 text-md-center text-left">
      <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
      </div>
    </div>`;
    $('#cover-finish-wrapper').append(row);
    });

    // Remove row
    $(document).on('click', '.remove-row', function () {
    $(this).closest('.cover-finish-row').remove();
    });

  </script>
@endpush