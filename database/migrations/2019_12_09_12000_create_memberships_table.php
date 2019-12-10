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
        });

        DB::table('memberships')->insert(
            array(
                'membership' => 'Gold',
                'discount' => 20
            )
        );

        DB::table('memberships')->insert(
            array(
                'membership' => 'Silver',
                'discount' => 15
            )
        );

        DB::table('memberships')->insert(
            array(
                'membership' => 'Bronze',
                'discount' => 10
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
