@foreach($subs as $sub)
    <option value="{{ $sub->id }}">{{ $sub->class_name ?? '' }}</option>
@endforeach