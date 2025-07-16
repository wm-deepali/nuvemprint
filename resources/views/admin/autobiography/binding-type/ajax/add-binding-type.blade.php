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
                        <label>Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                        <div class="text-danger validation-err" id="image-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Single Side Minimum Page</label>
                        <input type="number" name="single_side_minimum_page" id="single_side_minimum_page" class="form-control" value="1">
                        <div class="text-danger validation-err" id="single_side_minimum_page-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Single Side Maximum Page</label>
                        <input type="number" name="single_side_maximum_page" id="single_side_maximum_page" class="form-control" value="5">
                        <div class="text-danger validation-err" id="single_side_maximum_page-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Double Side Minimum Page</label>
                        <input type="number" name="double_side_minimum_page" id="double_side_minimum_page" class="form-control" value="1">
                        <div class="text-danger validation-err" id="double_side_minimum_page-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Double Side Maximum Page</label>
                        <input type="number" name="double_side_maximum_page" id="double_side_maximum_page" class="form-control" value="5">
                        <div class="text-danger validation-err" id="double_side_maximum_page-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Has Embossing</label>
                        <select class="form-control" name="has_embossing" id="has_embossing">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                        </select>
                        <div class="text-danger validation-err" id="has_embossing-err"></div>
                    </div>
					<div class="form-group row">
                        <label>Has Custom Cover</label>
                        <select class="form-control" name="has_custom_cover" id="has_custom_cover">
                            <option value="no" selected>No</option>
                            <option value="yes">Yes</option>
                        </select>
                        <div class="text-danger validation-err" id="has_custom_cover-err"></div>
                    </div>
                    <div class="form-group row">
                        <label>Price</label>
                        <input type="text" name="price" id="price" class="form-control" value="1.00">
                        <div class="text-danger validation-err" id="price-err"></div>
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
                        <button type="button" class="btn btn-info" id="add-binding-type-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>