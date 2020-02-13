<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('facility');
            $table->unsignedBigInteger('group');
            $table->float('price');
            $table->float('min_hour');
            $table->integer('status')->default(1);
            $table->string('colour')->default('black');
            $table->text('remark')->nullable();
            $table->integer('flag')->default(1);
            $table->unsignedBigInteger('updated_by')->default(1);
            $table->timestamps();

            $table->foreign('group')->references('id')->on('l_facility_groups');
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
        Schema::dropIfExists('l_facilities');
    }
}
