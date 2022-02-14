<div class="form-group">
    {{ Form::submit(@__("$name", $transArgs),array_merge(['class' => 'btn'], $attributes))}}
</div>
