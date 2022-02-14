@if(!empty($nameLabel))
    {{ Form::label(@__("$nameLabel", $transArgs), null, ['class' => 'control-label']) }}
@endif

<div class="input-group {{ $errors->has($nameCamp) ? ' has-error' : '' }}">
    <span class="input-group-addon">
    	<i class="fa {{$iconVal}}" aria-hidden="true"></i>
    </span>
    @if(isset($selected) && !empty($selected))
        {{ Form::select($nameCamp, $value, $selected, array_merge(['class' => 'form-control'], $attributes))}}
    @else
        {{ Form::select($nameCamp, $value, '', array_merge(['class' => 'form-control'], $attributes))}}
    @endif
    <p class="text-danger">{{ $errors->first($nameCamp, ':message')}}</p>
</div>
