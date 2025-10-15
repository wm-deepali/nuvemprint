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
                  <li class="breadcrumb-item active">Contact Messages</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Contact Messages</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="contact-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <!-- <th>Phone</th> -->
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($submissions as $contact)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $contact->name }}</td>
                          <td>{{ $contact->email }}</td>
                          <!-- <td>{{ $contact->phone ?? '—' }}</td> -->
                          <td>{{ $contact->subject ?? '—' }}</td>
                          <td>{{ Str::limit($contact->message, 50) }}</td>
                          <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                          <td>
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" class="btn btn-sm btn-info view-contact"
                                  data-id="{{ $contact->id }}">
                                  <i class="fas fa-eye"></i>
                                </a>
                              </li>
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" onclick="deleteConfirmation({{ $contact->id }})">
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

    {{-- View Modal --}}
    <div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
  </div>
@endsection


@push('scripts')
  <script>
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // View Contact Message
    $(document).on('click', '.view-contact', function () {
      const id = $(this).data('id');
      $.get(`/admin/contact-submissions/${id}`, function (result) {
        if (result.success) {
          $('#contact-modal').html(result.html).modal('show');
        } else {
          Swal.fire('Error', 'Unable to fetch message details', 'error');
        }
      });
    });

    // Delete Contact Message
    function deleteConfirmation(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the message!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/admin/contact-submissions/${id}`,
            type: "DELETE",
            success: function (response) {
              if (response.success) {
                Swal.fire('Deleted!', '', 'success');
                setTimeout(() => location.reload(), 300);
              } else {
                Swal.fire('Error', response.msgText || 'Something went wrong', 'error');
              }
            }
          });
        }
      });
    }
  </script>
@endpush
