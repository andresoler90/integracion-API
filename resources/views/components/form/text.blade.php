<div class="form-group">
    @if(!empty($nameLabel))

        @if(! empty($attributes['iconLabel']))
            {!! $attributes['iconLabel'] !!}

            @php unset($attributes['iconLabel']) @endphp
        @endif

        {{ Form::label(@__("$nameLabel"), null, ['class' => 'control-label']) }}
    @endif

    {{ Form::text($nameCamp, $value, array_merge(['class' => 'form-control','autocomplete'=>"off"], $attributes)) }}
</div>
