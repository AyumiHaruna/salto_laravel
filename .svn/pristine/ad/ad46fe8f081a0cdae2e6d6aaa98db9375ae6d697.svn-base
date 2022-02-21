<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('coach_id');
            $table->integer('coachee_id');
            $table->integer('status')->comment('0/Agendado, 1/confirmado, 2/cancelado, 3/Atendido, 4/noAtendido, 5/Disponible, 6/oculto');
            $table->datetime('start_datetime');
            $table->datetime('end_datetime');
            $table->tinyInteger('origin_type')->comment('1/coach_config, 2/single_create');
            $table->tinyInteger('first_session')->default(0);
            $table->tinyInteger('eval')->nullable();
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
        Schema::dropIfExists('sessions');
    }
}
