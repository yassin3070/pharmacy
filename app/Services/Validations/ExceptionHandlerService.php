<?php

namespace App\Services\Validations;

use App\Exceptions\CouponExpiredException;
use App\Exceptions\CouponNotValidException;
use App\Exceptions\CouponUsageLimitExceededException;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ExceptionHandlerService
{
    use ApiResponseTrait;
    public function handle(\Exception $e): JsonResponse
    {
        return match (true) {
            $e instanceof CouponExpiredException,
                $e instanceof CouponUsageLimitExceededException,
                $e instanceof CouponNotValidException => $this->ApiResponse(null, $e->getMessage(), 400),
            $e instanceof ModelNotFoundException      => $this->ApiResponse(null, $e->getMessage(), 404),
            default                                   => $this->ApiResponse(null, __('apis.errors.unexpected'), 500),
        };
    }
}
