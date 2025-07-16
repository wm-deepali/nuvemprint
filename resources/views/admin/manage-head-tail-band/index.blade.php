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
          <li class="breadcrumb-item active">Head And Tail Bands</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <div class="dropdown">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
          id="add-head-tail-band">Add</a>
        </div>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Head And Tail Bands</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="head-tail-band-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th width="70px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($headAndTailBands as $headAndTailBand)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $headAndTailBand->name }}</td>
            <td>
            @if($headAndTailBand->image_path)
          <img src="{{ asset('storage/' . $headAndTailBand->image_path) }}" width="50" height="50"
          alt="head-tail-band" />
        @endif
            </td>

            <td>
            <ul class="list-inline">
            <li class="list-inline-item">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm-custom edit-head-tail-band"
              data-id="{{ $headAndTailBand->id }}">
              <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteConfirmation({{ $headAndTailBand->id }})">
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

  <div class="modal" id="head-tail-band-modal"></div>
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
        url: `/admin/manage-head-tail-band/${id}`,
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
    $('#head-tail-band-table').DataTable();

    $('#add-head-tail-band').on('click', function () {
      $.get("{{ route('admin.manage-head-tail-band.create') }}", function (response) {
      if (response.success) {
        $('#head-tail-band-modal').html(response.html).modal('show');
      }
      });
    });

    $(document).on('click', '#add-head-tail-band-btn', function () {
      $(this).prop('disabled', true);
      let formData = new FormData(document.getElementById('head-tail-band-form'));
      $.ajax({
      url: "{{ route('admin.manage-head-tail-band.store') }}",
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Created!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#add-head-tail-band-btn').prop('disabled', false);
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

    $(document).on('click', '.edit-head-tail-band', function () {
      let id = $(this).data('id');
      $.get(`/admin/manage-head-tail-band/${id}/edit`, function (response) {
      if (response.success) {
        $('#head-tail-band-modal').html(response.html).modal('show');
      }
      });
    });

    $(document).on('click', '#update-head-tail-band-btn', function () {
      $(this).prop('disabled', true);
      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('head-tail-band-form'));
      formData.append('_method', 'PUT');
      $.ajax({
      url: `/admin/manage-head-tail-band/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
        Swal.fire('Updated!', '', 'success');
        setTimeout(() => location.reload(), 300);
        } else {
        $('#update-head-tail-band-btn').prop('disabled', false);
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

    // Add more head tail band row
    $(document).on('click', '#add-more-head-tail-band', function () {
    const row = `
    <div class="form-row mb-2 head-tail-band-row align-items-center">
      <div class="col-md-5 mb-1 mb-md-0">
      <input type="text" name="name[]" class="form-control" placeholder="e.g. White & Black">
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
    $('#head-tail-band-wrapper').append(row);
    });

    // Remove row
    $(document).on('click', '.remove-row', function () {
    $(this).closest('.head-tail-band-row').remove();
    });

  </script>
@endpush