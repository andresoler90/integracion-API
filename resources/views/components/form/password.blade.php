<div class="form-group{{ $errors->has($nameCamp) ? ' has-error' : '' }}">

    @if(!empty($nameLabel))
        {{ Form::label(@__("$nameLabel", $transArgs), null, ['class' => 'control-label']) }}
    @endif

    {{ Form::password($nameCamp, array_merge(['class' => 'form-control'], $attributes))}}
    <p class="text-danger">{{ $errors->first($nameCamp, ':message')}}</p>
</div>
