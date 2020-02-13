<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('role')->default(2);
            $table->unsignedBigInteger('status')->default(1);
            $table->string('password');
            $table->integer('flag')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role')->references('id')->on('l_roles');
            $table->foreign('status')->references('id')->on('l_user_statuses');
        });

        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'role' => 1,
                'status' => 2,
                'password' => Hash::make(123456),
                'flag' => 1,
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
        Schema::dropIfExists('users');
    }
}
