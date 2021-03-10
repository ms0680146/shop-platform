<?php

namespace App\Services;

class OrderService
{
    public function calculate($carts, $saleStrategies)
    {

        return [
            'sum' => $sum,
            'sum_discount' => $sumDiscount,
            'ship_sum' => $shipSum,
            'ship_discount' => $shipDiscount,
            'total' => $total
        ];
    }
}
