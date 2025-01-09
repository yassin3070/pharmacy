<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CouponUsageLimitExceededException extends Exception {
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message != '' ??  __('apis.coupon_errors.usage_limit');
        parent::__construct($message, $code, $previous);
    }
}
