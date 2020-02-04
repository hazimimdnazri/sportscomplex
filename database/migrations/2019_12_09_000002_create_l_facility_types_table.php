<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLFacilityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_facility_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('remark')->nullable();
            $table->timestamps();
        });

        DB::table('l_facility_types')->insert(
            array(
                'type' => 'Outdoor'
            )
        );

        DB::table('l_facility_types')->insert(
            array(
                'type' => 'Indoor'
            )
        );

        DB::table('l_facility_types')->insert(
            array(
                'type' => 'Outdoor Arena'
            )
        );

        DB::table('l_facility_types')->insert(
            array(
                'type' => 'Indoor Arena'
            )
        );

        DB::table('l_facility_types')->insert(
            array(
                'type' => 'Stadium'
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
        Schema::dropIfExists('l_facility_types');
    }
}
