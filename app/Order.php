<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public const STARUS_WAITING = 'WAITING'; // 訂單處理中
    public const STATUS_ACCEPTED = 'ACCEPTED'; // 訂單成立
    public const STATUS_COMPLETED = 'COMPLETED'; // 付款完成
    public const STATUS_CANCELLED = 'CANCELLED'; // 交易取消
    public const STATUS_FAILED = 'FAILED'; // 付款失敗

    protected $fillable = [
        'order_no', 'user_id', 'sum',
        'sum_discount', 'ship_sum', 'ship_discount',
        'total', 'status', 'paid_at', 'cancelled_at'
    ];
}