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
            $table->integer('application_id');
            $table->integer('asset_id')->nullable();
            $table->integer('activity_id')->nullable();
            $table->integer('type');
            $table->float('duration')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('asset_id')->references('id')->on('l_assets');
            $table->foreign('activity_id')->references('id')->on('l_activities');
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
