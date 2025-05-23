<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find(int $id, array $relations = null): ?Model
    {
        $query = $this->model->query();

        if ($relations) {
            $query->with($relations);
        }

        return $query->find($id);
    }

    public function findAllWithPagination(int $int, array $filters = null): LengthAwarePaginator
    {
        $query = $this->model->query();

        if (!empty($filters)) {
            $query->where($filters);
        }

        return $query->paginate($int);
    }

    public function findAll(array $relations = null): Collection
    {
        $query = $this->model->query();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->get();
    }
}
