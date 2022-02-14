@if(!empty($nameLabel))
    {{ Form::label (@__("$nameLabel", $transArgs), null, ['class' => 'control-label'])}}
@endif
<div class="input-group{{ $errors->has($nameCamp) ? ' has-error' : '' }}">
    {{ Form::password($nameCamp, $value, array_merge(['class' => 'form-control', 'step' => 'any'], $attributes))}}
    <span class="input-group-addon passPar" id="{{$idChangePass}}" onclick="viewPassword(this.id)">
    	<i class="fa {{$iconVal}}" aria-hidden="true"></i>
    </span>
</div>
<br>
