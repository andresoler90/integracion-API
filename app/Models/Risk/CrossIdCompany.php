<?php namespace App\Models\Risk;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Risk\CrossIdCompany
 *
 * @property int $id
 * @property int $companies_id Id de la tabla companies
 * @property int $processes_id Id de la tabla processes
 * @property string $comment Observación del registro
 * @property int $row_file Número de fila del archivo del registro
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdCompany whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdCompany whereCompaniesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdCompany whereProcessesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossIdCompany whereRowFile($value)
 * @mixin \Eloquent
 */
class CrossIdCompany extends Model
{
    use Notifiable, Loggable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "companies_id",
        "processes_id",
        "comment",
        "row_file"
    ];

    public static $logAttributes = [
        "companies_id",
        "processes_id",
        "comment",
        "row_file"
    ];//Se asigna publico para insercion
}
