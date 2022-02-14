<?php namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Loc3Country
 *
 * @property int $loc3_id
 * @property string $loc3_shortName
 * @property string $loc3_officialName
 * @property string|null $loc3_language
 * @property bool $loc3_status
 * @property string $loc3_createdDate
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country active()
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country whereLoc3CreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country whereLoc3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country whereLoc3Language($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country whereLoc3OfficialName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country whereLoc3ShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loc3Country whereLoc3Status($value)
 * @mixin \Eloquent
 */
class Loc3Country extends Model
{
    /**
     * Campos validos para cargue desde cliente
     *
     * @var array
     */
    protected $fillable=['loc3_shortName','loc3_officialName','loc3_iso3','loc3_iso2','loc3_faostat',
                        'loc3_gaul','loc3_codDian','loc3_status','loc3_createdDate','lg1_creatorId'];

    /**
     * No editables por la aplicacion
     *
     * @var array
     */
    protected $guarded=['loc3_id'];
    protected $casts=['loc3_status'=>'boolean'];
    protected $primaryKey= 'loc3_id';

    public function scopeActive($query)
    {
        return $query->where('loc3_status',1);
    }
}
