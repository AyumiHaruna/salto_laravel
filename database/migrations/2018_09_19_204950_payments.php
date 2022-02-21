<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('plan');
            $table->float('amount', 5, 2);
            $table->datetime('payment_datetime');
            $table->integer('invoice');
            $table->string('invoice_rfc');
            $table->string('invoice_email');
            $table->string('invoice_address');
            $table->string('invoice_name');
            $table->integer('first_payment');
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
        Schema::drop('payments');
    }
}
