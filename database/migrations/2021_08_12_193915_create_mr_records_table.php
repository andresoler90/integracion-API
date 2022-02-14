<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMrRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mr_records'))
        {
            Schema::create('mr_records', function (Blueprint $table) {
                $table->id();
                $table->bigInteger("user_id")->comment("Id del usuario del permiso de visualización")->unsigned();
                $table->bigInteger("table_id")->comment("Id de la tabla del registro");
                $table->enum("table", ['people', 'companies'])->comment("Nombre de la tabla");
                $table->enum("data_base", ['mi proveedor', 'mi evaluacion'])->comment("Nombre de la base de datos");
                $table->timestamps();
                $table->softDeletes();
                //$table->foreign('user_id')->references('id')->on('users');
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
        if (Schema::hasTable('mr_records'))
        {
            Schema::table('mr_records', function (Blueprint $table) {
                $table->dropSoftDeletes();
                //$table->dropForeign('mr_records_user_id_foreign');//tabla_campo_foreign
            });
            Schema::dropIfExists('mr_records');
        }
    }
}
