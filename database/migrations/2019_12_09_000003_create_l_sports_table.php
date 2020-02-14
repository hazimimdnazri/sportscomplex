<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_sports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sport');
            $table->unsignedBigInteger('venue');
            $table->string('facility');
            $table->float('price');
            $table->float('min_hour');
            $table->string('colour');
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('updated_by')->default(1);
            $table->timestamps();

            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('venue')->references('id')->on('l_venues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_sports');
    }
}
