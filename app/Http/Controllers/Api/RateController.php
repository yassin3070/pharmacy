<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RateResource;
use App\Models\Rate;
use App\Notifications\RateNotification;
use App\Repositories\IRateRepository;
use App\Requests\Api\Orders\RateProductRequest;
use App\Requests\Api\Orders\RateSearchRequest;
use App\Traits\ApiResponseTrait;
use Arr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RateController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        IRateRepository $IrateRepository,
    )
    {
        $this->user            = user();
        $this->IrateRepository = $IrateRepository;
        $this->data            = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(RateSearchRequest $request)
    {
        $ratesQuery = Rate::query()->approved();

        // Fetch the average rate
        $this->data['rate'] = $ratesQuery->avg('rate'); // Replace 'rating' with the actual column for the rate value in your Rate model

        // Fetch the total count of rates
        $this->data['rate_count'] = $ratesQuery->count();

        // Fetch the total count of rates with comments
        $this->data['comment_count'] = $ratesQuery->whereNotNull('comment')->count();

        $ratesQuery = $ratesQuery->with('user')
                                 ->where('product_id', $request->input('product_id'))
                                 ->whereNotNull('comment');

        // Paginate the results
        $rates = $ratesQuery->paginate(per_page());

        // Format rates and metadata
        $this->data['rates'] = RateResource::collection($rates);
        $this->data['meta']  = Arr::except($rates->toArray(), ['data']);

        return $this->ApiResponse($this->data, __('apis.fetched'), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param RateProductRequest $request
     * @return JsonResponse
     */
    public function store(RateProductRequest $request)
    {
        $validated             = $request->validated() ;
        $validated['user_id']  = auth()->id();

        $rate = $this->IrateRepository->findWhere([
            'product_id' => $request->product_id, 'user_id' => $request->user_id
        ]);

        if ($rate) {
            $rate->update($validated);
        } else {
            // create the rate
            $rate = $this->IrateRepository->create($validated);
        }

//        $rate->load('store.provider');
        // notify  provider
//        $this->notifyRatedUser($rate, $rate->store?->provider);

        $this->data['rate'] = new RateResource($rate);
        return $this->ApiResponse($this->data, __('apis.model_created', ['model' => __('dashboard.rate')]), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Rate $rate
     * @return JsonResponse
     */
    public function update(Request $request, Rate $rate)
    {
        //
    }

    public function notifyRatedUser($rate, $user)
    {
        $tokens    = $user->devices->pluck('device_id')->toArray();
        $platforms = $user->devices->pluck('device_type')->toArray();
        $user->notify(new RateNotification($rate, $tokens, $platforms));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rate $rate
     * @return JsonResponse
     */
    public function destroy(Rate $rate)
    {
        if ($rate->author_id != $this->user->id) {
            return $this->unauthorizedReturn(null);
        }

        $rate->delete();

        return $this->ApiResponse(null, __('apis.model_deleted', ['model' => __('dashboard.rate')]), 200);

    }
}
