<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrossDifferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cross_differences')){
            Schema::create('cross_differences', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('key_model')->comment('id del modelo dependiendo de la columna [type]');
                $table->enum('type',['id_people','name_people','id_companies','name_companies'])->comment('tipo de modelo people o companies');
                $table->json('data')->comment('Data de diferencia, comparasion de las 2 ultimas corridas');
                $table->timestamps();
                $table->softDeletes();
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
        if (Schema::hasTable('cross_differences')){
            Schema::dropIfExists('cross_differences');
        }

    }
}
