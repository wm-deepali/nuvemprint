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
          <li class="breadcrumb-item active">Book Types</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <div class="dropdown">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
          id="add-book-type">Add</a>
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
          <table class="table" id="book-type-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th width="70px">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($bookTypes) && count($bookTypes) > 0)
            @foreach($bookTypes as $type)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $type->name }}</td>
            <td>
            @if($type->image)
          <img src="{{ asset('storage/' . $type->image) }}" alt="" width="50">
          @endif
            </td>
            <td>
            <ul class="list-inline">
            <li class="list-inline-item">
            <a href="javascript:void()" class="btn btn-primary btn-sm-custom edit-book-type"
            data-id="{{ $type->id }}">
            <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteConfirmation({{ $type->id }})" title="Delete">
            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
            </a>
            </li>
            </ul>
            </td>
          </tr>
          @endforeach
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

  {{-- Modal --}}
  <div class="modal fade" id="book-type-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
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
        url: `/admin/manage-book-type/${id}`,
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
    $('#book-type-table').DataTable();

    // Load modal for Create
    $('#add-book-type').on('click', function () {
      $.get("{{ route('admin.manage-book-type.create') }}", function (response) {
      if (response.success) {
        $('#book-type-modal').html(response.html).modal('show');
      }
      });
    });

    // Load modal for Edit
    $(document).on('click', '.edit-book-type', function () {
      let id = $(this).data('id');
      $.get(`/admin/manage-book-type/${id}/edit`, function (response) {
      if (response.success) {
        $('#book-type-modal').html(response.html).modal('show');
      }
      });
    });

    // Store
    $(document).on('click', '#add-book-type-btn', function () {
      $(this).prop('disabled', true);
      $('.validation-err').html('');

      let names = [];
      let hasError = false;

      $('input[name="name[]"]').each(function () {
      const val = $(this).val().trim();
      if (!val) {
        $(this).siblings('.name-err').text('Name is required');
        hasError = true;
      } else {
        names.push(val);
      }
      });

      if (hasError || names.length === 0) {
      $(this).prop('disabled', false);
      return;
      }

      let formData = new FormData();
      $('input[name="name[]"]').each(function (i) {
      const nameVal = $(this).val().trim();
      const fileInput = $('input[name="image[]"]').eq(i)[0];
      const file = fileInput?.files[0];

      if (!nameVal) {
        $(this).siblings('.name-err').text('Name is required');
        hasError = true;
      }

      formData.append(`name[${i}]`, nameVal);
      if (file) {
        formData.append(`image[${i}]`, file);
      }
      });

      $.ajax({
      url: "{{ route('admin.manage-book-type.store') }}",
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Created!', 'Book Types added successfully.', 'success');
        setTimeout(() => location.reload(), 400);
        } else {
        $('#add-book-type-btn').prop('disabled', false);
        if (response.code === 422) {
          $.each(response.errors['name'], function (index, message) {
          $('.name-err').eq(index).text(message);
          });
        } else {
          Swal.fire('Error', response.msgText ?? 'Something went wrong', 'error');
        }
        }
      }
      });
    });

    // Update
    $(document).on('click', '#update-book-type-btn', function () {
      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('book-type-form'));
      formData.append('_method', 'PUT');

      $('#update-book-type-btn').prop('disabled', true);
      $('.validation-err').text('');

      $.ajax({
      url: `/admin/manage-book-type/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Updated!', response.message, 'success');
        setTimeout(() => location.reload(), 500);
        } else {
        $('#update-book-type-btn').prop('disabled', false);
        if (response.code === 422) {
          if (response.errors.name) {
          $('#name-err').text(response.errors.name[0]);
          }
          if (response.errors.image) {
          $('#image-err').text(response.errors.image[0]);
          }
        } else {
          Swal.fire('Error', response.message ?? 'Something went wrong', 'error');
        }
        }
      }
      });
    });


    // Modal Add More
    $(document).on('click', '#add-more', function () {
      let newRow = `
    <div class="book-type-row form-row mb-2">
    <div class="col-md-5">
      <input type="text" name="name[]" class="form-control" placeholder="Enter book type name">
      <span class="text-danger validation-err name-err"></span>
    </div>
    <div class="col-md-5">
      <input type="file" name="image[]" class="form-control">
      <span class="text-danger validation-err image-err"></span>
    </div>
    <div class="col-md-2 text-right">
      <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
    </div>
    </div>
    `;
      $('#book-type-wrapper').append(newRow);
      $('.remove-row').show();
    });

    // Modal Remove Row
    $(document).on('click', '.remove-row', function () {
      $(this).closest('.book-type-row').remove();
      if ($('.book-type-row').length === 1) {
      $('.remove-row').hide();
      }
    });

    });
  </script>
@endpush