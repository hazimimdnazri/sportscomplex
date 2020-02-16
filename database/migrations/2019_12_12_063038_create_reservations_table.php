<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('activity')->nullable();
            $table->unsignedBigInteger('sport')->nullable();
            $table->integer('type')->nullable();
            $table->integer('price_type')->nullable();
            $table->float('duration')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('sport')->references('id')->on('l_sports');
            $table->foreign('activity')->references('id')->on('l_activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
