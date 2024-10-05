<?php

namespace App\Repositories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\EloquentContract;

class LocationEloquentRepository extends Repository implements EloquentContract
{
    protected $model = Location::class;

    /**
     * Searches for a location
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): Collection
    {
        $scope = $this->query();
        
        return $scope->get();
    }
    
    /**
     * Finds a record by user id
     * 
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByUser(int $userId): Collection
    {
        $scope = $this->query();
        $scope->where('user_id', $userId);

        return $scope->get();
    }
}