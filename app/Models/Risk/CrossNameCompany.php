<?php namespace App\Models\Risk;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Risk\CrossNameCompany
 *
 * @property int $id
 * @property int $companies_id Id de la tabla companies
 * @property int $processes_id Id de la tabla processes
 * @property string $comment Observación del registro
 * @property int $row_file Número de fila del archivo del registro
 * @property int|null $porcentage Porcentaje de coindicencia del registro
 * @property string|null $companies_name Nombres de coindicencia de la compañia del registro
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany whereCompaniesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany whereCompaniesName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany wherePorcentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany whereProcessesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrossNameCompany whereRowFile($value)
 * @mixin \Eloquent
 */
class CrossNameCompany extends Model
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
        "row_file",
        "porcentage",
        "companies_name"
    ];

    public static $logAttributes = [
        "companies_id",
        "processes_id",
        "comment",
        "row_file",
        "porcentage",
        "companies_name"
    ];//Se asigna publico para insercion
}
