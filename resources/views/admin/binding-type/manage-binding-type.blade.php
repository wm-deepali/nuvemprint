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
            <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" id="add-binding-type">Add</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Binding Types</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pagetype-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Has Embossing</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if (isset($binding_types) && count($binding_types)>0)
                          @foreach ($binding_types as $binding_type)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $binding_type->name }}</td>
                            <td>
                                @if (isset($binding_type->image) && Storage::exists($binding_type->image))
                                    <img src="{{ URL::asset('storage/'.$binding_type->image) }}" alt="{{ $binding_type->name }}">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $binding_type->has_embossing }}</td>
                            <td>{{ $binding_type->price }}</td>
                            <td>{{ $binding_type->status }}</td>
                            <td>
                              <li><a href="javascript:void()" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light edit-binding-type" binding_type_id="{{ $binding_type->id }}"><i class="fas fa-pencil-alt"></i></a></li>
                              <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $binding_type->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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

<div class="modal" id="binding-type-modal">
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
                  url:`{{ URL::to('admin/manage-binding-type/${id}') }}`,
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
    $(document).on('click','#add-binding-type',function(event){
        $.ajax({
            url:"{{ URL::to('admin/manage-binding-type/create') }}",
            type:"GET",
            dataType:"json",
            success:function(result) {
                if (result.success) {
                    $("#binding-type-modal").html(result.html);
                    $("#binding-type-modal").modal('show');
                } else {

                }
            }
        });
    });
    $(document).on("click","#add-binding-type-btn",function(event){
        $(this).attr('disabled',true);
        $('.validation-err').html('');
        let formData=new FormData();
        formData.append('name',$('#name').val());
        formData.append('image',(typeof($('#image')[0].files[0]) == 'undefined') ? '' : $('#image')[0].files[0]);
        formData.append('single_side_minimum_page',$('#single_side_minimum_page').val());
        formData.append('single_side_maximum_page',$('#single_side_maximum_page').val());
        formData.append('double_side_minimum_page',$('#double_side_minimum_page').val());
        formData.append('double_side_maximum_page',$('#double_side_maximum_page').val());
        formData.append('has_embossing',$('#has_embossing').val());
        formData.append('price',$('#price').val());
        formData.append('status',$('#status').val());
        $.ajax({
            url:"{{ URL::to('admin/manage-binding-type') }}",
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

    $(document).on("click",".edit-binding-type",function(event){
      let id = $(this).attr('binding_type_id');
      $.ajax({
          url:`{{ URL::to('admin/manage-binding-type/${id}/edit') }}`,
          type:"get",
          dataType:"json",
          success:function(result) {
            if(result.success) {
              $("#binding-type-modal").html(result.html);
              $("#binding-type-modal").modal('show');
            } else {
              console.log(result.msgText)
            }
          },
          error:function(error){
            console.log(result.msgText)
          }
      });
    });

    $(document).on("click","#update-binding-type-btn",function(event){
        $(this).attr('disabled',true);
        $('.validation-err').html('');
        let formData=new FormData();
        formData.append('_method','PUT');
        formData.append('name',$('#name').val());
        formData.append('image',(typeof($('#image')[0].files[0]) == 'undefined') ? '' : $('#image')[0].files[0]);
        formData.append('single_side_minimum_page',$('#single_side_minimum_page').val());
        formData.append('single_side_maximum_page',$('#single_side_maximum_page').val());
        formData.append('double_side_minimum_page',$('#double_side_minimum_page').val());
        formData.append('double_side_maximum_page',$('#double_side_maximum_page').val());
        formData.append('has_embossing',$('#has_embossing').val());
        formData.append('price',$('#price').val());
        formData.append('status',$('#status').val());
        let id = $(this).attr('binding_type_id');
        $.ajax({
            url:`{{ URL::to('admin/manage-binding-type/${id}') }}`,
            type:'POST',
            processData: false,
            contentType: false,
            dataType:'json',
            data:formData,
            context:this,
            success:function(result) {
                if(result.success) {
                  Swal.fire(
                    'Updated!',
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