<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public const TYPE_ACCESSORY = 'ACCESSORY';
    public const TYPE_PRODUCT = 'PRODUCT';

    public const STATUS_ONLINE = 'ONLINE';
    public const STATUS_OFFLINE = 'OFFLINE';

    protected $fillable = [
        'id', 'shop_id', 'sale_strategy_id', 
        'type', 'name', 'description', 
        'img', 'price', 'status', 'weight'
    ];

    public function shop()
    {
        $this->belongsTo(Shop::class);
    }
}
