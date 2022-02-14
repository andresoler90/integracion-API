<?php namespace App\Models\Risk;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Risk\Person
 *
 * @property int $id
 * @property string|null $name Nombres de la persona del registro
 * @property string|null $lastname Apellidos de la persona del registro
 * @property string|null $identification Identificación de la persona del registro
 * @property string|null $country Pais de la persona del registro
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFirstname($value)
 * @mixin \Eloquent
 * @property string|null $firstname Nombres de la persona del registro
 */
class Person extends Model
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
        "lastname",
        "firstname",
        "identification",
        "type_identification",
        "country"
    ];

    public static $logAttributes = [
        "name",
        "lastname",
        "firstname",
        "identification",
        "type_identification",
        "country"
    ];//Se asigna publico para insercion

    public function getCoincidence($identification, $nombre = "")
    {
        if ($nombre!="")
            $dataCoincidence = Person::whereRaw("MATCH(name) AGAINST('".replaceSymbols($nombre)."' IN BOOLEAN MODE) > 0");
        else
            $dataCoincidence = Person::whereIdentification($identification);
        return $dataCoincidence->distinct()->get();
    }

    public function scopeAddJoinCrossNamePeople($query)
    {
        return $query->join('cross_name_people','cross_name_people.people_id','=','people.id');
    }

    public function CrossNamePeople()
    {
        return $this->hasOne(CrossIdPerson::class,'people_id','id');
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
