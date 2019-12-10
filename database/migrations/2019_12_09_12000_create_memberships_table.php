<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('membership');
            $table->float('discount');
            $table->float('monthly');
            $table->float('anually');
        });

        DB::table('memberships')->insert(
            array(
                'membership' => 'Gold',
                'discount' => 20,
                'monthly' => 140,
                'anually' => 1200
            )
        );

        DB::table('memberships')->insert(
            array(
                'membership' => 'Silver',
                'discount' => 15,
                'monthly' => 140,
                'anually' => 900
            )
        );

        DB::table('memberships')->insert(
            array(
                'membership' => 'Bronze',
                'discount' => 10,
                'monthly' => 140,
                'anually' => 600
            )
        );

        DB::table('memberships')->insert(
            array(
                'membership' => 'EduCity Student',
                'discount' => 20,
                'monthly' => 0,
                'anually' => 377.50
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
        Schema::dropIfExists('memberships');
    }
}
