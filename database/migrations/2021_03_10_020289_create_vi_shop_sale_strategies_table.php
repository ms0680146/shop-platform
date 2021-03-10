<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViShopSaleStrategiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vi_shop_sale_strategies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_id')->comment('供應商ID');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->unsignedInteger('sale_strategy_id')->comment('銷售策略ID');
            $table->foreign('sale_strategy_id')->references('id')->on('sale_strategies')->onDelete('cascade');
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
        Schema::dropIfExists('vi_shop_sale_strategies');
    }
}
