<?php namespace App\Console\Commands;

use App\Http\Controllers\Api\RiskController;
use App\Imports\SidifImport;
use App\Models\Risk\Process;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SaveRiskSidif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Risk:saveSidif';//Declarar en app\Console\Kernel.php

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guardar data sidif';

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
        //php artisan Risk:saveSidif
        //Para la construcción del archivo log solo funciona desde la consola
        echo "Inicio archivo log Sidif\n";
        $pathFileLog = "integracion/risk/sidif/log_excel_".date("Y_m_d").".csv";
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
        fwrite($fp, "Inicio recorrido archivo listas Sidif\n");
        echo "Inicio recorrido archivo listas Sidif\n";
        //home es home/usu_riesgos en disco general
        //local es integracion/storage/app dentro de proyecto
        $pathFile = "sidif/load_excel.csv";
        $import = new SidifImport;
        //Valida si existe el archivo
        $pathFileOptAdd = "integracion/risk/";
        $riskController = new RiskController();
        if (Storage::disk('home')->exists($pathFile))
        {
            $pathFileOpt = str_replace(".csv", "_".date("Y_m_d").".csv", $pathFile);
            $stream = Storage::disk('home')->getDriver()->readStream($pathFile);
            Storage::disk('local')->put($pathFileOptAdd.$pathFileOpt, $stream);
            Storage::disk('home')->delete($pathFile);
            Excel::import($import, storage_path('app')."/".$pathFileOptAdd.$pathFileOpt);
            //Excel::import($import, "/home/usu_riesgos/".$pathFile);
            $data = $import->saveFile($pathFileOpt);//Guardar data archivo
            if ($data!=false && $data!=null && !empty($data) && isset($data->file))
                $import->saveData($data->id, $fp);
        }
        else
        {
            //Obtiene el ultimo registro cargado
            $pathFile = str_replace(".csv", "", $pathFile);
            $data = (new Process())->where('file', 'like', "%".$pathFile."%")->orderBy('id', 'DESC')->first();
            if ($data!=null && !empty($data) && isset($data->file))
            {
                $file = $pathFileOptAdd.$data->file;
                if (Storage::disk('local')->exists($file))
                {
                    Excel::import($import, storage_path('app')."/".$file);
                    $import->saveData($data->id, $fp);
                }
            }
        }
        unset($import);
        fwrite($fp, "Fin recorrido archivo listas Sidif\n");
        fclose($fp);
        echo "Fin recorrido archivo listas Sidif\n";
        echo "Inicio de comparacion de registros\n";
        $riskController->compareDifferences('sidif');
        echo "FIN de comparacion de registros\n";
        return 0;
    }
}
