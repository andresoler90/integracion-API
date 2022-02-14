<?php namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paym5Relation extends Model
{
    #TRAITS
    use SoftDeletes;
    protected $primaryKey = 'paym5_id';
    protected $fillable=[
        "paym5_value",
        "paym1_id",
        "paym2_id",
        "paym3_id",
        "paym7_id",
        "use6_id"
    ];

    /**
     * Segmento de query que hace referencia a los activos
     * @param $query
     * @return mixed
     */
    public function scopeActiveRegister($query)
    {
        return $query->where('paym5_state', 1);
    }

    ############################################################################################################
    ############################################RELACIONES######################################################
    ############################################################################################################
    /**
     * Relación con modelo paym1_products Uno a Muchos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paym1Products()
    {
        return $this->belongsTo('App\Payment\Models\Paym1Products', 'paym1_id', 'paym1_id');
    }

    /**
     * Relación con modelo paym2_subproducts Uno a Muchos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paym2SubProducts()
    {
        return $this->belongsTo('App\Payment\Models\Paym2SubProducts', 'paym2_id', 'paym2_id');
    }

    /**
     * Relación con modelo paym3_typebases Uno a Muchos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paym3TypeBases()
    {
        return $this->belongsTo('App\Payment\Models\Paym3TypeBases', 'paym3_id', 'paym3_id');
    }

    /**
     * Relación con modelo paym4_clients Uno a Muchos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paym4Clients()
    {
        return $this->belongsTo('App\Payment\Models\Paym4Clients', 'paym4_id', 'paym4_id');
    }

    /**
     * Relación con modelo paym7_clientcountries Uno a Muchos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paym7ClientCountries()
    {
        return $this->belongsTo('App\Payment\Models\Paym7ClientCountries', 'paym7_id', 'paym7_id');
    }

    /**
     * Relación con modelo use6_currencies  Uno a Muchos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function use6Currencies()
    {
        return $this->belongsTo('App\Use6Currencies', 'use6_id', 'use6_id');
    }

    /**
     * @param array $vlrsInstance
     * @return Paym5Relation
     */
    public function setPaym5Relations($vlrsInstance = [])
    {
        return  new Paym5Relation($vlrsInstance);
    }
}
