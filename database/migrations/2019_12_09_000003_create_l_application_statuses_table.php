<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLApplicationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_application_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
        });

        DB::table('l_application_statuses')->insert(
            array(
                'status' => 'Draft'
            )
        );

        DB::table('l_application_statuses')->insert(
            array(
                'status' => 'Processing'
            )
        );

        DB::table('l_application_statuses')->insert(
            array(
                'status' => 'Paid'
            )
        );

        DB::table('l_application_statuses')->insert(
            array(
                'status' => 'Rejected'
            )
        );

        DB::table('l_application_statuses')->insert(
            array(
                'status' => 'Finished'
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
        Schema::dropIfExists('l_application_statuses');
    }
}
