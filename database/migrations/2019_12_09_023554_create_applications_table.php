<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event');
            $table->string('name');
            $table->string('ic');
            $table->string('email');
            $table->string('address');
            $table->string('phone');
            $table->string('city');
            $table->string('zipcode');
            $table->integer('asset_id');
            $table->string('attachment')->nullable();
            $table->text('remarks')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('status')->default(2);
            $table->integer('registered_by');
            $table->integer('approved_by')->nullable();
            $table->integer('flag')->default(1);
            $table->timestamps();

            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('asset_id')->references('id')->on('l_assets');
            $table->foreign('status')->references('id')->on('l_application_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
