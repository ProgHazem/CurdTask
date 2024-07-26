<?php
namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
interface BaseRepositoryInterface
{
    public function create($data) :Model;
    public function find($id) :?Model;
    public function update($data);
    public function destroy($id);
    public function delete($id);
    public function all() :Collection;
    public function filter($filters) :Collection;
    public function updateOrCreate($oldData, $newData);
    public function firstOrCreate($data);
    public function where($column, $operator = null, $value = null, $boolean = 'and');
    public function whereIn($columnName, $columnValues);
    public function with($relations);
    public function first();
    public function getFirstModelWhere($columnName, $columnValue);
    public function query();
}