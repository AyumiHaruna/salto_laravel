<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogTemas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100)->unique();
            $table->string('display_url', 100)->unique();
            $table->string('foto');
            $table->boolean('activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogTemas');
    }
}
