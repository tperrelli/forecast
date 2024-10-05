<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    protected function query()
    {
        return $this->model::query();
    }

    /**
     * Gets all application resources
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): Collection
    {
        return $this->query()->all();
    }

    /**
     * Finds an application resource
     * 
     * @param int
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function findById(int $id): Model
    {
        return $this->query()->findOrFail($id);
    }

    /**
     * Stores an application resource
     * 
     * @param array $data
     * @return bool
     */
    public function store(array $data): bool
    {
        $model = $this->query()->getModel()->newInstance();

        $model->fill($data);

        return $model->save();
    }

    /**
     * Updates an application resource
     * 
     * @param Illuminate\Database\Eloquent\Model
     * @param array $data;
     */
    public function update(Model $model, array $data): Model
    {
        $model->fill($data);
        
        $model->save();

        return $model;
    }

    /**
     * Deletes an application resource
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->query()->where('id', $id)->delete();
    }

    /**
     * Counts all records
     * 
     * @param int $userId
     * @return int
     */
    public function totalByUser(int $userId): int
    {
        return $this->query()->where('user_id', $userId)->count();
    }
}