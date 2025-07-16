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

        .form-check {
            padding-top: 0.65rem;
            padding-left: 1.25rem;
        }

        label {
            font-weight: 500;
            font-size: 0.875rem;
        }
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-2">
                <div class="col-md-6">
                    <h4 class="mb-0">Edit Pricing Rule</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.pricing-rules.index') }}" class="btn btn-secondary btn-sm">← Back to List</a>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pricing-rules.update', $pricingRule->id) }}"
                            id="pricing-rule-form">
                            @csrf
                            @method('PUT')

                            {{-- Category & Subcategory --}}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Category</label>
                                    <div class="form-control-plaintext">{{ $pricingRule->category->name }}</div>
                                    <input type="hidden" name="category_id" value="{{ $pricingRule->category_id }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Subcategory</label>
                                    <div class="form-control-plaintext">{{ $pricingRule->subcategory->name }}</div>
                                    <input type="hidden" name="subcategory_id" value="{{ $pricingRule->subcategory_id }}">
                                </div>
                            </div>

                            <hr>

                            {{-- Pricing Rules --}}
                            <h6>Pricing Rules</h6>
                            <div id="pricing-rule-container">
                                @foreach($pricingRule->quantities as $rule)
                                    <div class="form-row pricing-rule-row border rounded p-1 mb-1 position-relative">
                                        <div class="form-group col-md-3">
                                            <label>Quantity From</label>
                                            <input type="number" class="form-control" name="quantity_from[]"
                                                value="{{ $rule->quantity_from }}" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Quantity To</label>
                                            <input type="number" class="form-control" name="quantity_to[]"
                                                value="{{ $rule->quantity_to }}" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Base Price</label>
                                            <input type="text" class="form-control" name="base_price[]"
                                                value="{{ $rule->base_price }}" required>
                                        </div>
                                        <div class="form-group col-md-3 d-flex align-items-end pricing-buttons"></div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            {{-- Attribute Modifiers --}}
                            <h6>Attribute Modifiers</h6>
                            <div id="attribute-modifier-container">
                                @foreach($pricingRule->attributes as $mod)
                                    <div class="form-row attribute-row border rounded p-1 mb-1 position-relative">
                                        <div class="form-group col-md-3">
                                            <label>Attribute</label>
                                            <select class="form-control" name="attribute_id[]">
                                                @foreach($subcategoryAttributes as $attr)
                                                    <option value="{{ $attr->id }}" {{ $attr->id == $mod->attribute_id ? 'selected' : '' }}>
                                                        {{ $attr->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Value</label>
                                            <select class="form-control" name="value_id[]">
                                                @php
                                                    $selectedAttr = $subcategoryAttributes->firstWhere('id', $mod->attribute_id);
                                                @endphp
                                                @foreach($selectedAttr->values ?? [] as $val)
                                                    <option value="{{ $val->id }}" {{ $val->id == $mod->value_id ? 'selected' : '' }}>
                                                        {{ $val->value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Modifier Type</label>
                                            <select class="form-control" name="modifier_type[]">
                                                <option value="add" {{ $mod->price_modifier_type == 'add' ? 'selected' : '' }}>Add</option>
                                                <option value="multiply" {{ $mod->price_modifier_type == 'multiply' ? 'selected' : '' }}>Multiply</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Modifier Value</label>
                                            <input type="text" class="form-control" name="modifier_value[]"
                                                value="{{ $mod->price_modifier_value }}">
                                        </div>
                                          <div class="form-group col-md-1 d-flex align-items-center justify-content-center mt-2">
     
                                          <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="default_${Date.now()}" name="is_default[]" {{ $mod->is_default ? 'checked' : '' }} value="1">
      <label class="custom-control-label" for="default_${Date.now()}" title="Mark this value as default">Default</label>
      </div>
    </div>
                                      
                                        <div class="form-group col-md-1 d-flex align-items-end modifier-buttons"></div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-success mt-2" id="save-pricing-rule-btn">Update Pricing Rule</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let subcategoryAttributes = @json($subcategoryAttributes);

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

        document.addEventListener('DOMContentLoaded', function () {
            updateButtons('#pricing-rule-container', 'pricing-rule-row', 'add-pricing-rule', 'remove-pricing-rule', '.pricing-buttons');
            updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
        });

        document.addEventListener('click', function (e) {
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

        document.addEventListener('change', function (e) {
            if (e.target.name === 'attribute_id[]') {
                const attrId = e.target.value;
                const selectedAttr = subcategoryAttributes.find(attr => attr.id == attrId);
                const valueSelect = e.target.closest('.attribute-row').querySelector('select[name="value_id[]"]');
                valueSelect.innerHTML = selectedAttr?.values.map(v => `<option value="${v.id}">${v.value}</option>`).join('') || '';
            }
        });
    </script>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#save-pricing-rule-btn').on('click', function () {
                    const $btn = $(this);
                    const form = $('#pricing-rule-form')[0];
                    const formData = new FormData(form);

                    $btn.prop('disabled', true);
                    $('.invalid-feedback').remove();
                    $('input, select').removeClass('is-invalid');

                    $.ajax({
                        url: "{{ route('admin.pricing-rules.update', $pricingRule->id) }}",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('Updated!', res.message || 'Pricing rule updated successfully.', 'success');
                                setTimeout(() => {
                                    window.location.href = res.redirect;
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
                                const msg = errors[key][0];
                                const baseKey = key.replace(/\.\d+/, '[]');
                                const $input = $(`[name="${baseKey}"]`).first();
                                $input.addClass('is-invalid');
                                if ($input.next('.invalid-feedback').length === 0) {
                                    $input.after(`<div class="invalid-feedback">${msg}</div>`);
                                } else {
                                    $input.next('.invalid-feedback').text(msg);
                                }
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
