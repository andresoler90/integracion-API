<?php namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\MiProveedor\Paym1_providerPayments
 *
 * @property int $paym1_id
 * @property string $paym1_paymentDate
 * @property int $paym1_baseValue
 * @property int $paym1_paymentValue
 * @property int $paym1_methodpayment
 * @property int $paym1_concept
 * @property string $paym1_year
 * @property string $paym1_contactName
 * @property string $paym1_contactEmail
 * @property string $paym1_address
 * @property string $paym1_phone
 * @property string $paym1_attached
 * @property string|null $paym1_certificate
 * @property string|null $paym1_description
 * @property int $paym1_modulestatus 2 ==> visible para proveedor y admin | 1 ==> visibles para todo el sistema
 * @property int $paym1_status
 * @property string $paym1_createddate
 * @property int $lg1_creatorId
 * @property int $pv1_id
 * @property int|null $loc3_id
 * @property int|null $loc2_id
 * @property int|null $loc1_id
 * @property int $cl1_id
 * @property int|null $lg1_userUpdate
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments newQuery()
 * @method static \Illuminate\Database\Query\Builder|Paym1_providerPayments onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments query()
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments whereCl1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments whereLg1CreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments whereLg1UserUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments whereLoc1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments whereLoc2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments whereLoc3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Address($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Attached($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1BaseValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Certificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Concept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1ContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1ContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Createddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Description($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Methodpayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Modulestatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1PaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1PaymentValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Phone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePaym1Year($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paym1_providerPayments wherePv1Id($value)
 * @method static \Illuminate\Database\Query\Builder|Paym1_providerPayments withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Paym1_providerPayments withoutTrashed()
 * @mixin \Eloquent
 */
class Paym1_providerPayments extends Model
{
    use SoftDeletes;

    protected $connection = "miproveedor";
    protected $table = 'paym1_providerpayments';
    protected $primaryKey = 'paym1_id';

    protected $fillable = [
        "paym1_paymentDate",
        "paym1_baseValue",
        "paym1_paymentValue",
        "paym1_methodpayment",
        "paym1_concept",
        "paym1_year",
        "paym1_contactName",
        "paym1_contactEmail",
        "paym1_address",
        "paym1_phone",
        "paym1_attached",
        "paym1_certificate",
        "paym1_description",
        "paym1_modulestatus",
        "paym1_status",
        "lg1_creatorId",
        "pv1_id",
        "loc3_id",
        "loc2_id",
        "loc1_id",
        "cl1_id",
        "lg1_userUpdate",
        "deleted_at"
    ];
}
