<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHisabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hisabs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('party_id')->unsigned()->index(); // customer_id and vendor_id
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->float('credit');
            $table->float('debit');            
            $table->float('discount');
            $table->enum('status',['ongoing','paid']);
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
        Schema::drop('hisabs');
    }
}
