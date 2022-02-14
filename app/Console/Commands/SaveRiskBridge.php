<?php namespace App\Console\Commands;

use App\Http\Controllers\Api\RiskController;
use App\Imports\BridgeImport;
use App\Models\Risk\Process;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SaveRiskBridge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Risk:saveBridge';//Declarar en app\Console\Kernel.php

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guardar data bridge lexis nexis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //php artisan Risk:saveBridge
        //Para la construcción del archivo log solo funciona desde la consola
        echo "Inicio archivo log Bridge\n";
        $pathFileLog = "integracion/risk/bridge/log_excel_".date("Y_m_d").".csv";
        if (!Storage::disk('local')->exists($pathFileLog))
        {
            $file = 1;
            Storage::disk('local')->put($pathFileLog, "");//Crear Archivo
        }
        $pathFileLog = "storage/app/".$pathFileLog;
        if (isset($file))
        {
            $fp = fopen($pathFileLog, 'r+');//Abrir memoria de archivo
            fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));//UTF-8 - Necesario
        }
        else
            $fp = fopen($pathFileLog, 'a');//Abrir memoria de archivo
        fwrite($fp, "Hora: ".date("H:i:s")."\n");
        fwrite($fp, "Inicio recorrido archivo listas Bridge\n");
        echo "Inicio recorrido archivo listas Bridge\n";
        //home es home/usu_riesgos en disco general
        //local es integracion/storage/app dentro de proyecto
        $arrayFiles = array(1 => "natural", 2 => "juridica");
        $pathFileOptAdd = "integracion/risk/";
        $riskController = new RiskController();
        foreach ($arrayFiles as $model => $valueFile)
        {
            fwrite($fp, " Inicio ".$valueFile.".\n");
            echo " Inicio ".$valueFile.".\n";
            $pathFile = "bridge/in/".$valueFile.".xml";
            $import = new BridgeImport;
            //Valida si existe el archivo
            if (Storage::disk('home')->exists($pathFile))
            {
                $pathFileOpt = str_replace("/in", "", str_replace(".xml", "_".date("Y_m_d").".xml", $pathFile));
                $stream = Storage::disk('home')->getDriver()->readStream($pathFile);
                Storage::disk('local')->put($pathFileOptAdd.$pathFileOpt, $stream);
                Storage::disk('home')->delete($pathFile);
                $pathFileTemp = config('filesystems.disks.local.root')."/".$pathFileOptAdd.$pathFileOpt;
                $xmlObject = simplexml_load_file($pathFileTemp);
                $pathFileTemp = str_replace(".xml", ".csv", $pathFileTemp);
                $f = fopen($pathFileTemp, 'w');
                fputs($f, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));//utf-8
                $this->createCsv($xmlObject, $f);//Creacion de csv con data unica
                Excel::import($import, $pathFileTemp);
                $data = $import->saveFile($pathFileOpt);//Guardar data archivo
                if ($data!=false && $data!=null && !empty($data) && isset($data->file))
                    $import->saveData($data->id, $valueFile, $model, $fp);
            }
            else
            {
                //Obtiene el ultimo registro cargado
                $pathFile = str_replace("/in", "", str_replace(".xml", "", $pathFile));
                $data = (new Process())->where('file', 'like', "%".$pathFile."%")->orderBy('id', 'DESC')->first();
                if ($data!=null && !empty($data) && isset($data->file))
                {
                    $file = $pathFileOptAdd.str_replace(".xml", ".csv", $data->file);
                    if (Storage::disk('local')->exists($file))
                    {
                        Excel::import($import, storage_path('app')."/".$file);
                        $import->saveData($data->id, $valueFile, $model, $fp);
                    }
                }
            }
            unset($import);
        }
        fwrite($fp, "Fin recorrido archivo listas Bridge\n");
        fclose($fp);
        echo "Fin recorrido archivo listas Bridge\n";
        echo "Inicio de comparacion de registros\n";
        $riskController->compareDifferences('bridge');
        echo "FIN de comparacion de registros\n";
        return 0;
    }

    public function createCsv($xml, $f)
    {
        $columns = array();
        $dataGral = array();
        $contGral = 0;
        foreach ($xml->children() as $item)
        {
            $lastData = array();
            $dataGralInfo = array();
            $dataGral[$contGral] = array();
            $item = get_object_vars($item);
            //Data general de coincidencia
            foreach ($item as $name => $coincidence)
            {
                if ($name!="WatchList")
                {
                    $coincidenceTemp = $this->convertToArray($lastData, $coincidence, $name);
                    if (is_array($coincidenceTemp) && !empty($coincidenceTemp) && count($coincidenceTemp))
                    {
                        foreach ($coincidenceTemp as $keyTemp => $valueTemp)
                        {
                            if (!in_array($keyTemp, $columns))
                                array_push($columns, $keyTemp);
                            $dataGralInfo[array_search($keyTemp, $columns)] = replaceEnter($valueTemp);
                        }
                    }
                }
            }
            $cont = 0;
            //Obtener items de coincidencia
            if (isset($item['WatchList']) && !empty($item['WatchList']))
            {
                $coincidences = $item['WatchList'];
                if (isset($coincidences->Match) && !empty($coincidences->Match))
                {
                    $coincidences = $coincidences->Match;
                    foreach ($coincidences as $name => $coincidence)
                    {
                        $coincidenceTemp = $this->convertToArray($lastData, $coincidence, $name);
                        if (is_array($coincidenceTemp) && !empty($coincidenceTemp) && count($coincidenceTemp))
                        {
                            $dataGral[$contGral][$cont] = array();
                            $dataGral[$contGral][$cont] = array_merge($dataGral[$contGral][$cont], $dataGralInfo);
                            foreach ($coincidenceTemp as $keyTemp => $valueTemp)
                            {
                                if (!in_array($keyTemp, $columns))
                                    array_push($columns, $keyTemp);
                                $dataGral[$contGral][$cont][array_search($keyTemp, $columns)] = replaceEnter($valueTemp);
                            }
                            $cont++;
                        }
                    }
                }
            }
            unset($dataGralInfo);
            $contGral++;
        }
        //Registrar data en el csv
        if (!empty($dataGral) && count($dataGral))
        {
            fputcsv($f, $columns ,';','"');
            foreach ($dataGral as $data)
            {
                foreach ($data as $cont => $info)
                {
                    for ($i=0;$i<count($columns);$i++)
                    {
                        if (!isset($info[$i]))
                            $info[$i] = "";
                    }
                    ksort($info);
                    fputcsv($f, $info ,';','"');
                }
            }
        }
        return true;
    }

    public function convertToArray($lastData, $coincidence, $name, $lastName = "", $lastName2 = "", $lastName3 = "")
    {
        if ($lastName2!="" && $lastName3!="" && (is_array($coincidence) || is_object($coincidence)))
        {
            $lastName2 = $lastName2."_".$lastName3;
            $lastName3 = "";
        }
        if (is_array($coincidence))
        {
            //Recorrer data para sacar valores
            foreach ($coincidence as $key => $value)
            {
                if ($lastName=="")
                {
                    $lastName = $key;
                    $dltLastName = 1;
                }
                else if ($lastName2=="")
                {
                    $lastName2 = $key;
                    $dltLastName2 = 1;
                }
                else if ($lastName3=="")
                {
                    $lastName3 = $key;
                    $dltLastName3 = 1;
                }
                $returnTemp = $this->convertToArray($lastData, $value, $name, $lastName, $lastName2, $lastName3);
                if (isset($dltLastName))
                {
                    $lastName = "";
                    unset($dltLastName);
                }
                else if (isset($dltLastName2))
                {
                    $lastName2 = "";
                    unset($dltLastName2);
                }
                else if (isset($dltLastName3))
                {
                    $lastName3 = "";
                    unset($dltLastName3);
                }
                //Recorrer data que se guarda en el array final
                foreach ($returnTemp as $keyTemp => $valueTemp)
                {
                    if (!isset($lastData[$keyTemp]))
                        $lastData[$keyTemp] = $valueTemp;
                }
            }
            return $lastData;
        }
        else if (is_string($coincidence) || is_int($coincidence))
        {
            //Construcción de dato que se guarda en el array final
            $title = "";
            if ($name!="")
                $title .= $name;
            if ($lastName!="")
            {
                if ($title!="")
                    $title .= "_";
                $title .= $lastName;
            }
            if ($lastName2!="")
            {
                if ($title!="")
                    $title .= "_";
                $title .= $lastName2;
            }
            if ($lastName3!="")
            {
                if ($title!="")
                    $title .= "_";
                $title .= $lastName3;
            }
            if ($title!="")
            {
                $title = str_replace("@", "", $title);
                if (!isset($lastData[$title]))
                    $lastData[$title] = $coincidence;
                return $lastData;
            }
        }
        else
        {
            if (is_object($coincidence))
                $coincidence = get_object_vars($coincidence);
            return $this->convertToArray($lastData, $coincidence, $name, $lastName, $lastName2, $lastName3);
        }
    }

}
