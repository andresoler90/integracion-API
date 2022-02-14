<?php

namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Lg1_user
 *
 * @property int $lg1_id
 * @property string $lg1_user
 * @property string $lg1_userName
 * @property string $lg1_email
 * @property string $lg1_password
 * @property int $lg1_status 0 Inactivo / 1 Activo
 * @property int|null $lg1_creatorId
 * @property string $lg1_createdDate
 * @property int|null $role1_id
 * @property int $lg1_moduleStatus 0 Inactivo / 1 Activo / 2 Bloqueado
 * @property int|null $loc3_id
 * @property int|null $lg1_code_sap table rup: us_usuarios_detalle
 * @property int $lg1_count_failed Contador de ingresos fallidos al sistema
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $lg1_updateid
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1CodeSap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1CountFailed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1CreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1CreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1Email($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1ModuleStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1Password($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1Updateid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1User($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLg1UserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereLoc3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereRole1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lg1_user whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Lg1_user extends Model
{
    protected $connection = "miproveedor";

}
