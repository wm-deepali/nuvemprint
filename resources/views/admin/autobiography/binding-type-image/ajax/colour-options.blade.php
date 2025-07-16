<option value="">Select</option>
@if (isset($colours) && count($colours)>0)
    @foreach ($colours as $colour)
        <option value="{{ $colour->id }}">{{ $colour->name }}</option>
    @endforeach
@endif