<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paym6Paymentregisters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('paym6_paymentregisters'))
        {
            Schema::create('paym6_paymentregisters', function (Blueprint $table)
            {
                $table->increments('paym6_id');
                $table->string('paym6_providerName',200)->comment('Razon social');
                $table->string('paym6_identification',200)->comment('Identificación');
                $table->string('paym6_fullName',200)->comment('Nombre completo');
                $table->string('paym6_email',200)->comment('Correo electronico');
                $table->string('paym6_phone',200)->comment('Telefono');
                $table->string('paym6_address',200)->comment('Dirección');
                $table->tinyInteger('paym6_state')->default(1)->comment('Estado del registro');
                $table->integer('loc3_id')->unsigned()->comment('País')->nullable();
                $table->foreign('loc3_id','paym6_fk_loc3')->references('loc3_id')->on('loc3_countries');
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
        if (Schema::hasTable('paym6_paymentregisters'))
        {
            Schema::table('paym6_paymentregisters', function (Blueprint $table)
            {
                $table->dropForeign('paym6_fk_loc3');
            });
            Schema::dropIfExists('paym6_paymentregisters');
        }
    }
}
