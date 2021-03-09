<?php

namespace App\Services;

class CustomResponseService
{
    public function apiResponse($code, $message, $data = null)
    {
        return response()->make([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
