<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('Users ID');
            $table->integer('cash_sum')->comment('Total cash savings');
            $table->integer('stock_sum')->comment('Total stock investment funds');
            $table->integer('fx_sum')->nullable()->comment('Not use:Total fx investment funds');
            $table->integer('bitcoin_sum')->nullable()->comment('Not use:Total bitcoin investment funds');
            $table->integer('additional_fund')->default(0)->comment('Additinal cash funds');
            $table->date('date')->useCurrent()->comment('History');
            $table->date('updated_at')->useCurrent()->comment('Updated at');
            $table->date('created_at')->useCurrent()->comment('Created at');
            //外部キー
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Wallet_history');
    }
}
