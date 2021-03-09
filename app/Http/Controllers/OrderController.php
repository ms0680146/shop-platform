<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\CustomResponseService;

class OrderController extends Controller
{
    public function __construct(CustomResponseService $customResponseService)
    {
        $this->customResponseService = $customResponseService;
    }

    // 試算訂單金額
    public function caclOrder(Request $request)
    {
        $user = Auth::user();
        $shoppingCart = $user->shoppingCart;

        if (is_null($shoppingCart)) {
            return $this->customResponseService->apiResponse(404, 'not found', 'Nothing in shopping cart');
        }

        return $this->customResponseService->apiResponse(200, 'success', $data);
    }
}