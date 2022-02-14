<div class="form-group {{ $errors->has($nameCamp) ? ' has-error' : '' }}">

    @if(! empty($attributes['iconLabel']))
        {!! $attributes['iconLabel'] !!}

        @php unset($attributes['iconLabel']) @endphp
    @endif

    {{ Form::label(@__("$nameLabel", $transArgs), null, ['class' => 'control-label'])}}


    {{ Form::textarea($nameCamp,$value, $attributes)}}
    <p class="text-danger">{{ $errors->first($nameCamp, ':message')}}</p>
</div>
