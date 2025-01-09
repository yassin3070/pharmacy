<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CouponNotValidException extends Exception {
    public function __construct(string $message = null, int $code = 0, ?Throwable $previous = null)
    {
        isset($message) ??  __('apis.coupon_errors.not_valid');
        parent::__construct($message, $code, $previous);
    }
}
