<?php

namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Pv2_infoproviders
 *
 * @property int $pv2_id
 * @property string $pv2_address
 * @property string $pv2_codificateAddress
 * @property string|null $pv2_phone1
 * @property string|null $pv2_phone1Ind
 * @property int|null $pv2_phone1Ext
 * @property string|null $pv2_phone2
 * @property string|null $pv2_phone2Ind
 * @property int|null $pv2_phone2Ext
 * @property string|null $pv2_cellPhone
 * @property string|null $pv2_cellPhoneInd
 * @property string $pv2_corporateEmail
 * @property string|null $pv2_webPage
 * @property string|null $pv2_brochure
 * @property int|null $pv1_id
 * @property string|null $pv2_virtualbrochure
 * @property string|null $pv2_logo
 * @property int|null $pv2_natureType
 * @property int|null $pv2_titleType
 * @property int|null $pv2_fax
 * @property string|null $pv2_taxId
 * @property int|null $cl1_id_referredBy CAMPO CLIENTE REFERIDO POR EN EL NUEVO PRE REGISTRO ESTANDAR
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders whereCl1IdReferredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Address($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Brochure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2CellPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2CellPhoneInd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2CodificateAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2CorporateEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Fax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Logo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2NatureType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Phone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Phone1Ext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Phone1Ind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Phone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Phone2Ext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Phone2Ind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2TaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2TitleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2Virtualbrochure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv2_infoproviders wherePv2WebPage($value)
 * @mixin \Eloquent
 */
class Pv2_infoproviders extends Model
{
    protected $connection = "miproveedor";
    protected $table = 'pv2_infoproviders';
    protected $primaryKey = 'pv2_id';

    protected $fillable = [
        "pv1_id",
        "pv2_natureType"
    ];
}
