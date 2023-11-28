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
        Schema::create('other_delivery_kharlachis', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('musalsal_num')->unsigned();
            $table->foreign('musalsal_num')->references('id')->on('kharlachi_orders'); 
            $table->integer('dealer_pk')->unsigned();
            $table->foreign('dealer_pk')->references('id')->on('admins'); 
            $table->integer('dealer_af')->unsigned();
            $table->foreign('dealer_af')->references('id')->on('admins'); 
            $table->string('kiraya_punjab');
            $table->string('custom_pk');
            $table->string('labour_pk');
            $table->string('nlc_pk');
            $table->string('kanta_pk');
            $table->string('commission_pk');
            $table->string('total_pk');
            $table->string('gumrak_af');
            $table->string('mutabik_kiraya_af');
            $table->string('extra_kiraya_af');
            $table->string('ponch_af');
            $table->string('total_af');
            $table->string('bilty');
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
        Schema::dropIfExists('other_delivery_kharlachi');
    }
};
