<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit Cover Finish</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="cover-finish-form" enctype="multipart/form-data">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ $coverFinish->name }}">
          <span class="text-danger" id="name-err"></span>
        </div>
        <div class="form-group">
          <label>Image</label><br>
          @if($coverFinish->image_path)
            <img src="{{ asset('storage/' . $coverFinish->image_path) }}" width="70" class="mb-2">
          @endif
          <input type="file" name="image" class="form-control">
          <span class="text-danger" id="image-err"></span>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="update-cover-finish-btn" data-id="{{ $coverFinish->id }}">Update</button>
    </div>
  </div>
</div>
