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
            $table->increments('id');
            $table->integer('musalsal_num')->unsigned();
            $table->foreign('musalsal_num')->references('id')->on('ghulamkhan_orders')->onDelete('cascade');
            $table->string('us_malwala');
            $table->string('exchange_rate');
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
