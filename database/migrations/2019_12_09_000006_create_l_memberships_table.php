<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('membership');
            $table->string('activities')->nullable(); // Unlimited free usage
            $table->string('facilities')->nullable(); // Just discount
            $table->float('discount');
            $table->float('monthly');
            $table->float('anually');
            $table->unsignedBigInteger('updated_by')->default(1);
            $table->timestamps();

            $table->foreign('updated_by')->references('id')->on('users');
        });

        DB::table('l_memberships')->insert(
            array(
                'membership' => 'Gold',
                'discount' => 20,
                'monthly' => 140,
                'anually' => 1200
            )
        );

        DB::table('l_memberships')->insert(
            array(
                'membership' => 'Silver',
                'discount' => 15,
                'monthly' => 140,
                'anually' => 900
            )
        );

        DB::table('l_memberships')->insert(
            array(
                'membership' => 'Bronze',
                'discount' => 10,
                'monthly' => 140,
                'anually' => 600
            )
        );

        DB::table('l_memberships')->insert(
            array(
                'membership' => 'EduCity Student',
                'discount' => 20,
                'monthly' => 0,
                'anually' => 377.50
            )
        );

        DB::table('l_memberships')->insert(
            array(
                'id' => 99,
                'membership' => 'Non Member',
                'discount' => 0,
                'monthly' => 0,
                'anually' => 0
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
        Schema::dropIfExists('l_memberships');
    }
}
