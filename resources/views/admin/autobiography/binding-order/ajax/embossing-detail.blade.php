<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Embossing</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                Art: {{ Str::title(str_replace('_', ' ', $binding_order->front_art)) }}<br>
                Title: {{ Str::title(str_replace('_', ' ', $binding_order->front_title)) }}<br>
                Year: {{ Str::title(str_replace('_', ' ', $binding_order->front_year)) }}<br>
                Author: {{ Str::title(str_replace('_', ' ', $binding_order->front_author)) }}<br>
                University: {{ Str::title(str_replace('_', ' ', $binding_order->front_university)) }}<br>
                @if ($binding_order->has_embossed_spine == 'yes')
                Spine Art: {{ Str::title(str_replace('_', ' ', $binding_order->spine_art)) }}<br>
                Spine Author: {{ Str::title(str_replace('_', ' ', $binding_order->spine_author)) }}<br>
                Spine Year: {{ Str::title(str_replace('_', ' ', $binding_order->spine_year)) }}<br>
                @endif
                Country: {{ $binding_order->autobiography_university_country->name ?? '-' }}<br>
                University: {{ $binding_order->autobiography_university->name ?? '-' }}<br>
                
                @if (isset($binding_order->university->logo_silver) && $binding_order->embossing_colour == 'silver')
                Logo: <a href="{{ URL::asset('storage/'.$binding_order->university->logo_silver) }}" download="">view</a><br>
                @endif
                @if (isset($binding_order->university->logo_black) && $binding_order->embossing_colour == 'black')
                Logo: <a href="{{ URL::asset('storage/'.$binding_order->university->logo_black) }}" download="">view</a><br>
                @endif
                @if (isset($binding_order->university->logo_golden) && $binding_order->embossing_colour == 'golden')
                Logo: <a href="{{ URL::asset('storage/'.$binding_order->university->logo_gold) }}" download="">view</a><br>
                @endif
            </div>
        </div>
    </div>
</div>