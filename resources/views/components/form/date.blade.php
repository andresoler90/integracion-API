<div class="form-group{{ $errors->has($nameCamp) ? ' has-error' : '' }}">

    @if(! empty($attributes['iconLabel']))
        {!! $attributes['iconLabel'] !!}

        @php unset($attributes['iconLabel']) @endphp
    @endif
    {{ Form::label(@__("$nameCamp"), null, ['class' => 'control-label']) }}
    @if($nameCamp=="fecha_carta_hocol_pago_en_pesos" || $nameCamp=="fecha_de_verificacion_en_world_check")
        @if(isset($attributes['class']))
            @php
                unset($attributes['class']);
            @endphp
        @endif
        @php($attributes['class'] = 'form-control fecha_hocol')
        @php($attributes['readonly'] = "readonly")
        {{ Form::text($nameCamp, $value, $attributes) }}
    @else
        {{ Form::date($nameCamp, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @endif
    <p class="text-danger">{{ $errors->first($nameCamp, ':message')}}</p>
</div>
