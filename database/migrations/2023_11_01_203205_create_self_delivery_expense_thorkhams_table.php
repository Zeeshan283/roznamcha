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
            $table->integer('musalsal_num')->unsigned();
            $table->foreign('musalsal_num')->references('id')->on('thorkham_orders'); 
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
        Schema::dropIfExists('self_delivery_expense_thorkhams');
    }
};
