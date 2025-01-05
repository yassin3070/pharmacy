<?php

namespace App\Requests\Api\Auth;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use App\Requests\ApiMasterRequest;
use Illuminate\Foundation\Http\FormRequest;


class RegisterRequest extends FormRequest {

    public function rules() {

        return [

            'name'                  => 'required|max:255',
            'phone'                 => 'required|phone_number|unique:users,phone',
            'email'                 => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
            'device_id'             => 'required|max:250',
            'device_type'           => 'required|in:ios,android,web',
            'image'                 => 'nullable|image',
            'password'              => 'required|max:191|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
            'password_confirmation' => 'required|same:password',

        ];
    }
}
