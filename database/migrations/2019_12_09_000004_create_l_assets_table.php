<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asset');
            $table->integer('type');
            $table->text('remark')->nullable();
            $table->float('price');
            $table->integer('status')->default(1);
            $table->integer('flag')->default(1);

            $table->foreign('type')->references('id')->on('l_asset_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
