<?php

namespace App\Services;

class SaleStrategyService
{
    /**
     * 找出可以使用優惠策略的商品, 店家, 訂單及折價卷
     */
    public function getCanUsedStrategies(string $type, $data)
    {
        if ($type === SaleStrategy::TYPE_PRODUCT) {
            return $this->getCanUsedProductStrateyIds($data);
        } elseif ($type === SaleStrategy::TYPE_SHOP) {
            return $this->getCanUsedShopStrategyIds($data);
        } elseif ($type === SaleStrategy::TYPE_ORDER) {
            return $this->getCanUsedOrderStrategyIds($data);
        } elseif ($type === SaleStrategy::TYPE_SHOP) {
            return $this->getCanUsedCouponStrategyIds($data);
        } else {
            throw \Exception('type not allow');
        }
    }

    private function getCanUsedProductStrateyIds($data)
    {
        return;
    }

    private function getCanUsedShopStrategyIds($data)
    {
        return;
    }

    private function getCanUsedOrderStrategyIds($data)
    {
        return;
    }

    private function getCanUsedCouponStrategyIds($data)
    {
        return;
    }
}
