<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLFacilityGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_facility_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group');
            $table->unsignedBigInteger('type');
            $table->string('remark')->nullable();
            $table->timestamps();

            $table->foreign('type')->references('id')->on('l_facility_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_facility_groups');
    }
}
