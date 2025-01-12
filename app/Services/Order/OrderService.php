<?php

namespace App\Services\Order;

use App\Models\MeasurementOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use App\Repositories\IOrderItemRepository as OrderItemRepository;
use App\Repositories\IOrderRepository as OrderRepository;
use App\Traits\Distance;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderService
 * @package App\Services\Order
 */
class OrderService
{
//    use Distance;

    protected $orderRepository;
    protected $orderItemRepository;

    protected $couponService;

    /**
     * OrderService constructor.
     * @param OrderRepository $orderRepository
     * @param OrderItemRepository $orderItemRepository
     */
    public function __construct(
        OrderRepository     $orderRepository,
        OrderItemRepository $orderItemRepository,
    )
    {
        $this->orderRepository     = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * Create an order with items.
     * @param array $orderData
     * @return Order
     */
    public function createOrder(array $orderData): Order
    {
        return DB::transaction(function () use ($orderData) {
            // if address_id is null create a new address
//            if (empty($orderData['address_id']) && !empty($orderData['latitude']) && !empty($orderData['longitude'])) {
//                $address                 = User::find($orderData['user_id'])->addresses()->create(['latitude' => $orderData['latitude'], 'longitude' => $orderData['longitude']]);
//                $orderData['address_id'] = $address->id;
//            }

            /** @var Order $order */
            $order = $this->orderRepository->create($orderData);
            $product = Product::findOrFail($orderData['product_id']);
            $total = $product->price * $orderData['quantity'];
            $order->items()->create($orderData + [
                    'status'   => OrderItem::STATUSES['in_cart'],
                    'order_id' => $order->id,
                    'price'    =>$product->price ,
                    'total'    => $total
                ]);

            $this->updateOrderCalculations($order);


            return $order;
        });
    }

    /**
     * Proceed with an order.
     * @param int $orderId
     * @return Order
     */
    public function proceedOrder(int $orderId, $orderData): Order
    {
        return DB::transaction(function () use ($orderId ,$orderData)  {
            /** @var Order $order */
            $order = $this->orderRepository->findOne($orderId);

            $orderData['status'] = Order::STATUSES['pending'];

            $order = $this->updateOrder($orderId, $orderData);
            $this->updateOrderCalculations($order);

//            $order->items()->update(['status' => OrderItem::STATUSES['new']]);


            return $order;
        });
    }


    /**
     * Update order calculations.
     * @param Order $order
     */
    protected function updateOrderCalculations(Order $order)
    {
        return DB::transaction(function () use ($order) {


            $productsPrice = $order->items->sum('total');

            $order->update([
                'total'          => $productsPrice ,
            ]);

        });
    }

    /**
     * Cancel an order.
     * @param int $orderId
     * @return Order
     */
    public function cancelOrder(int $orderId): Order
    {
        return DB::transaction(function () use ($orderId) {
            $order         = $this->orderRepository->findOne($orderId);
            $order->status = Order::STATUSES['canceled'];
            $order->save();

            $order->items()->update(['status' => OrderItem::STATUSES['canceled']]);

            $this->notifyCancellation($order);

            return $order;
        });
    }

    /**
     * Notify providers and customers about the cancellation.
     * @param Order $order
     */
    protected function notifyCancellation(Order $order): void
    {
        // Implement logic to notify the providers and customer about the cancellation
    }

    /**
     * Update an order.
     * @param int $orderId
     * @param array $data
     * @return Order
     */
    public function updateOrder(int $orderId, array $data): Order
    {
        return DB::transaction(function () use ($orderId, $data) {
            $order = $this->orderRepository->findOne($orderId);
            $order->update($data);
            return $order;
        });
    }

    /**
     * Update an order Status.
     * @param int $orderId
     * @param string $status
     * @return Order
     */
    public function updateOrderStatus(int $orderId, string $status): Order
    {
        return DB::transaction(function () use ($orderId, $status) {
            $order     = $this->orderRepository->findOne($orderId);
            $newStatus = Order::STATUSES[$status];
            $order->update(['status' => $newStatus]);
            $order->items()->update(['status' => $newStatus]);
            return $order;
        });
    }

    /**
     * Add an item to an order.
     * @param int $orderId
     * @param array $itemData
     * @return Order
     */
    public function addItemToOrder(int $orderId, array $itemData): Order
    {
        $order = DB::transaction(function () use ($orderId, $itemData) {
            $product = Product::findOrFail($itemData['product_id']);
            if($product->need_recipe == 1){
                $itemData['need_recipe'] = 1 ;
            }
            $itemData['total'] = $itemData['quantity'] * $product->price;
            $itemData['price'] = $product->price;
            $itemData['order_id'] = $orderId;
            /** @var Order $order */
            $order = $this->orderRepository->findOne($orderId);

            $itemBasicData = \Arr::only($itemData, ['order_id','user_id','product_id']);

            $orderItem = $order->items()->updateOrCreate($itemBasicData, $itemData);

            $this->updateOrderCalculations($order);

            return $order;
        });

        return $order->refresh();
    }

    /**
     * Remove an item from an order.
     * @param int $orderId
     * @param int $itemId
     * @return Order
     */
    public function removeItemFromOrder(int $orderId, int $itemId): Order
    {
        return DB::transaction(function () use ($orderId, $itemId) {
            /** @var Order $order */
            $order = $this->orderRepository->findOne($orderId);
            $order->items()->where('id', $itemId)->delete();

            $this->updateOrderCalculations($order);

            return $order;
        });
    }


    /**
     * Get orders by user.
     * @param int $userId
     * @return Collection
     */
    public function getOrdersByUser(int $userId): Collection
    {
        return $this->orderRepository->getWhere(['user_id' => $userId]);
    }

    /**
     * Get orders by user.
     * @param int $branchId
     * @return Collection
     */
    public function getOrdersByBranch(int $branchId): Collection
    {
        return $this->orderRepository->getWhere(['branch_id' => $branchId]);
    }

    public function syncOrderStatusItems(Order $order): void
    {
        $orderItems         = $order->items;
        $orderItemsStatuses = $orderItems?->pluck('status')?->unique();
        $firstItemStatus    = $orderItemsStatuses->first();

        if ($orderItemsStatuses?->count() === 1) {
            $order->status = $firstItemStatus;
        }

        $order->save();
    }


    public function measurementOrderCompleted(Order $order, MeasurementOrder $measurementOrder): void
    {
        $this->updateOrder($order->id, [
            'status'               => Order::STATUSES['preparing'],
            'measurement_order_id' => $measurementOrder->id,
            'measurement_id'       => $measurementOrder->measurement_id
        ]);
    }
}
