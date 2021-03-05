<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'product_id', 'sku_no', 
        'size', 'color', 'color_code', 
        'stock'
    ];
}
