<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleStrategiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_strategies', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['PRODUCT', 'ORDER', 'SHOP'])->nullable()->comment('銷售類型: PRODUCT(商品)|ORDER(訂單)|SHOP(供應商)');
            $table->tinyInteger('strategy')->comment('策略');
            $table->string('amount', 256)->nullable()->comment('滿 xx 件 or 滿 xx 元');
            $table->string('discount', 256)->nullable()->comment('折 xx 元(-100) or 打 xx 折(95%)');
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
        Schema::dropIfExists('sale_strategies');
    }
}
