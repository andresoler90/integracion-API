<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('companies'))
        {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->longText('name')->nullable()->comment("Nombre de la empresa del registro");
                $table->string('identification', 45)->comment("Identificación de la empresa del registro");
                $table->string('country', 45)->nullable()->comment("Pais de la empresa del registro");
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
        if (Schema::hasTable('companies'))
            Schema::dropIfExists('companies');
    }
}
