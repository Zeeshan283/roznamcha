<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kharlachi_orders', function (Blueprint $table) {
            $table->increments('id'); 
            $table->date('date');
            $table->integer('musalsal_num');
            $table->integer('name1')->unsigned();
            $table->foreign('name1')->references('id')->on('admins'); 
            $table->integer('name2')->unsigned();
            $table->foreign('name2')->references('id')->on('admins'); 
            $table->string('bulit_no');
            $table->string('name_driver');
            $table->string('driver_num');
            $table->string('vehicle_num');
            $table->string('loading_place');
            $table->string('port');
            $table->string('p_of_d');
            $table->string('n_plate_usd');
            $table->string('product');
            $table->string('quantity');
            $table->text('weight');
            $table->text('kariya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kharlachi');
    }
};
