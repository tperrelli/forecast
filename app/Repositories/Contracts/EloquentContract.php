<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface EloquentContract
{
    /**
     * Searches for a location
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): Collection;

    /**
     * Finds a record by user id
     * 
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByUser(int $userId): Collection;
}