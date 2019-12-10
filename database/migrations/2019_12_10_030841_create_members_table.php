<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
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
            $table->integer('membership');
            $table->integer('cycle');
            $table->timestamps();

            $table->foreign('membership')->references('id')->on('memberships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
