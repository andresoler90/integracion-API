<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeDocumentToPeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('people')) {
            Schema::table('people', function (Blueprint $table) {
                $table->char('type_identification', 10)->after('firstname')->nullable()->comment('Tipo de identificacion');
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

        if (Schema::hasColumn('people', 'type_identification'))
            Schema::table('people', function (Blueprint $table) {
                $table->dropColumn('type_identification');
            });
    }
}
