<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('chat', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_coachee');
          $table->integer('id_support')->nullable();
          $table->tinyInteger('status')->default(1)->comment('1=pending/2=attended/3closed');
          $table->text('file');
          $table->dateTime('created_at');
          $table->dateTime('updated_at');
          $table->dateTime('attended_at')->nullable();
          $table->dateTime('closed_at')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chat');
    }
}
