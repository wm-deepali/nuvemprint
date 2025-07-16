<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form>
                    <div class="form-group row">
                        <label>Binding Type</label>
                        <select class="form-control" name="binding_type" id="binding_type">
                            <option value="">Select</option>
                            @if (isset($binding_types) && count($binding_types)>0)
                                @foreach ($binding_types as $binding_type)
                                    <option value="{{ $binding_type->id }}">{{ $binding_type->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="text-danger validation-err" id="binding_type-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Colour</label>
                        <select class="form-control" name="colour" id="colour">
                            <option value="">Select</option>
                        </select>
                        <div class="text-danger validation-err" id="colour-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Front Image <span class="text-danger">* Dimension should be 496*699</span></label>
                        <input type="file" class="form-control-file" name="front_image" id="front_image">
                        <div class="text-danger validation-err" id="front_image-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Spine Image <span class="text-danger">* Dimension should be 496*699</span></label>
                        <input type="file" class="form-control-file" name="spine_image" id="spine_image">
                        <div class="text-danger validation-err" id="spine_image-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Back Image <span class="text-danger">* Dimension should be 496*699</span></label>
                        <input type="file" class="form-control-file" name="back_image" id="back_image">
                        <div class="text-danger validation-err" id="back_image-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" selected>Active</option>
                            <option value="block">Block</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                    <div class="form-group row">
                        <button type="button" class="btn btn-info" id="add-binding-type-image-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>