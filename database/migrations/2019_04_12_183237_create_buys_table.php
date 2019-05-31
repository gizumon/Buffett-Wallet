<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->date('date')->comment('Buy at');
            $table->integer('price')->comment('Price for buy');
            $table->integer('target_price')->comment('Target price');
            
            $table->date('updated_at')->useCurrent()->comment('Updated at');
            $table->date('created_at')->useCurrent()->comment('Created at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buys');
    }
}
