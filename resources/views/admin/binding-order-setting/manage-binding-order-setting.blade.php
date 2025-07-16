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
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Setting</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Price Setting</h4>
            </div>
            <div class="card-body">
              <form>
                <h5>Embossing: </h5>
                <h6>Standard Embossing:</h6>
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Embossing Price</label>
                        <input type="text" class="form-control" id="standard_embossing_price" name="standard_embossing_price" value="{{ $binding_order_setting->standard_embossing_price ?? 0 }}"/>
                        <div class="text-danger validation-err" id="standard_embossing_price-err"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Spine Embossing Price</label>
                          <input type="text" class="form-control" id="standard_spine_embossing_price" name="standard_spine_embossing_price" value="{{ $binding_order_setting->standard_spine_embossing_price ?? 0 }}"/>
                          <div class="text-danger validation-err" id="standard_spine_embossing_price-err"></div>
                        </div>
                    </div>
                </div>
                <h6>Customised Embossing:</h6>
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Embossing Price</label>
                        <input type="text" class="form-control" id="customised_embossing_price" name="customised_embossing_price" value="{{ $binding_order_setting->customised_embossing_price ?? 0 }}"/>
                        <div class="text-danger validation-err" id="customised_embossing_price-err"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Spine Embossing Price</label>
                        <input type="text" class="form-control" id="customised_spine_embossing_price" name="customised_spine_embossing_price" value="{{ $binding_order_setting->customised_spine_embossing_price ?? 0 }}"/>
                        <div class="text-danger validation-err" id="customised_spine_embossing_price-err"></div>
                      </div>
                    </div>
                </div>
                <br>
                <h5>Data Check:</h5>
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Check for Printability Price</label>
                        <input type="text" class="form-control" id="check_for_printability_price" name="check_for_printability_price" value="{{ $binding_order_setting->check_for_printability_price ?? 0 }}"/>
                        <div class="text-danger validation-err" id="check_for_printability_price-err"></div>
                      </div>
                    </div>
                </div>
                <br>
                <h5>Extra & Accessories:</h5>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Ribbon Price</label>
                      <input type="text" class="form-control" id="ribbon_price" name="ribbon_price" value="{{ $binding_order_setting->ribbon_price ?? 0 }}"/>
                      <div class="text-danger validation-err" id="ribbon_price-err"></div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Triangular Pocket Price</label>
                      <input type="text" class="form-control" id="triangular_pocket_price" name="triangular_pocket_price" value="{{ $binding_order_setting->triangular_pocket_price ?? 0 }}"/>
                      <div class="text-danger validation-err" id="triangular_pocket_price-err"></div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>CD Self Adhesive Price</label>
                      <input type="text" class="form-control" id="cd_self_adhesive_price" name="cd_self_adhesive_price" value="{{ $binding_order_setting->cd_self_adhesive_price ?? 0 }}"/>
                      <div class="text-danger validation-err" id="cd_self_adhesive_price-err"></div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Corner Protector Price</label>
                      <input type="text" class="form-control" id="corner_protector_price" name="corner_protector_price" value="{{ $binding_order_setting->corner_protector_price ?? 0 }}"/>
                      <div class="text-danger validation-err" id="corner_protector_price-err"></div>
                    </div>
                  </div>
                </div>
                {{-- <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Foil Price</label>
                      <input type="text" class="form-control" id="foil_price" name="foil_price" value="{{ $binding_order_setting->foil_price ?? 0 }}"/>
                      <div class="text-danger validation-err" id="foil_price-err"></div>
                    </div>
                  </div>
                </div> --}}
                <br>
                <h5>Delivery:</h5>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Next Day Delivery</label>
                      <input type="text" class="form-control" id="delivery_next_day_price" name="delivery_next_day_price" value="{{ $binding_order_setting->delivery_next_day_price ?? 0 }}"/>
                      <div class="text-danger validation-err" id="delivery_next_day_price-err"></div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>3 - 5 day delivery</label>
                      <input type="text" class="form-control" id="delivery_3_5_day_price" name="delivery_3_5_day_price" value="{{ $binding_order_setting->delivery_3_5_day_price ?? 0 }}"/>
                      <div class="text-danger validation-err" id="delivery_3_5_day_price-err"></div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>5 - 10 day delivery</label>
                      <input type="text" class="form-control" id="delivery_5_10_day_price" name="delivery_5_10_day_price" value="{{ $binding_order_setting->delivery_5_10_day_price ?? 0 }}"/>
                      <div class="text-danger validation-err" id="delivery_5_10_day_price-err"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <button type="button" class="btn btn-primary" id="add-binding-order-setting-btn">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $(document).on('click','#add-binding-order-setting-btn',function(event){
            $(this).attr('disabled',true);
            $('.validation-err').html('');
            let formData=new FormData();
            formData.append('standard_embossing_price',$('#standard_embossing_price').val());
            formData.append('standard_spine_embossing_price',$('#standard_spine_embossing_price').val());
            formData.append('customised_embossing_price',$('#customised_embossing_price').val());
            formData.append('customised_spine_embossing_price',$('#customised_spine_embossing_price').val());
            formData.append('check_for_printability_price',$('#check_for_printability_price').val());
            formData.append('ribbon_price',$('#ribbon_price').val());
            formData.append('triangular_pocket_price',$('#triangular_pocket_price').val());
            formData.append('cd_self_adhesive_price',$('#cd_self_adhesive_price').val());
            formData.append('corner_protector_price',$('#corner_protector_price').val());
            formData.append('foil_price',0);
            formData.append('delivery_next_day_price',$('#delivery_next_day_price').val());
            formData.append('delivery_3_5_day_price',$('#delivery_3_5_day_price').val());
            formData.append('delivery_5_10_day_price',$('#delivery_5_10_day_price').val());
            $.ajax({
                url:"{{ URL::to('admin/manage-binding-order-setting') }}",
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