<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudios extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('audios', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('category');
        $table->string('title');
        $table->string('description');
        $table->string('url');
        $table->string('thumbnail');
        $table->integer('position');
        $table->tinyInteger('lock')->default(1)->comment('0=off/1=on');
        $table->tinyInteger('active')->default(0)->comment('0=off/1=on');
        $table->timestamps();
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('audios');
  }
}
