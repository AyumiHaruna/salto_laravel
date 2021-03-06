<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name')->nullable();;
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('company_id')->default(1);
            $table->date('birthdate')->nullable();
            $table->string('photo')->nullable();
            $table->string('cv')->nullable();
            $table->text('description')->nullable();
            $table->integer('active')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->string('confirmation_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
