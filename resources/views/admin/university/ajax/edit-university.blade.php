<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form>
                    <div class="form-group row">
                        <label>Country</label>
                        <select class="form-control" name="country" id="country">
                            <option value="">Select</option>
                            @if (isset($countries) && count($countries)>0)
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if ($country->id == $university->university_country_id)
                                        selected
                                    @endif>{{ $country->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="text-danger validation-err" id="country-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ $university->name }}">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Logo Silver</label>
                        <input type="file" name="logo_silver" id="logo_silver" class="form-control-file">
                        <div class="text-danger validation-err" id="logo_silver-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Logo Gold</label>
                        <input type="file" name="logo_gold" id="logo_gold" class="form-control-file">
                        <div class="text-danger validation-err" id="logo_gold-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Logo Black</label>
                        <input type="file" name="logo_black" id="logo_black" class="form-control-file">
                        <div class="text-danger validation-err" id="logo_black-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" @if ($university->status == 'active')
                                selected
                            @endif>Active</option>
                            <option value="block" @if ($university->status == 'block')
                                selected
                            @endif>Block</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                    <div class="form-group row">
                        <button type="button" class="btn btn-info" id="update-university-btn" university_id="{{ $university->id }}">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>