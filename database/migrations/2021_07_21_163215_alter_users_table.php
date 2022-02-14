<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users'))
        {
            if (!Schema::hasColumn('users', 'deleted_at'))
            {
                Schema::table('users', function (Blueprint $table) {
                    $table->softDeletes();
                });
            }
            if (!Schema::hasColumn('users', 'created_user'))
            {
                Schema::table('users', function (Blueprint $table) {
                    $table->bigInteger('created_user')->after('id')->unsigned()->nullable()->comment("Usuario que crea");
                    $table->foreign('created_user')->references('id')->on('users');
                });
            }
            if (!Schema::hasColumn('users', 'updated_user'))
            {
                Schema::table('users', function (Blueprint $table) {
                    $table->bigInteger('updated_user')->after('created_user')->unsigned()->nullable()->comment("Ultimo usuario que modifica");
                    $table->foreign('updated_user')->references('id')->on('users');
                });
            }
            if (!Schema::hasColumn('users', 'deleted_user'))
            {
                Schema::table('users', function (Blueprint $table) {
                    $table->bigInteger('deleted_user')->after('updated_user')->unsigned()->nullable()->comment("Usuario que elimina");
                    $table->foreign('deleted_user')->references('id')->on('users');
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
        if (Schema::hasTable('users'))
        {
            if (Schema::hasColumn('users', 'deleted_at'))
            {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropSoftDeletes();
                });
            }
            if (Schema::hasColumn('users', 'created_user'))
            {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropForeign('users_created_user_foreign');//tabla_campo_foreign
                    $table->dropColumn('created_user');
                });
            }
            if (Schema::hasColumn('users', 'updated_user'))
            {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropForeign('users_updated_user_foreign');//tabla_campo_foreign
                    $table->dropColumn('updated_user');
                });
            }
            if (Schema::hasColumn('users', 'deleted_user'))
            {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropForeign('users_deleted_user_foreign');//tabla_campo_foreign
                    $table->dropColumn('deleted_user');
                });
            }
        }
    }
}
