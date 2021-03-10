<?php

namespace App\Services;

class SaleStrategyService
{
    /**
     * 找出購物車中可以使用優惠策略的商品, 店家及訂單
     */
    public function getSaleStrategies($carts)
    {
        $canUsedProductSaleStrategyIds = [1, 3];
        $canUsedShopSaleStrategyIds = [2];
        $canUsedOrderSaleStrategyIds = [5];

        return [
            'product_sale_strategies' => $canUsedProductSaleStrategyIds,
            'shop_sale_strategies' => $canUsedShopSaleStrategyIds,
            'order_sale_strategies' => $canUsedOrderSaleStrategyIds
        ];
    }
}
