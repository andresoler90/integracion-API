<?php namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paym4Client extends Model
{
    #TRAITS
    use SoftDeletes;
    protected $primaryKey = 'paym4_id';
    protected $fillable=[
        "paym4_name",
        "paym4_identification"
    ];
}
