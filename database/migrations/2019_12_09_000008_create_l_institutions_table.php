<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_institutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institution');
            $table->string('remark')->nullable();
            $table->integer('flag')->default(1);
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
        Schema::dropIfExists('l_institutions');
    }
}
