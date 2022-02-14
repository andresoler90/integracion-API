<div class="radio-inline{{ $errors->has($nameCamp) ? ' has-error' : '' }}">
	<label>
	    {{Form::checkbox($nameCamp, $value, false,array_merge($attributes))}}
		@if(!empty($nameLabel))
			{{@__("$nameCamp")}}
		@endif
    	<p class="text-danger">{{ $errors->first($nameCamp, ':message')}}</p>
	</label>
</div>

