<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AddressResource;
use App\Models\Address;
use App\Repositories\IAddressRepository;
use App\Requests\Api\Orders\AddressRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        IAddressRepository $IAddress
    )
    {
        $this->userId           = user()?->id;
        $this->IAddress = $IAddress;
        $this->data             = [];
    }

    public function index()
    {

        $this->data['shipping_addresses'] = AddressResource::collection($this->IAddress->getAllWhere(['user_id' => $this->userId ],
            ['column' => 'updated_at', 'dir' => 'DESC']));

        return $this->ApiResponse($this->data, __('apis.fetched'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddressRequest $request
     * @return JsonResponse
     */
    public function store(AddressRequest $request)
    {
        $address = $this->IAddress->create($request->validated());

        if ($request->is_default) {
            Address::where('user_id', $this->userId)->where('id', '!=', $address->id)->update(['is_default' => 0]);
        }

        $this->data['shipping_address'] = new  AddressResource($address);

        return $this->ApiResponse($this->data, __('apis.created'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function show(Address $address)
    {
        $addressData = new AddressResource($address);

        return $this->ApiResponse(['shipping_address' => $addressData], __('apis.fetched'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddressRequest $request
     * @param Address $address
     * @return JsonResponse
     */
    public function update(AddressRequest $request, Address $address)
    {
        $address->update($request->validated());

        if ($request->is_default) {
            Address::where('user_id', $this->userId)->where('id', '!=', $address->id)->update(['is_default' => 0]);
        }

        $this->data['shipping_address'] = new  AddressResource($address->refresh());

        return $this->ApiResponse($this->data, __('apis.updated'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy(Address $address)
    {
        if ($address->user_id != user()->id) {
            return $this->unauthorizedReturn(null);
        }

        $address->update([ 'is_default' => 0]);

        return $this->ApiResponse(null, __('apis.deleted'), 200);
    }
}
