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
        Schema::create('self_delivery_ghulamkhans', function (Blueprint $table) {
            $table->integer('musalsal_num')->unsigned();
            $table->foreign('musalsal_num')->references('id')->on('kharlachi_orders'); 
            $table->integer('name1')->unsigned();
            $table->foreign('name1')->references('id')->on('admins'); 
            $table->integer('name2')->unsigned();
            $table->foreign('name2')->references('id')->on('admins'); 
            $table->string('date');
            $table->string('kharcha');
            $table->string('vehicle_num');
            $table->string('details');
            $table->string('kanta_pk');
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
        Schema::dropIfExists('self_delivery_ghulamkhan');
    }
};
