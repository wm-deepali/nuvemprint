<!-- Add Modal -->
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Attributes</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div id="attribute-fields-wrapper">
          <div class="attribute-item border p-2 mb-2">
            <div class="form-group">
              <label>Name <span class="text-danger">*</span></label>
              <input type="text" name="attributes[0][name]" class="form-control">
              <small class="text-danger validation-err" id="attributes_0_name-err"></small>
            </div>

            <div class="form-group">
              <label>Input Type <span class="text-danger">*</span></label>
              <select name="attributes[0][input_type]" class="form-control">
                <option value="dropdown">Dropdown</option>
                <option value="radio">Radio</option>
                <option value="checkbox">Checkbox</option>
                <option value="text">Text</option>
                <option value="number">Number</option>
                <option value="range">Range</option>
                <option value="select_image">Select Image</option>
                <option value="select_icon">Select Icon</option>
                <option value="toggle">Toggle</option>
                <option value="textarea">Textarea</option>
                <option value="grouped_select">Grouped Select</option>
              </select>
              <small class="text-danger validation-err" id="attributes_0_input_type-err"></small>
            </div>

            <div class="form-group">
              <label>Detail</label>
              <textarea name="attributes[0][detail]" class="form-control" rows="2"
                placeholder="Optional description..."></textarea>
              <small class="text-danger validation-err" id="attributes_0_detail-err"></small>
            </div>


            <div class="form-group form-check">
              <input type="checkbox" name="attributes[0][has_image]" value="1" class="form-check-input" id="image-0">
              <label class="form-check-label" for="image-0">Supports Images</label>
            </div>

            <div class="form-group form-check">
              <input type="checkbox" name="attributes[0][has_icon]" value="1" class="form-check-input" id="icon-0">
              <label class="form-check-label" for="icon-0">Supports Icons</label>
            </div>


            <button type="button" class="btn btn-danger btn-sm remove-attribute d-none">Remove</button>
          </div>
        </div>

        <button type="button" class="btn btn-sm btn-success" id="add-more-attribute">Add More</button>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="save-attribute-btn">Save</button>
      </div>
    </form>
  </div>
</div>


<script>
  let attributeIndex = 1;

  const excludedTypes = ['select_image', 'select_icon', 'grouped_select', 'range', 'toggle', 'number'];

  // 🔁 Attach event to handle conditional hide/show
  function toggleSupportFields($item, selectedType) {
    if (excludedTypes.includes(selectedType)) {
      $item.find('.form-check-input[name$="[has_image]"]').closest('.form-group').hide();
      $item.find('.form-check-input[name$="[has_icon]"]').closest('.form-group').hide();
    } else {
      $item.find('.form-check-input[name$="[has_image]"]').closest('.form-group').show();
      $item.find('.form-check-input[name$="[has_icon]"]').closest('.form-group').show();
    }
  }

  // 🟡 Attach change event for all input_type selects
  $(document).on('change', 'select[name$="[input_type]"]', function () {
    const $item = $(this).closest('.attribute-item');
    const selectedType = $(this).val();
    toggleSupportFields($item, selectedType);
  });

  // ➕ Add new attribute field block
  $(document).on('click', '#add-more-attribute', function () {
    const html = `
      <div class="attribute-item border p-2 mb-2">
        <div class="form-group">
          <label>Name <span class="text-danger">*</span></label>
          <input type="text" name="attributes[${attributeIndex}][name]" class="form-control">
          <small class="text-danger" id="attributes.${attributeIndex}.name-err"></small>
        </div>

        <div class="form-group">
          <label>Input Type <span class="text-danger">*</span></label>
          <select name="attributes[${attributeIndex}][input_type]" class="form-control">
            <option value="dropdown">Dropdown</option>
            <option value="radio">Radio</option>
            <option value="checkbox">Checkbox</option>
            <option value="text">Text</option>
            <option value="number">Number</option>
            <option value="range">Range</option>
            <option value="select_image">Select Image</option>
            <option value="select_icon">Select Icon</option>
            <option value="toggle">Toggle</option>
            <option value="textarea">Textarea</option>
            <option value="grouped_select">Grouped Select</option>
          </select>
          <small class="text-danger" id="attributes.${attributeIndex}.input_type-err"></small>
        </div>

        <div class="form-group">
          <label>Detail</label>
          <textarea name="attributes[${attributeIndex}][detail]" class="form-control" rows="2" placeholder="Optional description..."></textarea>
          <small class="text-danger" id="attributes.${attributeIndex}.detail-err"></small>
        </div>

        <div class="form-group form-check">
          <input type="checkbox" name="attributes[${attributeIndex}][has_image]" value="1" class="form-check-input" id="image-${attributeIndex}">
          <label class="form-check-label" for="image-${attributeIndex}">Supports Images</label>
        </div>

        <div class="form-group form-check">
          <input type="checkbox" name="attributes[${attributeIndex}][has_icon]" value="1" class="form-check-input" id="icon-${attributeIndex}">
          <label class="form-check-label" for="icon-${attributeIndex}">Supports Icons</label>
        </div>

        <button type="button" class="btn btn-danger btn-sm remove-attribute">Remove</button>
      </div>
    `;

    $('#attribute-fields-wrapper').append(html);
    attributeIndex++;
  });

  // ❌ Remove attribute block
  $(document).on('click', '.remove-attribute', function () {
    $(this).closest('.attribute-item').remove();
  });

  // ✅ Trigger toggle for existing field on load (index 0)
  $(document).ready(function () {
    const $firstItem = $('.attribute-item').first();
    const selectedType = $firstItem.find('select[name$="[input_type]"]').val();
    toggleSupportFields($firstItem, selectedType);
  });
</script>
