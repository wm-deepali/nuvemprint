<div class="modal-dialog modal-dialog-centered modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit Book Type</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form id="book-type-form" enctype="multipart/form-data">
        {{-- Name --}}
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" value="{{ $bookType->name }}" class="form-control">
          <span class="text-danger validation-err" id="name-err"></span>
        </div>

        {{-- Image --}}
        <div class="form-group">
          <label>Image</label><br>
          @if($bookType->image)
            <img src="{{ asset('storage/' . $bookType->image) }}" width="70" class="mb-2">
          @endif
          <input type="file" name="image" class="form-control">
          <span class="text-danger validation-err" id="image-err"></span>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="update-book-type-btn" data-id="{{ $bookType->id }}">Update</button>
    </div>
  </div>
</div>
