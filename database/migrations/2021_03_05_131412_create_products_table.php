<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 商品主表
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['ACCESSORY', 'PRODUCT'])->comment('分類: 贈品(ACCESSORY)|商品(PRODUCT)');
            $table->string('name', 128)->comment('名稱');
            $table->text('description')->nullable()->comment('介紹');
            $table->string('img', 128)->nullable()->comment('圖片');
            $table->unsignedInteger('price')->nullable()->comment('價格');
            $table->enum('status', ['ONLINE', 'OFFLINE'])->default('OFFLINE')->comment('上下架');
            $table->unsignedInteger('weight')->default(1)->comment('權重');
            $table->softDeletes();
            $table->timestamps();
        });

        // 商品庫存; 有不同顏色尺寸的就會有多個
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->comment('商品ID');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('sku_no')->comment('商品唯一代號');
            $table->string('size', 20)->nullable()->comment('尺寸');
            $table->string('color')->nullable()->comment('顏色名稱');
            $table->string('color_code', 20)->nullable()->comment('顏色色碼');
            $table->unsignedInteger('stock')->default(0)->comment('庫存數');
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
        Schema::dropIfExists('product_stocks');
        Schema::dropIfExists('products');
    }
}
