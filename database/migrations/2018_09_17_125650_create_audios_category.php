<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiosCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('audios_category', function (Blueprint $table) {
        $table->increments('id');
        $table->string('category');
        $table->string('display_name');
        $table->text('description');
        $table->string('thumbnail');
        $table->tinyInteger('active')->default(1)->comment('0=off/1=on');
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
        Schema::drop('audios_category');
    }
}
