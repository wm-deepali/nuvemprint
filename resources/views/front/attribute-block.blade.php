@php
    $inputType = $attribute['input_type'] ?? 'radio';
    $values = $attribute['values'] ?? [];
    $supportImage = $attribute['has_image'] ?? false;
@endphp

{{-- ========== RADIO WITH IMAGE ========== --}}
@if ($inputType === 'radio' && $supportImage)
    <div class="attribute-wrapper col-md-12 mb-3" data-attribute-id="{{ $attribute['id'] }}"
        data-is-required="{{ $attribute['is_required'] }}">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            {{ $attribute['name'] }}
            <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="row attribute-values">
            <div class="col-md-6">
                <div class="paper-type-section">
                    @foreach ($values as $value)
                        <button type="button"
                            class="btn btn-light radio-button text-start {{ $value['is_default'] ? 'active' : '' }}"
                            data-attribute-id="{{ $attribute['id'] }}" data-value-id="{{ $value['id'] }}"
                            data-image="{{ asset('storage/' . ($value['image_path'] ?? 'default-preview.png')) }}" {{ $value['is_default'] ? 'data-selected=true' : '' }}>
                            {{ $value['value'] }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="border rounded overflow-hidden" style="width: 100%; height: 200px; padding: 3px;">
                    <img id="preview-image-{{ $attribute['id'] }}"
                        src="{{ asset('storage/' . ($attribute['values'][0]['image_path'] ?? 'default-preview.png')) }}"
                        class="img-fluid h-100 w-100 object-fit-cover" alt="Preview">
                    <div class="zoom-section">
                        <div class="zoomicon" data-bs-toggle="modal" data-bs-target="#imageZoomModal"
                            style="cursor: pointer;">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========== PLAIN RADIO ========== --}}
@elseif ($inputType === 'radio')
    <div class="{{ in_array($attribute['name'], ['Paper Weight', 'Cover Paper Weight']) ? 'col-md-12 attribute-wrapper' : 'col-md-6 attribute-wrapper' }} mb-3"
        data-attribute-id="{{ $attribute['id'] }}" data-is-required="{{ $attribute['is_required'] }}">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            {{ $attribute['name'] }}
            <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="attribute-values {{ count($values) <= 4 ? 'color-print' : 'color-print1' }}">
            @foreach ($values as $value)
                <div class="print-color {{ $value['is_default'] ? 'active' : '' }}" data-attribute-id="{{ $attribute['id'] }}"
                    data-value-id="{{ $value['id'] }}" data-value="{{ $value['value'] }}">
                    <p>{{ $value['value'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ========== SELECT WITH IMAGES ========== --}}
@elseif ($inputType === 'select_image')
    <div class="attribute-wrapper col-md-12 mb-3" data-attribute-id="{{ $attribute['id'] }}"
        data-is-required="{{ $attribute['is_required'] }}">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            {{ $attribute['name'] }}
            <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="attribute-value color-print1">
            @foreach ($values as $value)
                <div class="choose-binding {{ $value['is_default'] ? 'active' : '' }}" data-value="{{ $value['value'] }}"
                    data-attribute-id="{{ $attribute['id'] }}" data-value-id="{{ $value['id'] }}">
                    <div>
                        <img src="{{ asset('storage/' . ($value['image_path'] ?? 'default.png')) }}"
                            alt="{{ $value['value'] }}" />
                        <div class="zoom-section1">
                            <div class="zoomicon">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </div>
                        </div>
                        <p class="text-center">{{ $value['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ========== DROPDOWN SELECT ========== --}}
@elseif ($inputType === 'dropdown')
    <div class="attribute-wrapper col-md-6 mb-3" data-attribute-id="{{ $attribute['id'] }}"
        data-is-required="{{ $attribute['is_required'] }}">
        <div class="d-flex justify-content-between size-btn">
            <label class="form-label d-flex align-items-center" style="gap: 5px;">
                {{ $attribute['name'] }}
                <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                    data-target="#helpModal">?</span>
            </label>
            <button type="button" class="btn btn-link p-0">Custom Size</button>
        </div>
        <div class="attribute-values">
            <select class="custom-select" id="dropdown_{{ $attribute['id'] }}" name="attributes[{{ $attribute['id'] }}]">
                <option value="">-- Select --</option>
                @foreach ($values as $value)
                    <option value="{{ $value['value'] }}" data-attribute-id="{{ $attribute['id'] }}"
                        data-value-id="{{ $value['id'] }}" {{ $value['is_default'] ? 'selected' : '' }}>
                        {{ $value['value'] }}
                    </option>
                @endforeach
            </select>

        </div>
    </div>
@endif