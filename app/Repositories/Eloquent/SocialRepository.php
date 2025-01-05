<?php

namespace App\Repositories\Eloquent;

use App\Models\Social;
use App\Repositories\ISocialRepository;
use App\Repositories\Eloquent\BaseRepository;

class SocialRepository extends BaseRepository implements ISocialRepository
{
    public function __construct()
    {
        $this->model = new Social();
    }
    
}