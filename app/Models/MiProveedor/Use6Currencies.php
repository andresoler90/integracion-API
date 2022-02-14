<?php namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Use6Currencies
 *
 * @property int $use6_id
 * @property string $use6_acronym
 * @property string $use6_description
 * @property int $use6_status
 * @property string $use6_symbol Simbolo de la moneda
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies active()
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies query()
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies whereUse6Acronym($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies whereUse6Description($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies whereUse6Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies whereUse6Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Use6Currencies whereUse6Symbol($value)
 * @mixin \Eloquent
 */
class Use6Currencies extends Model
{
    protected $table='use6_currencies';
    public $timestamps = false;

    /**
     * Campos validos para cargue desde cliente
     *
     * @var array
     */
    protected $fillable=['use6_acronym','use6_description','loc3_id','use6_symbol'];

    /**
     * No editables por la aplicacion
     *
     * @var array
     */
    protected $guarded=['use6_id'];
    protected $primaryKey= 'use6_id';

    public function scopeActive($query)
    {
        return $query->where('use6_status',1);
    }
}
