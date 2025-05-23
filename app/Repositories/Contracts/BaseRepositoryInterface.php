<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function find(int $id, array $relations = null): ?Model;

    public function findAll(array $relations = null): Collection;
}
