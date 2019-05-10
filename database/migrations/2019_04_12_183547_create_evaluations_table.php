<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id')->comment('Evaluation ID');
            $table->unsignedInteger('user_id')->comment('FK:Users ID');
            $table->integer('stock_code')->comment('FK:Stock code');
            $table->unsignedInteger('buy_id')->nullable()->comment('FK:Buys ID');
            $table->unsignedInteger('sale_id')->nullable()->comment('FK:Sales ID');
            $table->date('evaluate_date')->useCurrent()->comment('Evaluate date');
            $table->string('comment')->nullable()->comment('Comment for evaluation');
            $table->integer('point')->default(0)->comment('Evaluation point (0~100)');
            $table->date('next_check')->nullable()->comment('Next check date');
            $table->date('profit')->default(0)->comment('Profit');
            $table->date('updated_at')->useCurrent()->comment('Updated at');
            $table->date('created_at')->useCurrent()->comment('Created at');
            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('stock_code')->references('stock_code')->on('stocks');
            $table->foreign('buy_id')->references('id')->on('buys');
            $table->foreign('sale_id')->references('id')->on('sales');
            //論理削除
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
