<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('ic');
            $table->string('phone');
            $table->string('email');
            $table->date('dob');
            $table->string('address');
            $table->string('zipcode');
            $table->string('city');
            $table->integer('state');
            $table->integer('type')->default(1);
            $table->integer('membership')->default(99);
            $table->integer('cycle')->nullable();
            $table->date('cycle_start')->nullable();
            $table->date('cycle_end')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('customers');
    }
}
