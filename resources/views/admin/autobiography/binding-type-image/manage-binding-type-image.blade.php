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
                <li class="breadcrumb-item active">Binding Type </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" id="add-binding-type-image">Add</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Binding Type Image</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pagetype-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Binding Type</th>
                      <th>Colour</th>
                      <th>Front Image</th>
                      <th>Spine Image</th>
                      <th>Back Image</th>
                      <th>Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if (isset($binding_type_images) && count($binding_type_images)>0)
                          @foreach ($binding_type_images as $binding_type_image)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $binding_type_image->autobiography_binding_type->name ?? '-' }}</td>
                            <td>{{ $binding_type_image->autobiography_colour->name ?? '-' }}</td>
                            <td>
                                @if (isset($binding_type_image->front_image) && Storage::exists($binding_type_image->front_image))
                                    <img src="{{ URL::asset('storage/'.$binding_type_image->front_image) }}" alt="{{ $binding_type_image->front_image }}" height="75">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if (isset($binding_type_image->spine_image) && Storage::exists($binding_type_image->spine_image))
                                    <img src="{{ URL::asset('storage/'.$binding_type_image->spine_image) }}" alt="{{ $binding_type_image->spine_image }}" height="75">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if (isset($binding_type_image->back_image) && Storage::exists($binding_type_image->back_image))
                                    <img src="{{ URL::asset('storage/'.$binding_type_image->back_image) }}" alt="{{ $binding_type_image->back_image }}" height="75">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $binding_type_image->status }}</td>
                            <td>
                              <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $binding_type_image->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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

<div class="modal" id="binding-type-image-modal">
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  function deleteConfirmation(id){
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url:`{{ URL::to('admin/manage-bio-binding-type-image/${id}') }}`,
                  type:"DELETE",
                  dataType:"json",
                  success:function(result) {
                      if(result.success) {
                          Swal.fire(
                              'Deleted!',
                              'success'
                          );
                          setTimeout(function(){
                              location.reload();
                          },400);
                      } else {
                          Swal.fire(result.msgText);
                      }
                  }
              });
          }
      })
  };
  $(document).ready( function () {
    $('#pagetype-table').DataTable();
    $(document).on('change','#binding_type',function(event){
      let binding_type = $(this).val();
      $.ajax({
        url:`{{ URL::to('admin/fetch_bio_colour_by_binding_type/${binding_type}') }}`,
        type:"GET",
        dataType:"json",
        success:function(result) {
          if (result.success) {
              $("#colour").html(result.html);
          } else {

          }
        }
      });
    });

    $(document).on('click','#add-binding-type-image',function(event){
        $.ajax({
            url:"{{ URL::to('admin/manage-bio-binding-type-image/create') }}",
            type:"GET",
            dataType:"json",
            success:function(result) {
                if (result.success) {
                    $("#binding-type-image-modal").html(result.html);
                    $("#binding-type-image-modal").modal('show');
                } else {

                }
            }
        });
    });
    $(document).on("click","#add-binding-type-image-btn",function(event){
        $(this).attr('disabled',true);
        $('.validation-err').html('');
        let formData=new FormData();
        formData.append('binding_type',$('#binding_type').val());
        formData.append('colour',$('#colour').val());
        formData.append('front_image',(typeof($('#front_image')[0].files[0]) == 'undefined') ? '' : $('#front_image')[0].files[0]);
        formData.append('spine_image',(typeof($('#spine_image')[0].files[0]) == 'undefined') ? '' : $('#spine_image')[0].files[0]);
        formData.append('back_image',(typeof($('#back_image')[0].files[0]) == 'undefined') ? '' : $('#back_image')[0].files[0]);
        formData.append('status',$('#status').val());
        $.ajax({
            url:"{{ URL::to('admin/manage-bio-binding-type-image') }}",
            type:'POST',
            processData: false,
            contentType: false,
            dataType:'json',
            data:formData,
            context:this,
            success:function(result) {
                if(result.success) {
                  Swal.fire(
                    'Created!',
                    'success'
                  );
                  setTimeout(function() {
                      location.reload();
                  },400);
                } else {
                    $(this).attr('disabled',false);
                    if(result.code==422) {
                        for (const key in result.errors) {
                            $(`#${key}-err`).html(result.errors[key][0]);
                        }
                    } else {
                      console.log(result.msgText)
                    }
                }
            }
        });
    });
  });
</script>
@endpush