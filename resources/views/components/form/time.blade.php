<div class="form-group{{ $errors->has($nameCamp) ? ' has-error' : '' }}">

    @if(! empty($attributes['iconLabel']))
        {!! $attributes['iconLabel'] !!}

        @php unset($attributes['iconLabel']) @endphp
    @endif
    {{ Form::label(@__("$nameLabel"),null, ['class' => 'control-label']) }}
    {{ Form::time($nameCamp, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    <p class="text-danger">{{ $errors->first($nameCamp, ':message')}}</p>
</div>
