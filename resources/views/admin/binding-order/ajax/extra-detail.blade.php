<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Extra's</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                @php
                $extra_accessories = json_decode($binding_order->extra_accessories_json);
                @endphp
                @if (is_array($extra_accessories))
                @foreach ($extra_accessories as $extra_accessory)
                {{ Str::title(str_replace('_', ' ', $extra_accessory->name)) }}<br>
                @endforeach
                @else
                -
                @endif
            </div>
        </div>
    </div>
</div>