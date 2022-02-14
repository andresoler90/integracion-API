<?php

namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Pv17_contacts
 *
 * @property int $pv17_id
 * @property string $pv17_identification
 * @property string $pv17_name
 * @property int $pv17_representativetype
 * @property string $pv17_phone
 * @property string|null $pv17_negotiationcapacity
 * @property int|null $pv17_limitofnegotiation
 * @property string|null $pv17_email
 * @property string|null $pv17_attached1 Anexar DOC Reporte legal
 * @property string|null $pv17_attached1_PATH
 * @property string|null $pv17_documentexpeditiondoc
 * @property int $pv17_status
 * @property int $pv17_modulestatus 1 creado/afectado por Admin | 2 Creado por Proveedor | 3 Afectado por proveedor
 * @property string $pv17_createddate
 * @property int $pv1_id
 * @property int $use1_id
 * @property int $loc3_id
 * @property int $loc2_id
 * @property int $loc1_id
 * @property string|null $pv17_cityexpedition
 * @property int|null $lg1_creatorid
 * @property string|null $pv17_evrdSession
 * @property string|null $pv17_attached_temp
 * @property string|null $pv17_expirateDate
 * @property string|null $pv17_cellPhone
 * @property string|null $pv17_cellPhoneInd
 * @property string|null $pv17_cellPhoneExt
 * @property string|null $pv17_phoneInd
 * @property string|null $pv17_phoneExt
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $lg1_updatedId
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts whereLg1Creatorid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts whereLg1UpdatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts whereLoc1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts whereLoc2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts whereLoc3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Attached1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Attached1PATH($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17AttachedTemp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17CellPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17CellPhoneExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17CellPhoneInd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Cityexpedition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Createddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Documentexpeditiondoc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Email($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17EvrdSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17ExpirateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Identification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Limitofnegotiation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Modulestatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Negotiationcapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Phone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17PhoneExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17PhoneInd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Representativetype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv17Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts wherePv1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv17_contacts whereUse1Id($value)
 * @mixin \Eloquent
 */
class Pv17_contacts extends Model
{
    protected $connection = "miproveedor";
    protected $table = 'pv17_contacts';
    protected $primaryKey = 'pv17_id';

    protected $fillable = [
        "pv17_identification",
        "pv17_name",
        "pv17_status",
        "pv17_modulestatus",
        "pv1_id"
    ];
}
