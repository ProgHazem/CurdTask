<?php
namespace App\Repositories;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class BaseRepository implements BaseRepositoryInterface
{
    
    public function __construct(private Model $model)
    {}

    public function create($data): Model
    {
        Log::info("Model", ["model" => $this->model]);
        return $this->model->create($data);
    }

    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function findWithoutFail($id): ?Model
    {
        return $this->model->find($id);
    }

    public function update($data)
    {
        return $this->model->update($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function paginate($per_page): LengthAwarePaginator
    {
        return $this->model->paginate($per_page);
    }

    public function listFiltered($filters)
    {
        return $this->model->queryFilter($filters);
    }

    public function filter($filters): Collection
    {
        return $this->model->where($filters);
    }

    public function updateOrCreate($oldData, $newData)
    {
        return $this->model->updateOrCreate($oldData, $newData);
    }

    public function firstOrCreate($data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        return $this->model->where($column, $operator, $value, $boolean);
    }

    public function whereIn($columnName, $columnValues)
    {
        return $this->model->whereIn($columnName, $columnValues);
    }

    public function whereHas($relation, Closure $callback = null, $operator = '>=', $count = 1)
    {
        return $this->model->whereHas($relation, $callback, $operator, $count);
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function first()
    {
        return $this->model->first();
    }

    public function firstOrFail()
    {
        return $this->model->firstOrFail();
    }

    public function getFirstModelWhere($columnName, $columnValue)
    {
        return $this->model->firstWhere($columnName, $columnValue);
    }

    public function getFilteredRelationToQuery(Builder $modelQuery, $relationName, $columnName, $columnValue)
    {
        return $modelQuery->whereHas($relationName, function ($query) use ($columnName, $columnValue) {
            $query->where($columnName, $columnValue);
        })
            ->with($relationName, function ($query) use ($columnName, $columnValue) {
                $query->where($columnName, $columnValue);
            });
    }

    public function query()
    {
        return $this->model->newQuery();
    }
}