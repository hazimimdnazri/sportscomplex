<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('state');
            $table->timestamps();
        });

        DB::table('l_states')->insert(
            array(
                'state' => 'Johor'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Kedah'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Kelantan'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Melaka'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Negeri Sembilan'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Pahang'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Perak'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Perlis'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Pulau Pinang'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Sabah'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Sarawak'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Selangor'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'Terengganu'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'W.P. Kuala Lumpur'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'W.P. Labuan'
            )
        );

        DB::table('l_states')->insert(
            array(
                'state' => 'W.P. Putrajaya'
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
        Schema::dropIfExists('l_states');
    }
}
