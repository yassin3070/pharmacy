<?php

namespace App\Repositories\Eloquent;

use App\Models\OrderItem;
use App\Repositories\IOrderItemRepository;
use App\Repositories\Eloquent\BaseRepository;

class OrderItemRepository extends BaseRepository implements IOrderItemRepository
{
    public function __construct()
    {
        $this->model = new OrderItem();
    }
    
}