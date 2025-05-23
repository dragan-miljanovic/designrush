<?php

namespace App\Services\Category\Contracts;

use Illuminate\Support\Collection;

interface CategoryServiceInterface
{
    public function findAll(array $relations = null): Collection;
}
