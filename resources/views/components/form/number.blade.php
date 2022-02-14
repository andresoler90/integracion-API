<div class="form-group">

    @if(!empty($nameLabel))
        @if(! empty($attributes['iconLabel']))
            {!! $attributes['iconLabel'] !!}

            @php unset($attributes['iconLabel']) @endphp
        @endif

        {{ Form::label (@__("$nameLabel", $transArgs), null, ['class' => 'control-label'])}}
    @endif

    {{ Form::number($nameCamp, $value, array_merge(['class' => 'form-control', 'step' => 'any'], $attributes))}}
    <p class="text-danger"></p>
</div>
