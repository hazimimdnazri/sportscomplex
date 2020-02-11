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
            $table->unsignedBigInteger('facility_id');
            $table->string('serial_number')->unique();
            $table->integer('status')->default(1); // 1 baik | 2 rosak
            $table->string('remark')->nullable();
            $table->timestamps();

            $table->foreign('facility_id')->references('id')->on('l_facilities');
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
