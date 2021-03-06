<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('blogPost', function (Blueprint $table) {
          $table->increments('id');
          $table->string('foto');
          $table->string('titulo')->unique();
          $table->string('display_url')->unique();
          $table->string('metatag');
          $table->longText('mensaje');
          $table->integer('id_usuario');
          $table->timestamps();
          $table->date('publiDate');
          $table->boolean('visible');
          $table->integer('likes');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogPost');
    }
}
