<?php namespace App\Payment;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Paym1Product extends Model
{
    #TRAITS
    use SoftDeletes;
    protected $primaryKey = 'paym1_id';
    protected $fillable=[
        "paym1_product"
    ];
}
