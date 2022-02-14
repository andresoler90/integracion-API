<?php namespace App\Imports;

use App\Http\Controllers\Api\RiskController;
use App\Models\Risk\Company;
use App\Models\Risk\Person;
use App\Models\Risk\Process;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SidifImport implements ToCollection
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

    public function saveData($id, $fp)
    {
        if (!empty($this->rows) && count($this->rows)>1)
        {
            //Valida existencia con función getCoincidence dentro de los modelos de persona y compañia
            $person = new Person();
            $company = new Company();
            $risk = new RiskController();
            $models = array(1 => "Person", 2 => "Company");
            $avanceTemp = 0;
            //Recorre filas
            foreach ($this->rows as $row => $dataRow)
            {
                $avance = round(($row*100)/count($this->rows), 0);
                if (is_object($dataRow) && $row>0)
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
                        $data = explode(";", $data[0]);//Obtiene cada dato por separado
                        $data['id'] = $id;
                        $data['fila'] = ($row+1);
                        //Recorrer los tipos de almacenamiento
                        foreach ($models as $model => $class)
                        {
                            //Quitar caracteres
                            foreach ($data as $key => $value)
                            {
                                $data[$key] = replaceSymbols($value);
                            }
                            $data['model'] = $model;
                            $data['class'] = $class;
                            //Cruce por id
                            if (isset($data[10]) && str_replace(" ", "", $data[10])!="")
                            {
                                $data[10] = str_replace(" ", "", $data[10]);
                                fwrite($fp, $data['fila'].". Identification: ".$data[10].".\n");
                                $dataTemp = ${strtolower($class)}->getCoincidence($data[10]);
                                $risk->addCross($dataTemp, $data, 1, $fp);
                                unset($dataTemp);
                            }
                            //Cruce por nombre
                            if (isset($data[3]) && str_replace(" ", "", $data[3])!="")
                            {
                                fwrite($fp, $data['fila'].". Name: ".$data[3].".\n");
                                $dataTemp = ${strtolower($class)}->getCoincidence("", $data[3]);
                                $risk->addCross($dataTemp, $data, 2, $fp);
                                unset($dataTemp);
                            }
                        }
                    }
                    unset($data);
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
