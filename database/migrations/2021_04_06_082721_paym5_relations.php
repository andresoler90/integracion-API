<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paym5Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('paym5_relations'))
        {
            Schema::create('paym5_relations', function (Blueprint $table)
            {
                $table->increments('paym5_id');
                $table->integer('paym5_value')->comment('Valor asociado al registro');
                $table->tinyInteger('paym5_state')->default(1)->comment('Estado del registro');
                $table->integer('paym1_id')->unsigned()->comment('Id del producto');
                $table->foreign('paym1_id','paym5_fk_paym1')->references('paym1_id')->on('paym1_products');
                $table->integer('paym2_id')->unsigned()->comment('Id del sub producto');
                $table->foreign('paym2_id','paym5_fk_paym2')->references('paym2_id')->on('paym2_subproducts');
                $table->integer('paym3_id')->unsigned()->comment('Id de la base');
                $table->foreign('paym3_id','paym5_fk_paym3')->references('paym3_id')->on('paym3_typebases');
                $table->integer('paym7_id')->unsigned()->comment('Id del cliente-país');
                $table->foreign('paym7_id','paym5_fk_paym7')->references('paym7_id')->on('paym7_clientcountries');
                $table->integer('use6_id')->unsigned()->comment('Id currencia')->nullable();
                $table->foreign('use6_id','paym5_fk_use6')->references('use6_id')->on('use6_currencies');
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
        if (Schema::hasTable('paym5_relations'))
        {
            Schema::table('paym5_relations', function (Blueprint $table)
            {
                $table->dropForeign('paym5_fk_paym1');
                $table->dropForeign('paym5_fk_paym2');
                $table->dropForeign('paym5_fk_paym3');
                $table->dropForeign('paym5_fk_paym7');
                $table->dropForeign('paym5_fk_use6');
            });

            Schema::dropIfExists('paym5_relations');
        }
    }
}
