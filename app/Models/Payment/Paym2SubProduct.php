<?php namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paym2SubProduct extends Model
{
    #TRAITS
    use SoftDeletes;
    protected $table = "paym2_subproducts";
    protected $primaryKey = 'paym2_id';
    protected $fillable=[
        "paym2_subProduct"
    ];
}
