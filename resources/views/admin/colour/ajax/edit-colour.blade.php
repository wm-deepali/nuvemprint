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
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ $colour->name }}">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Code</label>
                        <input type="color" name="code" id="code" class="form-control" placeholder="Enter code" value="{{ $colour->code }}">
                        <div class="text-danger validation-err" id="code-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" @if ($colour->status == 'active')
                                selected
                            @endif>Active</option>
                            <option value="block" @if ($colour->status == 'block')
                                selected
                            @endif>Block</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                    <div class="form-group row">
                        <button type="button" class="btn btn-info" id="update-colour-btn" colour_id="{{ $colour->id }}">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>