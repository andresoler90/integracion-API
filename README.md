

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 15/09/2020
Para el cargue inicial se agrego la autenticacion en el api

## Vendors

*Traducciones:* https://github.com/joedixon/laravel-translation

*Debug bar :* https://github.com/barryvdh/laravel-debugbar

*Ide helper :* https://github.com/barryvdh/laravel-ide-helper

    //Actualiza la documentacion en general
    php artisan ide-helper:generate

    //Actualiza la documentacion de los modelos
    php artisan ide-helper:models 

*Laravel Collective :* https://github.com/LaravelCollective/html

*Model log:* https://github.com/spatie/laravel-activitylog

*Excel:* https://docs.laravel-excel.com/3.1/getting-started/installation.html

*Log detail:* https://laravelarticle.com/laravel-user-activity

*Menu:* https://github.com/lavary/laravel-menu

*Impersonar:* https://github.com/404labfr/laravel-impersonate

*Importar o exportar excel:* https://www.studentstutorial.com/laravel/import

    //1. Download the dependecy using composer for Import and export excel file.
    composer require maatwebsite/excel
    You may visit https://packagist.org/packages/maatwebsite/excel for more details.
    //2. Add providers and aliases in config/app.php
    'providers' => [
    		/*
             * Laravel Framework Service Providers...
             */
            ......,
            ......,
            Maatwebsite\Excel\ExcelServiceProvider::class,
    ]
    'aliases' => [
        .......,
        -------,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
    ]
    //3. Now publish the changes using vendor:publish.
    php artisan vendor:publish
    //4. Create Import and Export class using import/export command.
    php artisan make:import BulkImport --model=Bulk(Opcional)
    Note: This command avaialble only if you download dependecy successfully using composer(step 1)
    //5. In app/Imports/BulkImport.php file.
    namespace App\Imports;
    use App\Bulk;
    use Maatwebsite\Excel\Concerns\ToModel;
    use Maatwebsite\Excel\Concerns\WithHeadingRow;
    class BulkImport implements ToModel,WithHeadingRow
    {
    	/**
        * @param array $row
        *
        * @return \Illuminate\Database\Eloquent\Model|null
        */
        public function model(array $row)
        {
            return new Bulk([
                'name'     => $row['name'],
                'email'    => $row['email'],
            ]);
        }
    }
    //6. In Bulk.php Model.(Opcional)
    namespace App;
    use Illuminate\Database\Eloquent\Model;
    class Bulk extends Model
    {
        protected $table = 'bulk';
        protected $fillable = [
            'name', 'email',
        ];
    }
    //7. create ImportExportController(Opcional)
    php artisan make:controller ImportExportController
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Exports\BulkExport;
    use App\Imports\BulkImport;
    use Maatwebsite\Excel\Facades\Excel;
    class ImportExportController extends Controller
    {
        /**
        * 
        */
        public function importExportView()
        {
           return view('importexport');
        }
        public function import() 
        {
            Excel::import(new BulkImport,request()->file('file'));
               
            return back();
        }
    }
