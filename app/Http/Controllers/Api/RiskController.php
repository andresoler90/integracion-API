<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Risk\Company;
use App\Models\Risk\CrossDifference;
use App\Models\Risk\CrossIdCompany;
use App\Models\Risk\CrossNameCompany;
use App\Models\Risk\CrossIdPerson;
use App\Models\Risk\CrossNamePerson;
use App\Models\Risk\MrRecord;
use App\Models\Risk\Process;
use App\Models\Risk\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiskController extends Controller
{
    /**
     * Agrega un proveedor a la bd para ser tomado en cuenta en los cruce
     */
    public function addCompany(Request $request)
    {
        try {
            //URLS: http://integracion.local/api/risk/save/company; http://cip.parservicios.com/api/risk/save/company
            //POST; Authorization: bearer token y en el campo token se deja el que retorna la funcion login; Body: form data y se envia informacion con la estructura: {z1};{z2};
            if (isset($request->identification) && $request->identification && isset($request->name) && $request->name && isset($request->type) && $request->type)
            {
                $identification = explode("};", $request->identification);
                $name = explode("};", $request->name);
                if (isset($request->lastname))
                    $lastname = explode("};", $request->lastname);
                if (isset($request->firstname))
                    $firstname = explode("};", $request->firstname);
                $country = explode("};", $request->country);
                $return = array();
                $return['save'] = array();
                $return['exist'] = array();
                foreach ($identification as $key => $value)
                {
                    if (isset($name[$key]) && ($name[$key])!="" && str_replace(" ", "", $value)!="{")
                    {
                        if (($request->type)=="Person" || ($request->type)=="natural")
                            $model = new Person();
                        else
                            $model = new Company();
                        $modelIdentification = substr($value, 1);
                        $modelName = substr($name[$key], 1);
                        $cant = $model->whereIdentification($modelIdentification)->whereName($modelName)->count();//Valida existencia
                        if ($cant==0)
                        {
                            $model->name = $modelName;
                            $model->identification = $modelIdentification;
                            if (isset($lastname) && isset($lastname[$key]))
                                $model->lastname = substr($lastname[$key], 1);
                            if (isset($firstname) && isset($firstname[$key]))
                                $model->firstname = substr($firstname[$key], 1);
                            $model->country = substr($country[$key], 1);
                            if ($model->save())
                                $return['save'][$modelIdentification] = $modelName.".\n";//Almacenadas
                        }
                        else if (!isset($return['exist'][$modelIdentification]))
                            $return['exist'][$modelIdentification] = $modelName.".\n";//Repetidas
                        unset($model);
                    }
                }
                if (count($return))
                {
                    $return['msg'] = "Ok";
                    return response()->json($return, 202);
                }
                else
                    return response()->json(['msg' => 'No se almacena data'], 202);
            }
            else
                return response()->json(['msg' => 'No existe data'], 202);
        } catch (\Exception $e) {
            return response()->json(['exception' => $e], 202);
        }
        return response()->json(['msg' => 'Acceso no autorizado'], 202);
    }

    /**
     * Agrega una lista de proveedores para la supervision por parte del sistema
     */
    public function addCompanies($companies)
    {

    }

    /**
     * Se añade una persona para ser supervisado por el sistema
     */
    public function addPerson($person)
    {

    }

    /**
     * Se añade una persona para ser supervisado por el sistema
     */
    public function addPeople($people)
    {

    }

    /**
     * Consulta las alertas de cada numero de identificacion en la lista
     * Si no recibe parametro este metodo retorna la coleccion de todas las personas con alertas de este cliente
     */
    public function getPeopleAlert(Request $request ): array
    {
        $query = Person::select(['id','identification','name','type_identification AS use1_acronym'])
            ->SearchByIdentification($request->identification)
            ->SearchByName($request->name)
            ->addSelect(DB::raw("'$request->cl1_id' AS cl1_id"))
            ->addSelect(DB::raw('\'Empleado\' AS clase'))
            ->distinct();

        $process_id = Process::where('file', 'like', "%sidif%")->latest()->first()->id;
        $comments = [];

        foreach ($query->cursor() as $key => $data) {
            if ($request->identification)
                $comments = CrossIdPerson::where('people_id',$data->id)->where('processes_id', $process_id)->pluck('comment')->toArray();
            elseif ($request->name)
                $comments = CrossNamePerson::where('people_id',$data->id)->where('processes_id', $process_id)->pluck('comment')->toArray();
            $data->comments = $comments;
            $result[] = $data;
        }

        return $result ?? [];

    }

    /**
     * Consulta las alertas de cada numero de identificacion en la lista
     * Si no recibe parametro este metodo retorna la coleccion de todas las personas con alertas de este cliente
     */
    public function getCompaniesAlert(Request $request): array
    {
        $query = Company::select(['id','identification','name','type_identification AS use1_acronym'])
            ->SearchByIdentification($request->identification)
            ->SearchByName($request->name)
            ->addSelect(DB::raw("'$request->cl1_id' AS cl1_id"))
            ->addSelect(DB::raw('\'Cliente\' AS clase'))
            ->distinct();

        $process_id = Process::where('file', 'like', "%bridge%")->latest()->first()->id;
        $comments = [];

        foreach ($query->cursor() as $key => $data) {
            if ($request->identification)
                $comments = CrossIdCompany::where('companies_id',$data->id)->where('processes_id', $process_id)->pluck('comment')->toArray();
            elseif ($request->name)
                $comments = CrossNameCompany::where('companies_id',$data->id)->where('processes_id', $process_id)->pluck('comment')->toArray();

            $data->comments = $comments;
            $result[] = $data;
        }

        return $result ?? [];
    }

    /**
     * Se obtine las alertas de personas y compañias
     */
    public function getAllAlerts(Request $request): array
    {
        $person = $this->getPeopleAlert($request);
        $company = $this->getCompaniesAlert($request);

        return array_merge($person,$company);

    }

    /*
     * Obtener toda la data
     * */
    public function getListCompany(Request $request)
    {
        $request = (array)(json_decode($request->getContent(), true));
        $request = array_merge($request, ['table' => "companies"]);
        $records = new MrRecord;
        $companies = new Company();
        $records = $records->getRecords($request)->get()->pluck('table_id');
        return $companies->getData($records);
    }

    /**
     * Se obtienen las diferencias existentes de una corrida
     */
    public function getDifferences()
    {
        return CrossDifference::get();
    }

    public function addCross($dataTemp, $data, $type, $fp, $topPercent = 95)
    {
        //Cruce por id type 1 y Cruce por nombre type 2
        if ($dataTemp!=null && !empty($dataTemp) && isset($dataTemp[0]) && isset($dataTemp[0]->id))
        {
            fwrite($fp, " ".$data['fila'].".".$data['model'].". ".$data['class'].".\n");
            //Recorrer todas las coincidencias aproximadas
            foreach ($dataTemp as $keyPv => $dataCross)
            {
                if ($type==2)
                {
                    //No se valida la llave del porcentaje que viene por data ya que como recorre todas las coincidencias necesita volver a hacer el cruce para asegurar la coincidencia
                    similar_text(strtoupper($dataCross->name), strtoupper($data[3]), $percent);
                }
                else
                    $percent = 100;
                if (isset($dataCross->id) && (int)($dataCross->id)>0 && $percent>=$topPercent)
                {
                    $data['name'] = $data[3];
                    $data['identification'] = $data[10];
                    $data['comment'] = $data[11];
                    $data['country'] = $data[18];
                    if (!isset($data['porcentage']))
                        $data['porcentage'] = $percent;
                    //Guarda el $class según corresponda
                    if ($data['model']==1)
                    {
                        if (isset($data[5]) && str_replace(" ", "", $data[5])!="")
                            $data['firstname'] = $data[4]." ".$data[5];
                        else
                            $data['firstname'] = $data[4];
                        if (isset($data[7]) && str_replace(" ", "", $data[7])!="")
                            $data['lastname'] = $data[6]." ".$data[7];
                        else
                            $data['lastname'] = $data[6];
                        fwrite($fp, "  * ".$this->addCrossPerson($data, (int)($dataCross->id), $type)." de persona.\n");
                    }
                    else if ($data['model']==2)
                        fwrite($fp, "  * ".$this->addCrossCompany($data, (int)($dataCross->id), $type)." de empresa.\n");
                    unset($data['porcentage']);
                }
            }
        }
        return true;
    }

    /**
     * Se añade cruce de una persona
     */
    public function addCrossPerson($data, $id, $type)
    {
        if ($type==2)
            $personCross = new CrossNamePerson();
        else
            $personCross = new CrossIdPerson();
        //Guardar el comentario
        $personCross->people_id = $id;
        $personCross->processes_id = $data['id'];
        $personCross->comment = $data['comment'];
        $personCross->row_file = $data['fila'];
        if ($type==2)
        {
            $personCross->porcentage = $data['porcentage'];
            $personCross->people_name = $data['name'];
            $personCross->people_lastname = $data['lastname'];
            $personCross->people_firstname = $data['firstname'];
        }
        if ($personCross->save())
        {
            $this->addLog($personCross);
            return "Se guarda comentario";
        }
        else
            return "Error al guardar comentario";
    }

    /**
     * Se añade cruce de una empresa
     */
    public function addCrossCompany($data, $id, $type)
    {
        if ($type==2)
            $companyCross = new CrossNameCompany();
        else
            $companyCross = new CrossIdCompany();
        //Guardar el comentario
        $companyCross->companies_id = $id;
        $companyCross->processes_id = $data['id'];
        $companyCross->comment = $data['comment'];
        $companyCross->row_file = $data['fila'];
        if ($type==2)
        {
            $companyCross->porcentage = $data['porcentage'];
            $companyCross->companies_name = $data['name'];
        }
        if ($companyCross->save())
        {
            $this->addLog($companyCross);
            return "Se guarda comentario";
        }
        else
            return "Error al guardar comentario";
    }

    public function addLog($data)
    {
        //Guardar data en tabla logs
        $className = 'App\\Models\\Risk\\'.\Str::studly(\Str::singular($data->getTable()));
        if (class_exists($className))
        {
            $model = new $className;
            $log = $model::$logAttributes;
            if (is_array($log) && !empty($log) && count($log)>0)
            {
                $json = "{";
                foreach ($log as $column)
                {
                    if (isset($data->$column))
                        $json .= "\"".$column."\":".$data->$column.",";
                }
                if ($json!="{")
                {
                    if (!in_array("id", $log))
                        $json .= "\"id\":".$data->id.",";
                    $log = new Log;
                    $log->user_id = 1;
                    if (isset($data->created_at))
                        $log->log_date = $data->created_at;
                    else
                        $log->log_date = date("Y-m-d H:i:s");
                    $log->table_name = $data->getTable();
                    $log->log_type = "create";
                    $log->data = str_replace(",}", "}", $json."}");
                    return $log->save();
                }
            }
        }
        return false;
    }

    /**
     * @param null $type = sidif | bridge
     *
     */
    public function compareDifferences($type = null)
    {
        if ($type) {
            $processes = Process::latest()->where('file', 'like', "%" . $type . "%")->limit(2)->pluck('id')->toArray();

            if (count($processes) == 2) { // Se verifica si hay 2 ultimos registros para comparacion
                $lastIdPerson = CrossIdPerson::where('processes_id', $processes[0])->pluck('people_id', 'people_id')->toArray();//Consultamos el ultimo registro
                $previousIdPerson = CrossIdPerson::where('processes_id', $processes[1])->pluck('people_id', 'people_id')->toArray();//Consultamos el anterior registro
                $result['id_people'] = array_diff($lastIdPerson, $previousIdPerson);// diferencia de registros
                $lastNamePerson = CrossNamePerson::where('processes_id', $processes[0])->pluck('people_id', 'people_id')->toArray();
                $previousNamePerson = CrossNamePerson::where('processes_id', $processes[1])->pluck('people_id', 'people_id')->toArray();
                $result['name_people'] = array_diff($lastNamePerson, $previousNamePerson);// diferencia de registros
                $lastIdCompany = CrossIdCompany::where('processes_id', $processes[0])->pluck('companies_id', 'companies_id')->toArray();
                $previousIdCompany = CrossIdCompany::where('processes_id', $processes[1])->pluck('companies_id', 'companies_id')->toArray();
                $result['id_companies'] = array_diff($lastIdCompany, $previousIdCompany);// diferencia de registros
                $lastNameCompany = CrossNameCompany::where('processes_id', $processes[0])->pluck('companies_id', 'companies_id')->toArray();
                $previousNameCompany = CrossNameCompany::where('processes_id', $processes[1])->pluck('companies_id', 'companies_id')->toArray();
                $result['name_companies'] = array_diff($lastNameCompany, $previousNameCompany);// diferencia de registros

                foreach ($result as $nameType => $values) {
                    foreach ($values as $value) {
                        if ($nameType == 'id_people' || $nameType == 'name_people')
                            $data = Person::find($value);
                        elseif ($nameType == 'id_companies' || $nameType == 'name_companies')
                            $data = Company::find($value);
                        if (isset($data) && $data != null) {
                            $deleteDiff = CrossDifference::where([['key_model', (int)$value], ['type', $nameType]])->delete();
                            $crossDifference = new CrossDifference();
                            $crossDifference->key_model = (int)$value;
                            $crossDifference->type = $nameType;
                            $crossDifference->data = json_encode($data);
                            $crossDifference->save();
                        }
                    }
                }
            }
        }
    }
}
