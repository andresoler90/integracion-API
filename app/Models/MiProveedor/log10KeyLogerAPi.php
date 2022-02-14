<?php

namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\MiProveedor\log10KeyLogerAPi
 *
 * @property int $log10_id ID de la tabla
 * @property string $log10_key_loger Token Generado para el usuario
 * @property int $log10_key_user Usuario asignado al token
 * @property string $log10_api Nombre del api que invoka
 * @property string $sys4_role_name Nombre del role
 * @property int $sys4_role_id Id del role
 * @property int $cl1_id Id del cliente
 * @property int $lg1_creatorId Id del usuario que realizo el registro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\MiProveedor\Lg1_user|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi newQuery()
 * @method static \Illuminate\Database\Query\Builder|log10KeyLogerAPi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi query()
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereCl1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereLg1CreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereLog10Api($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereLog10Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereLog10KeyLoger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereLog10KeyUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereSys4RoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereSys4RoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|log10KeyLogerAPi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|log10KeyLogerAPi withTrashed()
 * @method static \Illuminate\Database\Query\Builder|log10KeyLogerAPi withoutTrashed()
 * @mixin \Eloquent
 */
class log10KeyLogerAPi extends Model
{
    use SoftDeletes;

    protected $connection = "miproveedor";
    protected $table = 'log10_keylogerapis';
    protected $primaryKey = 'log10_id';

    protected $fillable = [
        "log10_key_loger",
        "log10_key_user",
        "log10_api",
        "sys4_role_name",
        "sys4_role_id",
        "cl1_id",
        "lg1_creatorId"
    ];

    public function user()
    {
        return $this->hasOne(Lg1_user::class, 'lg1_id', 'log10_key_user');
    }
}
