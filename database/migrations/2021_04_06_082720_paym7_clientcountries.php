<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paym7Clientcountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('paym7_clientcountries'))
        {
            Schema::create('paym7_clientcountries', function (Blueprint $table)
            {
                $table->increments('paym7_id');
                $table->tinyInteger('paym7_state')->default(1)->comment('Estado del registro');
                $table->integer('paym4_id')->unsigned()->comment('Id del cliente')->nullable();
                $table->foreign('paym4_id','paym7_fk_paym4')->references('paym4_id')->on('paym4_clients');
                $table->integer('loc3_id')->unsigned()->comment('Id del pais');
                $table->foreign('loc3_id','paym7_fk_loc3')->references('loc3_id')->on('loc3_countries');
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
        if (Schema::hasTable('paym7_clientcountries'))
        {
            Schema::table('paym7_clientcountries', function (Blueprint $table)
            {
                $table->dropForeign('paym7_fk_paym4');
                $table->dropForeign('paym7_fk_loc3');
            });

            Schema::dropIfExists('paym7_clientcountries');
        }
    }
}
