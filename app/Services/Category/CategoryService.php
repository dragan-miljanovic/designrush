<?php

namespace App\Services\Category;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\Category\Contracts\CategoryServiceInterface;
use Illuminate\Support\Collection;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
    ){
        //
    }

    public function findAll(array $relations = null): Collection
    {
        return $this->categoryRepository->findAll($relations);
    }
}
