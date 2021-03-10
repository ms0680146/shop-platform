<?php

namespace App\Http\Controllers;

use App\SaleStrategy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\CustomResponseService;

class OrderController extends Controller
{
    protected $customResponseService;
    protected $saleStrategyService;
    protected $orderService;

    public function __construct(
        CustomResponseService $customResponseService,
        SaleStrategyService $saleStrategyService,
        OrderService $orderService
    ) {
        $this->customResponseService = $customResponseService;
    }

    // 試算訂單金額
    public function caclOrder(Request $request)
    {
        $this->validate($request, [
            'coupon_id' => 'integer'
        ]);

        $user = Auth::user();
        $shoppingCart = $user->shoppingCart;

        if (is_null($shoppingCart)) {
            return $this->customResponseService->apiResponse(400, 'bad request', 'user do not have shopping cart');
        }

        $carts = $shoppingCart->carts;
        if (is_null($carts)) {
            return $this->customResponseService->apiResponse(404, 'not found', 'Nothing in shopping cart');
        }

        // Get sale strategy (product, shop, order, coupon)
        $productSaleStrategyIds = $this->saleStrategyService->getCanUsedStrategies(SaleStrategy::TYPE_PRODUCT, $carts);
        $shopSaleStrategyIds = $this->saleStrategyService->getCanUsedStrategies(SaleStrategy::TYPE_SHOP, $carts);
        $orderSaleStrategyIds = $this->saleStrategyService->getCanUsedStrategies(SaleStrategy::TYPE_ORDER, $carts);
        $couponSaleStrategyIds = $this->saleStrategyService->getCanUsedStrategies(SaleStrategy::TYPE_COUPON, $request->coupon_id);

        $totalSaleStrategyIds = array_merge(
            $productSaleStrategyIds, 
            $shopSaleStrategyIds,
            $orderSaleStrategyIds,
            $couponSaleStrategyIds
        );

        // Calculate sum, discount, total
        $caclOrder = $this->orderService->calculate($carts, $totalSaleStrategyIds);

        $result = [
            'caclOrder' => $caclOrder,
            'product_strategies' => $productSaleStrategyIds,
            'shop_strategies' => $shopSaleStrategyIds,
            'order_strategies' => $orderSaleStrategyIds,
            'coupon_strategies' => $couponSaleStrategyIds,
        ];

        return $this->customResponseService->apiResponse(200, 'success', $result);
    }
}