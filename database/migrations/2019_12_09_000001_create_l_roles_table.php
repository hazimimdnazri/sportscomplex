<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role');
            $table->timestamps();
        });

        DB::table('l_roles')->insert(
            array(
                'role' => 'Superadmin'
            )
        );

        DB::table('l_roles')->insert(
            array(
                'role' => 'Admin'
            )
        );

        DB::table('l_roles')->insert(
            array(
                'role' => 'Customer'
            )
        );

        DB::table('l_roles')->insert(
            array(
                'role' => 'Vendor'
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
        Schema::dropIfExists('l_roles');
    }
}
