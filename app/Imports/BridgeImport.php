<?php namespace App\Imports;

use App\Http\Controllers\Api\RiskController;
use App\Models\Risk\Company;
use App\Models\Risk\Person;
use App\Models\Risk\Process;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BridgeImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $this->rows = $collection;
    }

    public function saveFile($file)
    {
        //Guardar data archivo
        $process = new Process();
        $process->file = $file;
        $process->rows = count($this->rows);
        if ($process->save())
        {
            $risk = new RiskController();
            $risk->addLog($process);
            return $process;
        }
        else
            return false;
    }

    public function saveData($id, $valueFile, $model, $fp)
    {
        if (!empty($this->rows) && count($this->rows)>1)
        {
            echo " ";
            //Valida existencia con función getCoincidence dentro de los modelos de persona y compañia
            $person = new Person();
            $company = new Company();
            $risk = new RiskController();
            $models = array('natural' => "Person", 'juridica' => "Company");
            $avanceTemp = 0;
            //Recorre filas
            foreach ($this->rows as $row => $dataRow)
            {
                $avance = round(($row*100)/count($this->rows), 0);
                if (is_object($dataRow))
                {
                    if ($row==0)
                    {
                        $data = $dataRow->toArray();
                        if (isset($data[0]))
                        {
                            $string = "Match_MatchDetails_Entity_Descriptions_Description_";
                            $columns = explode(";", $data[0]);//Obtiene cada dato por separado
                            $columnsNotes = array();
                            $columnsValue = array();
                            //Obtener el indice de cada dato necesario
                            foreach ($columns as $keyC => $valueC)
                            {
                                if ($valueC=="Match_EntityScore")
                                    $columnScore = $keyC;
                                else if ($valueC=="Match_MatchDetails_Entity_Name_Full")
                                    $columnName = $keyC;
                                else if ($valueC=="Match_MatchDetails_Entity_Name_First")
                                    $columnName1 = $keyC;
                                else if ($valueC=="Match_MatchDetails_Entity_Name_Last")
                                    $columnName2 = $keyC;
                                else if ($valueC=="GeneralInfo_IDNumber")
                                    $columnId = $keyC;
                                else if ($valueC=="Match_MatchDetails_Entity_Addresses_Address_Country")
                                    $columnCountry = $keyC;
                                else if ($valueC=="Match_MatchDetails_Entity_Reason" || $valueC=="Match_MatchDetails_Entity_Notes")
                                {
                                    array_push($columnsNotes, $keyC);
                                    /*$pos = strpos($valueC, $string);
                                    if ($pos===false)
                                    {}
                                    else
                                    {
                                        $pos = strpos($valueC, "Value");
                                        if ($pos===false)
                                        {
                                            $pos = strpos($valueC, "Notes");
                                            if ($pos===false)
                                            {}
                                            else
                                                array_push($columnsNotes, $keyC);
                                        }
                                        else
                                            array_push($columnsValue, $keyC);
                                    }*/
                                }
                            }
                        }
                    }
                    else if (isset($columns))
                    {
                        $data = $dataRow->toArray();
                        if (isset($data[0]))
                        {
                            if (count($data)>1)
                            {
                                //Une todos los registros de la fila en 1 solo
                                foreach ($data as $rowData => $detail)
                                {
                                    if ($rowData>0)
                                        $data[0] .= $detail;
                                }
                            }
                            $dataTempData = explode(";", $data[0]);//Obtiene cada dato por separado
                            unset($data);
                            $data = array();
                            $data['id'] = $id;
                            $data['fila'] = ($row+1);
                            $data['model'] = $model;
                            $data['class'] = $models[$valueFile];
                            $data['porcentage'] = $dataTempData[$columnScore];
                            $data[3] = $dataTempData[$columnName];
                            $data[4] = $dataTempData[$columnName1];
                            $data[6] = $dataTempData[$columnName2];
                            $data[10] = $dataTempData[$columnId];
                            $data[18] = $dataTempData[$columnCountry];
                            //Quitar caracteres
                            foreach ($data as $key => $value)
                            {
                                $data[$key] = replaceSymbols($value);
                            }
                            foreach ($columnsNotes as $notes)
                            {
                                if (isset($dataTempData[$notes]) && str_replace(" ", "", $dataTempData[$notes])!="")
                                {
                                    $data[11] = replaceSymbols($dataTempData[$notes]);
                                    //Cruce por nombre
                                    if (str_replace(" ", "", $data[3])!="")
                                    {
                                        fwrite($fp, $data['fila'].". Name: ".$data[3].".\n");
                                        $dataTemp = ${strtolower($models[$valueFile])}->getCoincidence("", $data[3]);
                                        $risk->addCross($dataTemp, $data, 2, $fp);
                                        unset($dataTemp);
                                    }
                                }
                            }
                            unset($data);
                        }
                    }
                }
                if (($avance%4)==0 && $avance!=$avanceTemp)
                {
                    $avanceTemp = $avance;
                    echo " ".$avance."% ...";
                }
            }
            if ($avanceTemp>0)
                echo " \n";
        }
        return true;
    }
}
