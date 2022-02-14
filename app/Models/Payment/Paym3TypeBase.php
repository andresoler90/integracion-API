<?php namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paym3TypeBase extends Model
{
    #TRAITS
    use SoftDeletes;
    protected $table = "paym3_typebases";
    protected $primaryKey = 'paym3_id';
    protected $fillable=[
        "paym3_typeBase"
    ];
}
