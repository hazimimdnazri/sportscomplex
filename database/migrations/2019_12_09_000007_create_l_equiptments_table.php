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
            $table->string('serial_number')->unique();
            $table->integer('status')->default(1); // 1 baik | 2 rosak
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('updated_by')->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('l_equiptments');
    }
}
