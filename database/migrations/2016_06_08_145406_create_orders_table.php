<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('order_created_on');
            $table->date('invoice_date');
            $table->integer('customer_id')->unsigned()->index();
            $table->enum('order_status', ['draft', 'confirmed','paid']);
            $table->enum('invoice_received', ['No', 'Yes','Lost']);
            // $table->boolean('invoice_received');
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
        Schema::drop('orders');
    }
}
