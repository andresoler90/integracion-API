<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('people'))
        {
            if (!Schema::hasColumn('people', 'firstname'))
            {
                Schema::table('people', function (Blueprint $table) {
                    $table->longText('firstname')->after('lastname')->nullable()->comment("Nombres de la persona del registro");
                });
            }
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
        {
            if (Schema::hasColumn('people', 'firstname'))
            {
                Schema::table('people', function (Blueprint $table) {
                    $table->dropColumn('firstname');
                });
            }
        }
    }
}
