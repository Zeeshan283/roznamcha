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
        Schema::create('wana_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('malwala')->unsigned();
            $table->foreign('malwala')->references('id')->on('admins'); 
            $table->integer('musalsal_num');
            $table->date('date');
            $table->string('city');
            $table->string('product');
            $table->string('vehicle_num');
            $table->string('quantity');
            $table->text('detail')->nullable();
            $table->string('kiraya');
            $table->string('mutabik_kiraya');
            $table->string('izafi_kiraya');
            $table->string('comission');
            $table->string('ponch');
            $table->string('total');
            $table->string('total_af');
            $table->string('bilty')->nullable();
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
        Schema::dropIfExists('wana');
    }
};
