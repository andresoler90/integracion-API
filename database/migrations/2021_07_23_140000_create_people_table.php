<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('people'))
        {
            Schema::create('people', function (Blueprint $table) {
                $table->id();
                $table->longText('name')->nullable()->comment("Nombre completo de la persona del registro");
                $table->longText('lastname')->nullable()->comment("Apellidos de la persona del registro");
                $table->string('identification', 45)->nullable()->comment("Identificación de la persona del registro");
                $table->string('country', 45)->nullable()->comment("Pais de la persona del registro");
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
        if (Schema::hasTable('people'))
            Schema::dropIfExists('people');
    }
}
