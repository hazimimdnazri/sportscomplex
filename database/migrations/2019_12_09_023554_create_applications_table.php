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
            $table->integer('customer_id');
            $table->string('event')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('status')->default(1);
            $table->date('date')->nullable();
            $table->integer('registered_by');
            $table->integer('approved_by')->nullable();
            $table->text('remark')->nullable();
            $table->integer('flag')->default(1);
            $table->timestamps();

            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('status')->references('id')->on('l_application_statuses');
            $table->foreign('customer_id')->references('id')->on('customers');
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
