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
            $table->string('trans_number'); // B - Booking | M - Membership
            $table->string('trans_type'); // B - Booking | M - Membership
            $table->unsignedBigInteger('application_id')->nullable();
            $table->string('receipt')->nullable();
            $table->date('date');
            $table->unsignedBigInteger('customer_id');
            $table->integer('issuer')->default('1');
            $table->integer('payment_type')->default('1');
            $table->float('tax');
            $table->float('membership_discount');
            $table->float('general_discount');
            $table->float('deposit')->default(0.00);
            $table->float('subtotal');
            $table->float('total');
            $table->float('paid');
            $table->float('trans_changes');
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('customer_id')->references('id')->on('users');
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
