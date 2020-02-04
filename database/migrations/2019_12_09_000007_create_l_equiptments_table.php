<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLEquiptmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_equiptments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('equiptment');
            $table->unsignedBigInteger('facility');
            $table->string('remark')->nullable();
            $table->timestamps();

            $table->foreign('facility')->references('id')->on('l_facilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_equiptments');
    }
}
