<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeDocumentToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('companies')){
            Schema::table('companies', function (Blueprint $table) {
                $table->char('type_identification',10)->after('name')->nullable()->comment('Tipo de identificacion');
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
        if (Schema::hasColumn('companies','type_identification')){
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('type_identification');
            });
        }
    }
}
