<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alter2PeopleTable extends Migration
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
            if (Schema::hasColumn('people', 'name'))
            {
                Schema::table('people', function (Blueprint $table) {
                    \DB::statement("ALTER TABLE people ADD FULLTEXT(name)");
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
    }
}
