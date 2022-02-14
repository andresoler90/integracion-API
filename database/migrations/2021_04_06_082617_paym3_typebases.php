<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paym3Typebases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('paym3_typebases'))
        {
            Schema::create('paym3_typebases', function (Blueprint $table)
            {
                $table->increments('paym3_id');
                $table->string('paym3_typeBase',200)->comment('Nombre de la base');
                $table->tinyInteger('paym3_state')->default(1)->comment('Estado de la base');
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
        if (Schema::hasTable('paym3_typebases'))
        {
            Schema::dropIfExists('paym3_typebases');
        }
    }
}
