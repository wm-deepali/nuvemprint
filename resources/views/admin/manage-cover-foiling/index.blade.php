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
          <li class="breadcrumb-item active">Cover Foiling</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <div class="dropdown">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
          id="add-cover-foiling">Add</a>
        </div>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cover Foiling</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="cover-foiling-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th width="70px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($coverFoilings as $coverfoiling)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $coverfoiling->name }}</td>
            <td>
            @if($coverfoiling->image_path)
          <img src="{{ asset('storage/' . $coverfoiling->image_path) }}" width="50" height="50"
          alt="cover-foiling" />
        @endif
            </td>

            <td>
            <ul class="list-inline">
            <li class="list-inline-item">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm-custom edit-cover-foiling"
              data-id="{{ $coverfoiling->id }}">
              <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteConfirmation({{ $coverfoiling->id }})">
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

  <div class="modal" id="cover-foiling-modal"></div>
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
        url: `/admin/manage-cover-foiling/${id}`,
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
    $('#cover-foiling-table').DataTable();

    $('#add-cover-foiling').on('click', function () {
      $.get("{{ route('admin.manage-cover-foiling.create') }}", function (response) {
      if (response.success) {
        $('#cover-foiling-modal').html(response.html).modal('show');
      }
      });
    });

    $(document).on('click', '#add-cover-foiling-btn', function () {
      $(this).prop('disabled', true);
      let formData = new FormData(document.getElementById('cover-foiling-form'));
      $.ajax({
      url: "{{ route('admin.manage-cover-foiling.store') }}",
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Created!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#add-cover-foiling-btn').prop('disabled', false);
        if (response.errors) {
          $.each(response.errors, function (field, messages) {
          if (field.startsWith("name.") || field.startsWith("image.")) {
            const index = field.split('.')[1];
            const key = field.split('.')[0]; // "name" or "image"
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

    $(document).on('click', '.edit-cover-foiling', function () {
      let id = $(this).data('id');
      $.get(`/admin/manage-cover-foiling/${id}/edit`, function (response) {
      if (response.success) {
        $('#cover-foiling-modal').html(response.html).modal('show');
      }
      });
    });

    $(document).on('click', '#update-cover-foiling-btn', function () {
      $(this).prop('disabled', true);
      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('cover-foiling-form'));
      formData.append('_method', 'PUT');
      $.ajax({
      url: `/admin/manage-cover-foiling/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Updated!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#update-cover-foiling-btn').prop('disabled', false);
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

    // Add more cover foiling rows
    $(document).on('click', '#add-more-cover-foiling', function () {
    const newRow = `
      <div class="form-row mb-2 cover-foiling-row">
      <div class="col-md-5">
      <input type="text" name="name[]" class="form-control" placeholder="e.g. Gold, Silver, Copper">
      <span class="text-danger validation-err name-err"></span>
      </div>
      <div class="col-md-5">
      <input type="file" name="image[]" class="form-control">
      <span class="text-danger validation-err image-err"></span>
      </div>
       <div class="col-md-1 text-right">
      <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none;">×</button>
      </div>
      </div>
    `;
    $('#cover-foiling-wrapper').append(newRow);
    $('.remove-row').show();
    });

    // Remove cover foiling row
    $(document).on('click', '.remove-row', function () {
    $(this).closest('.cover-foiling-row').remove();
    if ($('.cover-foiling-row').length === 1) {
      $('.remove-row').hide();
    }
    });
  </script>
@endpush