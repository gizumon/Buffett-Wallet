<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->integer('stock_code')->default(0000)->comment('Stock code');
            $table->string('name')->default(0)->comment('Stock name');
            $table->integer('sales_num')->default(0)->comment('The number of deal');
            $table->timestamp('created_at')->comment('Timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Stocks');
    }
}
