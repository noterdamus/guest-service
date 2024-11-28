<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function success($data = []): JsonResponse
    {
        return response()->json($data);
    }
}
