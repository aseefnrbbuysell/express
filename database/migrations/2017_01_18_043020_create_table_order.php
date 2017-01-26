<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('sender_phone');
            $table->string('sender_steet');
            $table->string('sender_address_1');
            $table->string('sender_city');
            $table->string('sender_state');
            $table->string('sender_zipcode');
            $table->string('sender_country');
            $table->string('reciever_name');
            $table->string('reciever_email');
            $table->string('reciever_phone');
            $table->string('reciever_steet');
            $table->string('reciever_address_1');
            $table->string('reciever_city');
            $table->string('reciever_state');
            $table->string('reciever_zipcode');
            $table->string('reciever_country');
            $table->timestamp('pickup_date');
            $table->text('shipment_info');
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
        Schema::drop('orders');
    }
}
