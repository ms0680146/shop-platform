<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViUserCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vi_user_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('使用者ID');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('coupon_id')->comment('折價卷ID');
            $table->foreign('coupon_id')->references('id')->on('sale_strategies')->onDelete('cascade');
            $table->timestamp('registered_at')->nullable()->comment('取得日期');
            $table->timestamp('used_at')->nullable()->comment('使用日期');
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
        Schema::dropIfExists('vi_user_coupons');
    }
}
