<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrossIdPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cross_id_people'))
        {
            Schema::create('cross_id_people', function (Blueprint $table) {
                $table->id();
                $table->bigInteger("people_id")->comment("Id de la tabla people")->unsigned();
                $table->bigInteger("processes_id")->comment("Id de la tabla processes")->unsigned();
                $table->longText('comment')->comment("Observación del registro");
                $table->bigInteger('row_file')->comment("Número de fila del archivo del registro");
                $table->foreign('people_id')->references('id')->on('people');
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
        if (Schema::hasTable('cross_id_people'))
        {
            Schema::table('cross_id_people', function (Blueprint $table) {
                $table->dropForeign('cross_id_people_people_id_foreign');//tabla_campo_foreign
                $table->dropForeign('cross_id_people_processes_id_foreign');//tabla_campo_foreign
            });
            Schema::dropIfExists('cross_id_people');
        }
    }
}
