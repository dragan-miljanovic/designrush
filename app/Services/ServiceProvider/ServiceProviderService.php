<?php

namespace App\Services\ServiceProvider;

use App\Models\ServiceProvider;
use App\Repositories\Contracts\ServiceProviderRepositoryInterface;
use App\Services\Cache\Contracts\CacheServiceInterface;
use App\Services\ServiceProvider\Contracts\ServiceProviderServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceProviderService implements ServiceProviderServiceInterface
{
    public function __construct(
        private ServiceProviderRepositoryInterface $serviceProviderRepository,
        private CacheServiceInterface $cacheService,
    ) {}

    public function find(int $id, array $relations = null): ServiceProvider
    {
        $cacheKey = $this->cacheService->generateCacheKey('service_provider', [$id, $relations]);

        return $this->cacheService->remember($cacheKey, 3600, function () use ($id, $relations) {
            return $this->serviceProviderRepository->find($id, $relations);
        });
    }

    public function findAllWithPagination(int $number, int $page, array $filters = null): LengthAwarePaginator
    {
        $params = ['number' => $number, 'page' => $page, 'filters' => $filters];
        $cacheKey = $this->cacheService->generateCacheKey('service_provider_paginated', $params);

        return $this->cacheService->remember($cacheKey, 3600, function () use ($number, $filters) {
            return $this->serviceProviderRepository->findAllWithPagination($number, $filters);
        });
    }
}
