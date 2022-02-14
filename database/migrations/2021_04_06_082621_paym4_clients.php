<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paym4Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('paym4_clients'))
        {
            Schema::create('paym4_clients', function (Blueprint $table)
            {
                $table->increments('paym4_id');
                $table->string('paym4_name',200)->comment('Nombre del cliente');
                $table->string('paym4_identification',200)->default(null)->comment('Identificacion del cliente');
                $table->tinyInteger('paym4_state')->default(1)->comment('Estado del cliente');
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
        if (Schema::hasTable('paym4_clients'))
        {
            Schema::dropIfExists('paym4_clients');
        }
    }
}
