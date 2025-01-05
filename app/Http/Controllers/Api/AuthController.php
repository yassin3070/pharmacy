<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Requests\Api\Auth\RegisterRequest;
use App\Requests\Api\Auth\LoginRequest;
use App\Requests\Api\Auth\ActivateRequest;
use App\Requests\Api\Auth\LoginWithoutPasswordRequest;
use App\Requests\Api\Auth\ChangePasswordRequest;
use App\Requests\Api\Auth\SendOtpRequest;
use App\Requests\Api\Auth\ResetPasswordRequest;
use App\Requests\Api\Auth\ActivateByGeneralRequest;
use App\Requests\Api\Auth\ApproveRequest;
use App\Traits\ApiResponseTrait;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponseTrait;

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->authService->register($request->validated());
            return $this->ApiResponse(['user' => $user], __('apis.registered'), 200);
        } catch (\Exception $e) {
            Log::error('Error in register', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->authService->login($request->validated());
            if (!$user) {
                return $this->ApiResponse(null, __('auth.failed'), 400);
            }
            return $this->ApiResponse(['user' => $user->login()], __('auth.signed'), 200);
        } catch (\Exception $e) {
            Log::error('Error in login', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function loginWithoutPassword(LoginWithoutPasswordRequest $request)
    {
        try {
            $user = $this->authService->loginWithoutPassword($request->validated());
            if (!$user) {
                return $this->ApiResponse(null, __('auth.code_invalid'), 400);
            }
            return $this->ApiResponse(['user' => $user->login()], __('auth.signed_in'), 200);
        } catch (\Exception $e) {
            Log::error('Error in loginWithoutPassword', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'email_phone' => 'required|string',
                'code' => 'required|string',
            ]);
            $user = $this->authService->verifyOtp( $validated );
            if (!$user) {
                return $this->ApiResponse(null, __('auth.code_invalid'), 400);
            }
            return $this->ApiResponse(['user' => $user], __('auth.otp_verified'), 200);
        } catch (\Exception $e) {
            Log::error('Error in verifyOtp', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function activate(ActivateRequest $request)
    {
        try {
            $user = $this->authService->activate($request->validated());
            if (!$user) {
                return $this->ApiResponse(null, __('auth.code_invalid'), 400);
            }
            return $this->ApiResponse(['user' => $user], __('auth.activated'), 200);
        } catch (\Exception $e) {
            Log::error('Error in activate', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = Auth::guard('sanctum')->user();
            $this->authService->logout($user, $request->device_id);
            return $this->ApiResponse(null, __('apis.loggedOut'), 200);
        } catch (\Exception $e) {
            Log::error('Error in logout', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $user = Auth::guard('sanctum')->user();
            $this->authService->resetPassword($user, $request->password);
            return $this->ApiResponse(null, __('apis.updated'), 200);
        } catch (\Exception $e) {
            Log::error('Error in resetPassword', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        try {
            $user = Auth::guard('sanctum')->user();
            $success = $this->authService->updatePassword($user, $request->old_password, $request->password);
            if (!$success) {
                return $this->ApiResponse(null, __('auth.password_incorrect'), 400);
            }
            return $this->ApiResponse(null, __('apis.updated'), 200);
        } catch (\Exception $e) {
            Log::error('Error in updatePassword', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function OtpForPhoneOrMail(SendOtpRequest $request)
    {
        try {
            $user = $this->authService->otpForPhoneOrMail($request->email_phone);
            if (!$user) {
                return $this->ApiResponse(null, __('auth.user_not_found'), 404);
            }
            return $this->ApiResponse(null, __('auth.code_sent'), 200);
        } catch (\Exception $e) {
            Log::error('Error in OtpForPhoneOrMail', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function OtpForPhone(SendOtpRequest $request)
    {
        $user = User::query()->firstOrCreate(['phone' => $request['email_phone']]);

        if ($user->name) {
            $this->data['new'] = false;
        } else {
            $this->data['new'] = true;
        }

        $user->sendVerificationCode();

        $this->data['verfiy_token'] = $user->verfiy_token;

        return $this->ApiResponse($this->data, __('auth.code_sent'), 200);
    }


    public function activateByGeneralCode(ActivateByGeneralRequest $request)
    {
        try {
            $user = $this->authService->activateByGeneralCode($request->validated());
            if (!$user) {
                return $this->ApiResponse(null, __('auth.code_invalid'), 400);
            }
            return $this->ApiResponse(['user' => $user], __('auth.activated'), 200);
        } catch (\Exception $e) {
            Log::error('Error in activateByGeneralCode', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }

    public function approveAccount(ApproveRequest $request)
    {
        try {
            $user = $this->authService->approveAccount($request->phone);
            if (!$user) {
                return $this->ApiResponse(null, __('auth.failed'), 400);
            }
            return $this->ApiResponse(new UserResource($user), __('auth.activated'), 200);
        } catch (\Exception $e) {
            Log::error('Error in approveAccount', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);
        }
    }
}
