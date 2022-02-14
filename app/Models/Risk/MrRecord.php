<?php namespace App\Models\Risk;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Risk\MrRecord
 *
 * @property int $id
 * @property int $user_id Id del usuario del permiso de visualización
 * @property int $table_id Id de la tabla del registro
 * @property string $table Nombre de la tabla
 * @property string $data_base Nombre de la base de datos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord whereDataBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MrRecord whereUserId($value)
 * @mixin \Eloquent
 */
class MrRecord extends Model
{
    use Notifiable, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "user_id",
        "table_id",
        "table",
        "data_base"
    ];

    private static $logAttributes = [
        "user_id",
        "table_id",
        "table",
        "data_base"
    ];

    public function getRecords($request)
    {
        $records = MrRecord::whereDataBase($request['db'])->whereTable($request['table'])->whereUserId($request['user']);
        return $records;
    }
}
