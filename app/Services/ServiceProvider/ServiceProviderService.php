<?php

namespace App\Services\ServiceProvider;

use App\Models\ServiceProvider;
use App\Repositories\Contracts\ServiceProviderRepositoryInterface;
use App\Services\ServiceProvider\Contracts\ServiceProviderServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceProviderService implements ServiceProviderServiceInterface
{
    public function __construct(
        private ServiceProviderRepositoryInterface $serviceProviderRepository,
    ){
        //
    }

    public function find(int $id, array $relations = null): ServiceProvider
    {
        /** @var ServiceProvider $serviceProvider */
        $serviceProvider = $this->serviceProviderRepository->find($id, $relations);

        return $serviceProvider;
    }

    public function findAllWithPagination(int $number, array $filters = null): LengthAwarePaginator
    {
        return $this->serviceProviderRepository->findAllWithPagination($number, $filters);
    }
}
