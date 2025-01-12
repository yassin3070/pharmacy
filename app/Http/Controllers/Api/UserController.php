<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserTypeResource;
use App\Http\Resources\Api\UserResource;
use App\Requests\Api\Auth\UpdateProfileRequest;
use App\Requests\Api\ContactRequest;
use App\Models\User;
use App\Models\UserType;
use App\Models\Contact;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;


    /**
     * Retrieve the authenticated user's profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(Request $request)
    {
        try {
            $user = auth()->user();
            $token = ltrim($request->header('authorization'), 'Bearer ');
            $userData = UserResource::make($user)->setToken($token);

            return $this->ApiResponse(['user' => $userData], null, 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $user = auth()->user();
            $user->update($request->validated());

            return $this->ApiResponse(['user' => new UserResource($user->refresh())], __('apis.updated'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Change the application's language for the authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeLang(Request $request)
    {
        try {
            $user = auth()->user();
            $lang = in_array($request->lang, languages()) ? $request->lang : 'ar';

            $user->update(['lang' => $lang]);
            \App::setLocale($lang);

            return $this->ApiResponse(null, __('apis.lang_updated'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Toggle notification status for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchNotificationStatus()
    {
        try {
            $user = auth()->user();
            $user->update(['is_notify' => !$user->is_notify]);

            return $this->ApiResponse(['notify' => (bool)$user->refresh()->is_notify], __('apis.updated'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    /**
     * Retrieve user types for the application.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userTypes()
    {
        try {
            // Retrieve user types with specific IDs
            $user_types = UserType::whereIn('id', [2, 3])->get();
            return $this->ApiResponse(UserTypeResource::collection($user_types), __('apis.fetched'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }

    public function sendContactMessage(ContactRequest $request)
    {
        try {

            $contact = Contact::create([
                'user_id' => \Auth::user()->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'message' => $request->message,
            ]);

            return $this->ApiResponse($contact, __('apis.sent'), 201);
        } catch (\Exception $e) {
            Log::error('Error sending contact message', ['error' => $e->getMessage()]);
            return $this->ApiResponse(null, __('apis.contact_error'), 500);
        }
    }

    /**
     * Delete the authenticated user's account.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAccount($id)
    {
        try {
            $user = User::find($id);

            // Check if the user exists and is the authenticated user
            if ($user && auth()->id() == $user->id) {
                // Delete associated devices and user
                $user->devices()->delete();
                $user->delete();

                return $this->ApiResponse(null, __('apis.deleted'), 200);
            } else {
                return $this->ApiResponse(null, __('apis.data_not_found'), 404);
            }
        } catch (\Exception $e) {
            return $this->ApiResponse(null, __('apis.error_occurred'), 500, $e->getMessage());
        }
    }
}
