<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-value-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Attribute Value</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        {{-- Attribute Select --}}
        <div class="form-group">
          <label>Attribute <span class="text-danger">*</span></label>
          <select name="attribute_id" class="form-control" id="attribute-select">
            @foreach ($attributes as $attribute)
              <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
            @endforeach
          </select>
          <span class="text-danger validation-err" id="attribute_id-err"></span>
        </div>

        {{-- Values Wrapper --}}
        <div id="attribute-values-wrapper">
          <div class="value-block border p-2 mb-2">
            <div class="form-group" id="value-input-wrapper-0">
              <label>Value <span class="text-danger">*</span></label>
              <input type="text" name="attribute_values[0][value]" class="form-control">
              <span class="text-danger validation-err" id="values_0_value-err"></span>
            </div>

            <div class="form-group d-none" id="title-wrapper-0">
              <label>Title <span class="text-danger">*</span></label>
              <input type="text" name="attribute_values[0][title]" class="form-control">
              <span class="text-danger validation-err" id="values_0_title-err"></span>
            </div>

            <div class="form-group" id="icon-class-wrapper-0">
              <label>Icon Class (optional)</label>
              <input type="text" name="attribute_values[0][icon_class]" class="form-control" placeholder="e.g., fa fa-star">
              <span class="text-danger validation-err" id="values_0_icon_class-err"></span>
            </div>

            <div class="form-group" id="description-wrapper-0">
              <label>Description (optional)</label>
              <textarea name="attribute_values[0][description]" class="form-control" rows="3"></textarea>
              <span class="text-danger validation-err" id="values_0_description-err"></span>
            </div>

            <div class="form-group" id="image-wrapper-0">
              <label>Image (optional)</label>
              <input type="file" name="attribute_values[0][image]" class="form-control-file">
              <span class="text-danger validation-err" id="values_0_image-err"></span>
            </div>

            <button type="button" class="btn btn-danger btn-sm remove-value d-none">Remove</button>
          </div>
        </div>

        <button type="button" class="btn btn-success btn-sm" id="add-more-value">Add More</button>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
        <button type="button" id="save-attribute-value-btn" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
  function initAttributeModalScripts() {
    const attributeConfigs = @json($attributeConfigs);
    let valueIndex = $('#attribute-values-wrapper .value-block').length;

    function renderValueField(index, isFileType) {
      const wrapper = $(`#value-input-wrapper-${index}`);
      const input = isFileType
        ? `<input type="file" name="attribute_values[${index}][value]" class="form-control-file">`
        : `<input type="text" name="attribute_values[${index}][value]" class="form-control">`;
      wrapper.html(`
        <label>Value ${isFileType ? '(File)' : ''} <span class="text-danger">*</span></label>
        ${input}
        <span class="text-danger validation-err" id="values_${index}_value-err"></span>
      `);
    }

    function toggleFieldsForBlock(index) {
      const attributeId = $('#attribute-select').val();
      const config = attributeConfigs[attributeId] || {};
      const inputType = config.input_type || '';

      const isFileType = ['select_image', 'select_icon'].includes(inputType);
      renderValueField(index, isFileType);

      $(`#icon-class-wrapper-${index}`)[config.has_icon ? 'show' : 'hide']();
      $(`#description-wrapper-${index}`)[config.has_description ? 'show' : 'hide']();
      $(`#image-wrapper-${index}`)[config.has_image ? 'show' : 'hide']();
      $(`#title-wrapper-${index}`)[isFileType ? 'removeClass' : 'addClass']('d-none');
    }

    // Initial toggle
    toggleFieldsForBlock(0);

    $('#attribute-select').off('change').on('change', function () {
      for (let i = 0; i < valueIndex; i++) {
        toggleFieldsForBlock(i);
      }
    });

    $('#add-more-value').off('click').on('click', function () {
      const newBlock = `
        <div class="value-block border p-2 mb-2">
          <div class="form-group" id="value-input-wrapper-${valueIndex}">
            <label>Value <span class="text-danger">*</span></label>
            <input type="text" name="attribute_values[${valueIndex}][value]" class="form-control">
            <span class="text-danger validation-err" id="values_${valueIndex}_value-err"></span>
          </div>

          <div class="form-group d-none" id="title-wrapper-${valueIndex}">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="attribute_values[${valueIndex}][title]" class="form-control">
            <span class="text-danger validation-err" id="values_${valueIndex}_title-err"></span>
          </div>

          <div class="form-group" id="icon-class-wrapper-${valueIndex}">
            <label>Icon Class (optional)</label>
            <input type="text" name="attribute_values[${valueIndex}][icon_class]" class="form-control">
            <span class="text-danger validation-err" id="values_${valueIndex}_icon_class-err"></span>
          </div>

          <div class="form-group" id="description-wrapper-${valueIndex}">
            <label>Description (optional)</label>
            <textarea name="attribute_values[${valueIndex}][description]" class="form-control" rows="3"></textarea>
            <span class="text-danger validation-err" id="values_${valueIndex}_description-err"></span>
          </div>

          <div class="form-group" id="image-wrapper-${valueIndex}">
            <label>Image (optional)</label>
            <input type="file" name="attribute_values[${valueIndex}][image]" class="form-control-file">
            <span class="text-danger validation-err" id="values_${valueIndex}_image-err"></span>
          </div>

          <button type="button" class="btn btn-danger btn-sm remove-value">Remove</button>
        </div>
      `;
      $('#attribute-values-wrapper').append(newBlock);
      toggleFieldsForBlock(valueIndex);
      valueIndex++;
    });

    $(document).off('click', '.remove-value').on('click', '.remove-value', function () {
      $(this).closest('.value-block').remove();
    });
  }
</script>
