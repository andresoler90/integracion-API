<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrossIdCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cross_id_companies'))
        {
            Schema::create('cross_id_companies', function (Blueprint $table) {
                $table->id();
                $table->bigInteger("companies_id")->comment("Id de la tabla companies")->unsigned();
                $table->bigInteger("processes_id")->comment("Id de la tabla processes")->unsigned();
                $table->longText('comment')->comment("Observación del registro");
                $table->bigInteger('row_file')->comment("Número de fila del archivo del registro");
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
        if (Schema::hasTable('cross_id_companies'))
        {
            Schema::table('cross_id_companies', function (Blueprint $table) {
                $table->dropForeign('cross_id_companies_companies_id_foreign');//tabla_campo_foreign
                $table->dropForeign('cross_id_companies_processes_id_foreign');//tabla_campo_foreign
            });
            Schema::dropIfExists('cross_id_companies');
        }
    }
}
