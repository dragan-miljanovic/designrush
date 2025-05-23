<?php

namespace App\Repositories;

use App\Models\ServiceProvider;
use App\Repositories\Contracts\ServiceProviderRepositoryInterface;

class ServiceProviderRepository extends BaseRepository implements ServiceProviderRepositoryInterface
{
    public function __construct(ServiceProvider $model) {
        parent::__construct($model);
    }
}
