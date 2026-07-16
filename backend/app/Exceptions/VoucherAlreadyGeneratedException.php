<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class VoucherAlreadyGeneratedException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'errors' => [
                'flightNumber' => [
                    $this->getMessage(),
                ],
            ],
        ], 409);
    }
}