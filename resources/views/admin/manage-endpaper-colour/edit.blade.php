<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit Endpaper Colour</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="endpaper-colour-form" enctype="multipart/form-data">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ $endpaperColour->name }}">
          <span class="text-danger" id="name-err"></span>
        </div>
        <div class="form-group">
          <label>Image</label><br>
          @if($endpaperColour->image_path)
            <img src="{{ asset('storage/' . $endpaperColour->image_path) }}" width="70" class="mb-2">
          @endif
          <input type="file" name="image" class="form-control">
          <span class="text-danger" id="image-err"></span>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="update-endpaper-colour-btn" data-id="{{ $endpaperColour->id }}">Update</button>
    </div>
  </div>
</div>
