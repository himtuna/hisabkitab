<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category'); //category of product
            $table->string('packaging_type'); // Dibbi or Looose
            $table->tinyInteger('pack_units'); //units in a pack
            $table->tinyInteger('unit_pieces'); //pieces in a unit
            $table->tinyInteger('unit_price'); //price per unit (Dibbi)
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
        Schema::drop('products');
    }
}
