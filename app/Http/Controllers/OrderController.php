<?php

namespace App\Http\Controllers;

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
        $user = Auth::user();
        $shoppingCart = $user->shoppingCart;

        if (is_null($shoppingCart)) {
            return $this->customResponseService->apiResponse(400, 'bad request', 'user do not have shopping cart');
        }

        $carts = $shoppingCart->carts;
        if (is_null($carts)) {
            return $this->customResponseService->apiResponse(404, 'not found', 'Nothing in shopping cart');
        }

        // Get sale strategy (product, shop, order)
        $saleStrategyIds = $this->saleStrategyService->getSaleStrategies($carts);
        // Calculate sum, discount, total
        $caclOrder = $this->orderService->calculate($carts, $saleStrategyIds);

        $result = [
            'caclOrder' => $caclOrder,
            'saleStrategyIds' => $saleStrategyIds
        ];

        return $this->customResponseService->apiResponse(200, 'success', $result);
    }
}