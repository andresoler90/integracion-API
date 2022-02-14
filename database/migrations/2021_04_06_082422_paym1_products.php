<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paym1Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('paym1_products'))
        {
            Schema::create('paym1_products', function (Blueprint $table)
            {
                $table->increments('paym1_id');
                $table->string('paym1_product',200)->comment('Nombre del producto');
                $table->tinyInteger('paym1_state')->default(1)->comment('Estado del producto');
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
        if (Schema::hasTable('paym1_products'))
        {
            Schema::dropIfExists('paym1_products');
        }
    }
}
