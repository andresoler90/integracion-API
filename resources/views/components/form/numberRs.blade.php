{{ Form::label (@__("$nameLabel", $transArgs), null, ['class' => 'control-label'])}}
<div class="input-group{{ $errors->has($nameCamp) ? ' has-error' : '' }}">
    <span class="input-group-addon" style="color:white">
    	Rs
    </span>
    {{ Form::text($nameCamp, $value, array_merge(['class' => 'form-control', 'step' => 'any'], $attributes))}}
</div>
<p class="text-danger">{{ $errors->first($nameCamp, ':message')}}</p>
