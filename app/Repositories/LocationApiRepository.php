<?php

namespace App\Repositories;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use App\Repositories\Contracts\ApiContract;

class LocationApiRepository implements ApiContract
{
    /**
     * @var string
     */
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5/';

    /**
     * Searches for a location
     * 
     * @param string[]
     * @return \Illuminate\Http\Response|[]
     */
    public function forecast(array $data): Response|array
    {
        $city = $data['city'] ?? '';
        $country = $data['country'] ?? '';
        $endpoint = 
            $this->baseUrl . 
            "weather?q={$city},{$country}" . 
            $this->id();

        $response = Http::get($endpoint)
            ->json();
    
        return $response ?? [];
    }

    private function id(): string
    {
        return '&APPID=' . Config::get('openweather.key');
    }
}