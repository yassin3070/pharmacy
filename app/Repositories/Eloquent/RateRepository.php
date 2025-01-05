<?php

namespace App\Repositories\Eloquent;

use App\Models\Rate;
use App\Repositories\IRateRepository;
use App\Repositories\Eloquent\BaseRepository;

class RateRepository extends BaseRepository implements IRateRepository
{
    public function __construct()
    {
        $this->model = new Rate();
    }
    
}