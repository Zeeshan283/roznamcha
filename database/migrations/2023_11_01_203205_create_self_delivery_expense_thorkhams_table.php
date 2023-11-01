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
        Schema::create('self_delivery_expense_thorkhams', function (Blueprint $table) {
            $table->id();
            $table->integer('malwala')->unsigned();
            $table->foreign('malwala')->references('id')->on('admins'); 
            $table->integer('musalsal_num')->unsigned();
            $table->foreign('musalsal_num')->references('id')->on('kharlachi_orders'); 
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
        Schema::dropIfExists('self_delivery_expense_thorkhams');
    }
};
