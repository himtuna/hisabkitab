<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('party_id')->unsigned()->index(); // customer_id and vendor_id
            $table->integer('hisab_id')->unsigned()->index()->nullable(); // customer_id and vendor_id
            $table->date('date');        
            $table->float('credit')->nullable();
            $table->float('debit')->nullable();            
            // $table->float('discount');
            $table->enum('type',['receivable','payable','expense','wage']);
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
        Schema::drop('payments');
    }
}
