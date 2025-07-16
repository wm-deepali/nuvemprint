<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-value-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute Value</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        {{-- Attribute (readonly) --}}
        <div class="form-group">
          <label>Attribute <span class="text-danger">*</span></label>
          <select class="form-control" disabled id="attribute-select">
            <option value="{{ $attribute->id }}" selected>{{ $attribute->name }}</option>
          </select>
          <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
          <span class="text-danger validation-err" id="attribute_id-err"></span>
        </div>

        {{-- Title --}}
        <div class="form-group" id="title-wrapper" style="display: none;">
          <label>Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ $attributeValue->title }}">
          <span class="text-danger validation-err" id="title-err"></span>
        </div>

        {{-- Value --}}
        <div class="form-group" id="value-wrapper">
          <label>Value <span class="text-danger">*</span></label>
          @php
            $inputType = $attributeConfigs[$attribute->id]['input_type'] ?? 'text';
          @endphp

          @if (in_array($inputType, ['select_image', 'select_icon']))
            <input type="file" name="value" class="form-control-file">
            @if ($attributeValue->image_path)
              <div class="mt-2 existing-preview">
                <strong>Existing Image:</strong><br>
                <img src="{{ asset('storage/' . $attributeValue->image_path) }}" width="80" alt="Current Image">
              </div>
            @endif
          @else
            <input type="text" name="value" class="form-control" value="{{ $attributeValue->value }}">
          @endif

          <span class="text-danger validation-err" id="value-err"></span>
        </div>

        {{-- Icon Class --}}
        @if ($attribute->has_icon)
          <div class="form-group" id="icon-class-wrapper">
            <label>Icon Class</label>
            <input type="text" name="icon_class" class="form-control" value="{{ $attributeValue->icon_class }}">
            <span class="text-danger validation-err" id="icon_class-err"></span>
          </div>
        @endif

        {{-- Description --}}
        @if ($attribute->has_description)
          <div class="form-group" id="description-wrapper">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="2">{{ $attributeValue->description }}</textarea>
            <span class="text-danger validation-err" id="description-err"></span>
          </div>
        @endif

        {{-- Optional Image Field --}}
        @if ($attribute->has_image)
          <div class="form-group" id="image-wrapper">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control-file">
            @if ($attributeValue->image_path)
              <div class="mt-2">
                <img src="{{ asset('storage/' . $attributeValue->image_path) }}" width="60">
              </div>
            @endif
            <span class="text-danger validation-err" id="image-err"></span>
          </div>
        @endif
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-attribute-value-btn" data-id="{{ $attributeValue->id }}">
          Update
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    const inputType = @json($attributeConfigs[$attribute->id]['input_type'] ?? 'text');

    // Show/hide title
    if (['select_image', 'select_icon'].includes(inputType)) {
      $('#title-wrapper').show();
    } else {
      $('#title-wrapper').hide();
    }

    // Hide existing image preview when a new file is selected
    $('input[name="value"]').on('change', function () {
      $(this).siblings('.existing-preview').hide();
    });
  });
</script>
