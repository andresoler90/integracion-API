<?php namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Pv15_statesRelations
 *
 * @property int $pv15_id
 * @property string|null $pv15_start_date
 * @property string|null $pv15_end_date
 * @property string|null $pv15_observation
 * @property string|null $pv15_modificationDate
 * @property int $pv15_status
 * @property string $pv15_createdDate
 * @property int $pv1_id
 * @property int|null $conf5_id
 * @property int|null $conf4_id
 * @property int $lg1_creatorId
 * @property int|null $cl1_id
 * @property string|null $pv15_codigointerno1
 * @property string|null $pv15_codigointerno2
 * @property string|null $pv15_nombreinterno1
 * @property string|null $pv15_nombreinterno2
 * @property int|null $pv32_id
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int|null $lg1_updateId
 * @property string|null $pv15_acta
 * @property int|null $pv33_id
 * @property int|null $pv34_id
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations whereCl1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations whereConf4Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations whereConf5Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations whereLg1CreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations whereLg1UpdateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15Acta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15Codigointerno1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15Codigointerno2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15CreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15EndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15ModificationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15Nombreinterno1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15Nombreinterno2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15Observation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15StartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv15Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv32Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv33Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations wherePv34Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv15_statesRelations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pv15_statesRelations extends Model
{
    protected $connection = "miproveedor";
    protected $table = 'pv15_statesrelations';
    protected $primaryKey = 'pv15_id';

    protected $fillable = [
        "pv15_start_date",
        "pv15_end_date",
        "pv15_observation",
        "pv15_modificationDate",
        "pv15_status",
        "pv15_createdDate",
        "pv1_id",
        "conf5_id",
        "conf4_id",
        "lg1_creatorId",
        "cl1_id",
        "pv15_codigointerno1",
        "pv15_codigointerno2",
        "pv15_nombreinterno1",
        "pv15_nombreinterno2",
        "pv32_id",
        "updated_at",
        "lg1_updateId",
        "pv15_acta",
        "pv33_id",
        "pv34_id"
    ];
}
