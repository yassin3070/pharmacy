<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CouponExpiredException extends Exception {
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message != '' ??  __('apis.coupon_errors.expired');
        parent::__construct($message, $code, $previous);
    }
}
