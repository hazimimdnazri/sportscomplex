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
            $table->string('ic');
            $table->string('phone');
            $table->date('dob');
            $table->string('address');
            $table->string('zipcode');
            $table->string('city');
            $table->integer('state');
            $table->unsignedBigInteger('membership')->default(99);
            $table->integer('cycle')->nullable();
            $table->date('cycle_start')->nullable();
            $table->date('cycle_end')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('membership')->references('id')->on('l_memberships');
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
