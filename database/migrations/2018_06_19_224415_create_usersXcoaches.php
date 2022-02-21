<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersXcoaches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('usersXcoaches', function (Blueprint $table) {
          $table->integer('id_user');
          $table->integer('id_coach');
          $table->text('perfilcliente')->nullable();
          $table->text('seguiminetoCliente')->nullable();
          $table->boolean('active')->default(1);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usersXcoaches');
    }
}
