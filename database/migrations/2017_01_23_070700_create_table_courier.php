<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCourier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('contact_no_home');
            $table->string('contact_no_work');
            $table->string('contact_no_other');
            $table->string('email');
            $table->char('gender', 1);
            $table->date('dob');
            $table->string('dob_doc');
            $table->string('religion');
            $table->string('maritial_status', 1);
            $table->string('nationality');
            $table->string('national_id_number');
            $table->string('national_id_number_doc');
            $table->string('blood_group', 4);
            $table->string('present_address');
            $table->string('address_verification_doc');
            $table->string('permanent address');
            $table->string('picture');
            $table->string('cv');
            $table->string('references');
            $table->text('experiences');
            $table->text('comments');
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
        Schema::drop('couriers');
    }
}
