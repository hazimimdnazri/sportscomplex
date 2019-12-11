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
            $table->integer('trans_type');
            $table->integer('item');
            $table->date('date');
            $table->integer('asset');
            $table->integer('customer');
            $table->integer('issuer');
            $table->integer('payment_type');
            $table->float('tax');
            $table->float('discount');
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
