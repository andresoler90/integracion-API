<?php namespace App\Models\Risk;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Risk\CrossNamePerson
 *
 * @property int $id
 * @property int $people_id Id de la tabla people
 * @property int $processes_id Id de la tabla processes
 * @property string $comment Observación del registro
 * @property int $row_file Número de fila del archivo del registro
 * @property int|null $porcentage Porcentaje de coindicencia del registro
 * @property string|null $people_name Nombres de coindicencia de la persona del registro
 * @property string|null $people_lastname Apellidos de coindicencia de la persona del registro
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson query()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson wherePeopleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson wherePeopleLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson wherePeopleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson wherePorcentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson whereProcessesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson whereRowFile($value)
 * @mixin \Eloquent
 * @property string|null $people_firstname
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNamePerson wherePeopleFirstname($value)
 */
class CrossNamePerson extends Model
{
    use Notifiable, Loggable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "people_id",
        "processes_id",
        "comment",
        "row_file",
        "porcentage",
        "people_name",
        "people_lastname",
        "people_firstname"
    ];

    public static $logAttributes = [
        "people_id",
        "processes_id",
        "comment",
        "row_file",
        "porcentage",
        "people_name",
        "people_lastname",
        "people_firstname"
    ];//Se asigna publico para insercion
}
