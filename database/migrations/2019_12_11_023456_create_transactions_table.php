<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_number');
            $table->integer('trans_type');
            $table->integer('reservation_id')->nullable();
            $table->date('date');
            $table->integer('customer_id');
            $table->integer('issuer')->default('1');
            $table->integer('payment_type')->default('1');
            $table->float('tax');
            $table->float('membership_discount');
            $table->float('general_discount');
            $table->float('trans_changes');
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
