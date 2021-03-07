<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleStrategy extends Model
{
    public const TYPE_PRODUCT = 'PRODUCT';
    public const TYPE_ORDER = 'ORDER';
    public const TYPE_SHOP = 'SHOP';

    public const STRAGETY_UP_AMOUNT_DISCOUNT_PRICE = 1; // 滿 X 件折 Y 元
    public const STRAGETY_UP_AMOUNT_DISCCOUNT_PERCENT = 2; // 滿 X 件打 Z 折
    public const STRAGETY_UP_PRICE_DISCOUNT_PRICE = 3; // 滿 X 元折 Y 元
    public const STRAGETY_UP_PRICE_DISCOUNT_PERCENT = 4; // 滿 X 元打 z 折 
    public const STRAGETY_UP_PRICE_WITHOUT_SHIP = 5; // 滿 X 元免運費
    public const STRAGETY_UP_PRICE_GIFT = 6; // 滿 X 元贈送特定商品

    protected $fillable = [
        'id', 'name', 'address', 
        'phone', 'open_hours'
    ];
}