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
          <li class="breadcrumb-item active">Cover Weight</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <div class="dropdown">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
          id="add-cover-weight">Add</a>
        </div>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cover Weight</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="cover-weight-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th width="70px">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($coverWeights) && count($coverWeights) > 0)
            @foreach($coverWeights as $weight)
          <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $weight->gsm }}</td>
          <td>
          <ul class="list-inline">
          <li class="list-inline-item">
          <a href="javascript:void()" class="btn btn-primary btn-sm-custom edit-cover-weight"
            data-id="{{ $weight->id }}">
            <i class="fas fa-pencil-alt"></i>
          </a>
          </li>
          <li class="list-inline-item">
          <a href="javascript:void(0)" onclick="deleteConfirmation({{ $weight->id }})" title="Delete">
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

  <div class="modal" id="cover-weight-modal"></div>
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
        url: `/admin/manage-cover-weight/${id}`,
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
    $('#cover-weight-table').DataTable();

    // Add
    $('#add-cover-weight').on('click', function () {
      $.get("{{ route('admin.manage-cover-weight.create') }}", function (response) {
      if (response.success) {
        $('#cover-weight-modal').html(response.html).modal('show');
      }
      });
    });

    // Store
    $(document).on('click', '#add-cover-weight-btn', function () {
      $(this).prop('disabled', true);
      $('.gsm-err').html('');

      let formData = new FormData(document.getElementById('cover-weight-form'));

      $.ajax({
      url: "{{ route('admin.manage-cover-weight.store') }}",
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Created!', '', 'success');
        $('#cover-weight-modal').modal('hide');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#add-cover-weight-btn').prop('disabled', false);
        if (response.code === 422 && response.errors) {
          $.each(response.errors, function (key, messages) {
          const parts = key.split('.');
          if (parts.length === 2 && parts[0] === 'gsm') {
            const index = parseInt(parts[1]);
            $('.gsm-err').eq(index).text(messages[0]);
          }
          });
        } else {
          Swal.fire('Error', response.msgText ?? 'Something went wrong', 'error');
        }
        }
      }
      });
    });


    // Edit
    $(document).on('click', '.edit-cover-weight', function () {
      let id = $(this).data('id');
      $.get(`/admin/manage-cover-weight/${id}/edit`, function (response) {
      if (response.success) {
        $('#cover-weight-modal').html(response.html).modal('show');
      }
      });
    });

    // Update
    $(document).on('click', '#update-cover-weight-btn', function () {
      $(this).prop('disabled', true);
      $('.validation-err').text('');

      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('cover-weight-form'));
      formData.append('_method', 'PUT');

      $.ajax({
      url: `/admin/manage-cover-weight/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Updated!', '', 'success');
        $('#cover-weight-modal').modal('hide');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#update-cover-weight-btn').prop('disabled', false);
        if (response.errors) {
          $.each(response.errors, function (key, messages) {
          const $input = $(`[name="${key}"]`);
          const $errorSpan = $input.siblings('.' + key + '-err');
          if ($errorSpan.length) {
            $errorSpan.html(messages[0]);
          }
          });
        }
        else {
          Swal.fire('Error', response.msgText ?? 'Something went wrong', 'error');
        }
        }
      }
      });
    });

    // Modal Add More
    $(document).on('click', '#add-more', function () {
      let newRow = `
      <div class="cover-weight-row form-row mb-2">
      <div class="col-md-11">
      <input type="text" name="gsm[]" class="form-control" placeholder="Enter GSM">
      <span class="text-danger validation-err gsm-err"></span>
      </div>
      <div class="col-md-1 text-right">
      <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none;">×</button>
      </div>
      </div>
      `;
      $('#cover-weight-wrapper').append(newRow);
      $('.remove-row').show();
    });

    });
  </script>
@endpush