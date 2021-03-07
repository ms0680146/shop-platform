<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no', 15)->comment('訂單編號');
            $table->unsignedInteger('user_id')->comment('會員ID');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('sum')->comment('訂單原金額');
            $table->unsignedInteger('sum_discount')->comment('折抵總金額');
            $table->unsignedInteger('ship_sum')->comment('運費原金額');
            $table->unsignedInteger('ship_discount')->comment('運費折抵金額');
            $table->unsignedInteger('total')->comment('訂單付款總額');

            $table->enum('status', ['WAITING', 'ACCEPTED', 'COMPLETED', 'CANCELLED', 'FAILED'])
                ->default('WAITING')
                ->comment('訂單狀態: WAITING(等待付款)|ACCEPTED(訂單成立)|COMPLETED(付款完成)|CANCELLED(交易取消)|FAILED(付款失敗)');
            $table->timestamp('paid_at')->nullable()->comment('付款時間');
            $table->timestamp('cancelled_at')->nullable()->comment('交易取消日');
            $table->softDeletes();
            // created_at 為訂單成立時間
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('訂單ID');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedInteger('shop_id')->comment('供應商ID');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->unsignedInteger('product_id')->comment('商品ID');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('product_stock_id')->unsigned()->comment('商品庫存ID');
            $table->foreign('product_stock_id')->references('id')->on('product_stocks')->onDelete('cascade');
            
            $table->unsignedInteger('price')->comment('商品單價');
            $table->unsignedInteger('amount')->comment('商品數量');
            $table->softDeletes();
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
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
}
