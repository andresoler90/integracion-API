<?php namespace App\Models\Risk;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Risk\Company
 *
 * @property int $id
 * @property string|null $name Nombre de la empresa del registro
 * @property string $identification Identificación de la empresa del registro
 * @property string|null $country Pais de la empresa del registro
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    use Notifiable, Loggable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "identification",
        "type_identification",
        "country"
    ];

    public static $logAttributes = [
        "name",
        "identification",
        "type_identification",
        "country"
    ];//Se asigna publico para insercion

    public function getCoincidence($identification, $nombre = "")
    {
        if ($nombre!="")
            $dataCoincidence = Company::whereRaw("MATCH(name) AGAINST('".replaceSymbols($nombre)."' IN BOOLEAN MODE) > 0");
        else
            $dataCoincidence = Company::whereIdentification($identification);
        return $dataCoincidence->distinct()->get();
    }

    public function getData($records)
    {
        return Company::whereIn('id', $records)->distinct()->get();
    }
    public function scopeSearchByIdentification($query, $identification)
    {
        if ($identification)
            return $query->where('identification',$identification);
    }
    public function scopeSearchByName($query, $name)
    {
        if ($name)
            return $query->where('name', 'like', "%" . $name . "%");
    }
}
