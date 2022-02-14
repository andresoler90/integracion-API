<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('processes'))
        {
            Schema::create('processes', function (Blueprint $table) {
                $table->id();
                $table->longText('file')->comment("Nombre del archivo que se carga");
                $table->bigInteger('rows')->comment("Cantidad de filas archivo");
                $table->timestamps();
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
        if (Schema::hasTable('processes'))
            Schema::dropIfExists('processes');
    }
}
