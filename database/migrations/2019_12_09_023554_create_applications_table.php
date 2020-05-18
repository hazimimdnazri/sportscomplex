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
            $table->unsignedBigInteger('user_id');
            $table->integer('type')->nullable(); // 1 - facility | 2 - activity
            $table->string('event')->nullable();
            $table->string('attachment')->nullable();
            $table->unsignedBigInteger('status')->default(1);
            $table->date('date')->nullable();
            $table->unsignedBigInteger('registered_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->text('remark')->nullable();
            $table->string('weather')->nullable();
            $table->integer('flag')->default(1);
            $table->timestamps();

            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('status')->references('id')->on('l_application_statuses');
            $table->foreign('user_id')->references('id')->on('users');
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
