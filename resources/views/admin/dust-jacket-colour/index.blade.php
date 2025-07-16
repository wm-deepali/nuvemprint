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
          <li class="breadcrumb-item active">Dust Jacket Colours</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <div class="dropdown">
        <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-round" id="add-dust-colour">Add</a>
        </div>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Dust Jacket Colours</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="dust-colour-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th width="70px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dustColours as $dustColour)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $dustColour->name }}</td>
          <td>
          <ul class="list-inline">
          <li class="list-inline-item">
          <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-sm-custom edit-dust-colour"
            data-id="{{ $dustColour->id }}">
            <i class="fas fa-pencil-alt"></i>
          </a>
          </li>
          <li class="list-inline-item">
          <a href="javascript:void(0)" onclick="deleteDustColour({{ $dustColour->id }})"
            title="Delete">
            <i class="fa fa-trash text-danger"></i>
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

  {{-- Modal --}}
  <div class="modal fade" id="dust-colour-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('scripts')
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    function deleteDustColour(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: 'This will permanently delete the record!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonColor: '#d33'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `/admin/manage-dust-jacket-colour/${id}`,
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
    $('#dust-colour-table').DataTable();

    // Load Create Modal
    $('#add-dust-colour').on('click', function () {
      $.get("{{ route('admin.manage-dust-jacket-colour.create') }}", function (response) {
      if (response.success) {
        $('#dust-colour-modal').html(response.html).modal('show');
      }
      });
    });

    // Load Edit Modal
    $(document).on('click', '.edit-dust-colour', function () {
      let id = $(this).data('id');
      $.get(`/admin/manage-dust-jacket-colour/${id}/edit`, function (response) {
      if (response.success) {
        $('#dust-colour-modal').html(response.html).modal('show');
      }
      });
    });

    // Store
    $(document).on('click', '#add-dust-colour-btn', function () {
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
      names.forEach(name => formData.append('name[]', name));

      $.ajax({
      url: "{{ route('admin.manage-dust-jacket-colour.store') }}",
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Created!', 'Dust jacket colour added successfully.', 'success');
        setTimeout(() => location.reload(), 400);
        } else {
        $('#add-dust-colour-btn').prop('disabled', false);
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
    $(document).on('click', '#update-dust-colour-btn', function () {
      $(this).prop('disabled', true);
      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('dust-colour-form'));
      formData.append('_method', 'PUT');

      $.ajax({
      url: `/admin/manage-dust-jacket-colour/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Updated!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#update-dust-colour-btn').prop('disabled', false);
        if (response.errors) {
          $.each(response.errors, function (key, value) {
          $(`#${key}-err`).html(value[0]);
          });
        }
        }
      }
      });
    });

    // Add More Input Fields
    $(document).on('click', '#add-more', function () {
      let newRow = `
      <div class="dust-colour-row form-row mb-2">
      <div class="col-md-11">
      <input type="text" name="name[]" class="form-control" placeholder="Enter dust jacket colour name">
      <span class="text-danger validation-err name-err"></span>
      </div>
      <div class="col-md-1 text-right">
      <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
      </div>
      </div>
      `;
      $('#dust-colour-wrapper').append(newRow);
      $('.remove-row').show();
    });

    $(document).on('click', '.remove-row', function () {
      $(this).closest('.dust-colour-row').remove();
      if ($('.dust-colour-row').length === 1) {
      $('.remove-row').hide();
      }
    });
    });
  </script>
@endpush