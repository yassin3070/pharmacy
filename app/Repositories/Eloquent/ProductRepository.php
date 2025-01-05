<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\IProductRepository;
use App\Repositories\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    public function __construct()
    {
        $this->model = new Product();
    }
    
}