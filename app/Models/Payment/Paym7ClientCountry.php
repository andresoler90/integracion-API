<?php namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paym7ClientCountry extends Model
{
    #TRAITS
    use SoftDeletes;
    protected $table = "paym7_clientcountries";
    protected $primaryKey = 'paym7_id';
    protected $fillable=[
        "paym4_id",
        "loc3_id"
    ];

    ############################################################################################################
    ############################################RELACIONES######################################################
    ############################################################################################################
    /**
     * Relación con modelo Lg1_user Uno a Muchos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paym4Clients()
    {
        return $this->belongsTo('App\Payment\Models\Paym4Clients', 'paym4_id', 'paym4_id');
    }

}
