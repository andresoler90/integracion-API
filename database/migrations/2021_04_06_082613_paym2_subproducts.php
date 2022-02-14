<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paym2Subproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('paym2_subproducts'))
        {
            Schema::create('paym2_subproducts', function (Blueprint $table)
            {
                $table->increments('paym2_id');
                $table->string('paym2_subProduct',200)->comment('Nombre del sub producto');
                $table->tinyInteger('paym2_state')->default(1)->comment('Estado del sub producto');
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
        if (Schema::hasTable('paym2_subproducts'))
        {
            Schema::dropIfExists('paym2_subproducts');
        }
    }
}
