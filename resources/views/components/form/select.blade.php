<div class="form-group">

	@if(!empty($nameLabel))

		@if(! empty($attributes['iconLabel']))
			{!! $attributes['iconLabel'] !!}

			@php unset($attributes['iconLabel']) @endphp
		@endif

		{{ Form::label(@__("$nameLabel", $transArgs), null, ['class' => 'control-label']) }}
	@endif
	{{--@if(!empty($selected))--}}
	{{ Form::select($nameCamp, @$value, @$selected, array_merge(['class' => 'form-control'], @$attributes))}}
	{{--@endif--}}
	<p class="text-danger"></p>
</div>
