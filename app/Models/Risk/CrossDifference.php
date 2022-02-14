<?php

namespace App\Models\Risk;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CrossDifference extends Model
{
    use Notifiable, Loggable, SoftDeletes;

    protected $guarded = [];
}
