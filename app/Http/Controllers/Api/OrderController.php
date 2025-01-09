<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Models\Product;
use App\Models\User;
use App\Repositories\IClothRepository;
use App\Repositories\IOrderRepository;
use App\Requests\Api\Orders\AddToCartRequest;
use App\Services\Order\CouponService;
use App\Services\Order\OrderService;
use App\Services\Validations\ExceptionHandlerService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var IOrderRepository
     */
    protected $orderRepository;


    /**
     * @var OrderService
     */
    protected $orderService;



    /**
     * @var ExceptionHandlerService
     */
    protected $exceptionHandlerService;

    /**
     * @var array
     */
    protected $data;

    /**
     * OrderController constructor.
     *
     * @param IOrderRepository $orderRepository
     */
    public function __construct(
        IOrderRepository        $orderRepository,
        OrderService            $orderService,
        ExceptionHandlerService $exceptionHandlerService,

    )
    {
        $this->orderRepository         = $orderRepository;
        $this->orderService            = $orderService;
        $this->exceptionHandlerService = $exceptionHandlerService;
        $this->data                    = [];
    }
    public function getCart(Request $request)
    {
        $cart               = user()->cart;
        $this->data['cart'] = null;
        if ($cart && !$cart->items->isEmpty()) {
            $cart->load('items');
            $this->data['cart'] = new OrderResource($cart);
        }

        return $this->ApiResponse($this->data, __('apis.fetched'), 200);
    }

    public function addToCart(AddToCartRequest $request)
    {

        $cart = user()?->cart;
        $validated = $request->validated();
        $validated['order_id'] = $cart?->id;
        $validated['user_id'] = auth()->id();

        if (isset($cart)) {
            // if yes, add the item to the order
            $cart = $this->orderService->addItemToOrder($cart->id, $validated);
        } else {
            $cart = $this->orderService->createOrder($validated);
        }

        $this->data['cart'] = new OrderResource($cart->refresh());
        return $this->ApiResponse($this->data, __('apis.cart_created'), 200);
    }

}
