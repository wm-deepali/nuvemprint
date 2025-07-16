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
                        <label>Binding Type</label>
                        <select class="form-control" name="binding_type" id="binding_type">
                            <option value="">Select</option>
                            @if (isset($binding_types) && count($binding_types)>0)
                                @foreach ($binding_types as $binding_type)
                                    <option value="{{ $binding_type->id }}" @if ($binding_type->id == $binding_type_image->binding_type_id)
                                        selected
                                    @endif>{{ $binding_type->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="text-danger validation-err" id="binding_type-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Colour</label>
                        <select class="form-control" name="colour" id="colour">
                            <option value="">Select</option>
                            @if (isset($colours) && count($colours)>0)
                                @foreach ($colours as $colour)
                                    <option value="{{ $colour->id }}" @if ($colour->id == $binding_type_image->colour_id)
                                        selected
                                    @endif>{{ $colour->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="text-danger validation-err" id="colour-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Front Image</label>
                        <input type="file" class="form-control-file" name="front_image" id="front_image">
                        <div class="text-danger validation-err" id="front_image-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Spine Image</label>
                        <input type="file" class="form-control-file" name="spine_image" id="spine_image">
                        <div class="text-danger validation-err" id="spine_image-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Back Image</label>
                        <input type="file" class="form-control-file" name="back_image" id="back_image">
                        <div class="text-danger validation-err" id="back_image-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" @if ($binding_type_image->status == 'active')
                                selected
                            @endif>Active</option>
                            <option value="block" @if ($binding_type_image->status == 'block')
                                selected
                            @endif>Block</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                    <div class="form-group row">
                        <button type="button" class="btn btn-info" id="update-binding-type-image-btn" binding_type_image_id="{{ $binding_type_image->id }}">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>