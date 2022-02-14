<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('companies'))
        {
            if (Schema::hasColumn('companies', 'name'))
            {
                Schema::table('companies', function (Blueprint $table) {
                    \DB::statement("ALTER TABLE companies ADD FULLTEXT(name)");
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
