<div class="input-group">
    {{ Form::submit(@__("$nameLabel", $transArgs),array_merge($attributes))}}
    <span class="input-group-addon iconRight">
    	<i class="fa {{$iconVal}}" aria-hidden="true"></i>
    </span>
</div>
