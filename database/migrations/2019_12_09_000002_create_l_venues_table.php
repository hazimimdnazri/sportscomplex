<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_venues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('venue');
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('updated_by')->default(1);
            $table->timestamps();

            $table->foreign('updated_by')->references('id')->on('users');
        });

        DB::table('l_venues')->insert(
            array(
                'venue' => 'Outdoor Arena'
            )
        );

        DB::table('l_venues')->insert(
            array(
                'venue' => 'Indoor Arena'
            )
        );

        DB::table('l_venues')->insert(
            array(
                'venue' => 'Stadium'
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
        Schema::dropIfExists('l_venues');
    }
}
