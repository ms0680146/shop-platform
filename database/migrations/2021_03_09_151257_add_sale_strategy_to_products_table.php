<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleStrategyToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('sale_strategy_id')->after('shop_id')->nullable()->comment('優惠策略');
            $table->foreign('sale_strategy_id')->references('id')->on('sale_strategies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_sale_strategy_id_foreign');
            $table->dropColumn('sale_strategy_id');
        });
    }
}
