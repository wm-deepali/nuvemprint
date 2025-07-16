<!-- resources/views/admin/attributes/modal.blade.php -->
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <form id="attribute-form" enctype="multipart/form-data">

      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label>Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" value="{{ $attribute->name ?? '' }}">
        </div>

        <div class="form-group">
          <label>Input Type <span class="text-danger">*</span></label>
           <select name="input_type" class="form-control">
    <option value="dropdown" {{ $attribute->input_type == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
    <option value="radio" {{ $attribute->input_type == 'radio' ? 'selected' : '' }}>Radio</option>
    <option value="checkbox" {{ $attribute->input_type == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
    <option value="text" {{ $attribute->input_type == 'text' ? 'selected' : '' }}>Text</option>
    <option value="number" {{ $attribute->input_type == 'number' ? 'selected' : '' }}>Number</option>
    <option value="range" {{ $attribute->input_type == 'range' ? 'selected' : '' }}>Range</option>
    <option value="select_image" {{ $attribute->input_type == 'select_image' ? 'selected' : '' }}>Select Image</option>
    <option value="select_icon" {{ $attribute->input_type == 'select_icon' ? 'selected' : '' }}>Select Icon</option>
    <option value="toggle" {{ $attribute->input_type == 'toggle' ? 'selected' : '' }}>Toggle</option>
    <option value="textarea" {{ $attribute->input_type == 'textarea' ? 'selected' : '' }}>Textarea</option>
    <option value="grouped_select" {{ $attribute->input_type == 'grouped_select' ? 'selected' : '' }}>Grouped Select</option>
</select>

        </div>

          <div class="form-group">
  <label>Detail</label>
  <textarea name="detail" class="form-control" rows="3" placeholder="Optional description...">{{ $attribute->detail ?? '' }}</textarea>
</div>

        <div class="form-group form-check">
          <input type="checkbox" name="has_image" value="1" class="form-check-input" id="edit-image"
            {{ $attribute->has_image ? 'checked' : '' }}>
          <label class="form-check-label" for="edit-image">Supports Images</label>
        </div>

        <div class="form-group form-check">
          <input type="checkbox" name="has_icon" value="1" class="form-check-input" id="edit-icon"
            {{ $attribute->has_icon ? 'checked' : '' }}>
          <label class="form-check-label" for="edit-icon">Supports Icons</label>
        </div>
      </div>

    


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-attribute-btn" data-id="{{ $attribute->id }}">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    const excludedTypes = ['select_image', 'select_icon', 'grouped_select', 'range', 'toggle', 'number'];

    function toggleEditSupportFields(selectedType) {
      if (excludedTypes.includes(selectedType)) {
        $('#edit-image').closest('.form-group').hide();
        $('#edit-icon').closest('.form-group').hide();
      } else {
        $('#edit-image').closest('.form-group').show();
        $('#edit-icon').closest('.form-group').show();
      }
    }

    // 🟡 Initial check on modal load
    const currentType = $('select[name="input_type"]').val();
    toggleEditSupportFields(currentType);

    // 🔁 Bind change event
    $('select[name="input_type"]').on('change', function () {
      const selectedType = $(this).val();
      toggleEditSupportFields(selectedType);
    });
  });
</script>
