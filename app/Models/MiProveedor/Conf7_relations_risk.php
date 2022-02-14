<?php

namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Conf7_relations_risk
 *
 * @property int $conf7_id
 * @property int $conf4_id
 * @property int $conf7_status
 * @property int $conf7_moduleStatus 1 => Se tiene en cuenta en busqueda listas. 2 => No se tiene en cuenta en busquedas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk whereConf4Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk whereConf7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk whereConf7ModuleStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk whereConf7Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conf7_relations_risk whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Conf7_relations_risk extends Model
{
    protected $connection = "miproveedor";
    protected $table = 'conf7_relations_risk';
    protected $primaryKey = 'conf7_id';

    protected $fillable = [
        "conf4_id",
        "conf7_status",
        "conf7_moduleStatus"
    ];
}
