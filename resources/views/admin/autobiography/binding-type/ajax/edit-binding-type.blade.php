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
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ $binding_type->name }}">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                        <div class="text-danger validation-err" id="image-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Single Side Minimum Page</label>
                        <input type="number" name="single_side_minimum_page" id="single_side_minimum_page" class="form-control" value="{{ $binding_type->single_side_minimum_page }}">
                        <div class="text-danger validation-err" id="single_side_minimum_page-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Single Side Maximum Page</label>
                        <input type="number" name="single_side_maximum_page" id="single_side_maximum_page" class="form-control" value="{{ $binding_type->single_side_maximum_page }}">
                        <div class="text-danger validation-err" id="single_side_maximum_page-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Double Side Minimum Page</label>
                        <input type="number" name="double_side_minimum_page" id="double_side_minimum_page" class="form-control" value="{{ $binding_type->double_side_minimum_page }}">
                        <div class="text-danger validation-err" id="double_side_minimum_page-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Double Side Maximum Page</label>
                        <input type="number" name="double_side_maximum_page" id="double_side_maximum_page" class="form-control" value="{{ $binding_type->double_side_maximum_page }}">
                        <div class="text-danger validation-err" id="double_side_maximum_page-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Has Embossing</label>
                        <select class="form-control" name="has_embossing" id="has_embossing">
                            <option value="yes" @if ($binding_type->has_embossing == 'yes')
                                selected
                            @endif>Yes</option>
                            <option value="no" @if ($binding_type->has_embossing == 'no')
                                selected
                            @endif>No</option>
                        </select>
                        <div class="text-danger validation-err" id="has_embossing-err"></div>
                    </div>
					<div class="form-group row">
                        <label>Has Custom Cover</label>
                        <select class="form-control" name="has_custom_cover" id="has_custom_cover">
                            <option value="yes" @if ($binding_type->has_custom_cover == 'yes')
                                selected
                            @endif>Yes</option>
                            <option value="no" @if ($binding_type->has_custom_cover == 'no')
                                selected
                            @endif>No</option>
                        </select>
                        <div class="text-danger validation-err" id="has_custom_cover-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Price</label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ $binding_type->price }}">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" @if ($binding_type->status == 'active')
                                selected
                            @endif>Active</option>
                            <option value="block" @if ($binding_type->status == 'block')
                                selected
                            @endif>Block</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                    <div class="form-group row">
                        <button type="button" class="btn btn-info" id="update-binding-type-btn" binding_type_id="{{ $binding_type->id }}">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>