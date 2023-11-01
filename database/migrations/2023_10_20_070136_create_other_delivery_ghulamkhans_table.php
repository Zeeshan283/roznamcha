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
        Schema::create('other_delivery_ghulamkhans', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('malwala')->unsigned();
            $table->foreign('malwala')->references('id')->on('admins'); 
            $table->string('ecchange_rate');
            $table->string('total_af');
            $table->string('munafa');
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
        Schema::dropIfExists('other_delivery_ghulamkhan');
    }
};
