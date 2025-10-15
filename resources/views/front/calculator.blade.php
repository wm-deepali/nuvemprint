<script src="https://code.jquery.com/npm/bootstrap@4.1.3"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /*.dropdown-menu {*/
    /*    -webkit-box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);*/
    /*    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;*/
    /*    border: 0 solid #e9ecef !important;*/
    /*    font-size: 14px !important;*/
    /*    margin: 8px 0 0 !important;*/
    /*    border-radius: 0px !important;*/
    /*    background-color: rgb(30 30 30 / 90%) !important;*/
    /*}*/

    /*.dropdown-toggle::after {*/
    /*    display: none !important;*/
    /*}*/

    /*.primary-menu .navbar .dropdown-large-menu ul li {*/
    /*    background: black;*/
    /*}*/

    /*.list-group-item.active {*/
    /*    background-color: #656565 !important;*/
    /*    border-color: #656565 !important;*/
    /*}*/

    /*.nav-item a {*/
    /*    color: gray !important;*/
    /*}*/

    .reset-card {
        width: 100%;
        height: 70px;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        align-items: center;
    }

    .reset-card button {
        background: none;
        border: none;
        color: red;
        border-bottom: 1px solid red;
        padding-bottom: 4px;
    }

    .calculation-card {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 30px 20px;
    }

    .color-print {
        width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .color-print1 {
        width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 10px;
    }

    .print-color {
        width: 100%;
        height: 38px;
        border: 2px solid #e0e0e0 !important;

        border-radius: .375rem !important;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .print-color.active,
    .print-color:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .print-color:hover {
        box-shadow: 0 0 0 0.2rem #6bd3cc82 !important;
    }

    .print-color p {
        margin: 0px;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .form-row-section {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .form-row-section1 {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .s-row {
        width: 100%;
    }

    .size-btn button {
        background: none;
        border: none;
        color: red;
    }

    .paper-type-section {
        width: 100%;
        height: 200px;
        display: flex;
        flex-direction: column;
        gap: 7px;
        border: 1px solid rgb(185, 185, 185);
        padding: 10px;
        border-radius: 7px;
        overflow: hidden;
        overflow-y: scroll;
        padding-right: 8px;
    }

    .paper-type-section button {
        text-align: left;
    }

    .paper-type-section button.active,
    .paper-type-section button:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .paper-type-options::-webkit-scrollbar {
        width: 8px;
    }

    .paper-type-options::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 5px;
    }

    .paper-type-options::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 5px;
    }

    .paper-type-options::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    .paper-type-options {
        scrollbar-color: #007bff #f0f0f0;
        scrollbar-width: thin;
    }

    .choose-binding {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    /*.choose-binding.active {*/
    /*    background-color: #fff;*/
    /*    border: 1px solid #80bdff;*/
    /*    border-radius: 6px;*/
    /*    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);*/
    /*}*/
    /* sirf image ke liye active style */
    .choose-binding.active img {
        border: 2px solid #80bdff;
        border-radius: 6px;
        box-shadow: 0 0 0 0.1rem rgb(173 175 177 / 25%);
        padding: 7px;
        margin-bottom: 5px;
    }

    /* normal image */
    .choose-binding img {
        width: 100%;
        border: 1px solid gray;
        border-radius: 6px;
        padding: 5px;
        margin-bottom: 5px;
    }


    /*.choose-binding img {*/
    /*    width: 100%;*/
    /*    border: 1px solid gray;*/
    /*    border-radius: 6px;*/
    /*    padding: 3px;*/
    /*}*/

    .help-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 1px solid #dbdbdb;
        color: #6f7070;
        font-weight: bold;
        font-size: 11px;
        cursor: pointer;
        /*margin-left: 5px;*/
        /*padding-left: 2px;*/
        /*padding-top: 1px;*/

    }

    .s-row label {
        font-size: 14px;
        font-weight: 600;
    }

    .form-label {
        display: flex;
        align-items: center;
        font-size: 16px;
        font-weight: 600;
        gap: 5px;
    }

    .page-slider {
        width: 100%;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-slider input[type="range"] {
        -webkit-appearance: none;
        width: 100%;
        height: 10px;
        background: #f0f0f0;
        border-radius: 5px;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .page-slider input[type="range"]:hover {
        opacity: 1;
    }

    .page-slider input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #17a2b8;
        border-radius: 50%;
        cursor: pointer;
    }

    .page-slider input[type="range"]::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #17a2b8;
        border-radius: 50%;
        cursor: pointer;

    }

    .page-slider input[type="range"]::-webkit-slider-runnable-track {
        background: linear-gradient(to right, #007bff 0%, #007bff var(--value, 0%), #f0f0f0 var(--value, 0%), #f0f0f0 100%);
        height: 10px;
        border-radius: 5px;

    }

    .page-slider input[type="range"]::-moz-range-track {
        background: linear-gradient(to right, #007bff 0%, #007bff var(--value, 0%), #f0f0f0 var(--value, 0%), #f0f0f0 100%);
        height: 10px;
        border-radius: 5px;

    }

    .page-slider .range-value {
        margin-top: 5px;
        text-align: center;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .page-slider button {
        background: none;
        border: none;
        color: rgb(0, 0, 0);
        /* border-bottom: 1px solid red; */
        padding-bottom: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .range-value button {
        background-color: rgb(189, 187, 187);
        padding: 5px;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right-side-section {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 20px 20px;
        position: sticky;
        top: 0px;
    }

    .estimate-card.active {
        border: 2px solid #6bd3cc;
        background-color: #f8f3f3;
    }

    .estimate-card.active .circle-point {
        border: 2px solid #6bd3cc;
        background-color: #fff;
    }


    .estimate-card {
        width: 100%;
        min-height: 15px;
        border: 1px solid gray;
        border-radius: 14px;
        display: flex;
        align-items: center;
        padding: 15px;
        gap: 20px;
        cursor: pointer;
        background: #e9e9e924;

    }


    .estimate-card-static {
        width: 100%;
        min-height: 15px;
        border: 1px solid gray;
        border-radius: 14px;
        display: flex;
        align-items: center;
        padding: 15px;
        gap: 20px;
        cursor: pointer;
        background: #e9e9e924;

    }

    .estimate-card-static.active {
        border: 2px solid #6bd3cc;
        background-color: #f8f3f3;
    }

    .estimate-card-static.active .circle-point {
        border: 2px solid #6bd3cc;
        background-color: #fff;
    }

    .circle-point {
        width: 22px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid gray;
    }

    .estimate-div {
        width: 90%;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .estimate-div-static {
        width: 90%;
        display: flex;
        align-items: center;
        gap: 20px;
        /* ensures spacing around the divider */
    }

    .estimate-div-static>div:first-child {
        flex: 1;
        min-width: 160px;
    }

    .estimate-div-static .line-y {
        flex: 0 0 1px;
        /* don't let flex sizing hide it */
        height: 50px;
        background-color: gray;
    }

    .estimate-div-static>div:last-child {
        flex: 1.5;
        /* allow more width for price + extra text */
        /* text-align: right; */
        min-width: 200px;
        word-break: break-word;
    }


    .line-y {
        width: 1px;
        height: 50px;
        background-color: gray;
    }

    .line-x {
        width: 100%;
        height: 1px;
        background-color: gray;

    }

    .est-card {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .disci i {
        color: green;
        margin-right: 5px;
    }

    .disci p {
        font-size: 13px;
    }

    .addtobtn button {
        width: 100%;
        background-color: #c48e3d;
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 4px;
        height: 40px;
        font-size: 18px;
    }

    .addtobtn button:hover {
        background-color: #e0aa0b;
    }

    .note-dis {
        width: 100%;
        display: flex;
        justify-content: space-between;

    }

    .note-dis p {
        font-size: 12px;
    }

    .extra-card {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 20px 20px;
        display: flex;
        gap: 20px;
    }

    .extra-card-details {
        display: flex;
        flex-direction: column;
        /* justify-content: space-between; */
    }

    .extra-card-details p {
        font-size: 13px;
        margin-top: 5px;
    }

    .page-slider {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Adjust slider height and remove unwanted margins */
    .page-slider input[type="range"] {
        -webkit-appearance: none;
        width: 90%;
        /* adjust as needed */
        height: 6px;
        background: #ccc;
        border-radius: 5px;
        outline: none;
        margin: 0;
        /* prevents misalignment */
        padding: 0;
        vertical-align: middle;
    }

    /* For WebKit browsers (Chrome, Safari) */
    .page-slider input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #2552a5;
        cursor: pointer;
        margin-top: -5px;
        /* Adjust to center thumb vertically */
        position: relative;
    }

    /* For Firefox */
    .page-slider input[type="range"]::-moz-range-thumb {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #000;
        cursor: pointer;
    }

    /* Button styling (optional) */
    .range-value button {
        width: 30px;
        height: 30px;
        border: none;
        background-color: #eee;
        border-radius: 4px;
        font-size: 20px;
        cursor: pointer;

    }

    .zoom-section {
        width: 30px;
        height: 30px;
        background-color: #ffffff;
        position: relative;
        bottom: 0px;
        right: 0px;
        z-index: 100;
        margin-top: -30px;
        float: inline-end;
        border-top-left-radius: 3px;

    }

    .zoom-section1 {
        width: 20px;
        height: 20px;
        background-color: #ffffff;
        position: relative;

        right: 5px;

        margin-top: -30px;
        float: inline-end;
        border-top-left-radius: 3px;
    }

    .zoomicon {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgb(170, 170, 170);
    }

    .btn-light {
        background-color: #f8f9fa !important;
        color: #212529 !important;
        border-color: #f8f9fa !important;
    }

    .btn-light.active,
    .btn-light:focus,
    .btn-light:hover {
        background-color: #e2e6ea !important;
        /* Slight hover */
        color: #212529 !important;
    }

    .btn-link {
        background-color: transparent !important;
    }

    .btn {
        border: none !important;
    }

    .selectable-proof-option {
        transition: 0.2s ease-in-out;
        border-radius: 12px;
        /* curved edges */
        border: 1px solid #ccc;
    }

    .selectable-proof-option.active {
        border-color: #6bd3cc !important;
        background-color: #f8f3f3 !important;
    }

    input[type="checkbox"].form-check-input {
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .form-check-input:checked {
        background-color: #6bd3cc;
        border: 1px solid #17a2b8 !important;
    }

    .attribute-wrapper.disabled .attribute-values {
        opacity: 0.5;
        pointer-events: none;
    }

    .attribute-wrapper .attribute-condition-note {
        color: #ff0000 !important;
        /* Bootstrap 'danger' red */
        font-size: 0.8rem;
        margin-bottom: 0px;
        margin-top: 0.25rem;
        /* aligns with checkbox/label spacing */
    }

    .attribute-wrapper.disabled label {
        color: #888 !important;
    }

    .modal-content {
        background: #ffffff;
    }

    #addToCartBtn.disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>
<style>
    @media only screen and (max-width: 600px) {
        .tab-buttons {
            display: flex !important;
            gap: 0.5rem !important;
            margin-bottom: 1rem !important;
            overflow: scroll !important;
        }

        .tab-buttons::-webkit-scrollbar {
            display: none !important;

        }

        .primary-menu .navbar {
            display: none;
        }
    }

    .cal-page {
        width: 100%;
        background: #f9f9f9;
        padding: 50px 0px;
    }

    .page-slider input[type="range"] {
        -webkit-appearance: none;
        width: 100%;
        height: 6px;
        background: transparent;
        /* background transparent kar dena */
        cursor: pointer;
        margin: 0;
        padding: 0;
    }

    /* Track (gray line) */
    .page-slider input[type="range"]::-webkit-slider-runnable-track {
        height: 6px;
        background: #e0e0e0;
        border-radius: 3px;
    }

    .page-slider input[type="range"]::-moz-range-track {
        height: 6px;
        background: #e0e0e0;
        border-radius: 3px;
    }

    /* Filled track (before thumb) */
    .page-slider input[type="range"]::-webkit-slider-runnable-track {
        background: linear-gradient(to right,
                #007bff var(--value, 0%),
                #e0e0e0 var(--value, 0%));
    }

    .page-slider input[type="range"]::-moz-range-progress {
        background: #007bff;
        height: 6px;
        border-radius: 3px;
    }

    /* Thumb */
    /* Thumb */
    .page-slider input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #fff;
        border: 4px solid #007bff;
        border-radius: 50%;
        cursor: pointer;
        margin-top: -8px;
    }

    .page-slider input[type="range"]::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #fff;
        border: 4px solid #007bff;
        /* outer blue ring */
        border-radius: 50%;
        cursor: pointer;
    }
</style>

<div class="cal-page">
    <div class="row" style="width: 1180px; margin:auto;">
        <div class="col-md-7">
            <div class="reset-card">
                <h5 class="m-0">Create Your {{ $subcategory->name ?? "Booklets" }}</h5>
                <button class="m-0">Reset</button>
            </div>
            <form>
                @if (!empty($attributeGroups) && count($attributeGroups))
                    @php
                        $mainGroup = collect($attributeGroups)->first(function ($group) {
                            return str_contains(strtolower($group['group_name']), 'main attributes');
                        });
                        $otherGroups = collect($attributeGroups)->reject(function ($group) {
                            return str_contains(strtolower($group['group_name']), 'main attributes');
                        });
                    @endphp
                    <div class="calculation-card mt-3">
                        {{-- Display attributes with values --}}
                        <div class="row">

                            @if(!empty($quantityInputRequired))
                                <div class="col-md-6 mb-3">
                                    <label for="quantityInput" class="form-label">
                                        Quantity
                                        <span class="help-circle" data-label="Quantity" data-toggle="modal"
                                            data-target="#helpModal">?</span>
                                    </label>
                                    <input type="number" class="form-control" id="quantityInput" placeholder="100"
                                        value="{{ $quantityDefaults['default'] ?? 100 }}"
                                        min="{{ $quantityDefaults['min'] ?? 1 }}" max="{{ $quantityDefaults['max'] ?? 10000 }}">
                                    <div class="invalid-feedback d-none" id="quantityError">
                                        Quantity must be between {{ $quantityDefaults['min'] ?? 1 }} and
                                        {{ $quantityDefaults['max'] ?? 10000 }}.
                                    </div>
                                </div>
                            @endif


                            {{-- Main Group Attributes --}}
                            @isset($mainGroup['attributes'])
                                @foreach ($mainGroup['attributes'] as $attribute)
                                    @include('front.attribute-block', ['attribute' => $attribute])
                                @endforeach
                            @endisset
                        </div>

                        @if ($pagesDraggerRequired)
                            <div id="composite-draggers" class="mt-3">
                                {{-- Page draggers will be injected here via JS --}}
                            </div>
                        @endif

                        @if ($pagesDraggerRequired)
                            <div class="form-row-section1 pages-dragger-wrapper">
                                <div class="s-row mb-3 pages-dragger">
                                    <label>Pages
                                        <span class="help-circle" data-label="Pages" data-toggle="modal"
                                            data-target="#helpModal">?</span>
                                    </label>
                                    <div class="page-slider">
                                        <input type="range" name="pages[]" min="{{ $pagesDefaults['min'] ?? 1 }}"
                                            max="{{ $pagesDefaults['max'] ?? 840 }}"
                                            value="{{ $pagesDefaults['default'] ?? 1 }}" step="1" id="pageSlider">
                                        <div class="range-value">
                                            <button type="button">-</button>
                                            <span id="pageValue">{{ $pagesDefaults['default'] ?? 1 }}</span>
                                            <button type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                    {{-- OTHER GROUPS (With Group Header) --}}
                    @foreach ($otherGroups as $group)
                        @php
                            $groupKey = \Illuminate\Support\Str::slug($group['group_name'], '_');
                            $isToggleable = $group['is_toggleable'] ?? false;
                        @endphp

                        <div class="calculation-card mt-3">
                            @if ($isToggleable)
                                {{-- Toggleable group with checkbox --}}

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input group-toggle" style="border: 1px solid #212529;margin-top: 9px;"
                                        type="checkbox" id="toggle_{{ $groupKey }}" data-target="#section_{{ $groupKey }}">
                                    <label class="form-check-label" for="toggle_{{ $groupKey }}"
                                        style="font-weight:600; font-size:22px;">{{ $group['group_name'] }}</label>
                                </div>
                            @else
                                {{-- Non-toggleable header --}}
                                <h5 class="mb-2">{{ $group['group_name'] }}</h5>
                            @endif
                            <div class="mt-3 {{ $isToggleable ? 'd-none' : '' }}" id="section_{{ $groupKey }}">
                                <div class="row">
                                    @foreach ($group['attributes'] as $attribute)
                                        @php
                                            // Disable default selection if group is toggleable
                                            if ($group['is_toggleable'] ?? false) {
                                                $attribute['values'] = $attribute['values']->map(function ($val) {
                                                    $val['original_is_default'] = $val['is_default'];
                                                    $val['is_default'] = false;
                                                    return $val;
                                                });
                                            }
                                            // dd($attribute); // check to confirm is_default: false now
                                        @endphp

                                        @include('front.attribute-block', ['attribute' => $attribute])
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </form>
        </div>
        <div class="col-md-5">
            <div class="right-side-section">
                <div class="estimate-card-static active estimate-option-static mb-3" data-date="{{ $defaultDate }}">
                    <div class="est-card">
                        <div class="estimate-div-static">
                            <div class="ast-active-static">
                                <p class="m-0 text-black">Estimated Price:</p>
                                <h4 class="text-black mb-1">{{ $defaultDate }}</h4>
                                <div class="title-static text-muted small">Standard Delivery</div>
                            </div>
                            <div class="line-y"></div>
                            <div>
                                <h4 class="text-black final-price">£0</h4>
                            </div>
                        </div>
                        <div class="line-x detail-section-static"></div>
                        <div class="disci text-black detail-section-static">
                            Delivery between {{ $minDate }} – {{ $maxDate }}. Includes standard packaging.
                        </div>
                    </div>
                </div>

                <hr>

                @php
                    use Carbon\Carbon;
                @endphp

                @if ($deliveryChargesRequired)
                    <h5>Choose Price & Delivery Date</h5>
                    @foreach ($deliveryCharges as $key => $option)
                        @php
                            $deliveryDate = Carbon::now()->addDays($option['no_of_days']);
                            $formattedDate = $deliveryDate->format('D, jS M');
                            $detailsHtml = $option['details'] ?? null;
                            $title = $option['title'] ?? null;
                        @endphp


                        <div class="estimate-card estimate-option {{ $option['is_default'] ? 'active' : 'mt-3' }}"
                            data-title="{{ $title ?? 'Standard Delivery' }}" data-price="{{ $option['price'] }}"
                            data-date="{{ $formattedDate }}" data-id="{{ $option['id'] }}">
                            <div class="circle-point"></div>
                            <div class="est-card">

                                <div class="estimate-div">
                                    <div class="{{ $option['is_default'] ? 'ast-active' : '' }}">

                                        <p class="m-0 text-black">Estimated Delivery:</p>
                                        <h4 class="text-black mb-1">{{ $formattedDate }}</h4>
                                        @if ($title)
                                            <div class="title text-muted small d-none">{{ $title }}</div>
                                        @endif

                                    </div>
                                    <div class="line-y"></div>
                                    <div>
                                        <h4 class="text-black final-price">
                                            @if($option['price'] == 0)
                                                Free
                                            @else
                                                    £{{ number_format($option['price'], 2) }}
                                                </h4>
                                            @endif
                                    </div>
                                </div>

                                @if (!empty($detailsHtml))
                                    <div class="line-x detail-section d-none"></div>
                                    <div class="disci text-black detail-section d-none">
                                        {!! $detailsHtml !!}
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-black mb-3">
                        <h4 class="final-price">£0.00</h4>
                    </div>
                @endif
                <hr>
                @if ($proofReadingRequired && !empty($proofReadings))
                    <div class="form-row-section1 mt-3">
                        <div class="s-row mb-3">
                            <label for="proof-reading" style="    font-size: 1.25rem;">File Check</label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach ($proofReadings as $index => $option)
                                    @if (!empty($option['proof_type']) && isset($option['price']))
                                        <div class="selectable-proof-option border rounded p-2 text-center"
                                            data-id="{{ $option['id'] }}" data-value="{{ $option['proof_type'] }}"
                                            data-price="{{ $option['price'] }}"
                                            style="width: 45%; cursor: pointer; background-color: #f9f9f9;">
                                            <strong style="font-size: 13px;">{{ $option['proof_type'] }}</strong>

                                            <div class="text-muted" style="font-size: 24px; font-weight:600;">
                                                £{{ number_format($option['price'], 2) }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif



                <div class="addtobtn mt-3">
                    <button id="addToCartBtn" data-route="{{ route("cart.store") }}"
                        data-subcategory-id="{{ $subcategory->id }}">Add to Cart</button>
                    @if ($deliveryChargesRequired)
                        <div class="note-dis">
                            <p>Delivery dates are estimated.</p>
                        </div>
                    @endif

                </div>

            </div>


        </div>
    </div>
</div>


<!-- Bootstrap 4 Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">Help</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="helpModalBody">
                <!-- Dynamic content will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Image Zoom Modal -->
<div class="modal fade" id="imageZoomModal" tabindex="-1" aria-labelledby="imageZoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageZoomModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="zoomedImage" src="" class="img-fluid" alt="Zoomed Image" />
            </div>
        </div>
    </div>
</div>


<script>
    const subcategoryId = {{ $subcategory->id }};
    const attributeConditions = @json($attributeConditions);
    const debouncedCalculateTotalPrice = debounce(calculateTotalPrice, 300);
    const compositeMap = @json($compositeMap ?? []);
    const compositeDraggerValues = @json($compositeDraggerValues ?? []);
    const pageRangeConfig = {
        min: {{ $pagesDefaults['min'] ?? 1 }},
        max: {{ $pagesDefaults['max'] ?? 840 }},
        default: {{ $pagesDefaults['default'] ?? 1 }}
    };
    // const defaultPages = $defaultPages;

    // to zoom the image section
    $(document).on('click', '.zoomicon', function () {
        const imageUrl = $(this).data('image');
        $('#zoomedImage').attr('src', imageUrl);
    });

    document.addEventListener('DOMContentLoaded', function () {
        var quantityInput = document.getElementById('quantityInput');
        if (quantityInput) {
            quantityInput.addEventListener('input', function () {
                const input = this;
                const min = parseInt(input.min);
                const max = parseInt(input.max);
                const value = parseInt(input.value);
                const errorDiv = document.getElementById('quantityError');

                if (value < min || value > max) {
                    input.classList.add('is-invalid');
                    errorDiv.classList.remove('d-none');
                } else {
                    input.classList.remove('is-invalid');
                    errorDiv.classList.add('d-none');
                }
            });
        }
    });

    function forceSliderRedraw() {
        const $slider = $('#pageSlider');
        if ($slider.length) {
            const slider = $slider[0]; // get DOM element
            const value = parseFloat($slider.val()) || 0;
            const min = parseFloat($slider.attr('min')) || 0;
            const max = parseFloat($slider.attr('max')) || 100;

            const percent = ((value - min) / (max - min)) * 100;

            // Method 1: For CSS using --value
            slider.style.setProperty('--value', `${percent}%`);

            // Method 2: For CSS using background linear-gradient directly
            slider.style.background = `linear-gradient(to right, #007bff 0%, #007bff ${percent}%, #ddd ${percent}%, #ddd 100%)`;
        }
    }


    function debounce(func, delay) {
        let timer;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function calculateTotalPrice() {
        const quantity = parseInt($('#quantityInput').val()) || 1;
        // const pages = parseInt($('#pageSlider').val()) || 32;

        let selectedAttributes = {};


        $('.attribute-wrapper:visible .active').each(function () {
            const attrId = $(this).data('attribute-id');
            const valueId = $(this).data('value-id');
            if (attrId && valueId) selectedAttributes[attrId] = valueId;
        });


        $('select.custom-select').each(function () {
            if ($(this).closest('.attribute-wrapper').is(':visible')) {
                const selected = $(this).find('option:selected');
                const attrId = selected.data('attribute-id');
                const valueId = selected.data('value-id');
                if (attrId && valueId) selectedAttributes[attrId] = valueId;
            }
        });


        // Include select_area attributes (length and width)
        $('.attribute-wrapper:visible').each(function () {

            const attrId = $(this).data('attribute-id');
            const isRequired = $(this).data('is-required');

            // Only for select_area input type
            const $lengthInput = $(this).find(`input[name="attributes[${attrId}][length]"]`);
            const $widthInput = $(this).find(`input[name="attributes[${attrId}][width]"]`);

            if ($lengthInput.length > 0 && $widthInput.length > 0) {
                const length = parseFloat($lengthInput.val());
                const width = parseFloat($widthInput.val());

                if (!isNaN(length) && !isNaN(width)) {
                    selectedAttributes[attrId] = { length, width };
                } else if (isRequired) {
                    // If required and missing, optionally mark as invalid
                    $lengthInput.addClass('is-invalid');
                    $widthInput.addClass('is-invalid');
                }
            }
        });


        // Add number inputs manually
        $('.attribute-wrapper[data-attribute-type="number"] input[type="number"]').each(function () {
            const input = $(this);
            const attrId = input.closest('.attribute-wrapper').data('attribute-id');
            const value = input.val();
            if (attrId && value !== '') {
                selectedAttributes[attrId] = {
                    value: value,
                    input_type: 'number'
                };
            }
        });



        document.querySelectorAll('.attribute-wrapper').forEach(wrapper => {
            if (window.getComputedStyle(wrapper).display === 'none') return; // skip hidden wrappers

            const attrId = wrapper.getAttribute('data-attribute-id');
            const inputType = wrapper.getAttribute('data-input-type');
            const isRequired = wrapper.getAttribute('data-is-required') === '1';

            if (wrapper.querySelector('.area-input')) {
                const lengthInput = wrapper.querySelector(`[id^="length_"]`);
                const widthInput = wrapper.querySelector(`[id^="width_"]`);

                const length = parseFloat(lengthInput?.value || 0);
                const width = parseFloat(widthInput?.value || 0);
                const area = length * width;

                selectedAttributes[attrId] = {
                    type: 'select_area',
                    length,
                    width,
                    area: parseFloat(area.toFixed(2))
                };
            }
        });


        // console.log("selectedAttributes", selectedAttributes);

        let pages = 0;
        let compositePages = {}; // { value_id: { 'Cover': 32, 'Inner': 64 } }

        const $compositeSliders = $('.composite-slider');

        if ($compositeSliders.length > 0) {
            // Get selected composite value ID
            let compositeValueId = null;


            $('.attribute-wrapper .active').each(function () {
                const valueId = $(this).data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            $('select.custom-select').each(function () {
                const selected = $(this).find('option:selected');
                const valueId = selected.data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });
            if (compositeValueId) {
                const valueObj = compositeDraggerValues.find(val => val.id === compositeValueId);
                const components = valueObj?.components || [];

                let pageBreakdown = {};

                $compositeSliders.each(function () {
                    const index = parseInt($(this).data('index')); // 1-based index
                    const label = components[index - 1] || `Part ${index}`;
                    const value = parseInt($(this).val()) || 0;

                    pageBreakdown[label] = value;
                });

                compositePages[compositeValueId] = pageBreakdown;
            }
        } else {
            pages = parseInt($('#pageSlider').val()) || 32;
        }



        $.ajax({
            url: '{{ route(name: 'calculate.price') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity,
                pages,
                attributes: selectedAttributes,
                composite_pages: compositePages,
                subcategory_id: subcategoryId,

            },
            beforeSend: function () {
                // Inside your price calculation AJAX function
                const staticCard = $('.estimate-card-static.active');
                if (staticCard.length) {
                    staticCard.find('.final-price').html('Loading...');
                }

            },
            success: function (res) {
                if (res.success) {
                    const calculatedPrice = parseFloat(res.total_price) || 0;
                    const selectedProofOption = $('.selectable-proof-option.active');
                    const proofPrice = parseFloat(selectedProofOption.data('price')) || 0;
                    const selectedDeliveryOption = $('.estimate-card.active');
                    const deliveryPrice = parseFloat(selectedDeliveryOption.data('price')) || 0;

                    // Get delivery title from active estimate card's hidden title div or fallback to default
                    const deliveryTitleElement = selectedDeliveryOption.find('.title.text-muted.small');
                    const deliveryTitle = deliveryTitleElement.length && deliveryTitleElement.text().trim() !== ''
                        ? deliveryTitleElement.text().trim()
                        : 'Standard Delivery';

                    const total = calculatedPrice + proofPrice + deliveryPrice;
                    const formattedTotal = '£' + total.toFixed(2);

                    // Update price display
                    const staticCard = $('.estimate-card-static.active');
                    if (staticCard.length > 0) {
                        // Remove any old percentage info first
                        staticCard.find('.percentage-charge-info').remove();

                        // Update final price
                        staticCard.find('.final-price').text(formattedTotal);

                        // --- Show first percentage charge below the price ---
                        const firstPercentageCharge = res.percentage_charges?.[0];
                        if (firstPercentageCharge) {
                            let percentageHtml = `<div class="text-muted small mt-1">` +
                                `${firstPercentageCharge.attribute} (${firstPercentageCharge.value}) added ${firstPercentageCharge.percent}%` +
                                `</div>`;

                            // Append new info
                            staticCard.find('.final-price').after(
                                `<div class="percentage-charge-info">${percentageHtml}</div>`
                            );
                        }

                        const deliveryTextDiv = staticCard.find('.title-static.text-muted.small');

                        const formattedDeliveryPrice = '£' + deliveryPrice.toFixed(2);
                        if (deliveryPrice > 0) {
                            if (!deliveryTextDiv.text().includes('(')) {
                                deliveryTextDiv.text(`${deliveryTitle} (with delivery charges: ${formattedDeliveryPrice})`);
                            }
                        } else {
                            // Show basic title if no delivery price
                            deliveryTextDiv.text(deliveryTitle);
                        }
                    } else {
                        // Remove old percentage info globally if no static card
                        $('.percentage-charge-info').remove();
                    }

                    // 🚫 Prevent add to cart if product total is 0
                    const $addToCartBtn = $('#addToCartBtn'); // Update ID if your button differs
                    if (calculatedPrice <= 0) {
                        $addToCartBtn.prop('disabled', true).addClass('disabled');
                        $addToCartBtn.attr('title', 'Cannot add to cart — product total is £0');
                    } else {
                        $addToCartBtn.prop('disabled', false).removeClass('disabled');
                        $addToCartBtn.removeAttr('title');
                    }

                }
            },


            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }


    $(function () {
        const compositeMap = @json($compositeMap ?? []);
        const compositeDraggerValues = @json($compositeDraggerValues ?? []);

        document.querySelectorAll('.btn-light').forEach(btn => {
            btn.addEventListener('mouseleave', () => {
                if (document.activeElement === btn) {
                    btn.blur();
                }
            });
        });


        function renderCompositeDraggers(valueId) {
            const count = compositeMap[valueId] ?? 0;
            const valueObj = compositeDraggerValues.find(val => val.id === valueId);
            const componentLabels = valueObj?.components || [];

            const $container = $('#composite-draggers');
            const $baseWrapper = $('.pages-dragger-wrapper');

            if (count > 1) {
                $baseWrapper.hide();
            } else {
                $baseWrapper.show();
                $container.empty();
                return;
            }

            $container.empty();
            $container.find('.composite-slider').each(function () {
                updateSliderFill(this); // apply fill on load
            });

            for (let i = 1; i <= count; i++) {
                const label = componentLabels[i - 1] ? `Pages ${componentLabels[i - 1]}` : `Pages ${i}`;
                $container.append(`
        <div class="form-row-section1">
            <div class="s-row mb-3">
                <label>${label}
                    <span class="help-circle" data-label="${label}" data-toggle="modal"
                        data-target="#helpModal">?</span>
                </label>
                <div class="page-slider">
                    <input 
                        type="range" 
                        name="composite_pages[]" 
                        min="${pageRangeConfig.min}" 
                        max="${pageRangeConfig.max}" 
                        value="${pageRangeConfig.default}" 
                        step="1"
                        class="composite-slider" 
                        data-index="${i}">
                    <div class="range-value">
                        <button type="button" class="decrease">-</button>
                        <span class="composite-value">${pageRangeConfig.default}</span>
                        <button type="button" class="increase">+</button>
                    </div>
                </div>
            </div>
        </div>
    `);
            }

            // ✅ After loop: apply fill effect to new sliders
            $container.find('.composite-slider').each(function () {
                updateSliderFill(this);
            });
        }

        function renderCompositeFromCurrentSelection() {
            let compositeValueId = null;

            $('.attribute-wrapper .active').each(function () {
                const valueId = $(this).data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            $('select.custom-select').each(function () {
                const selected = $(this).find('option:selected');
                const valueId = selected.data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            if (compositeValueId) {
                renderCompositeDraggers(compositeValueId);
            } else {
                $('#composite-draggers').empty();
                $('.pages-dragger-wrapper').show();
            }
        }

        $(document).on('click', '.attr-select, .print-color, .choose-binding', function () {
            const $this = $(this);
            const $wrapper = $this.closest('.attribute-wrapper');
            const isRequired = $wrapper.data('is-required');

            const wasActive = $this.hasClass('active');

            // If already selected and NOT required → unselect
            if (wasActive) {
                $this.removeClass('active').removeAttr('data-selected');

                const attrId = $wrapper.data('attribute-id');

                // Clear image preview if exists
                const previewImgSelector = `#preview-image-${attrId}`;
                if ($(previewImgSelector).length) {
                    $(previewImgSelector).attr('src', '{{ asset("storage/default-preview.png") }}');
                }

                handleAttributeConditions();
                renderCompositeFromCurrentSelection();
                calculateTotalPrice();

                return; // Exit early
            }

            // If required OR not active → select normally
            $wrapper.find('.attr-select, .print-color, .choose-binding')
                .removeClass('active')
                .removeAttr('data-selected');

            $this.addClass('active').attr('data-selected', 'true');

            const attrId = $wrapper.data('attribute-id');
            const valueId = $this.data('value-id');

            // ✅ Update image preview if exists
            const previewImgSelector = `#preview-image-${attrId}`;
            const newImage = $this.data('image');
            if (newImage && $(previewImgSelector).length) {
                $(previewImgSelector).attr('src', newImage);
            }

            handleAttributeConditions();
            renderCompositeFromCurrentSelection();
            calculateTotalPrice();
        });

        function convertArea(length, width, unit) {
            let area = length * width;
            return area;
        }

        function updateAreaAndPrice(attributeId) {
            const length = parseFloat(document.getElementById(`length_${attributeId}`).value) || 0;
            const width = parseFloat(document.getElementById(`width_${attributeId}`).value) || 0;
            const unit = document.getElementById(`length_${attributeId}`).dataset.areaUnit;

            const area = convertArea(length, width, unit);
            document.getElementById(`area_${attributeId}`).value = area.toFixed(2);

            // Trigger price calculation
            if (typeof calculateTotalPrice === "function") {
                calculateTotalPrice();
            }
        }

        document.querySelectorAll('.area-input').forEach(function (input) {
            input.addEventListener('input', function () {
                const attrId = this.dataset.attributeId;
                updateAreaAndPrice(attrId);
            });
        });


        $(document).on('change', 'select.custom-select', function () {
            const $select = $(this);
            const $wrapper = $select.closest('.attribute-wrapper');
            const isRequired = $wrapper.data('is-required');

            const $option = $select.find('option:selected');
            const attrId = $option.data('attribute-id');
            const valueId = $option.data('value-id');
            const selectedValue = $option.val();

            // If user selected the empty "-- Select --" option
            if (selectedValue === '') {
                if (isRequired) {
                    // Revert to first valid value
                    const $firstReal = $select.find('option[data-value-id]').first();
                    $firstReal.prop('selected', true);

                    handleAttributeConditions();
                    renderCompositeFromCurrentSelection();
                    calculateTotalPrice();
                } else {
                    // Optional → treat as no selection
                    handleAttributeConditions();
                    renderCompositeFromCurrentSelection();
                    calculateTotalPrice();
                }
                return;
            }

            // If a valid value was selected
            handleAttributeConditions();
            renderCompositeFromCurrentSelection();
            calculateTotalPrice();
        });


        $('#quantityInput').on('input', calculateTotalPrice);

        $(document).on('input', '.attribute-wrapper[data-attribute-type="number"] input[type="number"]', function () {
            calculateTotalPrice();
        });

        $(document).on('change', '.group-toggle', function () {
            const target = $(this).data('target');
            const isChecked = $(this).is(':checked');
            $(target).toggleClass('d-none', !isChecked);

            if (isChecked) {
                // Find all default buttons inside this group
                $(target).find('[data-original-default="true"]').each(function () {
                    const $btn = $(this);
                    const $input = $btn.find('input[type="radio"], input[type="checkbox"]');

                    // Deselect siblings (for radio-like buttons)
                    const name = $input.attr('name');
                    if ($input.attr('type') === 'radio') {
                        $(`input[name="${name}"]`).prop('checked', false).closest('.btn').removeClass('active').attr('data-selected', 'false');
                    }

                    // Set checked and active
                    $input.prop('checked', true);
                    $btn.addClass('active').attr('data-selected', 'true');
                });
                calculateTotalPrice();
            } else {
                // Optionally reset selections when unchecked
                $(target).find('input[type="radio"], input[type="checkbox"]').prop('checked', false);
                $(target).find('.btn').removeClass('active').attr('data-selected', 'false');
            }
        });


        $('.help-circle').on('click', function () {
            const label = $(this).data('label');
            const helpContent = {
                'Quantity': 'Specify the number of booklets you want to print. Enter a value between 1 and 1000.',
                'Colour Printing': 'Choose between full-color printing (Colors) or black-and-white (Grayscale) for your booklet.',
                'Orientation': 'Select the page orientation: Portrait (vertical) or Landscape (horizontal).',
                'Size': 'Choose the booklet size from standard options or select Custom Size for specific dimensions.',
                'Paper Type': 'Choose the type of paper finish, such as Silk, Gloss, Uncoated, or Recycled Natural.',
                'Paper Weight': 'Select the paper thickness, measured in grams per square meter (gsm). Higher gsm indicates thicker paper.',
                'Binding': 'Choose the binding method: Staple, Perfect (PUR), or Wiro for securing the booklet pages.',
                'Pages': 'Adjust the number of pages for your booklet, ranging from 32 to 840 pages.'
            };

            $('#helpModalLabel').text(`${label} Help`);
            $('#helpModalBody').text(helpContent[label] || 'No help content available.');
        });

        const slider = document.getElementById('pageSlider');
        const valueDisplay = document.getElementById('pageValue');
        const decrementBtn = valueDisplay.previousElementSibling;
        const incrementBtn = valueDisplay.nextElementSibling;


        function updateSliderFill(sliderElement) {
            if (!sliderElement) return; // Return early if no slider

            const value = sliderElement.value;  // safe to use after check
            const min = parseFloat(sliderElement.min) || 0;
            const max = parseFloat(sliderElement.max) || 100;

            const percent = ((value - min) / (max - min)) * 100;

            sliderElement.style.setProperty('--value', percent);
        }


        slider.addEventListener('input', () => {
            valueDisplay.textContent = slider.value;
            updateSliderFill();
            debouncedCalculateTotalPrice();
        });

        decrementBtn?.addEventListener('click', () => {
            let val = +slider.value;
            if (val > 32) {
                slider.value = val - 1;
                valueDisplay.textContent = slider.value;
                updateSliderFill(slider); // <-- updated here
                debouncedCalculateTotalPrice();
            }
        });

        incrementBtn?.addEventListener('click', () => {
            let val = +slider.value;
            if (val < 840) {
                slider.value = val + 1;
                valueDisplay.textContent = slider.value;
                updateSliderFill(slider); // <-- updated here
                debouncedCalculateTotalPrice();
            }
        });


        $(document).on('input', '#pageSlider', function () {
            const val = $(this).val();
            $(this).next('.range-value').find('#page-value').text(val);
            updateSliderFill(this); // <-- new addition
            debouncedCalculateTotalPrice();
        });

        $(document).on('input', '.composite-slider', function () {
            const val = $(this).val();
            $(this).next('.range-value').find('.composite-value').text(val);
            updateSliderFill(this); // <-- new addition
            debouncedCalculateTotalPrice();
        });

        $(document).on('click', '.increase', function () {
            const $slider = $(this).closest('.range-value').prev('input.composite-slider');
            let current = +$slider.val();
            if (current < 840) {
                $slider.val(current + 1).trigger('input');
                updateSliderFill($slider[0]); // <-- new
            }
        });

        $(document).on('click', '.decrease', function () {
            const $slider = $(this).closest('.range-value').prev('input.composite-slider');
            let current = +$slider.val();
            if (current > 32) {
                $slider.val(current - 1).trigger('input');
                updateSliderFill($slider[0]); // <-- new
            }
        });




        updateSliderFill();

        calculateTotalPrice();
        renderCompositeFromCurrentSelection();

        $('.attribute-wrapper .active').each(function () {
            const attrId = $(this).data('attribute-id');
            const valueId = $(this).data('value-id');
            handleAttributeConditions();
        });

        $('select.custom-select').each(function () {
            const selected = $(this).find('option:selected');
            const attrId = selected.data('attribute-id');
            const valueId = selected.data('value-id');
            handleAttributeConditions();
        });
    });

    function calculatedAttributeRow() {
        let colSum = 0;

        // Select only visible attribute blocks
        const $attributeBlocks = $('.row .attribute-wrapper:visible');

        // First, remove any existing hr-wrapper divs
        $('.hr-wrapper').remove();

        $attributeBlocks.each(function (index) {
            const $col = $(this);
            const colClass = $col.attr('class');

            // Extract the number after col-md-
            const match = colClass.match(/col-md-(\d+)/);
            const colWidth = match ? parseInt(match[1]) : 12;

            colSum += colWidth;

            if (colSum >= 12) {
                // Only insert <hr> if it's not the last one
                if (index !== $attributeBlocks.length - 1) {
                    $col.after(`
                   
                `);
                }
                colSum = 0;
            }
        });
    }

    // =========================
    //  ATTRIBUTE CONDITION LOGIC
    // =========================

    function handleAttributeConditions() {
        $('.attribute-condition-note').remove();

        // Reset all attributes first
        $('.attribute-wrapper').removeClass('disabled').show();
        $('.attribute-wrapper .attribute-values [data-value-id]').show();

        // Collect all active parent selections
        const activeSelections = {};
        $('.attribute-wrapper .active[data-value-id]').each(function () {
            const attrId = $(this).closest('.attribute-wrapper').data('attribute-id');
            const valueId = $(this).data('value-id');
            activeSelections[attrId] = valueId;
        });

        $('select.custom-select').each(function () {
            const selected = $(this).find('option:selected');
            const attrId = selected.data('attribute-id');
            const valueId = selected.data('value-id');
            if (valueId) activeSelections[attrId] = valueId;
        });

        // Loop through all conditions
        attributeConditions.forEach(cond => {
            const { parent_attribute_id, parent_value_id, affected_attribute_id, action, affected_value_ids } = cond;

            const $affectedWrapper = $(`[data-attribute-id="${affected_attribute_id}"]`);

            switch (action) {
                case 'hide_attribute':
                    if (activeSelections[parent_attribute_id] === parent_value_id) {
                        $affectedWrapper.addClass('disabled').hide();
                    }
                    break;

                case 'show_attribute':
                    if (activeSelections[parent_attribute_id] === parent_value_id) {
                        $affectedWrapper.removeClass('disabled').show();
                    } else {
                        $affectedWrapper.addClass('disabled').hide();
                    }
                    break;

                case 'hide_values':
                    if (activeSelections[parent_attribute_id] === parent_value_id) {
                        affected_value_ids.forEach(id => {
                            $affectedWrapper.find(`[data-value-id="${id}"]`).hide().removeClass('active').removeAttr('data-selected');
                            $affectedWrapper.find(`[data-value-id="${id}"] input[type="radio"], [data-value-id="${id}"] input[type="checkbox"]`).prop('checked', false);
                        });

                        // Add dropdown reset logic here
                        const select = $affectedWrapper.find('select.custom-select');
                        if (select.length) {
                            const selectedOption = select.find('option:selected');
                            if (selectedOption.length && selectedOption.css('display') === 'none') {
                                // Selected option is hidden, reset value to first visible or blank
                                const firstVisibleOption = select.find('option').filter(function () {
                                    return $(this).css('display') !== 'none';
                                }).first();
                                if (firstVisibleOption.length) {
                                    select.val(firstVisibleOption.val());
                                } else {
                                    select.val('');
                                }
                                select.trigger('change');
                            }
                        }
                    }
                    break;

                case 'show_values':
                    if (activeSelections[parent_attribute_id] === parent_value_id) {
                        // Hide all first
                        $affectedWrapper.find('[data-value-id]').hide().removeClass('active').removeAttr('data-selected');
                        // Show only selected
                        affected_value_ids.forEach(id => $affectedWrapper.find(`[data-value-id="${id}"]`).show());
                        // Add dropdown reset logic here
                        const select = $affectedWrapper.find('select.custom-select');
                        if (select.length) {
                            const selectedOption = select.find('option:selected');
                            if (selectedOption.length && selectedOption.css('display') === 'none') {
                                // Selected option is hidden, reset value to first visible or blank
                                const firstVisibleOption = select.find('option').filter(function () {
                                    return $(this).css('display') !== 'none';
                                }).first();
                                if (firstVisibleOption.length) {
                                    select.val(firstVisibleOption.val());
                                } else {
                                    select.val('');
                                }
                                select.trigger('change');
                            }
                        }
                    }
                    break;
            }
        });

        calculatedAttributeRow();
    }

    // function applyInitialHideConditions() {
    //     $('.attribute-wrapper').removeClass('disabled').show();
    //     $('.attribute-values [data-value-id]').show();
    //     $('.attribute-condition-note').remove();

    //     attributeConditions.forEach(condition => {
    //         const {
    //             parent_attribute_id,
    //             parent_value_id,
    //             affected_attribute_id,
    //             action,
    //             affected_value_ids
    //         } = condition;

    //         const $parentWrapper = $(`[data-attribute-id="${parent_attribute_id}"]`);
    //         const $affectedWrapper = $(`[data-attribute-id="${affected_attribute_id}"]`);

    //         // Detect selected value from buttons or dropdown
    //         let selectedValueId = null;
    //         const $activeBtn = $parentWrapper.find('.attribute-values .active[data-value-id]');
    //         if ($activeBtn.length) {
    //             selectedValueId = +$activeBtn.data('value-id');
    //         } else {
    //             const $select = $parentWrapper.find('select');
    //             if ($select.length && $select.val()) {
    //                 selectedValueId = +$select.find('option:selected').data('value-id');
    //             }
    //         }

    //         const isMatch = selectedValueId === +parent_value_id;

    //         switch (action) {
    //             case 'hide_attribute':
    //                 if (isMatch) {
    //                     $affectedWrapper.addClass('disabled').hide();
    //                 }
    //                 break;

    //             case 'show_attribute':
    //                 if (!isMatch) {
    //                     $affectedWrapper.addClass('disabled').hide();
    //                 }
    //                 break;

    //             case 'hide_values':
    //                 if (isMatch && Array.isArray(affected_value_ids)) {
    //                     affected_value_ids.forEach(valId => {
    //                         $affectedWrapper.find(`[data-value-id="${valId}"]`).hide();
    //                     });
    //                 }
    //                 break;

    //             case 'show_values':
    //                 if (isMatch && Array.isArray(affected_value_ids)) {
    //                     $affectedWrapper.find('[data-value-id]').hide();
    //                     affected_value_ids.forEach(valId => {
    //                         $affectedWrapper.find(`[data-value-id="${valId}"]`).show();
    //                     });
    //                 }
    //                 break;
    //         }
    //     });

    //     calculatedAttributeRow();
    // }


    $(document).on('change', '.change-option-checkbox', function () {
        const affectedAttrId = $(this).data('affected-id');
        const $wrapper = $(`[data-attribute-id="${affectedAttrId}"]`);
        const $values = $wrapper.find('.attribute-values');

        if ($(this).is(':checked')) {
            $values.slideDown().find('input, select, button').prop('disabled', false);
        } else {
            $values.slideUp().find('input, select, button').prop('disabled', true);
        }
    });


    function debounce(fn, delay) {
        let timer = null;
        return function (...args) {
            if (timer) clearTimeout(timer);
            timer = setTimeout(() => fn.apply(this, args), delay);
        }
    }

    // Use debouncedCalculateTotalPrice instead of calculateTotalPrice below

    $(document).ready(function () {
        handleAttributeConditions();
        forceSliderRedraw();
        calculatedAttributeRow();

        const savedDeliveryCharge = JSON.parse(localStorage.getItem('selectedDeliveryCharge'));

        if (savedDeliveryCharge && savedDeliveryCharge.id) {
            const selectedCard = document.querySelector(`.estimate-card[data-id="${savedDeliveryCharge.id}"]`);

            if (selectedCard) {
                // document.querySelectorAll('.estimate-card.active').forEach(card => card.classList.remove('active'));
                // selectedCard.classList.add('active');

                // const selectedDate = $(selectedCard).data('date');
                // $('.estimate-card-static .text-black.mb-1').text(selectedDate);

                const selectedTitle = $(selectedCard).data('title') || 'Standard Delivery';
                // $('.estimate-card-static .title-static.text-muted.small').text(selectedTitle);

                // ✅ Show only cards with the same title
                $('.estimate-card').each(function () {
                    const cardTitle = $(this).data('title') || 'Standard Delivery';
                    $(this).toggle(cardTitle === selectedTitle);
                });

                debouncedCalculateTotalPrice();
            }
        } else {
            $('.estimate-card').show();
            debouncedCalculateTotalPrice();
        }


        $('.estimate-card').on('click', function () {
            if ($(this).hasClass('active')) {
                // Deselect this card
                $(this).removeClass('active');
                $(this).find('.ast-active').removeClass('ast-active');
                $(this).find('.detail-section').addClass('d-none');
                $(this).find('.title').addClass('d-none');

                // Update static card to defaults if no card is active
                if ($('.estimate-card.active').length === 0) {
                    const staticCard = $('.estimate-card-static.active');
                    staticCard.find('.final-price').text('0.00');
                    staticCard.find('.title-static.text-muted.small').text('Standard Delivery');
                    staticCard.find('.text-black.mb-1').text(''); // Clear date
                    // You may want to clear or reset additional fields as needed
                }
            } else {
                // Remove active from all, then set for this
                $('.estimate-option').removeClass('active');
                $('.estimate-option .ast-active').removeClass('ast-active');
                $('.detail-section').addClass('d-none');
                $('.title').addClass('d-none');

                $(this).addClass('active');
                $(this).find('div').first().addClass('ast-active');
                $(this).find('.detail-section').removeClass('d-none');
                $(this).find('.title').removeClass('d-none');

                const selectedDate = $(this).data('date');
                $('.estimate-card-static .text-black.mb-1').text(selectedDate);

                const titleDiv = $(this).find('.title');
                const selectedTitle = titleDiv.length && titleDiv.text().trim() !== '' ? titleDiv.text().trim() : 'Standard Delivery';
                $('.estimate-card-static .title-static.text-muted.small').text(selectedTitle);
            }
            // Optionally trigger price recalculation, etc.
            debouncedCalculateTotalPrice();
        });


        $('.selectable-proof-option').on('click', function () {
            const $this = $(this);
            if ($this.hasClass('active')) {
                $this.removeClass('active');
            } else {
                $('.selectable-proof-option').removeClass('active');
                $this.addClass('active');
            }

            debouncedCalculateTotalPrice();
        });
    });



    $('#addToCartBtn').on('click', function () {
        let isValid = true;
        let missingFields = [];


        $('.attribute-wrapper').each(function () {
            const $wrapper = $(this);
            const isRequired = $wrapper.data('is-required');

            if (isRequired && $wrapper.is(':visible')) {  // Add visibility check
                const hasActive = $wrapper.find('.attr-select.active, .print-color.active, .choose-binding.active').length > 0;
                const hasSelect = $wrapper.find('select.custom-select option:selected').filter(function () {
                    return $(this).val() !== '';
                }).length > 0;

                if (!hasActive && !hasSelect) {
                    isValid = false;
                    const label = $wrapper.find('label').clone().children().remove().end().text().trim();
                    missingFields.push(label || 'Required attribute');
                }
            }
        });

        if (!isValid) {
            Swal.fire({
                title: "Missing Required Options",
                text: `Please select the following required options:\n- ${missingFields.join('\n- ')}`,
                icon: "warning",
                confirmButtonText: "OK",
            });
            return;
        }

        if ($('.estimate-card.active').length === 0) {
            Swal.fire({
                title: "Delivery Option Required",
                text: "Please select a delivery option before adding to cart.",
                icon: "warning",
                confirmButtonText: "OK",
            });
            return;
        }



        const route = $(this).data('route');
        // return

        const quantity = parseInt($('#quantityInput').val()) || 1;
        let pages = parseInt($('#pageSlider').val()) || 32;
        let compositePages = {};

        const selectedAttributes = {};

        $('.attribute-wrapper:visible .active').each(function () {
            const attrId = $(this).data('attribute-id');
            const valueId = $(this).data('value-id');
            if (attrId && valueId) selectedAttributes[attrId] = valueId;
        });

        $('select.custom-select').each(function () {
            if ($(this).closest('.attribute-wrapper').is(':visible')) {
                const selected = $(this).find('option:selected');
                const attrId = selected.data('attribute-id');
                const valueId = selected.data('value-id');
                if (attrId && valueId) selectedAttributes[attrId] = valueId;
            }
        });


        // Add select_area attribute values
        $('.attribute-wrapper[data-attribute-type="select_area"]:visible').each(function () {
            const $wrapper = $(this);
            const attrId = $wrapper.data('attribute-id');

            const length = parseFloat($wrapper.find('input[name^="attributes["][name$="[length]"]').val()) || 0;
            const width = parseFloat($wrapper.find('input[name^="attributes["][name$="[width]"]').val()) || 0;
            const area = parseFloat($wrapper.find('input[name^="attributes["][name$="[area]"]').val()) || (length * width);
            const unit = $wrapper.find('input.area-input').first().data('area-unit') || ''; // Grab from first area input

            if (length > 0 && width > 0) {
                selectedAttributes[attrId] = {
                    type: 'select_area',
                    length: length,
                    width: width,
                    area: area,
                    unit: unit
                };
            }
        });



        // Add number inputs manually
        $('.attribute-wrapper[data-attribute-type="number"] input[type="number"]').each(function () {
            const input = $(this);
            const attrId = input.closest('.attribute-wrapper').data('attribute-id');
            const value = input.val();
            if (attrId && value !== '') {
                selectedAttributes[attrId] = {
                    value: value,
                    input_type: 'number'
                };
            }
        });

        // Handle composite pages
        if ($('.composite-slider').length > 0) {
            let compositeValueId = null;

            $('.attribute-wrapper .active').each(function () {
                const valueId = $(this).data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            $('select.custom-select').each(function () {
                const selected = $(this).find('option:selected');
                const valueId = selected.data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            const valueObj = compositeDraggerValues.find(val => val.id === compositeValueId);
            const components = valueObj?.components || [];

            let pageBreakdown = {};
            $('.composite-slider').each(function () {
                const index = parseInt($(this).data('index'));
                const label = components[index - 1] || `Part ${index}`;
                const value = parseInt($(this).val()) || 0;
                pageBreakdown[label] = value;
            });

            compositePages[compositeValueId] = pageBreakdown;
            pages = 0; // composite overrides
        }

        // Get selected delivery option
        const selectedDelivery = $('.estimate-option.active');
        const deliveryDate = selectedDelivery.data('date') || null;
        const deliveryPrice = parseFloat(selectedDelivery.data('price')) || 0;
        const deliveryId = parseInt(selectedDelivery.data('id')) || null;

        // Get selected File Check option
        const proofOption = $('.selectable-proof-option.active');
        const proofType = proofOption.data('value') || null;
        const proofPrice = parseFloat(proofOption.data('price')) || 0;
        const proofId = parseInt(proofOption.data('id')) || null;

        const subcategory_id = $(this).data('subcategory-id');

        const selectedCard = $('.estimate-card-static.active'); // or use `.selected`, however your logic marks it

        var finalPriceText = 0;

        if (selectedCard.length === 0) {
            finalPriceText = $('.final-price').text();
        } else {
            finalPriceText = selectedCard.find('.final-price').text(); // e.g., "£27.50"
        }

        const totalPrice = parseFloat(finalPriceText.replace('£', '')) || 0;
        // console.log("selectedAttributes", selectedAttributes);
        // return;
        // Send AJAX to backend
        $.ajax({
            url: route,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                quantity,
                pages,
                subcategory_id,
                totalPrice: totalPrice,
                attributes: selectedAttributes,
                composite_pages: compositePages,
                delivery: {
                    id: deliveryId,
                    date: deliveryDate,
                    price: deliveryPrice,
                },
                proof: {
                    id: proofId,
                    proof_type: proofType,
                    price: proofPrice,
                }
            },
            success: function (response) {
                if (response.success && response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else {
                    alert('Something went wrong while adding to cart.');
                }
            },
            error: function (xhr) {
                alert('Error occurred while adding to cart.');
                console.error(xhr.responseText);
            }
        });
    });

</script>