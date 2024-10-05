<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Response;

interface ApiContract
{
    /**
     * Searches for a location
     * 
     * @param string[]
     * @return \Illuminate\Http\Response|[]
     */
    public function forecast(array $data): Response|array;
}