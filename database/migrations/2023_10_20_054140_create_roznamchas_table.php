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
        Schema::create('roznamchas', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('country');
            $table->string('serial_num');
            $table->date('date_pk')->nullable();
            $table->date('date_af')->nullable();
            $table->date('date_usa')->nullable();
            $table->integer('khata_banam')->unsigned();
            $table->foreign('khata_banam')->references('id')->on('admins'); 
            $table->text('detail')->nullable();
            $table->string('state');
            $table->string('amount_pk')->nullable();
            $table->string('amount_af')->nullable();
            $table->string('amount_usa')->nullable();
            $table->string('bilty')->nullable();
            $table->string('afghani')->nullable();
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
        Schema::dropIfExists('roznamchas');
    }
};
