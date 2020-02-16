<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLCustomerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_customer_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->timestamps();
        });

        DB::table('l_customer_types')->insert(
            array(
                'type' => 'Public'
            )
        );

        DB::table('l_customer_types')->insert(
            array(
                'type' => 'Staff'
            )
        );

        DB::table('l_customer_types')->insert(
            array(
                'type' => 'Student'
            )
        );

        DB::table('l_customer_types')->insert(
            array(
                'type' => 'Corporate'
            )
        );

        DB::table('l_customer_types')->insert(
            array(
                'type' => 'University'
            )
        );

        DB::table('l_customer_types')->insert(
            array(
                'type' => 'Club'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_customer_types');
    }
}
