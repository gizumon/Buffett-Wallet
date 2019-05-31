<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id')->comment('Sale ID');
            $table->date('date')->useCurrent()->comment('Sale at');
            $table->integer('price')->comment('Sale price');
            $table->string('reason')->comment('Reason for sale');
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
        Schema::dropIfExists('sales');
    }
}
