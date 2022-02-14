<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrossNameCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cross_name_companies'))
        {
            Schema::create('cross_name_companies', function (Blueprint $table) {
                $table->id();
                $table->bigInteger("companies_id")->comment("Id de la tabla companies")->unsigned();
                $table->bigInteger("processes_id")->comment("Id de la tabla processes")->unsigned();
                $table->longText('comment')->comment("Observación del registro");
                $table->bigInteger('row_file')->comment("Número de fila del archivo del registro");
                $table->integer('porcentage')->nullable()->comment("Porcentaje de coindicencia del registro");
                $table->longText('companies_name')->nullable()->comment("Nombres de coindicencia de la compañia del registro");
                $table->foreign('companies_id')->references('id')->on('companies');
                $table->foreign('processes_id')->references('id')->on('processes');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('cross_name_companies'))
        {
            Schema::table('cross_name_companies', function (Blueprint $table) {
                $table->dropForeign('cross_name_companies_companies_id_foreign');//tabla_campo_foreign
                $table->dropForeign('cross_name_companies_processes_id_foreign');//tabla_campo_foreign
            });
            Schema::dropIfExists('cross_name_companies');
        }
    }
}
