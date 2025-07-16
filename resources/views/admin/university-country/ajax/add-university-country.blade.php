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
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Flag</label>
                        <input type="file" name="flag" id="flag" class="form-control-file">
                        <div class="text-danger validation-err" id="flag-err"></div>
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
                        <button type="button" class="btn btn-info" id="add-university-country-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>