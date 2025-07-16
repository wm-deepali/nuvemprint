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
          <li class="breadcrumb-item active">Paper Sizes</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <div class="dropdown">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
          id="add-paper-size">Add</a>
        </div>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Paper Sizes</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="paper-size-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Dimensions</th>
              <th width="70px">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($paperSizes) && count($paperSizes) > 0)
            @foreach($paperSizes as $size)
          <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $size->name }}</td>
          <td>{{ $size->dimensions }}</td>
          <td>
          <ul class="list-inline">
          <li class="list-inline-item">
          <a href="javascript:void()" class="btn btn-primary btn-sm-custom edit-paper-size"
            data-id="{{ $size->id }}">
            <i class="fas fa-pencil-alt"></i>
          </a>
          </li>
          <li class="list-inline-item">
          <a href="javascript:void(0)" onclick="deleteConfirmation({{ $size->id }})" title="Delete">
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

  <div class="modal" id="paper-size-modal"></div>
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
        url: `/admin/manage-paper-size/${id}`,
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
    $('#paper-size-table').DataTable();

    // Add
    $('#add-paper-size').on('click', function () {
      $.get("{{ route('admin.manage-paper-size.create') }}", function (response) {
      if (response.success) {
        $('#paper-size-modal').html(response.html).modal('show');
      }
      });
    });

    // Store
    $(document).on('click', '#save-paper-size-btn', function () {
      $(this).prop('disabled', true);
      let formData = new FormData(document.getElementById('paper-size-form'));
      $.ajax({
      url: "{{ route('admin.manage-paper-size.store') }}",
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Created!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#save-paper-size-btn').prop('disabled', false);
        if (response.errors) {
          $('.validation-err').html(''); // Clear previous errors

          $.each(response.errors, function (key, value) {
          // Check if it's an array-style error like name.0
          const parts = key.split('.');
          if (parts.length === 2) {
            const field = parts[0]; // e.g., "name"
            const index = parseInt(parts[1]);

            const $row = $('.paper-size-row').eq(index);
            const $errorSpan = $row.find(`.${field}-err`);
            if ($errorSpan.length) {
            $errorSpan.html(value[0]);
            }
          } else {
            // Fallback for single input fields
            $(`.${key}-err`).html(value[0]);
          }
          });
        }

        }
      }
      });
    });

    // Edit
    $(document).on('click', '.edit-paper-size', function () {
      let id = $(this).data('id');
      $.get(`/admin/manage-paper-size/${id}/edit`, function (response) {
      if (response.success) {
        $('#paper-size-modal').html(response.html).modal('show');
      }
      });
    });

    // Update
    $(document).on('click', '#update-paper-size-btn', function () {
      $(this).prop('disabled', true);
      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('paper-size-form'));
      formData.append('_method', 'PUT');
      $.ajax({
      url: `/admin/manage-paper-size/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Updated!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#update-paper-size-btn').prop('disabled', false);
        if (response.errors) {
          $.each(response.errors, function (key, value) {
          $(`.${key}-err`).html(value[0]);
          });
        }
        }
      }
      });
    });

    // Add more paper size row
    $(document).on('click', '#add-more-paper-size', function () {
      let row = `
    <div class="paper-size-row form-row align-items-end mb-2">
      <div class="col-md-5">
      <input type="text" name="name[]" class="form-control" placeholder="e.g. A4">
      <span class="text-danger validation-err name-err small"></span>
      </div>
      <div class="col-md-5">
      <input type="text" name="dimensions[]" class="form-control" placeholder="e.g. 210 x 297 mm">
      <span class="text-danger validation-err dimensions-err small"></span>
      </div>
      <div class="col-md-1 text-right">
        <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none;">×</button>
      </div>
    </div>
    `;
      $('#paper-size-wrapper').append(row);
      $('.remove-row').show();
    });

    $(document).on('click', '.remove-row', function () {
      $(this).closest('.paper-size-row').remove();
      if ($('.paper-size-row').length === 1) {
      $('.remove-row').hide();
      }
    });

    });
  </script>
@endpush