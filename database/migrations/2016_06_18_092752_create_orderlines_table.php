<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderlines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->integer('colour_id')->unsigned()->index()->nullable(); //Make it Null
            $table->smallInteger('units')->unsigned(); //units
            $table->tinyInteger('unit_price')->unsigned(); //price per unit (Dibbi) Should be less
            $table->smallInteger('sub_amount')->unsigned(); //orderlineamount

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
        Schema::drop('orderlines');
    }
}