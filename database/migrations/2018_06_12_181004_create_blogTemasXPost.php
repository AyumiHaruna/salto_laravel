<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTemasXPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('blogTemasXPost', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_Tema');
          $table->integer('id_Post');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogTemasXPost');
    }
}
