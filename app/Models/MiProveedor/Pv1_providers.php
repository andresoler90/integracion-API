<?php namespace App\Models\MiProveedor;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MiProveedor\Pv1_providers
 *
 * @property int $pv1_id
 * @property string $pv1_identification
 * @property string|null $pv1_dv
 * @property string $pv1_providerName
 * @property string|null $pv1_commercialName
 * @property string|null $pv1_shortName
 * @property string|null $pv1_oracleNumber Numero oracle buscador 09-04-2019
 * @property int $pv1_status
 * @property string $pv1_createdDate
 * @property int|null $lg1_creatorId
 * @property int|null $use1_id
 * @property int $loc1_id
 * @property int|null $loc2_id
 * @property int|null $loc3_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_at_nit
 * @property int|null $lg1_updatedId
 * @property int|null $lg1_updatedIdNit
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereLg1CreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereLg1UpdatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereLg1UpdatedIdNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereLoc1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereLoc2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereLoc3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1CommercialName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1CreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1Dv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1Identification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1OracleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1ProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1ShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers wherePv1Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereUpdatedAtNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pv1_providers whereUse1Id($value)
 * @mixin \Eloquent
 * @property-read mixed $type_provider
 */
class Pv1_providers extends Model
{
    protected $connection = "miproveedor";
    protected $table = 'pv1_providers';
    protected $primaryKey = 'pv1_id';

    protected $fillable = [
        "pv1_identification",
        "pv1_dv",
        "pv1_providerName",
        "pv1_commercialName",
        "pv1_shortName",
        "pv1_oracleNumber",
        "pv1_status",
        "pv1_createdDate",
        "use1_id",
        "loc1_id",
        "loc2_id",
        "loc3_id",
        "updated_at",
        "updated_at_nit",
        "lg1_updatedId",
        "lg1_updatedIdNit"
    ];

    public function getCoincidence($identification, $tipo, $nombre = "", $lista = "sidif")
    {
        if ($tipo==1)
        {
            if ($nombre!="")
                $dataCoincidence = Pv1_providers::whereRaw("MATCH(pv1_providerName) AGAINST('".$nombre."' IN BOOLEAN MODE) > 0");
            else
                $dataCoincidence = Pv1_providers::wherePv1Identification($identification);
        }
        else if ($tipo==2)
        {
            $dataCoincidence = Pv1_providers::join('pv17_contacts', 'pv17_contacts.pv1_id', '=', 'pv1_providers.pv1_id')
                ->where('pv17_status', 1)->where('pv17_modulestatus', '!=', 2);
            if ($nombre!="")
                $dataCoincidence = $dataCoincidence->whereRaw("MATCH(pv17_name) AGAINST('".$nombre."' IN BOOLEAN MODE) > 0");
            else
                $dataCoincidence = $dataCoincidence->where('pv17_identification', $identification);
        }
        else if ($tipo==3)
        {
            $dataCoincidence = Pv1_providers::join('trad2_partners', 'trad2_partners.pv1_id', '=', 'pv1_providers.pv1_id')
                ->where('trad2_status', 1)->where('trad2_modulestatus', '!=', 2);
            if ($nombre!="")
                $dataCoincidence = $dataCoincidence->whereRaw("MATCH(trad2_name) AGAINST('".$nombre."' IN BOOLEAN MODE) > 0");
            else
                $dataCoincidence = $dataCoincidence->where('trad2_identification', $identification);
        }
        if ($lista=="sidif")
            $dataCoincidence = $dataCoincidence->where('pv1_providers.loc3_id', 13);
        return $dataCoincidence->wherePv1Status(1)->join('pv15_statesrelations', 'pv15_statesrelations.pv1_id', '=', 'pv1_providers.pv1_id')
            ->join('conf7_relations_risk','conf7_relations_risk.conf4_id','=','pv15_statesrelations.conf4_id')
            ->where('conf7_status', 1)->where('conf7_moduleStatus', 1)->where('pv15_status', 1);
    }

    public function getTypeProviderAttribute()
    {
        return $this->hasOne(Pv2_infoproviders::class, 'pv1_id', 'pv1_id')->addSelect('pv2_natureType')->first();
    }
}
