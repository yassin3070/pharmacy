<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;

class PhoneNumberRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = $phoneUtil->parse($value, null);
            return $phoneUtil->isValidNumber($phoneNumber);
        } catch (NumberParseException $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid phone number.';
    }
}
