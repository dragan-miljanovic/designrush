<?php

namespace App\Services\ServiceProvider\Contracts;

use App\Models\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceProviderServiceInterface
{
    public function find(int $id, array $relations = null): ServiceProvider;

    public function findAllWithPagination(int $number, int $page, array $filters = null): LengthAwarePaginator;
}
