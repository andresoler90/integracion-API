<?php

namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Trad2_partners
 *
 * @property int $trad2_id
 * @property string $trad2_name
 * @property string $trad2_identification
 * @property int $trad2_typecharge
 * @property string|null $trad2_percentageparticipation
 * @property string|null $trad2_attached
 * @property string|null $trad2_dateexpeditiondocument
 * @property int $trad2_status
 * @property int $trad2_modulestatus
 * @property string $trad2_createddate
 * @property int|null $lg1_creatorId
 * @property int|null $use1_id
 * @property int|null $loc3_id
 * @property int $pv1_id
 * @property string|null $trad2_opt
 * @property string|null $tra2_nacionalidad
 * @property string|null $trad_evrdSession
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereLg1CreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereLoc3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners wherePv1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTra2Nacionalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Attached($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Createddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Dateexpeditiondocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Identification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Modulestatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Opt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Percentageparticipation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTrad2Typecharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereTradEvrdSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereUse1Id($value)
 * @mixin \Eloquent
 * @property int|null $lg1_updateid
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $lg1_deleteid
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereLg1Deleteid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereLg1Updateid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trad2_partners whereUpdatedAt($value)
 */
class Trad2_partners extends Model
{
    protected $connection = "miproveedor";
    protected $table = 'trad2_partners';
    protected $primaryKey = 'trad2_id';

    protected $fillable = [
        "trad2_name",
        "trad2_identification",
        "trad2_status",
        "trad2_modulestatus",
        "pv1_id"
    ];
}
