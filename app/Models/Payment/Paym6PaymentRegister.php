<?php namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paym6PaymentRegister extends Model
{
    #TRAITS
    use SoftDeletes;
    protected $primaryKey = 'paym6_id';
    protected $fillable=[
        "paym6_providerName",
        "paym6_identification",
        "paym6_fullName",
        "paym6_email",
        "paym6_phone",
        "paym6_address",
        "loc3_id"
    ];
}
