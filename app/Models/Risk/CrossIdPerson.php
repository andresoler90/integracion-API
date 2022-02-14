<?php namespace App\Models\Risk;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Risk\CrossIdPerson
 *
 * @property int $id
 * @property int $people_id Id de la tabla people
 * @property int $processes_id Id de la tabla processes
 * @property string $comment Observación del registro
 * @property int $row_file Número de fila del archivo del registro
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdPerson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdPerson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdPerson query()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdPerson whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdPerson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdPerson wherePeopleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdPerson whereProcessesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdPerson whereRowFile($value)
 * @mixin \Eloquent
 */
class CrossIdPerson extends Model
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
        "row_file"
    ];

    public static $logAttributes = [
        "people_id",
        "processes_id",
        "comment",
        "row_file"
    ];//Se asigna publico para insercion
}
