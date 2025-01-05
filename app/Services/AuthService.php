<?php

namespace App\Services;

use App\Models\User;
use App\Http\Resources\Api\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        return User::create($data);
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email_phone'])
                    ->orWhere('phone', $data['email_phone'])
                    ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        return $user;
    }

    public function loginWithoutPassword(array $data)
    {
        $user = User::where('email', $data['email_phone'])
                    ->orWhere('phone', $data['email_phone'])
                    ->first();

        if (!$user || $user->code != $data['code']) {
            return null;
        }

        return $user;
    }

    public function verifyOtp(array $data)
    {
        $user = User::where('email', $data['email_phone'])
                    ->orWhere('phone', $data['email_phone'])
                    ->first();

        if (!$user || !$this->isCodeCorrectForLogin($user, $data['code'])) {
            return null;
        }

        return $user;
    }

    public function activate(array $data)
    {
        $user = User::where('phone', $data['phone'])->first();

        if ($user && $user->code == $data['code']) {
            return $user->markAsActive()->login();
        }

        return null;
    }

    public function logout($user, string $deviceId)
    {
        $user->devices()->where('device_id', $deviceId)->delete();
        $user->logout();
    }

    public function resetPassword($user, string $password)
    {
        $user->update(['password' => $password]);
        return $user;
    }

    public function updatePassword($user, string $oldPassword, string $newPassword)
    {
        if (!Hash::check($oldPassword, $user->password)) {
            return false;
        }

        $user->update(['password' => $newPassword]);
        return true;
    }

    public function otpForPhoneOrMail(string $emailPhone)
    {
        $user = User::where('email', $emailPhone)
                    ->orWhere('phone', $emailPhone)
                    ->first();

        if (!$user) {
            return null;
        }

        if ($user->email === $emailPhone) {
            $user->sendVerificationMail();
        } else {
            $user->sendVerificationCode();
        }

        return $user;
    }

    public function activateByGeneralCode(array $data)
    {
        $user = User::where('email', $data['email_phone'])
                    ->orWhere('phone', $data['email_phone'])
                    ->first();

        if (!$user || $user->code != $data['code'] || $user->verfiy_token != $data['verfiy_token']) {
            return null;
        }

        return $user->login();
    }

    public function approveAccount(string $phone)
    {
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return null;
        }

        $user->update(['is_approved' => 1]);
        return $user;
    }

    private function isCodeCorrectForLogin($user, $code): bool
    {
        return $user && $user->code == $code;
    }
}
