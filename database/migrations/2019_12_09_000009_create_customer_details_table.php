<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('ic')->nullable()->unique();
            $table->string('passport')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->integer('nationality')->nullable(); // 1 - malaysian | 2 - non-malaysian
            $table->unsignedBigInteger('state')->nullable();
            $table->unsignedBigInteger('type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type')->references('id')->on('l_customer_types');
            $table->foreign('state')->references('id')->on('l_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_details');
    }
}
