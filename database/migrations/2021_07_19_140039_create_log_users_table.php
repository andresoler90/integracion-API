<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('log_users'))
        {
            Schema::create('log_users', function (Blueprint $table) {
                $table->id();
                $table->bigInteger("users_id")->comment("Id de la tabla users")->unsigned();
                $table->string('ip', 45)->nullable()->comment("Ip conexión usuario");
                $table->timestamps();
                $table->foreign('users_id')->references('id')->on('users');
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
        if (Schema::hasTable('log_users'))
        {
            Schema::table('log_users', function (Blueprint $table) {
                $table->dropForeign('log_users_users_id_foreign');//tabla_campo_foreign
            });
            Schema::dropIfExists('log_users');
        }
    }
}
