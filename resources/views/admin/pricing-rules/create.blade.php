@extends('layouts.master')

@section('content')
  <style>
    .remove-modifier,
    .remove-pricing-rule,
    .add-pricing-rule,
    .add-modifier {
    margin-top: 10px;
    margin-right: 10px;
    }
  </style>

  <div class="app-content content">
    <div class="content-wrapper">
    <div class="content-header row mb-2">
      <div class="col-md-6">
      <h4 class="mb-0">Add Pricing Rule</h4>
      </div>
      <div class="col-md-6 text-right">
      <a href="{{ route('admin.pricing-rules.index') }}" class="btn btn-secondary btn-sm">← Back to List</a>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.pricing-rules.store') }}" id="pricing-rule-form">

        @csrf

        {{-- Category & Subcategory --}}
        <div class="form-row">
          <div class="form-group col-md-4">
          <label>Category</label>
          <select class="form-control" id="category-select" name="category_id" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
          </select>
          </div>
          <div class="form-group col-md-4">
          <label>Subcategory</label>
          <select class="form-control" id="subcategory-select" name="subcategory_id" required>
            <option value="">-- Select Subcategory --</option>
          </select>
          </div>
        </div>

        <hr>

        {{-- Pricing Rules --}}
        <h6>Pricing Rules</h6>
        <div id="pricing-rule-container">
          <div class="form-row pricing-rule-row border rounded p-1 mb-1 position-relative">
          <div class="form-group col-md-3">
            <label>Quantity From</label>
            <input type="number" class="form-control" name="quantity_from[]" required>
          </div>
          <div class="form-group col-md-3">
            <label>Quantity To</label>
            <input type="number" class="form-control" name="quantity_to[]" required>
          </div>
          <div class="form-group col-md-3">
            <label>Base Price</label>
            <input type="text" class="form-control" name="base_price[]" required>
          </div>
          <div class="form-group col-md-3 d-flex align-items-end pricing-buttons"></div>
          </div>
        </div>

        <hr>

        {{-- Attribute Modifiers --}}
        <h6>Attribute Modifiers</h6>
        <div id="attribute-modifier-container">
          <p class="text-muted">Select a subcategory to load attributes.</p>
        </div>
        <button type="button" class="btn btn-success mt-2" id="save-pricing-rule-btn">Save Pricing Rule</button>

        </form>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script>
    const categoryMap = @json($categories->mapWithKeys(fn($cat) => [$cat->id => $cat->subcategories->map(fn($s) => ['id' => $s->id, 'name' => $s->name])]));
    let subcategoryAttributes = [];

    document.getElementById('category-select').addEventListener('change', function () {
    const subSelect = document.getElementById('subcategory-select');
    subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
    const subs = categoryMap[this.value] || [];

    subs.forEach(sub => {
      const option = document.createElement('option');
      option.value = sub.id;
      option.textContent = sub.name;
      subSelect.appendChild(option);
    });

    // Reset attribute modifiers section on category change
    document.getElementById('attribute-modifier-container').innerHTML = '<p class="text-muted">Select a subcategory to load attributes.</p>';
    });

    document.getElementById('subcategory-select').addEventListener('change', function () {
    const subcategoryId = this.value;
    if (!subcategoryId) return;

    fetch(`/admin/subcategories/${subcategoryId}/attributes`)
      .then(res => res.json())
      .then(data => {
      subcategoryAttributes = data.attributes || [];
      renderAttributeRows();
      });
    });

    function renderAttributeRows() {
    const container = document.getElementById('attribute-modifier-container');
    container.innerHTML = '';
    if (subcategoryAttributes.length === 0) {
      container.innerHTML = '<p class="text-muted">No attributes available for this subcategory.</p>';
      return;
    }
    const row = createAttributeRow();
    container.appendChild(row);
    updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
    }

    function createAttributeRow() {
    const row = document.createElement('div');
    row.className = 'form-row attribute-row border rounded p-1 mb-1 position-relative';

    row.innerHTML = `
    <div class="form-group col-md-3">
      <label>Attribute</label>
      <select class="form-control" name="attribute_id[]">
      ${subcategoryAttributes.map(attr => `<option value="${attr.id}">${attr.name}</option>`).join('')}
      </select>
    </div>
    <div class="form-group col-md-3">
      <label>Value</label>
      <select class="form-control" name="value_id[]">
      ${subcategoryAttributes[0].values.map(val => `<option value="${val.id}">${val.value}</option>`).join('')}
      </select>
    </div>
    <div class="form-group col-md-2">
      <label>Modifier Type</label>
      <select class="form-control" name="modifier_type[]">
      <option value="add">Add</option>
      <option value="multiply">Multiply</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label>Modifier Value</label>
      <input type="text" class="form-control" name="modifier_value[]">
    </div>
    <div class="form-group col-md-1 d-flex align-items-center justify-content-center mt-2">
      <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="default_${Date.now()}" name="is_default[]" value="1">
      <label class="custom-control-label" for="default_${Date.now()}" title="Mark this value as default">Default</label>
      </div>
    </div>
    <div class="form-group col-md-1 d-flex align-items-end modifier-buttons"></div>
    `;

    return row;
    }


    document.addEventListener('change', function (e) {
    if (e.target.name === 'attribute_id[]') {
      const attrId = e.target.value;
      const selectedAttr = subcategoryAttributes.find(attr => attr.id == attrId);
      const valueSelect = e.target.closest('.attribute-row').querySelector('select[name="value_id[]"]');
      valueSelect.innerHTML = selectedAttr?.values.map(v => `<option value="${v.id}">${v.value}</option>`).join('') || '';
    }
    });

    function updateButtons(containerSelector, rowClass, addClass, removeClass, buttonGroupSelector) {
    const rows = document.querySelectorAll(`.${rowClass}`);
    rows.forEach((row, index) => {
      const btnGroup = row.querySelector(buttonGroupSelector);
      btnGroup.innerHTML = '';

      if (index !== 0) {
      const removeBtn = document.createElement('button');
      removeBtn.type = 'button';
      removeBtn.className = `btn btn-sm btn-danger ${removeClass}`;
      removeBtn.textContent = '- Remove';
      btnGroup.appendChild(removeBtn);
      }

      if (index === rows.length - 1) {
      const addBtn = document.createElement('button');
      addBtn.type = 'button';
      addBtn.className = `btn btn-sm btn-primary ${addClass}`;
      addBtn.textContent = '+ Add';
      btnGroup.appendChild(addBtn);
      }
    });
    }

    document.addEventListener('click', function (e) {
    if (e.target.classList.contains('add-pricing-rule')) {
      e.preventDefault();
      const container = document.getElementById('pricing-rule-container');
      const clone = container.querySelector('.pricing-rule-row').cloneNode(true);
      clone.querySelectorAll('input').forEach(input => input.value = '');
      container.appendChild(clone);
      updateButtons('#pricing-rule-container', 'pricing-rule-row', 'add-pricing-rule', 'remove-pricing-rule', '.pricing-buttons');
    }

    if (e.target.classList.contains('remove-pricing-rule')) {
      e.preventDefault();
      e.target.closest('.pricing-rule-row').remove();
      updateButtons('#pricing-rule-container', 'pricing-rule-row', 'add-pricing-rule', 'remove-pricing-rule', '.pricing-buttons');
    }

    if (e.target.classList.contains('add-modifier')) {
      e.preventDefault();
      const container = document.getElementById('attribute-modifier-container');
      const row = createAttributeRow();
      container.appendChild(row);
      updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
    }

    if (e.target.classList.contains('remove-modifier')) {
      e.preventDefault();
      e.target.closest('.attribute-row').remove();
      updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
    }
    });

    document.addEventListener('DOMContentLoaded', function () {
    updateButtons('#pricing-rule-container', 'pricing-rule-row', 'add-pricing-rule', 'remove-pricing-rule', '.pricing-buttons');
    });
  </script>
  @push('scripts')
    <script>
    $(document).ready(function () {
    // CSRF setup
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // On Save Pricing Rule
    $('#save-pricing-rule-btn').on('click', function () {
      const $btn = $(this);
      const form = $('#pricing-rule-form')[0];
      const formData = new FormData(form);

      $btn.prop('disabled', true);
      $('.validation-err').html('');
      $('input, select').removeClass('is-invalid');

      $.ajax({
      url: "{{ route('admin.pricing-rules.store') }}",
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) {
      if (res.success) {
      Swal.fire('Saved!', res.message || 'Pricing rule created successfully.', 'success');
      setTimeout(() => {
        window.location.href = res.redirect; // ✅ Use redirect URL from backend
      }, 800);
      } else {
      $btn.prop('disabled', false);
      Swal.fire('Error', res.message || 'Something went wrong', 'error');
      }
      },
      error: function (xhr) {
      $btn.prop('disabled', false);
      const errors = xhr.responseJSON.errors || {};

      for (const key in errors) {
      const fieldName = key.replace(/\.\d+/g, '[]'); // Converts quantity_from.0 → quantity_from[]
      const msg = errors[key][0];

      // Highlight the input field
      $(`[name="${fieldName}"]`).first().addClass('is-invalid');

      // Optional: Display error message near the field
      const input = $(`[name="${fieldName}"]`).first();
      if (input.length && input.next('.invalid-feedback').length === 0) {
        input.after(`<div class="invalid-feedback">${msg}</div>`);
      }
      }
      }

      });
    });
    });
    </script>
  @endpush

@endsection