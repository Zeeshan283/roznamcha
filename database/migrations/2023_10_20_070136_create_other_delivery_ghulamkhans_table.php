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
            $table->integer('musalsal_num')->unsigned();
            $table->foreign('musalsal_num')->references('id')->on('ghulamkhan_orders'); 
            $table->integer('name')->unsigned();
            $table->foreign('name')->references('id')->on('admins'); 
            $table->string('comission');
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
