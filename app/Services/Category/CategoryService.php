<?php

namespace App\Services\Category;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\Cache\Contracts\CacheServiceInterface;
use App\Services\Category\Contracts\CategoryServiceInterface;
use Illuminate\Support\Collection;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private CacheServiceInterface $cacheService,
    ){
        //
    }

    public function findAll(array $relations = null): Collection
    {
        return $this->cacheService->remember('categories.all', 3600, function () use ($relations) {
            return $this->categoryRepository->findAll($relations);
        });
    }
}
