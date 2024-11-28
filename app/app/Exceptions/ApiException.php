<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiException extends Exception
{
    public function render(): JsonResponse
    {
        $code = $this->getCode();
        return response()->json(['error' => $this->getMessage()], !empty($code) ? $code : 400);
    }
}
