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
                <li class="breadcrumb-item active">Paper Grade </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" id="add-paper-grade">Add</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Paper Grade</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pagetype-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Price Per Page (Single Sided)</th>
                      <th>Price Per Page (Double Sided)</th>
                      <th>Status</th>
                      <th width="70px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if (isset($paper_grades) && count($paper_grades)>0)
                          @foreach ($paper_grades as $paper_grade)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $paper_grade->name }}</td>
                            <td>{{ $paper_grade->price_per_page_single_side }}</td>
                            <td>{{ $paper_grade->price_per_page_double_side }}</td>
                            <td>{{ $paper_grade->status }}</td>
                            <td>
                              <li><a href="javascript:void()" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light edit-paper-grade" paper_grade_id="{{ $paper_grade->id }}"><i class="fas fa-pencil-alt"></i></a></li>
                              <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $paper_grade->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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

<div class="modal" id="paper-grade-modal">
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
                  url:`{{ URL::to('admin/manage-paper-grade/${id}') }}`,
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
    $(document).on('click','#add-paper-grade',function(event){
        $.ajax({
            url:"{{ URL::to('admin/manage-paper-grade/create') }}",
            type:"GET",
            dataType:"json",
            success:function(result) {
                if (result.success) {
                    $("#paper-grade-modal").html(result.html);
                    $("#paper-grade-modal").modal('show');
                } else {

                }
            }
        });
    });
    $(document).on("click","#add-paper-grade-btn",function(event){
        $(this).attr('disabled',true);
        $('.validation-err').html('');
        let formData=new FormData();
        formData.append('name',$('#name').val());
        formData.append('price_per_page_single_side',$('#price_per_page_single_side').val());
        formData.append('price_per_page_double_side',$('#price_per_page_double_side').val());
        formData.append('status',$('#status').val());
        $.ajax({
            url:"{{ URL::to('admin/manage-paper-grade') }}",
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

    $(document).on("click",".edit-paper-grade",function(event){
      let id = $(this).attr('paper_grade_id');
      $.ajax({
          url:`{{ URL::to('admin/manage-paper-grade/${id}/edit') }}`,
          type:"get",
          dataType:"json",
          success:function(result) {
            if(result.success) {
              $("#paper-grade-modal").html(result.html);
              $("#paper-grade-modal").modal('show');
            } else {
              console.log(result.msgText);
            }
          },
          error:function(error){
            console.log(result.msgText);
          }
      });
    });

    $(document).on("click","#update-paper-grade-btn",function(event){
        $(this).attr('disabled',true);
        $('.validation-err').html('');
        let formData=new FormData();
        formData.append('_method','PUT');
        formData.append('name',$('#name').val());
        formData.append('price_per_page_single_side',$('#price_per_page_single_side').val());
        formData.append('price_per_page_double_side',$('#price_per_page_double_side').val());
        formData.append('status',$('#status').val());
        let id = $(this).attr('paper_grade_id');
        $.ajax({
            url:`{{ URL::to('admin/manage-paper-grade/${id}') }}`,
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