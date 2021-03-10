<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleStrategyToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->unsignedInteger('sale_strategy_id')->after('open_hours')->nullable()->comment('優惠策略');
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
        Schema::table('shops', function (Blueprint $table) {
            $table->dropForeign('shops_sale_strategy_id_foreign');
            $table->dropColumn('sale_strategy_id');
        });
    }
}
