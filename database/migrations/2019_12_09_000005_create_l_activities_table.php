<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('activity');
            $table->unsignedBigInteger('venue');
            $table->float('public');
            $table->float('students');
            $table->float('underage');
            $table->float('deposit');
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('updated_by')->default(1);
            $table->timestamps();

            $table->foreign('venue')->references('id')->on('l_venues');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_activities');
    }
}
