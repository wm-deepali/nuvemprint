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
                <li class="breadcrumb-item active">University</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" id="add-university">Add</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">University</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pagetype-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Country</th>
                      <th>Name</th>
                      <th>Logo-Silver</th>
                      <th>Logo-Gold</th>
                      <th>Logo-Black</th>
                      <th>Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if (isset($universities) && count($universities)>0)
                          @foreach ($universities as $university)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $university->university_country->name }}</td>
                            <td>{{ $university->name }}</td>
                            <td>
                              @if (isset($university->logo_silver) && Storage::exists($university->logo_silver))
                                <img src="{{ URL::asset('storage/'.$university->logo_silver) }}" alt="{{ $university->name }}">
                              @else
                                -
                              @endif
                            </td>
                            <td>
                                @if (isset($university->logo_gold) && Storage::exists($university->logo_gold))
                                  <img src="{{ URL::asset('storage/'.$university->logo_gold) }}" alt="{{ $university->name }}">
                                @else
                                  -
                                @endif
                            </td>
                            <td>
                                @if (isset($university->logo_black) && Storage::exists($university->logo_black))
                                  <img src="{{ URL::asset('storage/'.$university->logo_black) }}" alt="{{ $university->name }}">
                                @else
                                  -
                                @endif
                            </td>
                            <td>{{ $university->status }}</td>
                            <td>
                              <li><a href="javascript:void()" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light edit-university" university_id="{{ $university->id }}"><i class="fas fa-pencil-alt"></i></a></li>
                              <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $university->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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

<div class="modal" id="university-modal">
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
                  url:`{{ URL::to('admin/manage-university/${id}') }}`,
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
    $(document).on('click','#add-university',function(event){
        $.ajax({
            url:"{{ URL::to('admin/manage-university/create') }}",
            type:"GET",
            dataType:"json",
            success:function(result) {
                if (result.success) {
                    $("#university-modal").html(result.html);
                    $("#university-modal").modal('show');
                } else {

                }
            }
        });
    });
    $(document).on("click","#add-university-btn",function(event){
        $(this).attr('disabled',true);
        $('.validation-err').html('');
        let formData=new FormData();
        formData.append('country',$('#country').val());
        formData.append('name',$('#name').val());
        formData.append('logo_silver',(typeof($('#logo_silver')[0].files[0]) == 'undefined') ? '' : $('#logo_silver')[0].files[0]);
        formData.append('logo_gold',(typeof($('#logo_gold')[0].files[0]) == 'undefined') ? '' : $('#logo_gold')[0].files[0]);
        formData.append('logo_black',(typeof($('#logo_black')[0].files[0]) == 'undefined') ? '' : $('#logo_black')[0].files[0]);
        formData.append('status',$('#status').val());
        $.ajax({
            url:"{{ URL::to('admin/manage-university') }}",
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

    $(document).on("click",".edit-university",function(event){
      let id = $(this).attr('university_id');
      $.ajax({
          url:`{{ URL::to('admin/manage-university/${id}/edit') }}`,
          type:"get",
          dataType:"json",
          success:function(result) {
            if(result.success) {
              $("#university-modal").html(result.html);
              $("#university-modal").modal('show');
            } else {
              console.log(result.msgText);
            }
          },
          error:function(error){
            console.log(result.msgText);
          }
      });
    });

    $(document).on("click","#update-university-btn",function(event){
        $(this).attr('disabled',true);
        $('.validation-err').html('');
        let formData=new FormData();
        formData.append('_method','PUT');
        formData.append('country',$('#country').val());
        formData.append('name',$('#name').val());
        formData.append('logo_silver',(typeof($('#logo_silver')[0].files[0]) == 'undefined') ? '' : $('#logo_silver')[0].files[0]);
        formData.append('logo_gold',(typeof($('#logo_gold')[0].files[0]) == 'undefined') ? '' : $('#logo_gold')[0].files[0]);
        formData.append('logo_black',(typeof($('#logo_black')[0].files[0]) == 'undefined') ? '' : $('#logo_black')[0].files[0]);
        formData.append('status',$('#status').val());
        let id = $(this).attr('university_id');
        $.ajax({
            url:`{{ URL::to('admin/manage-university/${id}') }}`,
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