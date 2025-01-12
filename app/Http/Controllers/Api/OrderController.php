<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Repositories\IClothRepository;
use App\Repositories\IOrderRepository;
use App\Requests\Api\Orders\AddToCartRequest;
use App\Requests\Api\Orders\ProcessOrderRequest;
use App\Requests\Api\Orders\RemoveItemFromOrderRequest;
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

    public function myOrders()
    {

        $orders = user()->orders() ;
        if(\request()->type == 'past'){
            $orders = $orders->where('delivery_date','<',now());
        }else{
            $orders = $orders->where('delivery_date','>=',now());
        }
        return $this->ApiResponse(OrderResource::collection($orders), __('apis.fetched'), 200);
    }
    public function getOrder($id)
    {
        $order = Order::findOrFail($id);
        if($order->user_id != user()->id){
            return $this->ApiResponse(null, __('apis.error_occurred'), 500);

        }
        return $this->ApiResponse(new OrderResource($order), __('apis.fetched'), 200);
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
        $validated['status']  = Order::STATUSES['in_cart'];

        if (!isset($cart)) {
            $cart = Order::create($validated);
        }
        $cart = $this->orderService->addItemToOrder($cart->id, $validated);

        $this->data['cart'] = new OrderResource($cart->refresh());
        return $this->ApiResponse($this->data, __('apis.cart_created'), 200);
    }

    public function removeItemFromOrder(RemoveItemFromOrderRequest $request)
    {
        $cart               = user()->cart;
        $cart               = $this->orderService->removeItemFromOrder($cart->id, $request->order_item_id);
        if ($cart->items()->count()== 0){
            $cart->delete();
        }
        $this->data['cart'] = new OrderResource($cart->refresh());
        return $this->ApiResponse($this->data, __('apis.deleted'), 200);
    }

    public function clearCart(Request $request)
    {
        user()?->cart?->delete();

        return $this->ApiResponse($this->data, __('apis.deleted'), 200);
    }
    public function proceedOrder(ProcessOrderRequest $request)
    {
        /** @var Order $order */
        $order = user()->cart;
        if (!$order || $order->items->isEmpty()) {
            return $this->ApiResponse($this->data, __('apis.empty_cart'), 400);
        }
        $allItemsValid = $order->items->every(function ($item) {
            return $item->need_recipe == 0;
        });
        if (!$allItemsValid) {
            return $this->ApiResponse($this->data, __('apis.some_items_need_recipe'), 400);
        }
        $order               = $this->orderService->proceedOrder($order->id, $request->validated());
//        OrderNotification::notifyProvider($order,'new-order');
        $this->data['order'] = new OrderResource($order->refresh());
        return $this->ApiResponse($this->data, __('apis.updated'), 200);
    }

    public function uploadItemRecipe(Request $request ,$orderItemId)
    {
        $request->validate([
            'recipe'=> 'required|file|mimes:jpeg,jpg,png,gif'
        ]);
        $item = OrderItem::findOrFail($orderItemId);
        $item->recipe = $request->file('recipe');
        $item->recipe_status = OrderItem::RECIPE_STATUS['pending'];
        $item->save();
        return $this->ApiResponse($this->data, __('apis.updated'), 200);

    }
}
