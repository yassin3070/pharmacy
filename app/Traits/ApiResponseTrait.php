<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


trait ApiResponseTrait {
    public $paginateNumber = 10;

    public function ApiResponse($data = null, $message = null, $code = 200) {
        $array =
            [
            'status'  => in_array($code, $this->successCode()) ? true : false,
            'message' => $message,
            'data'    => $data,       
        ];

        return response()->json($array, $code);
    }

    /**
     * Paginated API response structure.
     *
     * @param ResourceCollection $resourceCollection
     * @param string|null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function ApiPaginatedResponse(AnonymousResourceCollection $resourceCollection, $message = null, $status = 200)
    {
        $paginatedData = $resourceCollection->response()->getData(true);

        $pagination = [
            'total' => $paginatedData['total'] ?? $resourceCollection->resource->total(),
            'count' => $paginatedData['to'] ?? $resourceCollection->resource->count(),
            'per_page' => $paginatedData['per_page'] ?? $resourceCollection->resource->perPage(),
            'current_page' => $paginatedData['current_page'] ?? $resourceCollection->resource->currentPage(),
            'total_pages' => $paginatedData['last_page'] ?? $resourceCollection->resource->lastPage(),
            'next_page_url' => $paginatedData['last_page'] ?? $resourceCollection->resource->nextPageUrl(),
            'perv_page_url' => $paginatedData['last_page'] ?? $resourceCollection->resource->previousPageUrl(),
        ];

        $response = [
            'status' => in_array($status, [200, 201, 202]) ? true : false,
            'message' => $message,
            'data' => $paginatedData['data'] ?? $resourceCollection->collection,
            'pagination' => $pagination,
        ];

        return response()->json($response, $status);
    }


    public function successCode() {
        return [
            200, 201, 202,
        ];
    }

    public function unauthenticatedReturn() {

        return $this->ApiResponse(null, __('auth.unauthenticated'), 400);
    }

    public function unauthorizedReturn($otherData) {
        return $this->ApiResponse($otherData, __('auth.not_authorized'), 400);
    }

    public function blockedReturn($user) {
        $user->logout();
        return $this->ApiResponse(null, __('auth.blocked'), 400);
    }

    public function phoneActivationReturn($user) {

        $data = $user->sendVerificationCode();

        return $this->ApiResponse(null, __('auth.not_phone_active'), 400);
    }

    public function EmailActivationReturn($user) {

        $data = $user->sendVerificationMail();

        return $this->ApiResponse(null, __('auth.not_email_active'), 400);
    }

    public function NotApprovedReturn($user) {

        return $this->ApiResponse(null, __('auth.not_approved'), 400);
    }

    public function failMessage($msg) {

        return $this->ApiResponse(null, $msg, 400);
    }

    public function CustomeErrorMessage($key , $message) {

        return response()->json([
            'field' => $key,
            'message' => $message,
            'status'  => false
        ] , JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

}
?>